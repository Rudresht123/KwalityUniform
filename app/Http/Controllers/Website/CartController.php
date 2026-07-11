<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\SuperAdmin\Product as SuperAdminProduct;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    private function getActiveCart()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        // 1. If user is logged in, try to find their active cart first
        if ($userId) {
            $userCart = Cart::where('user_id', $userId)
                ->where('status', 'active')
                ->first();

            if ($userCart) {
                return $userCart;
            }

            // 2. No user cart found, check if there is a guest cart in the session to merge
            $guestCart = Cart::where('session_id', $sessionId)
                ->where('status', 'active')
                ->first();

            if ($guestCart) {
                // Create a new active cart for the user
                $userCart = Cart::create([
                    'cart_id' => Str::uuid(),
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'status' => 'active',
                ]);

                // Move all items from guest cart to user cart
                CartItem::where('cart_id', $guestCart->cart_id)
                    ->update(['cart_id' => $userCart->cart_id]);

                // Mark guest cart as abandoned
                $guestCart->update(['status' => 'abandoned']);

                return $userCart;
            }
        }

        // 3. Fallback: Find active cart by session (for guests) or create new one
        $cart = Cart::where('status', 'active')
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if (!$cart) {
            $cart = Cart::create([
                'cart_id' => Str::uuid(),
                'user_id' => $userId,
                'session_id' => $sessionId,
                'status' => 'active',
            ]);
        }

        return $cart;
    }

    public function count()
    {
        $cart = $this->getActiveCart();
        $count = CartItem::where('cart_id', $cart->cart_id)->sum('quantity');
        return response()->json(['count' => $count]);
    }

    public function index()
    {
        $cart = $this->getActiveCart();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)
            ->with(['product.schoolApprovals.school', 'variant'])
            ->get()
            ->map(function($item) {
                // Attach stock_qty to the item for easier frontend access
                $item->available_stock = $item->variant?->stock_qty ?? 0;
                return $item;
            });

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->unit_price);

        // Determine the primary school for the cart items
        $schools = $cartItems->flatMap(function ($item) {
            return $item->product->schoolApprovals->pluck('school');
        })->unique('school_id');

        $primarySchool = null;
        if ($schools->count() === 1) {
            $primarySchool = $schools->first();
        }

        return view('website.pages.cart', compact('cart', 'cartItems', 'subtotal', 'primarySchool'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $variantId = $request->variant_id ?: null;

        $cart = $this->getActiveCart();
        $product = SuperAdminProduct::findOrFail($request->product_id);
        
        // Stock Validation
        if ($variantId) {
            $variant = ProductVariant::find($variantId);
            if (!$variant) {
                return response()->json(['success' => false, 'message' => 'Selected variant not found.'], 404);
            }
            
            $currentCartQty = CartItem::where('cart_id', $cart->cart_id)
                ->where('product_id', $request->product_id)
                ->where('variant_id', $variantId)
                ->value('quantity') ?? 0;

            if (($currentCartQty + $request->quantity) > $variant->stock_qty) {
                return response()->json([
                    'success' => false, 
                    'message' => "Only {$variant->stock_qty} items available in stock."
                ], 422);
            }
            
            $unitPrice = $variant->selling_price ?? $variant->price ?? $product->base_price ?? 0.00;
        } else {
            $unitPrice = $product->base_price ?? 0.00;
        }

        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $request->product_id)
            ->where('variant_id', $variantId)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
                'unit_price' => $unitPrice,
            ]);
        } else {
            CartItem::create([
                'cart_item_id' => Str::uuid(),
                'cart_id' => $cart->cart_id,
                'product_id' => $request->product_id,
                'variant_id' => $variantId,
                'vendor_id' => $product->vendor_id,
                'quantity' => $request->quantity,
                'unit_price' => $unitPrice,
            ]);
        }

        return response()->json([
            'message' => 'Item added to basket successfully!',
            'cart_count' => CartItem::where('cart_id', $cart->cart_id)->sum('quantity')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = CartItem::findOrFail($request->cart_item_id);
        
        // Stock Validation
        if ($item->variant_id) {
            $variant = ProductVariant::find($item->variant_id);
            if ($variant && $request->quantity > $variant->stock_qty) {
                return response()->json([
                    'success' => false, 
                    'message' => "Only {$variant->stock_qty} items available in stock."
                ], 422);
            }
        }

        $item->update(['quantity' => $request->quantity]);

        $cart = $item->cart;
        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();
        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->unit_price);

        return response()->json([
            'message' => 'Quantity updated',
            'quantity' => $item->quantity,
            'item_total' => $item->quantity * $item->unit_price,
            'subtotal' => $subtotal,
            'total' => $subtotal, // Assuming free shipping as per the current view
        ]);
    }

    public function remove($id)
    {
        CartItem::findOrFail($id)->delete();
        return response()->json(['message' => 'Item removed']);
    }

    public function clear()
    {
        $cart = $this->getActiveCart();
        CartItem::where('cart_id', $cart->cart_id)->delete();
        return response()->json(['message' => 'Basket cleared']);
    }

    public function checkout()
    {
        $cart = $this->getActiveCart();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)
            ->with(['product.schoolApprovals.school', 'variant.size', 'variant.color'])
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/')->with('error', 'Your basket is empty.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->unit_price);

        // Determine the primary school for the cart items
        $schools = $cartItems->flatMap(function ($item) {
            return $item->product->schoolApprovals->pluck('school');
        })->unique('school_id');

        $primarySchool = null;
        if ($schools->count() === 1) {
            $primarySchool = $schools->first();
        }

        // Pass current state to the view so JS can jump to the correct step
        $currentState = session()->has('checkout_details') ? 'confirmation' : 'checkout';

        return view('website.pages.checkout', compact('cart', 'cartItems', 'subtotal', 'primarySchool', 'currentState'));
    }

    public function saveCheckoutDetails(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,upi,card',
            'delivery_type' => 'required|in:school,home',
        ]);

        session()->put('checkout_details', $request->all());

        return response()->json([
            'success' => true,
            'message' => 'Details saved successfully',
            'details' => session('checkout_details')
        ]);
    }

    public function confirmation()
    {
        // Kept for backward compatibility/direct access, but AJAX will use saveCheckoutDetails
        $details = session()->get('checkout_details');
        if (!$details) {
            return redirect()->route('website.checkout');
        }

        $cart = $this->getActiveCart();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)
            ->with(['product', 'variant'])
            ->get();

        if ($cartItems->isEmpty()) {
            session()->forget('checkout_details');
            return redirect('/')->with('error', 'Your basket is empty.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->unit_price);
        $shipping = ($details['delivery_type'] === 'home') ? 0 : 0;

        return view('website.pages.confirmation', compact('cart', 'cartItems', 'subtotal', 'shipping', 'details'));
    }

    public function store(Request $request, \App\Services\OrderService $orderService, \App\Services\InvoiceService $invoiceService)
    {
        $details = session()->get('checkout_details');
        if (!$details) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please enter your details again.'], 422);
        }

        $cart = $this->getActiveCart();

        try {
            // 1. Place the order using the atomic OrderService
            $order = $orderService->placeOrder($cart, $details);

            // 2. Trigger Order Confirmation (Immediate Email with PDF Attachment)
            \Illuminate\Support\Facades\Mail::to($details['email'])->send(new \App\Mail\OrderConfirmedMail($order));

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your order has been placed successfully.',
                'order_number' => $order->order_number,
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Checkout failed: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'cart_id' => $cart->cart_id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false, 
                'message' => $e->getMessage() ?: 'An error occurred while placing your order.'
            ], 422);
        }
    }

    public function success()
    {
        return view('website.pages.success');
    }
}

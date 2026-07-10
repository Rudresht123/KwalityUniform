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

        $cart = $this->getActiveCart();
        $product = SuperAdminProduct::findOrFail($request->product_id);
        
        // Stock Validation
        if ($request->variant_id) {
            $variant = ProductVariant::find($request->variant_id);
            if (!$variant) {
                return response()->json(['success' => false, 'message' => 'Selected variant not found.'], 404);
            }
            
            $currentCartQty = CartItem::where('cart_id', $cart->cart_id)
                ->where('product_id', $request->product_id)
                ->where('variant_id', $request->variant_id)
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
            ->where('variant_id', $request->variant_id)
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
                'variant_id' => $request->variant_id,
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
            ->with(['product.schoolApprovals.school', 'variant'])
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
        $shipping = ($details['delivery_type'] === 'home') ? 8.00 : 0;

        return view('website.pages.confirmation', compact('cart', 'cartItems', 'subtotal', 'shipping', 'details'));
    }

    public function store(Request $request)
    {
        Log::info('Checkout store request data:', $request->all());
        $details = session()->get('checkout_details');
        if (!$details) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please enter your details again.'], 422);
        }

        $cart = $this->getActiveCart();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Your basket is empty.'], 422);
        }

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->unit_price);
        $shipping = ($details['delivery_type'] === 'home') ? 8.00 : 0;
        $grandTotal = $subtotal + $shipping;

        try {
            DB::transaction(function () use ($cart, $cartItems, $subtotal, $shipping, $grandTotal, $details) {
                $deliveryType = match ($details['delivery_type']) {
                    'school' => \App\Enums\DeliveryType::SCHOOL_DELIVERY,
                    'home' => \App\Enums\DeliveryType::HOME_DELIVERY,
                    default => \App\Enums\DeliveryType::SCHOOL_DELIVERY,
                };

                $order = \App\Models\Order::create([
                    'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                    'user_id' => Auth::id(),
                    'cart_id' => $cart->cart_id,
                    'delivery_type' => $deliveryType,
                    'status' => 'pending',
                    'payment_status' => 'pending',
                    'subtotal' => $subtotal,
                    'shipping_charge' => $shipping,
                    'grand_total' => $grandTotal,
                    'placed_at' => now(),
                ]);

                foreach ($cartItems as $item) {
                    $product = $item->product;
                    \App\Models\OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'variant_id' => $item->variant_id,
                        'vendor_id' => $item->vendor_id,
                        'product_name' => $product->product_name,
                        'unit_price' => $item->unit_price,
                        'quantity' => $item->quantity,
                        'line_total' => $item->quantity * $item->unit_price,
                    ]);
                }

                // Clear cart items
                CartItem::where('cart_id', $cart->cart_id)->delete();
            });

            session()->forget('checkout_details');

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your order has been placed successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Order placement failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while placing your order.'], 500);
        }
    }

    public function success()
    {
        return view('website.pages.success');
    }
}

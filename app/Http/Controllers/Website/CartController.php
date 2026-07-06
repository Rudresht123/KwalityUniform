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
use Illuminate\Support\Str;

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

    public function index()
    {
        $cart = $this->getActiveCart();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)
            ->with(['product', 'variant'])
            ->get();

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->unit_price);

        return view('website.pages.cart', compact('cart', 'cartItems', 'subtotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getActiveCart();
        $product = SuperAdminProduct::findOrFail($request->product_id);
        
        // Prioritize: Variant Selling Price -> Variant Price -> Product Base Price -> 0.00
        $unitPrice = 0.00;
        if ($request->variant_id) {
            $variant = ProductVariant::find($request->variant_id);
            if ($variant) {
                $unitPrice = $variant->selling_price ?? $variant->price ?? $product->base_price ?? 0.00;
            } else {
                $unitPrice = $product->base_price ?? 0.00;
            }
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
        $item->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Quantity updated']);
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
}

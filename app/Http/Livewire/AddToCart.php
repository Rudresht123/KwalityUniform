<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AddToCart extends Component
{
    public $productId;
    public $variantId = null;
    public $quantity = 1;
    public $class;


    public function addToCart()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        // 1. Find or create active cart
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

        // 2. Get product price (from variant if available, otherwise product)
        $product = Product::findOrFail($this->productId);
        $unitPrice = $product->base_price;

        if ($this->variantId) {
            $variant = ProductVariant::find($this->variantId);
            if ($variant) {
                $unitPrice = $variant->price ?? $product->base_price;
            }
        }

        // 3. Check if item already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $this->productId)
            ->where('variant_id', $this->variantId)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $this->quantity,
                'unit_price' => $unitPrice, // update price in case it changed
            ]);
        } else {
            CartItem::create([
                'cart_item_id' => Str::uuid(),
                'cart_id' => $cart->cart_id,
                'product_id' => $this->productId,
                'variant_id' => $this->variantId,
                'quantity' => $this->quantity,
                'unit_price' => $unitPrice,
            ]);
        }

        // 4. Notify other components (like CartCounter and CartManager)
        $this->emit('cartUpdated');

        session()->flash('message', 'Item added to basket successfully!');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}

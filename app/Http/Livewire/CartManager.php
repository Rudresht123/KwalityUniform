<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartManager extends Component
{
    public $cart;
    public $cartItems = [];
    public $subtotal = 0;
    public $total = 0;
    public $deliveryFee = 0;
    public $deliveryOption = 'school'; // 'school' or 'home'
    public $addons = [];

    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        // Find or create an active cart for the user or session
        $this->cart = Cart::where('status', 'active')
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if (!$this->cart) {
            $this->cart = Cart::create([
                'cart_id' => Str::uuid(),
                'user_id' => $userId,
                'session_id' => $sessionId,
                'status' => 'active',
            ]);
        }

        $this->cartItems = CartItem::where('cart_id', $this->cart->cart_id)
            ->with(['product', 'variant'])
            ->get();

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->cartItems->sum(function($item) {
            return $item->quantity * $item->unit_price;
        });

        $this->deliveryFee = ($this->deliveryOption === 'home') ? 0 : 0;

        $addonTotal = 0;
        if (isset($this->addons['gift_box'])) {
            $addonTotal += 5.00;
        }
        if (isset($this->addons['labels'])) {
            $addonTotal += 3.50;
        }

        $this->total = $this->subtotal + $this->deliveryFee + $addonTotal;
    }

    public function updateQuantity($itemId, $delta)
    {
        $item = CartItem::find($itemId);
        if (!$item) return;

        $newQuantity = $item->quantity + $delta;

        if ($newQuantity <= 0) {
            $this->removeItem($itemId);
        } else {
            $item->update(['quantity' => $newQuantity]);
        }

        $this->updateCart();
    }

    public function removeItem($itemId)
    {
        CartItem::where('cart_item_id', $itemId)->delete();
        $this->updateCart();
    }

    public function clearCart()
    {
        CartItem::where('cart_id', $this->cart->cart_id)->delete();
        $this->cart->update(['status' => 'abandoned']);
        
        // Create a new active cart for future use
        $this->updateCart();
    }

    public function toggleAddon($addon)
    {
        if (isset($this->addons[$addon])) {
            unset($this->addons[$addon]);
        } else {
            $this->addons[$addon] = true;
        }
        $this->calculateTotals();
    }

    public function setDeliveryOption($option)
    {
        $this->deliveryOption = $option;
        $this->calculateTotals();
    }

    public function render()
    {
        return view('livewire.cart-manager');
    }
}

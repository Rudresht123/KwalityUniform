<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartCounter extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];

    public function render()
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

        $count = $cart ? CartItem::where('cart_id', $cart->cart_id)->sum('quantity') : 0;

        return view('livewire.cart-counter', ['count' => $count]);
    }
}

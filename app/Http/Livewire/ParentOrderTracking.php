<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Shipment;

class ParentOrderTracking extends Component
{
    public function render()
    {
        $userId = auth()->id();

        return view('livewire.parent.order-tracking', [
            'orders' => Order::where('user_id', $userId)
                ->with(['shippingAddress', 'shipments'])
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }
}

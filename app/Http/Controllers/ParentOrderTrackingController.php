<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ParentOrderTrackingController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)
            ->with(['shippingAddress', 'shipments'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('parent.order-tracking', compact('orders'));
    }
}

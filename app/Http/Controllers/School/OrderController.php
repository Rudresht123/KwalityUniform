<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    public function index()
    {
        $schoolId = Auth::user()->school_id;

        // Fetch orders where items are linked to the school's products
        $orders = Order::whereHas('items.product.schoolApprovals', function($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with(['items.product', 'user'])->latest()->paginate(10);

        return view('school.orders.index', compact('orders'), $this->pageData('My Orders', 'Orders|List'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $order->load(['items.product.vendor', 'shipments.courier', 'user', 'items.shipmentItem']);

        return view('school.orders.show', compact('order'), $this->pageData('Order Details', 'Orders|Details'));
    }
}

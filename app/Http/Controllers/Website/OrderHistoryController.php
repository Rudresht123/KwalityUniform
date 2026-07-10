<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderHistoryController extends Controller
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the user's orders.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $status = $request->get('status');
        
        $orders = $this->orderRepository->getOrdersForUser($userId, $perPage, $search, $status);

        if ($request->ajax()) {
            return view('website.orders.partials.table', compact('orders'))->render();
        }

        return view('website.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Authorize via Policy
        $this->authorize('view', $order);

        $order->load(['items.product', 'items.variant']);

        return view('website.orders.show', compact('order'));
    }

    /**
     * Download the invoice for the order.
     */
    public function downloadPdf(Order $order)
    {
        $this->authorize('downloadInvoice', $order);

        return app(\App\Services\InvoiceService::class)->downloadPdf($order);
    }
}

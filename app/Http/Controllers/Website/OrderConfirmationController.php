<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Services\OrderManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class OrderConfirmationController extends Controller
{
    protected OrderRepository $orderRepository;
    protected OrderManagementService $orderManagementService;

    public function __construct(OrderRepository $orderRepository, OrderManagementService $orderManagementService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderManagementService = $orderManagementService;
    }

    /**
     * Display the order confirmation page.
     */
    public function show(Request $request, $orderId)
    {
        $order = $this->orderRepository->getOrderWithDetails($orderId);

        if (!$order) {
            return redirect()->route('website.home')->with('error', 'Order not found.');
        }

        // Authorize access if user is logged in
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        return view('website.pages.order-success', compact('order'));
    }

    /**
     * Trigger an email of the invoice PDF.
     */
    public function emailInvoice(Request $request, $orderId)
    {
        $order = $this->orderRepository->getOrderWithDetails($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        if (Auth::check() && $order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $success = $this->orderManagementService->sendInvoiceEmail($order);

        return $success 
            ? response()->json(['message' => 'Invoice has been queued for delivery to your email.']) 
            : response()->json(['message' => 'Failed to queue invoice email.'], 500);
    }

    /**
     * Stream the invoice PDF.
     */
    public function streamInvoice($orderId)
    {
        $order = $this->orderRepository->getOrderWithDetails($orderId);
        if (!$order) abort(404);
        
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        return app(\App\Services\InvoiceService::class)->streamPdf($order);
    }

    /**
     * Download the invoice PDF.
     */
    public function downloadInvoice($orderId)
    {
        $order = $this->orderRepository->getOrderWithDetails($orderId);
        if (!$order) abort(404);

        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        return app(\App\Services\InvoiceService::class)->downloadPdf($order);
    }
}

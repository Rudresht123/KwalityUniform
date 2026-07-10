<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Models\Order;
use App\Mail\OrderPlacedMail;
use App\Mail\OrderStatusUpdatedMail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class OrderManagementService
{
    protected OrderRepository $orderRepository;
    protected InvoiceService $invoiceService;

    public function __construct(OrderRepository $orderRepository, InvoiceService $invoiceService)
    {
        $this->orderRepository = $orderRepository;
        $this->invoiceService = $invoiceService;
    }

    /**
     * Update order status and trigger notifications.
     */
    public function updateStatus(string $orderId, string $status): bool
    {
        $order = $this->orderRepository->getOrderWithDetails($orderId);
        if (!$order) return false;

        $oldStatus = $order->status;
        $success = $this->orderRepository->updateStatus($orderId, $status);

        if ($success && $oldStatus !== $status) {
            // Queue notification for status update
            Mail::to($order->user->email)->queue(new OrderStatusUpdatedMail($order));
        }

        return $success;
    }

    /**
     * Send an invoice PDF via email.
     */
    public function sendInvoiceEmail(Order $order): bool
    {
        try {
            $filePath = $this->invoiceService->generatePdf($order);
            
            Mail::to($order->user->email)->queue(new InvoiceMail($order, $filePath));
            
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send invoice email for Order {$order->id}: " . $e->getMessage());
            return false;
        }
    }
}

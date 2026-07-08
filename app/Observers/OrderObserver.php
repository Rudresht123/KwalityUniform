<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\EmailService;
use App\Enums\OrderStatus;

class OrderObserver
{
    public function updated(Order $order)
    {
        // Only send email if the status has actually changed
        if ($order->wasChanged('status')) {
            $this->sendStatusEmail($order);
        }
    }

    protected function sendStatusEmail(Order $order)
    {
        $user = $order->user;
        if (!$user || !$user->email) {
            return;
        }

        $status = $order->status;
        $templateKey = 'order_status_' . strtolower($status->value);
        
        // Map status to user-friendly names for the email
        $statusNames = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'processing' => 'Processing',
            'packed' => 'Packed',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        $friendlyStatus = $statusNames[$status->value] ?? $status->value;

        EmailService::send(
            $templateKey,
            $user->email,
            [
                'user_name' => $user->name,
                'order_id' => $order->id,
                'order_status' => $friendlyStatus,
                'total_amount' => number_format($order->total_amount, 2),
            ]
        );
    }
}

<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\EmailService;
use App\Enums\OrderStatus;
use App\Mail\OrderConfirmedMail;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    public function created(Order $order)
    {
        // Send order confirmation email with PDF invoice upon creation
        $user = $order->user;
        if ($user && $user->email) {
            Mail::to($user->email)->send(new OrderConfirmedMail($order));
        }
    }

    public function updated(Order $order)
    {
        // Only send email if the status has actually changed
        if ($order->wasChanged('status')) {
            $this->sendStatusEmail($order);

            // Additionally, notify the school when the order is confirmed
            if ($order->status->value === 'confirmed') {
                $this->notifySchoolsOfConfirmation($order);
            }
        }
    }

    protected function notifySchoolsOfConfirmation(Order $order)
    {
        // Get all schools associated with the products in this order
        $schoolIds = \App\Models\OrderItem::where('order_id', $order->id)
            ->join('app_models_super_admin_product_variants', 'order_items.variant_id', '=', 'product_variants.variant_id')
            ->join('app_models_super_admin_products', 'product_variants.product_id', '=', 'products.product_id')
            ->join('app_models_super_admin_school_product_approvals', 'products.product_id', '=', 'school_product_approvals.product_id')
            ->pluck('school_product_approvals.school_id')
            ->unique();

        foreach ($schoolIds as $schoolId) {
            $school = \App\Models\SuperAdmin\School::find($schoolId);
            if ($school && $school->email) {
                EmailService::send(
                    'order_confirmed_school',
                    $school->email,
                    [
                        'school_name' => $school->school_name,
                        'order_number' => $order->order_number,
                        'user_name' => $order->user->name,
                        'total_amount' => number_format($order->grand_total, 2),
                        'invoice_url' => route('website.orders.pdf', $order->id),
                    ]
                );
            }
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


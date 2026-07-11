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
        // Logic moved to sendOrderConfirmationEmails to ensure OrderItems exist
    }

    public function sendOrderConfirmationEmails(Order $order)
    {
        $user = $order->user;
        if (!$user || !$user->email) {
            return;
        }

        try {
            $invoiceService = new \App\Services\InvoiceService();
            $invoiceData = $invoiceService->generateInvoice($order);
            $fileName = 'Invoice_' . $order->order_number . '.pdf';

            // 1. Send confirmation to Customer
            Mail::to($user->email)->send(new OrderConfirmedMail($order));

            // 2. Notify associated Schools
            $schoolIds = \App\Models\OrderItem::where('order_id', $order->id)
                ->join('products', 'order_items.product_id', '=', 'products.product_id')
                ->join('school_product_approvals', 'products.product_id', '=', 'school_product_approvals.product_id')
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
                            'user_name' => $user->name,
                            'total_amount' => number_format($order->grand_total, 2),
                            'invoice_url' => route('website.orders.pdf', $order->id),
                        ],
                        ['attachments' => [$fileName => $invoiceData]]
                    );
                }
            }

            // 3. Notify associated Vendors
            $vendorIds = \App\Models\OrderItem::where('order_id', $order->id)
                ->pluck('vendor_id')
                ->unique();

            foreach ($vendorIds as $vendorId) {
                $vendor = \App\Models\SuperAdmin\Vendor::find($vendorId);
                if ($vendor && $vendor->email) {
                    EmailService::send(
                        'order_confirmed_vendor',
                        $vendor->email,
                        [
                            'vendor_name' => $vendor->vendor_name ?: 'Vendor',
                            'order_number' => $order->order_number,
                            'user_name' => $user->name,
                            'total_amount' => number_format($order->grand_total, 2),
                            'invoice_url' => route('website.orders.pdf', $order->id),
                        ],
                        ['attachments' => [$fileName => $invoiceData]]
                    );
                }
            }

        } catch (\Exception $e) {
            \Log::error('Failed to send order confirmation emails: ' . $e->getMessage());
        }
    }

    public function updated(Order $order)
    {
        // Only send email if the status has actually changed
        if ($order->wasChanged('status')) {
            if ($order->status->value === 'confirmed') {
                $this->sendConfirmationWithInvoice($order);
                $this->notifySchoolsOfConfirmation($order);
            } else {
                $this->sendStatusEmail($order);
            }
        }
    }

    protected function sendConfirmationWithInvoice(Order $order)
    {
        $user = $order->user;
        if (!$user || !$user->email) {
            return;
        }

        try {
            Mail::to($user->email)->send(new OrderConfirmedMail($order));
        } catch (\Exception $e) {
            \Log::error('Failed to send order confirmation invoice on status update: ' . $e->getMessage());
        }
    }

    protected function notifySchoolsOfConfirmation(Order $order)
    {
        // Get all schools associated with the products in this order
        $schoolIds = \App\Models\OrderItem::where('order_id', $order->id)
            ->join('product_variants', 'order_items.variant_id', '=', 'product_variants.variant_id')
            ->join('products', 'product_variants.product_id', '=', 'products.product_id')
            ->join('school_product_approvals', 'products.product_id', '=', 'school_product_approvals.product_id')
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


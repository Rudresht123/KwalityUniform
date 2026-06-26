<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationTemplate;

class NotificationTemplateSeeder extends Seeder
{
  public function run(): void
{
    $templates = [

        [
            'key' => 'product_approved',
            'title' => 'Product Approved',
            'message' => 'Congratulations! Your product "{product_name}" has been approved and is now available for customers.',
            'type' => 'success',
            'icon' => 'ti-circle-check-filled',
            'channels' => ['database', 'broadcast', 'mail'],
        ],

        [
            'key' => 'product_rejected',
            'title' => 'Product Rejected',
            'message' => 'Your product "{product_name}" was rejected. Reason: {admin_message}',
            'type' => 'danger',
            'icon' => 'ti-circle-x-filled',
            'channels' => ['database', 'broadcast', 'mail'],
        ],

        [
            'key' => 'product_status_updated',
            'title' => 'Product Status Updated',
            'message' => 'The status of your product "{product_name}" has been changed to {status}. {admin_message}',
            'type' => 'info',
            'icon' => 'ti-refresh',
            'channels' => ['database', 'broadcast', 'mail'],
        ],

        [
            'key' => 'product_resubmitted',
            'title' => 'Product Resubmitted',
            'message' => 'Your product "{product_name}" has been resubmitted for approval.',
            'type' => 'warning',
            'icon' => 'ti-refresh-alert',
            'channels' => ['database', 'broadcast'],
        ],

        [
            'key' => 'product_approval_request',
            'title' => 'New Product Awaiting Approval',
            'message' => 'A new product "{product_name}" has been submitted by {vendor_name} and is awaiting approval.',
            'type' => 'info',
            'icon' => 'ti-clock-hour-4',
            'channels' => ['database', 'broadcast'],
        ],

        [
            'key' => 'low_stock',
            'title' => 'Low Stock Alert',
            'message' => 'Product "{product_name}" stock is below the minimum threshold.',
            'type' => 'warning',
            'icon' => 'ti-alert-triangle',
            'channels' => ['database', 'broadcast'],
        ],

        [
            'key' => 'out_of_stock',
            'title' => 'Out of Stock',
            'message' => 'Product "{product_name}" is currently out of stock.',
            'type' => 'danger',
            'icon' => 'ti-package-off',
            'channels' => ['database', 'broadcast'],
        ],

        [
            'key' => 'stock_replenished',
            'title' => 'Stock Replenished',
            'message' => 'Inventory has been replenished for "{product_name}".',
            'type' => 'success',
            'icon' => 'ti-package',
            'channels' => ['database', 'broadcast'],
        ],

    ];

    foreach ($templates as $template) {

        NotificationTemplate::updateOrCreate(

            ['key' => $template['key']],

            [
                'title'    => $template['title'],
                'message'  => $template['message'],
                'type'     => $template['type'],
                'icon'     => $template['icon'],
                'channels' => json_encode($template['channels']),
            ]

        );
    }
}
}

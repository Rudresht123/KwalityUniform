<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationTemplate;

class NotificationTemplateSeeder extends Seeder
{
    public function run(): void
    {
        NotificationTemplate::insert([
            [
                'key' => 'product_approved',
                'title' => 'Product Approved',
                'message' => 'Your product {product_name} has been approved.',
                'type' => 'success',
                'icon' => 'ti-circle-check',
                'channels' => json_encode(['database', 'broadcast', 'mail']),
            ],

            [
                'key' => 'low_stock',
                'title' => 'Low Stock Alert',
                'message' => '{product_name} stock is below minimum level.',
                'type' => 'danger',
                'icon' => 'ti-alert-triangle',
                'channels' => json_encode(['database', 'broadcast']),
            ],
        ]);
    }
}

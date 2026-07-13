<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SuperAdmin\Vendor;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use App\Models\Courier;
use App\Enums\ShipmentStatus;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FulfillmentTestDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure we have a courier
        $courier = Courier::firstOrCreate(
            ['name' => 'FastTrack Logistics'],
            [
                'id' => 'COUR-' . Str::upper(Str::random(5)),
                'name' => 'FastTrack Logistics'
            ]
        );

        // 2. Get a vendor (assuming at least one exists, or create one)
        $vendor = Vendor::first();
        if (!$vendor) {
            $user = User::first() ?? User::factory()->create();
            $vendor = Vendor::create([
                'vendor_id' => 'VND-' . Str::random(5),
                'user_id' => $user->id,
                'name' => 'Test Premium Vendor',
                'email' => 'vendor@test.com',
                'phone' => '1234567890',
                'address' => '123 Vendor St, City',
                'bank_account_no' => '123456789',
                'status' => 'approved',
            ]);
        }
        $vendorId = $vendor->vendor_id;

        // 3. Create some products for this vendor
        $products = [];
        $userId = User::first()->id ?? User::factory()->create()->id;
        for ($i = 1; $i <= 5; $i++) {
            $name = "Premium Uniform Item $i";
            $code = 'PROD-TEST-' . $i;
            $products[] = Product::updateOrCreate(
                ['product_code' => $code],
                [
                    'product_name' => $name,
                    'slug' => \Illuminate\Support\Str::slug($name) . '-' . \Illuminate\Support\Str::random(5),
                    'description' => 'High quality material',
                    'vendor_id' => $vendorId,
                    'category_id' => Category::first()->category_id ?? \Illuminate\Support\Str::uuid(),
                    'approval_status' => 'approved',
                    'gender_type' => 'unisex',
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]
            );
        }


        // 4. Create some Confirmed Orders (Ready to Dispatch)
        for ($i = 1; $i <= 3; $i++) {
            $order = Order::create([
                'order_number' => 'ORD-' . Str::upper(Str::random(6)),
                'user_id' => User::first()->id ?? User::factory()->create()->id,
                'subtotal' => 5000,
                'grand_total' => 5000,
                'status' => 'confirmed',
                'created_at' => Carbon::now()->subDays(rand(1, 3)),
            ]);

            foreach ($products as $product) {
                $qty = rand(1, 5);
                $price = rand(500, 2000);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->product_id,
                    'vendor_id' => $vendorId,
                    'product_name' => $product->product_name,
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'line_total' => $qty * $price,
                ]);
            }
        }

        // 5. Create Some In-Transit Shipments
        for ($i = 1; $i <= 2; $i++) {
            $shipment = Shipment::create([
                'id' => (string) \Illuminate\Support\Str::uuid(),
                'vendor_id' => $vendorId,
                'tracking_number' => 'TRK' . Str::random(10),
                'courier_id' => $courier->id,
                'shipment_type' => 'bulk',
                'status' => ShipmentStatus::IN_TRANSIT,
                'shipped_at' => Carbon::now()->subDays(2),
            ]);

            // Add some items to these shipments
            $items = OrderItem::where('vendor_id', $vendorId)->take(3)->get();
            foreach ($items as $item) {
                ShipmentItem::create([
                    'id' => (string) \Illuminate\Support\Str::uuid(),
                    'shipment_id' => $shipment->id,
                    'order_item_id' => $item->id,
                    'quantity_shipped' => $item->quantity,
                ]);
            }
        }

        // 6. Create Some Delivered Shipments
        for ($i = 1; $i <= 2; $i++) {
            $shipment = Shipment::create([
                'id' => (string) \Illuminate\Support\Str::uuid(),
                'vendor_id' => $vendorId,
                'tracking_number' => 'DEL' . Str::random(10),
                'courier_id' => $courier->id,
                'shipment_type' => 'individual',
                'status' => ShipmentStatus::DELIVERED,
                'shipped_at' => Carbon::now()->subDays(10),
                'delivered_at' => Carbon::now()->subDays(5),
            ]);

            $items = OrderItem::where('vendor_id', $vendorId)->take(2)->get();
            foreach ($items as $item) {
                ShipmentItem::create([
                    'id' => (string) \Illuminate\Support\Str::uuid(),
                    'shipment_id' => $shipment->id,
                    'order_item_id' => $item->id,
                    'quantity_shipped' => $item->quantity,
                ]);
            }
        }
    }
}

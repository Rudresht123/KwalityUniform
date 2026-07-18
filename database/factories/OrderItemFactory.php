<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => \Database\Factories\SuperAdmin\ProductFactory::new(), // Use the factory class
            'vendor_id' => Vendor::factory(),
            'product_name' => $this->faker->word(),
            'quantity' => 1,
            'unit_price' => 10.00,
            'line_total' => 10.00,
        ];
    }
}

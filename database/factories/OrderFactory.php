<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\SuperAdmin\Vendor;
use App\Enums\OrderStatus;
use App\Enums\DeliveryType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'user_id' => User::factory(),
            'vendor_id' => Vendor::factory(),
            'delivery_type' => DeliveryType::HOME_DELIVERY,
            'status' => OrderStatus::CONFIRMED,
            'subtotal' => $this->faker->randomFloat(2, 10, 100),
            'grand_total' => $this->faker->randomFloat(2, 10, 100),
            'placed_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\CartItem;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        return [
            'cart_item_id' => Str::uuid()->toString(),
            'cart_id' => \Database\Factories\CartFactory::new()->definition(),
            'product_id' => Product::factory(),
            'variant_id' => ProductVariant::factory(),
            'vendor_id' => Vendor::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'unit_price' => $this->faker->randomFloat(2, 100, 2000),
        ];
    }
}

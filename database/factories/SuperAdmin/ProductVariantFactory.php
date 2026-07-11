<?php

namespace Database\Factories\SuperAdmin;

use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'variant_id' => Str::uuid()->toString(),
            'product_id' => \App\Models\SuperAdmin\Product::factory(),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-####-????')),
            'size_id' => \App\Models\SuperAdmin\Size::factory(),
            'color_id' => \App\Models\SuperAdmin\Color::factory(),
            'mrp' => $this->faker->randomFloat(2, 500, 5000),
            'selling_price' => $this->faker->randomFloat(2, 400, 4500),
            'stock_qty' => $this->faker->numberBetween(0, 100),
            'low_stock_alert' => 10,
            'barcode' => $this->faker->unique()->numerify('################'),
            'is_active' => true,
            'created_by' => \App\Models\User::factory(),
            'updated_by' => \App\Models\User::factory(),
        ];
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'stock_qty' => 0,
        ]));
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'is_active' => false,
        ]));
    }
}

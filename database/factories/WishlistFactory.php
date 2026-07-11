<?php

namespace Database\Factories;

use App\Models\WishlistItem;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistFactory extends Factory
{
    protected $model = WishlistItem::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'product_id' => Product::factory(),
            'variant_id' => ProductVariant::factory(),
        ];
    }
}

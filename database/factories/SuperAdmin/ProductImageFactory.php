<?php

namespace Database\Factories\SuperAdmin;

use App\Models\SuperAdmin\ProductImage;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'product_id' => \App\Models\SuperAdmin\Product::factory(),
            'file_id' => File::factory(),
            'is_primary' => false,
        ];
    }

    public function primary(): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'is_primary' => true,
        ]));
    }
}

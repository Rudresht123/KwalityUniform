<?php

namespace Database\Factories\SuperAdmin;

use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $productName = $this->faker->unique()->words(3, true);
        return [
            'product_id' => Str::uuid()->toString(),
            'vendor_id' => Vendor::factory(),
            'category_id' => Category::factory(),
            'product_code' => strtoupper($this->faker->unique()->bothify('PROD-####')),
            'product_name' => $productName,
            'slug' => Str::slug($productName),
            'meta_title' => $productName . ' | Quality Uniform',
            'meta_description' => $this->faker->sentence(),
            'meta_keywords' => $this->faker->words(5, true),
            'description' => $this->faker->paragraphs(3, true),
            'fabric_composition' => $this->faker->sentence(),
            'gender_type' => $this->faker->randomElement(['boys', 'girls', 'unisex']),
            'approval_status' => 'pending',
            'is_active' => true,
            'created_by' => \App\Models\User::factory(),
            'updated_by' => \App\Models\User::factory(),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'approval_status' => 'approved',
            'approved_at' => now(),
        ]));
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'approval_status' => 'rejected',
            'rejection_reason' => $this->faker->sentence(),
            'rejected_at' => now(),
        ]));
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'is_active' => false,
        ]));
    }
}

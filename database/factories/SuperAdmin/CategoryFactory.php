<?php

namespace Database\Factories\SuperAdmin;

use App\Models\SuperAdmin\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'category_id' => Str::uuid()->toString(),
            'parent_id' => null,
            'category_name' => $this->faker->unique()->words(2, true),
            'requires_size' => $this->faker->boolean(),
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }

    public function parent(array $attributes = []): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'category_name' => $this->faker->unique()->words(1, true) . ' (Parent)',
        ]));
    }

    public function child(array $attributes = []): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'parent_id' => Category::factory(),
        ]));
    }
}

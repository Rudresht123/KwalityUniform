<?php

namespace Database\Factories\SuperAdmin;

use App\Models\SuperAdmin\Size;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SizeFactory extends Factory
{
    protected $model = Size::class;

    public function definition(): array
    {
        return [
            'size_id' => Str::uuid()->toString(),
            'size_name' => $this->faker->unique()->randomElement(['S', 'M', 'L', 'XL', 'XXL', '32', '34', '36', '38', '40']),
            'display_name' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL', '32', '34', '36', '38', '40']),
            'is_active' => true,
            'created_by' => \App\Models\User::factory(),
            'updated_by' => \App\Models\User::factory(),
        ];
    }
}

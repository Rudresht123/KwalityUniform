<?php

namespace Database\Factories\SuperAdmin;

use App\Models\SuperAdmin\Color;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ColorFactory extends Factory
{
    protected $model = Color::class;

    public function definition(): array
    {
        return [
            'color_id' => Str::uuid()->toString(),
            'color_name' => $this->faker->unique()->colorName(),
            'hex_code' => $this->faker->hexColor(),
            'is_active' => true,
            'is_active' => true,
            'created_by' => \App\Models\User::factory(),
            'updated_by' => \App\Models\User::factory(),
        ];
    }
}

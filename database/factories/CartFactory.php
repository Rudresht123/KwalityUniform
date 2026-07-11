<?php

namespace Database\Factories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'cart_id' => Str::uuid()->toString(),
            'user_id' => \App\Models\User::factory(),
            'school_id' => \App\Models\SuperAdmin\School::factory(),
            'session_id' => Str::random(40),
            'status' => 'active',
            'converted_at' => null,
        ];
    }
}

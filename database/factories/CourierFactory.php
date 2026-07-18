<?php

namespace Database\Factories;

use App\Models\Courier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourierFactory extends Factory
{
    protected $model = Courier::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid()->toString(),
            'name' => $this->faker->company(),
            'api_integration_key' => Str::random(32),
            'contact_person' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}

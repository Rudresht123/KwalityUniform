<?php

namespace Database\Factories\SuperAdmin;

use App\Models\SuperAdmin\SchoolProductApproval;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SchoolProductApprovalFactory extends Factory
{
    protected $model = SchoolProductApproval::class;

    public function definition(): array
    {
        return [
            'school_product_approval_id' => Str::uuid()->toString(),
            'school_id' => School::factory(),
            'product_id' => Product::factory(),
            'status' => 'approved',
            'actioned_by' => \App\Models\User::factory(),
            'actioned_at' => now(),
        ];
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => array_merge($attributes, [
            'status' => 'rejected',
            'rejection_reason' => 'Does not meet school standards',
            'actioned_at' => now(),
        ]));
    }
}

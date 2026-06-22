<?php

namespace Database\Seeders;

use App\Models\SuperAdmin\Size;
use App\Models\User;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::role('super-admin')->first();
        if (!$admin) {
            return;
        }

        $sizes = [
            ['name' => 'XS', 'display' => 'Extra Small', 'order' => 1],
            ['name' => 'S', 'display' => 'Small', 'order' => 2],
            ['name' => 'M', 'display' => 'Medium', 'order' => 3],
            ['name' => 'L', 'display' => 'Large', 'order' => 4],
            ['name' => 'XL', 'display' => 'Extra Large', 'order' => 5],
            ['name' => 'XXL', 'display' => 'Double Extra Large', 'order' => 6],
            ['name' => '28', 'display' => 'Size 28', 'order' => 7],
            ['name' => '30', 'display' => 'Size 30', 'order' => 8],
            ['name' => '32', 'display' => 'Size 32', 'order' => 9],
            ['name' => '34', 'display' => 'Size 34', 'order' => 10],
            ['name' => '36', 'display' => 'Size 36', 'order' => 11],
            ['name' => '38', 'display' => 'Size 38', 'order' => 12],
            ['name' => '40', 'display' => 'Size 40', 'order' => 13],
            ['name' => '42', 'display' => 'Size 42', 'order' => 14],
        ];

        foreach ($sizes as $size) {
            Size::updateOrCreate(
                ['size_name' => $size['name']],
                [
                    'display_name' => $size['display'],
                    'sort_order' => $size['order'],
                    'is_active' => true,
                    'created_by' => $admin->id,
                    'updated_by' => $admin->id,
                ]
            );
        }
    }
}

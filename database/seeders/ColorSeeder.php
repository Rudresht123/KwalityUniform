<?php

namespace Database\Seeders;

use App\Models\SuperAdmin\Color;
use App\Models\User;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
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

        $colors = [
            ['name' => 'Red', 'hex' => '#FF0000'],
            ['name' => 'Blue', 'hex' => '#0000FF'],
            ['name' => 'Green', 'hex' => '#00FF00'],
            ['name' => 'Black', 'hex' => '#000000'],
            ['name' => 'White', 'hex' => '#FFFFFF'],
            ['name' => 'Yellow', 'hex' => '#FFFF00'],
            ['name' => 'Grey', 'hex' => '#808080'],
            ['name' => 'Navy Blue', 'hex' => '#000080'],
            ['name' => 'Maroon', 'hex' => '#800000'],
            ['name' => 'Sky Blue', 'hex' => '#87CEEB'],
            ['name' => 'Khaki', 'hex' => '#F0E68C'],
        ];

        foreach ($colors as $color) {
            Color::updateOrCreate(
                ['color_name' => $color['name']],
                [
                    'hex_code' => $color['hex'],
                    'is_active' => true,
                    'created_by' => $admin->id,
                    'updated_by' => $admin->id,
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\ParentCategory;
use App\Models\SuperAdmin\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Uniform' => [
                ['name' => 'Shirt', 'size' => true],
                ['name' => 'Trouser', 'size' => true],
                ['name' => 'Skirt', 'size' => true],
                ['name' => 'Blazer', 'size' => true],
            ],
            'Stationery' => [
                ['name' => 'Notebook', 'size' => false],
                ['name' => 'Pen', 'size' => false],
            ],
            'Accessory' => [
                ['name' => 'Bag', 'size' => false],
                ['name' => 'Belt', 'size' => true],
            ],
            'Footwear' => [
                ['name' => 'Shoes', 'size' => true],
                ['name' => 'Socks', 'size' => true],
            ],
        ];

        foreach ($data as $parentName => $subs) {
            $parent = ParentCategory::updateOrCreate(
                ['name' => $parentName],
                ['is_active' => true, 'created_by' => 1]
            );

            foreach ($subs as $sub) {
                Category::updateOrCreate(
                    ['category_name' => $sub['name']],
                    [
                        'parent_id' => $parent->parent_id,
                        'requires_size' => $sub['size'],
                        'is_active' => true,
                        'created_by' => 1
                    ]
                );
            }
        }
    }
}

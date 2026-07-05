<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Size;
use App\Models\SuperAdmin\Color;
use Illuminate\Support\Str;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have at least one vendor, category, size, and color
        $vendor =
            Vendor::first() ??
            Vendor::create([
                'vendor_id' => Str::uuid(),
                'business_name' => 'Sample Vendor Ltd',
                'category' => 'Uniforms',
                'email' => 'vendor@example.com',
                'gstin' => '22AAAAA0000A1Z5',
                'status' => 'approved',
                'is_active' => true,
                'user_id' => User::first()?->id ?? User::factory()->create(['role' => 'Vendor'])->id,
            ]);

        $category =
            Category::first() ??
            Category::create([
                'category_id' => Str::uuid(),
                'category_name' => 'School Uniforms',
                'is_active' => true,
            ]);

        $sizes = Size::all() ?: Size::factory(10)->create();
        $colors = Color::all() ?: Color::factory(10)->create();

        $productTemplates = [['name' => 'Classic White Shirt', 'code' => 'SHT', 'fabric' => '100% Cotton', 'gender' => 'Unisex'], ['name' => 'Navy Blue Trousers', 'code' => 'TRO', 'fabric' => 'Poly-Viscose', 'gender' => 'Boys'], ['name' => 'Pleated School Skirt', 'code' => 'SKR', 'fabric' => 'Poly-Viscose', 'gender' => 'Girls'], ['name' => 'School Blazer', 'code' => 'BLZ', 'fabric' => 'Wool Blend', 'gender' => 'Unisex'], ['name' => 'Winter Cardigan', 'code' => 'CRD', 'fabric' => 'Acrylic Wool', 'gender' => 'Unisex'], ['name' => 'School Tie', 'code' => 'TIE', 'fabric' => 'Silk Blend', 'gender' => 'Unisex'], ['name' => 'Formal Shoes', 'code' => 'SHO', 'fabric' => 'Leather', 'gender' => 'Unisex'], ['name' => 'School Socks', 'code' => 'SOC', 'fabric' => 'Cotton Blend', 'gender' => 'Unisex'], ['name' => 'P.E. T-Shirt', 'code' => 'PET', 'fabric' => 'Polyester', 'gender' => 'Unisex'], ['name' => 'P.E. Shorts', 'code' => 'PES', 'fabric' => 'Polyester', 'gender' => 'Unisex']];

        for ($i = 1; $i <= 100; $i++) {
            $template = $productTemplates[array_rand($productTemplates)];
            $productName = $template['name'] . ' ' . $i;
            $productCode = $template['code'] . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);

            $product = Product::create([
                'vendor_id' => $vendor->vendor_id,
                'category_id' => $category->category_id,
                'product_code' => $productCode,
                'product_name' => $productName,
                'slug' => Str::slug($productName),
                'description' => 'Premium quality ' . strtolower($productName) . ' designed for school students.',
                'fabric_composition' => $template['fabric'],
                'gender_type' => $template['gender'],
                'approval_status' => 'approved',
                'is_active' => true,

                'created_by' => 1,
                'updated_by' => 1,
            ]);

            // Create 5 variants per product for a total of 500 variants
            for ($v = 0; $v < 5; $v++) {
                $randomSize = $sizes->random();
                $randomColor = $colors->random();

                ProductVariant::create([
                    'product_id' => $product->product_id,
                    'sku' => $productCode . '-' . strtoupper($randomSize->size_name) . '-' . strtoupper($randomColor->color_name) . '-' . $v,
                    'size_id' => $randomSize->size_id ?? $randomSize->id,
                    'color_id' => $randomColor->color_id ?? $randomColor->id,
                    'mrp' => rand(500, 5000),
                    'selling_price' => rand(400, 4500),
                    'stock_qty' => rand(20, 500),
                    'low_stock_alert' => 15,
                    'is_active' => true,
                    
                'created_by' => 1,
                'updated_by' => 1,
                ]);
            }
        }
    }
}

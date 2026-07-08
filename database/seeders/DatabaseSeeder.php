<?php

namespace Database\Seeders;

use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data to prevent duplicate entry errors
        \Illuminate\Support\Facades\DB::table('product_variants')->truncate();
        \Illuminate\Support\Facades\DB::table('products')->truncate();
        \Illuminate\Support\Facades\DB::table('schools')->truncate();
        \Illuminate\Support\Facades\DB::table('vendors')->truncate();
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        \Illuminate\Support\Facades\DB::table('role_has_permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('model_has_roles')->truncate();
        \Illuminate\Support\Facades\DB::table('permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('roles')->truncate();

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Core Access Control
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            SuperAdminSeeder::class,
        ]);

        // 2. Product Attributes
        $this->call([
            SizeSeeder::class,
            ColorSeeder::class,
        ]);

        // 3. Entities
        \App\Models\SuperAdmin\School::factory()->count(150)->create();
        \App\Models\SuperAdmin\Vendor::factory()->count(180)->create();

        // 4. Products and Variants
        $this->call([
            ProductSeeder::class,
        ]);
    }
}

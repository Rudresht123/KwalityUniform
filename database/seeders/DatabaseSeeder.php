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
    //     // 1. Core Access Control
    //     $this->call([
    //         RoleSeeder::class,
    //         PermissionSeeder::class,
    //         SuperAdminSeeder::class,
    //     ]);

    //     // 2. Product Attributes
    //     $this->call([
    //         SizeSeeder::class,
    //         ColorSeeder::class,
    //     ]);

    //     // 3. Entities
    //     School::factory()->count(150)->create();
      //  Vendor::factory()->count(180)->create();

        // 4. Products and Variants
        $this->call([
            ProductSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\SuperAdmin\School;
use App\Models\User;
use App\Models\SuperAdmin\Schools;
use App\Models\SuperAdmin\Vendor;
use Database\Factories\SchoolFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Super Admin

        $this->call([RoleSeeder::class]);

        $this->call([SuperAdminSeeder::class]);

        $this->call([RoleSeeder::class]);

        $this->call([PermissionSeeder::class]);

        $this->call([SizeSeeder::class]);

        $this->call([ColorSeeder::class]);

        // Fake Schools

        School::factory()->count(100)->create();

        // Fake Vendors

        Vendor::factory()->count(100)->create();
    }
}

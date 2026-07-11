<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database with only essential production data.
     * This excludes all dummy users, vendors, and schools.
     */
    public function run(): void
    {
        // 1. Core Access Control & System Configuration
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            SuperAdminSeeder::class, // Necessary for initial admin access
            EmailTemplateSeeder::class,
            NotificationTemplateSeeder::class,
        ]);

        // 2. Product Attributes (Standardized values)
        $this->call([
            SizeSeeder::class,
            ColorSeeder::class,
            CategorySeeder::class,
        ]);

        $this->command->info('Production system data seeded successfully! No dummy data was added.');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FixVendorPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('name', 'vendor')->first();
        $permission = Permission::where('name', 'vendor.fulfillment.view')->first();

        if ($role && $permission) {
            $role->givePermissionTo($permission);
            $this->command->info('Permission assigned successfully.');
        } else {
            $this->command->error('Role or Permission not found.');
        }
    }
}

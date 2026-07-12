<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RolePermission\Permission;

class FixPermissionLeakage extends Command
{
    protected $signature = 'fix:permission-leakage';
    protected $description = 'Ensure admin-only permissions are correctly categorized as admin';

    public function handle()
    {
        $permissions = Permission::all();
        $count = 0;

        foreach ($permissions as $p) {
            if (
                str_contains($p->name, 'vendor.') || 
                str_contains($p->name, 'partnership.') || 
                str_contains($p->name, 'role.') || 
                str_contains($p->name, 'admin.') ||
                str_contains($p->name, 'global_settings')
            ) {
                $p->update(['role_category' => 'admin']);
                $count++;
            }
        }

        $this->info("Successfully updated {$count} permissions to 'admin' category.");
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolePermission\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [

            'Vendor Management' => [
                'vendor.view'   => 'View Vendors',
                'vendor.create' => 'Create Vendor',
                'vendor.edit'   => 'Edit Vendor',
                'vendor.delete' => 'Delete Vendor',
            ],

            'School Management' => [
                'school.view'   => 'View Schools',
                'school.create' => 'Create School',
                'school.edit'   => 'Edit School',
                'school.delete' => 'Delete School',
            ],

            'Role Management' => [
                'role.view'   => 'View Roles',
                'role.create' => 'Create Role',
                'role.edit'   => 'Edit Role',
                'role.delete' => 'Delete Role',
            ],

            'School Class Management' => [
                'school_class.view'   => 'View School Classes',
                'school_class.create' => 'Create School Class',
                'school_class.edit'   => 'Edit School Class',
                'school_class.delete' => 'Delete School Class',
            ],

        ];

        foreach ($modules as $group => $permissions) {

            foreach ($permissions as $slug => $name) {

                Permission::updateOrCreate(
                    [
                        'name'       => $slug,
                        'guard_name' => 'web',
                    ],
                    [
                        'permission_name' => $name,
                        'group_name'      => $group,
                    ]
                );

            }

        }
    }
}

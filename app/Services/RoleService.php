<?php

namespace App\Services;

use App\Models\RolePermission\Permission;
use App\Models\RolePermission\Role;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function getAllRoles()
    {
        return Role::whereNot("name","super-admin")->get();
    }

    public function getGroupedPermissions(?string $roleName = null)
    {
        $permissions = Permission::all();

        // Filter out unimplemented permissions
        $permissions = $permissions->filter(function ($permission) {
            return !str_starts_with($permission->name, 'product_assignment.') && 
                   !str_starts_with($permission->name, 'school_section.');
        });

        if ($roleName) {
            $roleName = strtolower($roleName);
            
            $mapping = [
                'school' => [
                    'School Management', 
                    'Parent Management',
                    'Product Management',
                ],
                'vendor' => [
                    'Vendor Management', 
                    'Product Management', 
                ],
                'admin' => [
                    'Vendor Management',
                    'School Management',
                    'School Board Management',
                    'User Management',
                    'Parent Management',
                    'Product Management',
                    'System Management',
                ],
                'parent' => [
                    'School Management',
                ],
            ];

            foreach ($mapping as $keyword => $allowedGroups) {
                if (str_contains($roleName, $keyword)) {
                    if ($keyword === 'school') {
                        $permissions = $permissions->filter(function ($permission) use ($allowedGroups) {
                            return (in_array($permission->group_name, $allowedGroups) && 
                                   ($permission->name === 'school.product.approve' || 
                                    $permission->name === 'school.product.report' || 
                                    $permission->group_name !== 'School Management'));
                        });
                    } else {
                        $permissions = $permissions->whereIn('group_name', $allowedGroups);
                    }
                    break;
                }
            }
        }

        return $permissions->groupBy('group_name');
    }

    public function createRole(array $data): Role
    {
        return DB::transaction(function () use ($data) {
            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($data['permissions'] ?? []);

            return $role;
        });
    }

    public function updateRole($id, array $data): Role
    {
        return DB::transaction(function () use ($id, $data) {
            $role = Role::findOrFail($id);

            $role->update([
                'name' => $data['name'],
            ]);

            // Filter permissions based on role name to prevent unauthorized permissions
            $permissions = $data['permissions'] ?? [];
            $roleName = strtolower($role->name);
            
            $allowedGroups = [];
            if (str_contains($roleName, 'school')) {
                $allowedGroups = ['School Management', 'Parent Management', 'Product Management'];
            } elseif (str_contains($roleName, 'vendor')) {
                $allowedGroups = ['Vendor Management', 'Product Management'];
            } elseif (str_contains($roleName, 'parent')) {
                $allowedGroups = ['School Management'];
            } elseif (str_contains($roleName, 'admin')) {
                $allowedGroups = [
                    'Vendor Management',
                    'School Management',
                    'School Board Management',
                    'User Management',
                    'Parent Management',
                    'Product Management',
                    'System Management',
                ];
            }

            if (!empty($allowedGroups)) {
                $permissions = Permission::whereIn('group_name', $allowedGroups)
                    ->whereIn('name', $permissions)
                    ->pluck('name')
                    ->toArray();
            }

            $role->syncPermissions($permissions);

            return $role;
        });
    }

    public function getRoleWithPermissions($id): Role
    {
        return Role::with('permissions')->findOrFail($id);
    }
}

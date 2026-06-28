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

        if ($roleName) {
            $roleName = strtolower($roleName);
            
            $mapping = [
                'school' => [
                    'School Management', 
                    'Parent Management',
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
                    $permissions = $permissions->whereIn('group_name', $allowedGroups);
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

            $role->syncPermissions($data['permissions'] ?? []);

            return $role;
        });
    }

    public function getRoleWithPermissions($id): Role
    {
        return Role::with('permissions')->findOrFail($id);
    }
}

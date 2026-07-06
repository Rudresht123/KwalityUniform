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

    public function getGroupedPermissions(?string $roleId = null)
    {
        $query = Permission::query();

        if ($roleId) {
            $role = Role::findOrFail($roleId);
            
            // Automatic Category Detection
            $category = $role->role_category;
            if (!$category) {
                $roleName = strtolower($role->name);
                if (str_contains($roleName, 'school')) {
                    $category = 'school';
                } elseif (str_contains($roleName, 'vendor')) {
                    $category = 'vendor';
                } elseif (str_contains($roleName, 'parent')) {
                    $category = 'parent';
                } elseif (str_contains($roleName, 'admin')) {
                    $category = 'admin';
                }
            }

            if ($category) {
                $query->where(function($q) use ($category) {
                    $q->where('role_category', $category)
                      ->orWhereNull('role_category');
                });
            }
        }

        $permissions = $query->get();

        // Filter out unimplemented permissions
        $permissions = $permissions->filter(function ($permission) {
            return !str_starts_with($permission->name, 'product_assignment.') && 
                   !str_starts_with($permission->name, 'school_section.');
        });

        return $permissions->groupBy('group_name');
    }

    public function createRole(array $data): Role
    {
        return DB::transaction(function () use ($data) {
            $roleName = $data['name'];
            $category = $data['role_category'] ?? null;

            // Auto-detect category if not provided
            if (!$category) {
                $lowerName = strtolower($roleName);
                if (str_contains($lowerName, 'school')) $category = 'school';
                elseif (str_contains($lowerName, 'vendor')) $category = 'vendor';
                elseif (str_contains($lowerName, 'parent')) $category = 'parent';
                elseif (str_contains($lowerName, 'admin')) $category = 'admin';
            }

            $role = Role::create([
                'name' => $roleName,
                'role_category' => $category,
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

            $roleName = $data['name'] ?? $role->name;
            $category = $data['role_category'] ?? $role->role_category;

            // Auto-detect category if it changes or is missing
            if (!$category) {
                $lowerName = strtolower($roleName);
                if (str_contains($lowerName, 'school')) $category = 'school';
                elseif (str_contains($lowerName, 'vendor')) $category = 'vendor';
                elseif (str_contains($lowerName, 'parent')) $category = 'parent';
                elseif (str_contains($lowerName, 'admin')) $category = 'admin';
            }

            $role->update([
                'name' => $roleName,
                'role_category' => $category,
            ]);

            $permissions = $data['permissions'] ?? [];
            
            if ($category) {
                $allowedPermissions = Permission::where(function($q) use ($category) {
                    $q->where('role_category', $category)
                      ->orWhereNull('role_category');
                })->pluck('name')->toArray();

                $permissions = array_intersect($permissions, $allowedPermissions);
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

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

            'Audit Management' => [
                'audit.view' => 'View Audit Reports',
            ],

            'Category Management' => [
                'category.view'   => 'View Categories',
                'category.create' => 'Create Category',
                'category.edit'   => 'Edit Category',
                'category.delete' => 'Delete Category',
            ],

            'Size Management' => [
                'size.view'   => 'View Sizes',
                'size.create' => 'Create Size',
                'size.edit'   => 'Edit Size',
                'size.delete' => 'Delete Size',
            ],

            'Color Management' => [
                'color.view'   => 'View Colors',
                'color.create' => 'Create Color',
                'color.edit'   => 'Edit Color',
                'color.delete' => 'Delete Color',
            ],

            'Admin Management' => [
                'admin.view'   => 'View Admins',
                'admin.create' => 'Create Admin',
                'admin.edit'   => 'Edit Admin',
                'admin.delete' => 'Delete Admin',
            ],

            'Product Management' => [
                'product.view'   => 'View Products',
                'product.create' => 'Create Product',
                'product.edit'   => 'Edit Product',
                'product.delete' => 'Delete Product',
                'product_approval_view'   => 'View Approval Queue',
                'product_approval_action' => 'Perform Approval Actions',
                'product.stock_update'    => 'Update Product Stock',
                'stock_view'              => 'View Stock Levels',
                'stock_adjust'            => 'Adjust Stock',
                'stock_history_view'      => 'View Stock History',
            ],

            'User Status Management' => [
                'user.view' => 'View User Status Report',
                'user.edit' => 'Manage User Status',
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

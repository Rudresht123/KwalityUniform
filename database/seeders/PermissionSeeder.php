<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolePermission\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [

            'User Management' => [
                'role.view'   => 'View Roles',
                'role.create' => 'Create Role',
                'role.edit'   => 'Edit Role',
                'role.delete' => 'Delete Role',
                'admin.view'   => 'View Admins',
                'admin.create' => 'Create Admin',
                'admin.edit'   => 'Edit Admin',
                'admin.delete' => 'Delete Admin',
                'user.view' => 'View User Status Report',
                'user.edit' => 'Manage User Status',
            ],

            'Parent Management' => [
                'parent.view'   => 'View Parents',
                'parent.create' => 'Create Parent',
                'parent.edit'   => 'Edit Parent',
                'parent.delete' => 'Delete Parent',
            ],

            'School Management' => [
                'school.view'   => 'View Schools',
                'school.create' => 'Create School',
                'school.edit'   => 'Edit School',
                'school.delete' => 'Delete School',
                'school_standard.view'   => 'View School Standards',
                'school_standard.create' => 'Create School Standard',
                'school_standard.edit'   => 'Edit School Standard',
                'school_standard.delete' => 'Delete School Standard',
                'school_section.view'    => 'View School Sections',
                'school_section.create'  => 'Create School Section',
                'school_section.delete'  => 'Delete School Section',
                'product_assignment.view'   => 'View Product Assignments',
                'product_assignment.create' => 'Create Product Assignment',
                'product_assignment.delete' => 'Delete Product Assignment',
                'school.product.view' => 'View Approved Products',
            ],

            'School Board Management' => [
                'school_board.view'   => 'View School Boards',
                'school_board.create' => 'Create School Board',
                'school_board.edit'   => 'Edit School Board',
                'school_board.delete' => 'Delete School Board',
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
                'category.view'   => 'View Categories',
                'category.create' => 'Create Category',
                'category.edit'   => 'Edit Category',
                'category.delete' => 'Delete Category',
                'size.view'   => 'View Sizes',
                'size.create' => 'Create Size',
                'size.edit'   => 'Edit Size',
                'size.delete' => 'Delete Size',
                'color.view'   => 'View Colors',
                'color.create' => 'Create Color',
                'color.edit'   => 'Edit Color',
                'color.delete' => 'Delete Color',
            ],

            'Vendor Management' => [
                'vendor.view'   => 'View Vendors',
                'vendor.create' => 'Create Vendor',
                'vendor.edit'   => 'Edit Vendor',
                'vendor.delete' => 'Delete Vendor',
            ],

            'System Management' => [
                'audit.view' => 'View Audit Reports',
                'global_settings.view' => 'View Global Settings',
                'global_settings.edit' => 'Edit Global Settings',
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

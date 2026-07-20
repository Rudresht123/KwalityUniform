<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolePermission\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Mapping of module groups to their default role categories
        $categoryMapping = [
            'User Management'         => 'admin',
            'Parent Management'       => 'school',
            'School Management'       => 'admin',
            'School Board Management' => 'admin',
            'Core Product Mgmt'       => null, // Global
            'Product Attributes'      => 'vendor',
            'Stock Management'        => 'vendor',
            'Product Approval'        => 'school',
            'Vendor Management'       => 'admin',
            'Partnership Management'  => 'admin',
            'School Vendor Mapping'   => 'admin',
            'Courier Management'      => 'admin',
            'Report Management'       => 'admin',
            'Order Fulfillment'       => 'vendor',
            'System Management'       => 'admin',
        ];

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
                'user.view'    => 'View User Status Report',
                'user.edit'    => 'Manage User Status',
            ],
            'Parent Management' => [
                'parent.view'   => 'View Parents',
                'parent.create' => 'Create Parent',
                'parent.edit'   => 'Edit Parent',
                'parent.delete' => 'Delete Parent',
            ],
            'School Management' => [
                'school.view'            => 'View Schools',
                'school.create'          => 'Create School',
                'school.edit'            => 'Edit School',
                'school.delete'          => 'Delete School',
                'product_assignment.view'   => 'View Product Assignments',
                'product_assignment.create' => 'Create Product Assignment',
                'product_assignment.delete' => 'Delete Product Assignment',
            ],
            'School Board Management' => [
                'school_board.view'   => 'View School Boards',
                'school_board.create' => 'Create School Board',
                'school_board.edit'   => 'Edit School Board',
                'school_board.delete' => 'Delete School Board',
            ],
            'Core Product Mgmt' => [
                'product.view'   => 'View Products',
                'product.create' => 'Create Product',
                'product.edit'   => 'Edit Product',
                'product.delete' => 'Delete Product',
            ],
            'Product Attributes' => [
                'category.view'   => 'View Categories',
                'category.create' => 'Create Category',
                'category.edit'   => 'Edit Category',
                'category.delete' => 'Delete Category',
                'size.view'       => 'View Sizes',
                'size.create'     => 'Create Size',
                'size.edit'       => 'Edit Size',
                'size.delete'     => 'Delete Size',
                'color.view'      => 'View Colors',
                'color.create'    => 'Create Color',
                'color.edit'      => 'Edit Color',
                'color.delete'    => 'Delete Color',
            ],
            'Stock Management' => [
                'stock_view'              => 'View Stock Levels',
                'stock_adjust'            => 'Adjust Stock',
                'stock_history_view'      => 'View Stock History',
                'vendor.stock.history.report' => 'View Stock History Report',
                'product.stock_update'    => 'Update Product Stock',
            ],
            'Order Fulfillment' => [
                'vendor.fulfillment.hub.view' => 'View Fulfillment Hub',
                'vendor.fulfillment.view' => 'View Order Fulfillment Hub',
                'vendor.fulfillment.ship' => 'Ship Orders',
            ],
            'Product Approval' => [
                'product_approval_view'   => 'View Approval Queue',
                'product_approval_action' => 'Perform Approval Actions',
                'school.product.approve'  => 'Approve Products',
                'school.product.report'   => 'View Approved Products Report',
            ],
            'Vendor Management' => [
                'vendor.view'   => 'View Vendors',
                'vendor.create' => 'Create Vendor',
                'vendor.edit'   => 'Edit Vendor',
                'vendor.delete' => 'Delete Vendor',
            ],
            'Partnership Management' => [
                'partnership.view'    => 'View Partnership Requests',
                'partnership.approve' => 'Approve Partnership Request',
                'partnership.reject'  => 'Reject Partnership Request',
            ],
            'School Vendor Mapping' => [
                'school_vendor.view'   => 'View School Vendor Mappings',
                'school_vendor.create' => 'Create Mapping',
                'school_vendor.edit'   => 'Edit Mapping',
                'school_vendor.delete' => 'Delete Mapping',
            ],
            'Courier Management' => [
                'courier.view'   => 'View Couriers',
                'courier.create' => 'Create Courier',
                'courier.edit'   => 'Edit Courier',
                'courier.delete' => 'Delete Courier',
            ],
            'Report Management' => [
                'report.recent_orders.view' => 'View Recent Orders Report',
            ],
            'School Report Management' => [
                'school.report.view' => 'View School Reports',
            ],
            'Order Fulfillment' => [

                'audit.view'            => 'View Audit Reports',
                'global_settings.view'  => 'View Global Settings',
                'global_settings.edit'  => 'Edit Global Settings',
            ]];

        $hierarchy = [
            'role.create'   => 'role.view',
            'role.edit'     => 'role.view',
            'role.delete'   => 'role.view',
            'admin.create'  => 'admin.view',
            'admin.edit'    => 'admin.view',
            'admin.delete'  => 'admin.view',
            'parent.create' => 'parent.view',
            'parent.edit'   => 'parent.view',
            'parent.delete' => 'parent.view',
            'school.create' => 'school.view',
            'school.edit'   => 'school.view',
            'school.delete' => 'school.view',
            'product.create' => 'product.view',
            'product.edit'   => 'product.view',
            'product.delete' => 'product.view',
            'category.create' => 'category.view',
            'category.edit'   => 'category.view',
            'category.delete' => 'category.view',
            'size.create'    => 'size.view',
            'size.edit'      => 'size.view',
            'size.delete'    => 'size.view',
            'color.create'    => 'color.view',
            'color.edit'      => 'color.view',
            'color.delete'    => 'color.view',
            'school_vendor.create' => 'school_vendor.view',
            'school_vendor.edit'   => 'school_vendor.view',
            'school_vendor.delete' => 'school_vendor.view',
            'courier.create' => 'courier.view',
            'courier.edit'   => 'courier.view',
            'courier.delete' => 'courier.view',
        ];

        foreach ($modules as $group => $permissions) {
            $defaultCategory = $categoryMapping[$group] ?? null;

            foreach ($permissions as $slug => $name) {
                $category = $defaultCategory;
                if (str_contains($slug, 'school.product')) {
                    $category = 'school';
                } elseif (str_contains($slug, 'stock') || $slug === 'product.stock_update' || $slug === 'report.recent_orders.view') {
                    $category = 'vendor';
                }

                $parentId = null;
                if (isset($hierarchy[$slug])) {
                    $parentSlug = $hierarchy[$slug];
                    $parent = Permission::where('name', $parentSlug)->first();
                    if ($parent) {
                        $parentId = $parent->id;
                    }
                }

                Permission::updateOrCreate(
                    [
                        'name'       => $slug,
                        'guard_name' => 'web',
                    ],
                    [
                        'permission_name' => $name,
                        'group_name'      => $group,
                        'role_category'   => $category,
                        'parent_id'       => $parentId,
                    ]
                );
            }
        }

        $superAdmin = \Spatie\Permission\Models\Role::where('name', 'super-admin')->first();
        if ($superAdmin) {
            $permissions = Permission::all();
            $superAdmin->syncPermissions($permissions);
        }
    }
}

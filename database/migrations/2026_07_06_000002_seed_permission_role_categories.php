<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1. Admin category
        DB::table('permissions')->where(function($q) {
            $q->where('name', 'like', 'role.%')
              ->orWhere('name', 'like', 'admin.%')
              ->orWhere('name', 'like', 'user.%')
              ->orWhere('name', 'like', 'global_settings.%')
              ->orWhere('name', 'like', 'audit.%')
              ->orWhere('name', 'like', 'school_board.%');
        })->update(['role_category' => 'admin']);

        // 2. School category
        DB::table('permissions')->where(function($q) {
            $q->where('name', 'like', 'school.%')
              ->orWhere('name', 'like', 'parent.%')
              ->orWhere('name', 'like', 'school_standard.%')
              ->orWhere('name', 'like', 'school_section.%')
              ->orWhere('name', 'like', 'product_assignment.%');
        })->update(['role_category' => 'school']);

        // 3. Vendor category
        DB::table('permissions')->where(function($q) {
            $q->where('name', 'like', 'vendor.%')
              ->orWhere('name', 'like', 'partnership.%')
              ->orWhere('name', 'like', 'stock.%')
              ->orWhere('name', 'product.stock_update');
        })->update(['role_category' => 'vendor']);

        // 4. Product Management - This is the tricky one.
        // Some product permissions are shared, some are specific.
        // We will leave generic ones (view, edit, etc.) as NULL or assign them based on current logic.
        // Actually, the user wants ONLY school related stuff for school roles.
        // If product.view is used by school admins, it should be 'school' or NULL.
        
        // Let's mark generic product ones as NULL so they appear for all.
        DB::table('permissions')->where('name', 'like', 'product.%')
            ->whereNotIn('name', ['product.stock_update']) // handled in vendor
            ->update(['role_category' => null]);
    }

    public function down(): void
    {
        DB::table('permissions')->update(['role_category' => null]);
    }
};

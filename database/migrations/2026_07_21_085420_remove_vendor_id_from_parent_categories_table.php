<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('parent_categories', function (Blueprint $table) {
            // Drop foreign key first if it exists
            if (Schema::hasColumn('parent_categories', 'vendor_id')) {
                $table->dropForeign(['vendor_id']); // Remove if vendor_id has a foreign key
                $table->dropColumn('vendor_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parent_categories', function (Blueprint $table) {
            $table->uuid('vendor_id')->nullable()->after('parent_id');

            // Recreate foreign key if it existed previously
            $table->foreign('vendor_id')
                ->references('vendor_id')
                ->on('vendors')
                ->onDelete('cascade');
        });
    }
};
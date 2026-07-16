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
        $map = [
            'parent_categories' => 'parent_id',
            'categories' => 'category_id',
            'colors' => 'color_id',
            'sizes' => 'size_id',
        ];

        foreach ($map as $tableName => $afterColumn) {
            Schema::table($tableName, function (Blueprint $table) use ($afterColumn) {
                $table->uuid('vendor_id')->nullable()->after($afterColumn);
                $table->foreign('vendor_id')->references('vendor_id')->on('vendors')->onDelete('cascade');
                $table->index('vendor_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['parent_categories', 'categories', 'colors', 'sizes'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign(['vendor_id']);
                $table->dropColumn('vendor_id');
            });
        }
    }
};

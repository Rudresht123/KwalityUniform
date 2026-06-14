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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('category_type');
            $table->uuid('parent_id')->nullable()->after('category_id');
            $table->foreign('parent_id')->references('parent_id')->on('parent_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
            $table->enum('category_type', ['uniform', 'stationery', 'accessory', 'footwear'])->after('category_id');
        });
    }
};

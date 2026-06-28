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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('image_id')->nullable()->constrained('files')->onDelete('set null')->after('avatar');
        });

        Schema::table('vendors', function (Blueprint $table) {
            $table->foreignId('image_id')->nullable()->constrained('files')->onDelete('set null')->after('logo_url');
        });

        Schema::table('schools', function (Blueprint $table) {
            $table->foreignId('image_id')->nullable()->constrained('files')->onDelete('set null')->after('logo_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });

        Schema::table('vendors', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });

        Schema::table('schools', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
    }
};

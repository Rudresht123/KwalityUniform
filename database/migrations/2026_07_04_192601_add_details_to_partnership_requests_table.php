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
        Schema::table('school_partnership_requests', function (Blueprint $table) {
            $table->string('address')->nullable()->after('phone');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('pincode')->nullable()->after('state');
        });

        Schema::table('vendor_partnership_requests', function (Blueprint $table) {
            $table->string('address')->nullable()->after('gstin');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('pincode')->nullable()->after('state');
            $table->string('pan_number')->nullable()->after('pincode');
            $table->string('bank_account_no')->nullable()->after('pan_number');
            $table->string('ifsc_code')->nullable()->after('bank_account_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_partnership_requests', function (Blueprint $table) {
            $table->dropColumn(['address', 'city', 'state', 'pincode']);
        });

        Schema::table('vendor_partnership_requests', function (Blueprint $table) {
            $table->dropColumn(['address', 'city', 'state', 'pincode', 'pan_number', 'bank_account_no', 'ifsc_code']);
        });
    }
};

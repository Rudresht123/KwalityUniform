<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        // 1. Shipping Addresses
        if (!Schema::hasTable('shipping_addresses')) {
            Schema::create('shipping_addresses', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('address_line1');
                $table->string('city');
                $table->string('state');
                $table->string('zip_code');
                $table->string('country')->default('India');
                $table->boolean('is_default')->default(false);
                $table->timestamps();
            });
        }

        // 2. Couriers
        if (!Schema::hasTable('couriers')) {
            Schema::create('couriers', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('api_integration_key')->nullable();
                $table->string('contact_person')->nullable();
                $table->string('phone')->nullable();
                $table->timestamps();
            });
        }

        // 3. Shipments
        if (!Schema::hasTable('shipments')) {
            Schema::create('shipments', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('tracking_number')->unique()->nullable();
                $table->foreignUuid('courier_id')->nullable()->constrained('couriers')->onDelete('set null');
                $table->string('shipment_type'); // bulk, individual
                $table->uuid('origin_address_id')->nullable(); // Logic for Vendor Address
                $table->uuid('destination_address_id')->nullable(); // Logic for School or Parent Address
                $table->string('status')->default('packed'); // Use ShipmentStatus Enum
                $table->timestamp('shipped_at')->nullable();
                $table->timestamp('delivered_at')->nullable();
                $table->timestamps();

                $table->index('tracking_number');
            });
        }

        // 4. Shipment Items (M:N OrderItems to Shipments)
        if (!Schema::hasTable('shipment_items')) {
            Schema::create('shipment_items', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignUuid('shipment_id')->constrained('shipments')->onDelete('cascade');
                $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade');
                $table->integer('quantity_shipped');
                $table->timestamps();
            });
        }

        // 5. School Distributions
        if (!Schema::hasTable('school_distributions')) {
            Schema::create('school_distributions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignUuid('shipment_id')->constrained('shipments')->onDelete('cascade');
                $table->foreignUuid('school_id')->references('school_id')->on('schools')->cascadeOnDelete();
                $table->timestamp('received_at')->nullable();
                $table->foreignId('received_by')->nullable()->constrained('users');
                $table->string('status')->default('received'); // received, distributing, completed
                $table->timestamps();
            });
        }

        // 6. Student Distributions
        if (!Schema::hasTable('student_distributions')) {
            Schema::create('student_distributions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade');
                $table->string('status')->default('pending_pickup'); // pending_pickup, delivered
                $table->timestamp('delivered_at')->nullable();
                $table->string('collected_by')->nullable();
                $table->timestamps();
            });
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_distributions');
        Schema::dropIfExists('school_distributions');
        Schema::dropIfExists('shipment_items');
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('couriers');
        Schema::dropIfExists('shipping_addresses');
    }
};

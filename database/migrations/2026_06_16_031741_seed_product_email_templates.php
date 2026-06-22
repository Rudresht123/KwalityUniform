<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('email_templates')->insert([
            [
                'template_key' => 'product_approval_request',
                'template_name' => 'Product Approval Request',
                'subject' => '🔔 Action Required: New Product Approval Request - {product_name}',
                'body' => '
<h2>Product Approval Request</h2>
<p>Hello Admin,</p>
<p>A new product has been submitted for approval by <strong>{vendor_name}</strong>.</p>
<p><strong>Product Details:</strong></p>
<ul>
    <li><strong>Name:</strong> {product_name}</li>
    <li><strong>Code:</strong> {product_code}</li>
    <li><strong>Category:</strong> {category_name}</li>
</ul>
<p>Please log in to the admin dashboard to review and approve/reject this product.</p>
<p>{view_button}</p>
<p>Best Regards,<br><strong>QualityUniform Team</strong></p>
',
                'available_placeholders' => 'product_name,product_code,vendor_name,category_name,view_button',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'template_key' => 'product_status_updated',
                'template_name' => 'Product Status Updated',
                'subject' => 'Update: Your Product {product_name} has been {status}',
                'body' => '
<h2>Product Status Update</h2>
<p>Dear {vendor_name},</p>
<p>The status of your product <strong>{product_name}</strong> ({product_code}) has been updated to: <strong>{status}</strong>.</p>
<p><strong>Message from Admin:</strong> {admin_message}</p>
<p>Log in to your dashboard to view more details.</p>
<p>{view_button}</p>
<p>Best Regards,<br><strong>QualityUniform Team</strong></p>
',
                'available_placeholders' => 'product_name,product_code,vendor_name,status,admin_message,view_button',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('email_templates')->whereIn('template_key', ['product_approval_request', 'product_status_updated'])->delete();
    }
};

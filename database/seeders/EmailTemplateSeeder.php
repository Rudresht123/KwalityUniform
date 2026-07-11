<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'template_key' => 'welcome_parent',
                'template_name' => 'Welcome Parent',
                'subject' => '🎉 Welcome to eSchoolKart, {user_name}!',
                'body' => '
                    <h2>🎉 Welcome to eSchoolKart!</h2>
                    <p>Hello <strong>{user_name}</strong>,</p>
                    <p>Thank you for registering with eSchoolKart. We are excited to have you join our community!</p>
                    <p>You can now easily browse and order school uniforms for your children, track your orders, and manage your wishlist all in one place.</p>
                    <p><strong>Get started now:</strong><br>
                    {login_button}</p>
                    <p>If you have any questions, feel free to contact our support team.</p>
                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>
                ',
                'available_placeholders' => 'user_name,login_button',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'template_key' => 'order_confirmed_user',
                'template_name' => 'Order Confirmation (User)',
                'subject' => '📦 Order Confirmed! Your order #{order_number} is placed',
                'body' => '
                    <h2>📦 Order Confirmed!</h2>
                    <p>Hello <strong>{user_name}</strong>,</p>
                    <p>Great news! Your order <strong>#{order_number}</strong> has been successfully placed.</p>
                    <p><strong>Order Summary:</strong><br>
                    Total Amount: <strong>₹{total_amount}</strong></p>
                    <p>We have attached the invoice for your order to this email.</p>
                    <p>You can track your order status through your dashboard.</p>
                    <p>Thank you for shopping with us!<br><strong>eSchoolKart Team</strong></p>
                ',
                'available_placeholders' => 'user_name,order_number,total_amount',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'template_key' => 'order_confirmed_school',
                'template_name' => 'Order Confirmation (School)',
                'subject' => '🔔 New Order Notification for School: #{order_number}',
                'body' => '
                    <h2>🔔 New Order Received</h2>
                    <p>Dear <strong>{school_name}</strong>,</p>
                    <p>A new order <strong>#{order_number}</strong> has been placed by <strong>{user_name}</strong>.</p>
                    <p><strong>Order Details:</strong><br>
                    Total Amount: <strong>₹{total_amount}</strong></p>
                    <p>Please review the order and proceed with the necessary approvals/coordination.</p>
                    <p>The detailed invoice is attached to this email.</p>
                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>
                ',
                'available_placeholders' => 'school_name,order_number,user_name,total_amount',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'template_key' => 'order_confirmed_vendor',
                'template_name' => 'Order Confirmation (Vendor)',
                'subject' => '🚚 New Order for Fulfillment: #{order_number}',
                'body' => '
                    <h2>🚚 New Order for Fulfillment</h2>
                    <p>Dear <strong>{vendor_name}</strong>,</p>
                    <p>You have a new order to fulfill: <strong>#{order_number}</strong>.</p>
                    <p><strong>Customer:</strong> {user_name}<br>
                    <strong>Total Order Value:</strong> ₹{total_amount}</p>
                    <p>Please check your vendor dashboard to see the items assigned to you and start the fulfillment process.</p>
                    <p>The full order invoice is attached for your reference.</p>
                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>
                ',
                'available_placeholders' => 'vendor_name,order_number,user_name,total_amount',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($templates as $template) {
            DB::table('email_templates')->updateOrInsert(
                ['template_key' => $template['template_key']],
                $template
            );
        }
    }
}

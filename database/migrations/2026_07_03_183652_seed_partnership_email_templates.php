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
                'template_key' => 'partnership_request_admin',
                'template_name' => 'School Partnership Admin Notification',
                'subject' => '🔔 New School Partnership Request: {school_name}',
                'body' => '
                    <h2>🔔 New School Partnership Request</h2>
                    <p>A new institution has applied to become an official partner.</p>
                    <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <p><strong>School Name:</strong> {school_name}</p>
                        <p><strong>Contact Person:</strong> {contact_person}</p>
                        <p><strong>Email:</strong> {email}</p>
                        <p><strong>Phone:</strong> {phone}</p>
                    </div>
                    <p>Please review the application in the admin dashboard to proceed with onboarding.</p>
                    <p>Best Regards,<br><strong>System Notification</strong></p>
                ',
                'available_placeholders' => 'school_name,contact_person,email,phone',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'template_key' => 'partnership_request_user',
                'template_name' => 'School Partnership User Confirmation',
                'subject' => '🤝 Thank you for your partnership interest, {school_name}!',
                'body' => '
                    <h2>🤝 Partnership Request Received</h2>
                    <p>Hello <strong>{contact_person}</strong>,</p>
                    <p>Thank you for reaching out to eSchoolKart. We have received your request to register <strong>{school_name}</strong> as an official partner institution.</p>
                    <p>Our Institutional Onboarding Team is reviewing your details. A partnership manager will contact you within 24 hours to schedule a virtual portal demo and garment sample validation.</p>
                    <p>We look forward to bringing a seamless uniform shopping experience to your students and parents.</p>
                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>
                ',
                'available_placeholders' => 'school_name,contact_person',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'template_key' => 'vendor_request_admin',
                'template_name' => 'Vendor Application Admin Notification',
                'subject' => '📦 New Vendor Application: {company_name}',
                'body' => '
                    <h2>📦 New Vendor Application</h2>
                    <p>A new supplier has applied to join the eSchoolKart marketplace.</p>
                    <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <p><strong>Company Name:</strong> {company_name}</p>
                        <p><strong>Product Category:</strong> {category}</p>
                        <p><strong>Email:</strong> {email}</p>
                        <p><strong>GSTIN:</strong> {gstin}</p>
                    </div>
                    <p>Please verify the GST credentials and company profile in the admin dashboard.</p>
                    <p>Best Regards,<br><strong>System Notification</strong></p>
                ',
                'available_placeholders' => 'company_name,category,email,gstin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'template_key' => 'vendor_request_user',
                'template_name' => 'Vendor Application User Confirmation',
                'subject' => '📦 Application Received: {company_name}',
                'body' => '
                    <h2>📦 Vendor Application Received</h2>
                    <p>Hello,</p>
                    <p>Thank you for applying to become an authorized supplier on eSchoolKart. We have received your application for <strong>{company_name}</strong>.</p>
                    <p>Our Merchant Desk is currently reviewing your tax status and GST credentials. You can expect an update regarding your application status within 2 business days.</p>
                    <p>If you have any questions in the meantime, please feel free to reply to this email.</p>
                    <p>Best Regards,<br><strong>eSchoolKart Team</strong></p>
                ',
                'available_placeholders' => 'company_name',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('email_templates')->whereIn('template_key', [
            'partnership_request_admin',
            'partnership_request_user',
            'vendor_request_admin',
            'vendor_request_user',
        ])->delete();
    }
};

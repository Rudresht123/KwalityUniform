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
                'template_key' => 'welcome_registration',

                'template_name' => 'Welcome Registration',

                'subject' => '🎉 Welcome to eSchoolKart',

                'body' => '

<h2>🎉 Welcome to eSchoolKart</h2>

<p>Hello <strong>{user_name}</strong>,</p>

<p>
Thank you for registering with eSchoolKart.
</p>

<p>
Your account has been created successfully and you are now ready to access our School Uniform ERP platform.
</p>

<p>
With eSchoolKart, you can:
</p>

<ul>
    <li>Manage Uniform Orders</li>
    <li>Track Inventory</li>
    <li>Manage Schools & Students</li>
    <li>Monitor Payments</li>
    <li>Generate Reports</li>
</ul>

<p>
Click the button below to access your account:
</p>

<p>
{login_button}
</p>

<p>
Thank you for choosing eSchoolKart.
</p>

<p>
Best Regards,<br>
<strong>eSchoolKart Team</strong>
</p>

',

                'available_placeholders' => 'user_name,login_button',

                'is_active' => true,

                'created_at' => now(),

                'updated_at' => now(),
            ],

            [
                'template_key' => 'otp_verification',

                'template_name' => 'OTP Verification',

                'subject' => '🔐 Verify Your Email Address',

                'body' => '

<h2>🔐 Email Verification</h2>

<p>Hello <strong>{user_name}</strong>,</p>

<p>
Use the following One-Time Password (OTP) to verify your email address:
</p>

<div style="
background:#f3f4f6;
padding:20px;
text-align:center;
font-size:32px;
font-weight:bold;
letter-spacing:8px;
border-radius:8px;
margin:20px 0;
">
{otp}
</div>

<p>
This OTP will expire in <strong>{expiry_minutes} minutes</strong>.
</p>

<p>
If you did not request this verification, please ignore this email.
</p>

<p>
Thank you,<br>
<strong>eSchoolKart Team</strong>
</p>

',

                'available_placeholders' => 'user_name,otp,expiry_minutes',

                'is_active' => true,

                'created_at' => now(),

                'updated_at' => now(),
            ],

            [
                'template_key' => 'forgot_password',

                'template_name' => 'Forgot Password',

                'subject' => '🔑 Reset Your Password',

                'body' => '

<h2>🔑 Password Reset Request</h2>

<p>Hello <strong>{user_name}</strong>,</p>

<p>
We received a request to reset the password associated with your eSchoolKart account.
</p>

<p>
To continue, click the button below:
</p>

<p>
{reset_button}
</p>

<p>
This password reset link will expire on <strong>{expiry_date}</strong>.
</p>

<p>
If you did not request a password reset, no further action is required.
</p>

<p>
For your security, never share your account credentials with anyone.
</p>

<p>
Regards,<br>
<strong>eSchoolKart Team</strong>
</p>

',

                'available_placeholders' => 'user_name,reset_button,expiry_date',

                'is_active' => true,

                'created_at' => now(),

                'updated_at' => now(),
            ],
            [
                'template_key' => 'vendor_registration',

                'template_name' => 'Vendor Registration Congratulations',

                'subject' => '🎉 Congratulations, {business_name}! Your vendor account is ready',

                'body' => '

<h2>🎉 Congratulations, {business_name}!</h2>

<p>Dear <strong>{owner_name}</strong>,</p>

<p>
Your vendor account has been successfully registered with eSchoolKart. We are thrilled to welcome you to our school uniform and supplier platform.
</p>

<p>
Here are the details of your registration:
</p>

<ul>
    <li><strong>Business Name:</strong> {business_name}</li>
    <li><strong>Owner Name:</strong> {owner_name}</li>
    <li><strong>Status:</strong> {status}</li>
</ul>

<p>
You can now manage your vendor profile, track orders, and collaborate with schools through the eSchoolKart dashboard.
</p>

<p>
{login_button}
</p>

<p>
If you need any help, feel free to reach out to our support team.
</p>

<p>
Warm regards,<br>
<strong>eSchoolKart Team</strong>
</p>

',

                'available_placeholders' => 'business_name,owner_name,status,login_button',

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
        DB::table('email_templates')->whereIn('template_key', [
            'welcome_registration',
            'otp_verification',
            'forgot_password',
            'vendor_registration',
        ])->delete();
    }
};

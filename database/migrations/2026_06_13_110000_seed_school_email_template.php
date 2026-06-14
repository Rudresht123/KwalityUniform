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
                'template_key' => 'school_registration',
                'template_name' => 'School Registration Congratulations',
                'subject' => '🎉 Welcome {school_name} to eSchoolKart!',
                'body' => '
<h2>🎉 Welcome to eSchoolKart!</h2>
<p>Dear <strong>{principal_name}</strong>,</p>
<p>
Your school <strong>{school_name}</strong> has been successfully registered with eSchoolKart. We are excited to have you on board.
</p>
<p>
Registration Details:
</p>
<ul>
    <li><strong>School Name:</strong> {school_name}</li>
    <li><strong>Principal Name:</strong> {principal_name}</li>
    <li><strong>Status:</strong> {status}</li>
</ul>
<p>
You can now manage your school profile, uniforms, and student orders through the eSchoolKart dashboard.
</p>
<p>
{login_button}
</p>
<p>
If you have any questions, please feel free to contact our support team.
</p>
<p>
Best Regards,<br>
<strong>eSchoolKart Team</strong>
</p>
',
                'available_placeholders' => 'school_name,principal_name,status,login_button',
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
        DB::table('email_templates')->where('template_key', 'school_registration')->delete();
    }
};

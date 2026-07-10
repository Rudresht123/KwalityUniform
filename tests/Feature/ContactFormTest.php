<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_submission_success()
    {
        $response = $this->postJson('/contact/send', [
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'subject' => 'General Inquiry',
            'message' => 'Hello, I would like to know more about your uniforms.',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        
        $this->assertDatabaseHas('contact_messages', [
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function test_contact_form_submission_validation_failure()
    {
        $response = $this->postJson('/contact/send', [
            'full_name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message', 'errors']);
    }
}

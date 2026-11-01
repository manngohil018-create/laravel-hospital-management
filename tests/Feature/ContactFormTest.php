<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_displays_the_message_form(): void
    {
        $response = $this->get(route('contact'));

        $response->assertOk()
            ->assertSee(route('contact.store'), false)
            ->assertSee('name="name"', false)
            ->assertSee('name="email"', false)
            ->assertSee('name="subject"', false)
            ->assertSee('name="message"', false)
            ->assertSee('Send Message');
    }

    public function test_contact_message_is_saved_and_confirmation_is_shown(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Asha Patel',
            'email' => 'asha@example.com',
            'phone' => '9876543210',
            'subject' => 'Appointment enquiry',
            'message' => 'I would like to know about appointment availability.',
        ]);

        $response->assertRedirect(route('contact'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Asha Patel',
            'email' => 'asha@example.com',
            'subject' => 'Appointment enquiry',
            'message' => 'I would like to know about appointment availability.',
        ]);

        $this->get(route('contact'))->assertSee('Your message has been submitted successfully.');
    }

    public function test_invalid_contact_message_is_not_saved(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'subject' => '',
            'message' => '',
        ]);

        $response->assertRedirect(route('contact'))
            ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthPagesTest extends TestCase
{
    public function test_login_page_uses_post_action_and_login_field(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('name="login"', false);
        $response->assertSee('action="/login"', false);
        $response->assertSee('method="POST"', false);
    }

    public function test_register_page_has_expected_registration_fields(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('name="username"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password_confirmation"', false);
    }
}

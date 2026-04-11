<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Doctor;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        Doctor::create([
            'name' => 'Test Doctor',
            'specialization' => 'General',
            'email' => 'testdoctor@example.com',
            'phone' => '9999999999',
            'about' => 'Test doctor for homepage.',
            'photo' => null,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

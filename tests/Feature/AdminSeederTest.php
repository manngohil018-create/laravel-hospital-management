<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_adds_admin_to_admins_table(): void
    {
        $this->seed();

        $this->assertDatabaseHas('admins', [
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'is_active' => true,
        ]);
    }
}

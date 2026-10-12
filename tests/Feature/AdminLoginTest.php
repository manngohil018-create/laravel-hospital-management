<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_from_admins_table_can_log_in_and_access_admin_dashboard(): void
    {
        $admin = Admin::create([
            'name' => 'Hospital Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret-password'),
            'is_active' => true,
        ]);

        $response = $this->post('/login', [
            'login' => $admin->email,
            'password' => 'secret-password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
        $this->get('/admin/dashboard')->assertOk();
    }

    public function test_inactive_admin_cannot_log_in_using_a_matching_user_account(): void
    {
        Admin::create([
            'name' => 'Inactive Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret-password'),
            'is_active' => false,
        ]);

        User::create([
            'name' => 'Legacy Admin',
            'username' => 'legacy-admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret-password'),
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'login' => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $response->assertSessionHasErrors('login');
        $this->assertGuest('admin');
        $this->assertGuest('web');
    }

    public function test_legacy_admin_user_can_still_access_the_admin_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Legacy Admin',
            'username' => 'legacy-admin',
            'email' => 'legacy-admin@example.com',
            'password' => Hash::make('secret-password'),
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'login' => $admin->email,
            'password' => 'secret-password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'web');
        $this->get('/admin/dashboard')->assertOk();
    }
}

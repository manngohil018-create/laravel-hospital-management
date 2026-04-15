<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enable foreign key constraints for SQLite
        if (config('database.default') === 'sqlite') {
            \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_keys = ON');
        }

        // Ensure an admin account exists for admin login
        if (Schema::hasTable('users')) {
            User::firstOrCreate(
                ['email' => 'admin@gmail.com'],
                [
                    'username' => 'admin',
                    'name' => 'Admin User',
                    'password' => Hash::make('admin@123'),
                    'role' => 'admin',
                ]
            );
        }
    }
}

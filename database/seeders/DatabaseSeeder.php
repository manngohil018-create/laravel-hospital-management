<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'username' => 'admin',
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123'),
            'role' => 'admin'
        ]);

        // Doctor User
        User::create([
            'username' => 'doctor',
            'name' => 'Dr. John Smith',
            'email' => 'doctor@lifecare.com',
            'password' => Hash::make('doctor123'),
            'role' => 'doctor'
        ]);

        // Patient User
        User::create([
            'username' => 'patient',
            'name' => 'Patient Name',
            'email' => 'patient@lifecare.com',
            'password' => Hash::make('123456'),
            'role' => 'patient'
        ]);

        // Additional Test Patients
        User::create([
            'username' => 'himanshu',
            'name' => 'Himanshu Singh',
            'email' => 'himanshu@lifecare.com',
            'password' => Hash::make('123456'),
            'role' => 'patient'
        ]);
    }
}

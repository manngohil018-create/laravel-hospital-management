<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123'),
            'phone' => '+91-9999999999',
            'department' => 'Management',
            'position' => 'System Administrator',
            'bio' => 'Main administrator for the LifeCare Hospital system',
            'is_active' => true,
        ]);
    }
}

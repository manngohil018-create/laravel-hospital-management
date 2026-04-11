<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'doctor1@lifecare.test';

        if (User::where('email', $email)->exists()) {
            $this->command->info('Test doctor already exists, skipping.');
            return;
        }

        $user = User::create([
            'name' => 'Dr. Test Doctor',
            'username' => 'drtest',
            'email' => $email,
            'password' => Hash::make('DoctorPass123!'),
            'role' => 'doctor',
            'phone' => '9876543210',
        ]);

        // Insert doctors row matching this user id (if your app expects a doctors table entry)
        // Use DB::table to avoid model differences.
        DB::table('doctors')->insert([
            'id' => $user->id,
            'name' => $user->name,
            'specialization' => 'General',
            'phone' => $user->phone,
            'email' => $user->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Seeded test doctor: ' . $email . ' / DoctorPass123!');
    }
}

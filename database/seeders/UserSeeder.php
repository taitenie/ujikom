<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'mimin',
                'password' => Hash::make('admin123'),
                'email' => 'admin@example.com',
                'birth' => '1990-01-01',
                'gender' => 'male',
                'address' => 'Jalan Admin No.1',
                'city' => 'Jakarta',
                'number' => '081234567890',
                'paypalId' => 'admin@paypal.com',
                'email_verified_at' => now(),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'user',
                'password' => Hash::make('user123'),
                'email' => 'user@example.com',
                'birth' => '1995-05-05',
                'gender' => 'female',
                'address' => 'Jalan User No.2',
                'city' => 'Bandung',
                'number' => '089876543210',
                'paypalId' => 'user@paypal.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

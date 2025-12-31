<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin NestTopup',
            'email' => 'admin@nesttopup.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'balance' => 0,
        ]);

        // User biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@nesttopup.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'balance' => 50000,
        ]);
    }
}

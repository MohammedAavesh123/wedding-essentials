<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin in admins table
        \App\Models\Admin::create([
            'name' => 'Admin',
            'email' => 'admin@dahejsaman.com',
            'password' => Hash::make('password123'),
        ]);

        // Create Customer Users
        User::create([
            'name' => 'Raj Kumar',
            'email' => 'customer@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '9876543210',
            'status' => true,
        ]);

        User::create([
            'name' => 'Priya Sharma',
            'email' => 'priya@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '9876543211',
            'status' => true,
        ]);

        User::create([
            'name' => 'Amit Patel',
            'email' => 'amit@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '9876543212',
            'status' => true,
        ]);
    }
}

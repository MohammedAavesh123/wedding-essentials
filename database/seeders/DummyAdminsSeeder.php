<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DummyAdminsSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Manager User',
                'email' => 'manager@dahejsaman.com',
                'role' => 'Manager'
            ],
            [
                'name' => 'Seller User',
                'email' => 'seller@dahejsaman.com',
                'role' => 'Seller'
            ],
            [
                'name' => 'Support User',
                'email' => 'support@dahejsaman.com',
                'role' => 'Support'
            ],
            [
                'name' => 'Marketing User',
                'email' => 'marketing@dahejsaman.com',
                'role' => 'Marketing'
            ],
        ];

        foreach ($users as $user) {
            $admin = Admin::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password123')
                ]
            );

            $admin->assignRole($user['role']);
        }
    }
}

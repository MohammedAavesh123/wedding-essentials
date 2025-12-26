<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            [
                'name' => 'Rahul Sharma',
                'email' => 'rahul@example.com',
                'phone' => '9876543210',
                'password' => Hash::make('password123'),
                'address' => '123, MG Road, Mumbai, Maharashtra - 400001',
            ],
            [
                'name' => 'Priya Patel',
                'email' => 'priya@example.com',
                'phone' => '9876543211',
                'password' => Hash::make('password123'),
                'address' => '456, Park Street, Delhi - 110001',
            ],
            [
                'name' => 'Amit Kumar',
                'email' => 'amit@example.com',
                'phone' => '9876543212',
                'password' => Hash::make('password123'),
                'address' => '789, Brigade Road, Bangalore - 560001',
            ],
            [
                'name' => 'Sneha Reddy',
                'email' => 'sneha@example.com',
                'phone' => '9876543213',
                'password' => Hash::make('password123'),
                'address' => '321, Banjara Hills, Hyderabad - 500034',
            ],
            [
                'name' => 'Vikram Singh',
                'email' => 'vikram@example.com',
                'phone' => '9876543214',
                'password' => Hash::make('password123'),
                'address' => '654, Civil Lines, Jaipur - 302006',
            ],
            [
                'name' => 'Anjali Mehta',
                'email' => 'anjali@example.com',
                'phone' => '9876543215',
                'password' => Hash::make('password123'),
                'address' => '987, SG Highway, Ahmedabad - 380015',
            ],
            [
                'name' => 'Karan Verma',
                'email' => 'karan@example.com',
                'phone' => '9876543216',
                'password' => Hash::make('password123'),
                'address' => '147, Sector 17, Chandigarh - 160017',
            ],
            [
                'name' => 'Neha Gupta',
                'email' => 'neha@example.com',
                'phone' => '9876543217',
                'password' => Hash::make('password123'),
                'address' => '258, Park Street, Kolkata - 700016',
            ],
        ];

        foreach ($customers as $customer) {
            User::create($customer);
        }

        $this->command->info('✅ Created 8 customer accounts');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            PackageSeeder::class,
            PopupSeeder::class,
            BookingSeeder::class,
            PaymentSeeder::class,
        ]);
        
        $this->command->info('✅ All seeders completed successfully!');
        $this->command->info('📧 Admin Login: admin@dahejsaman.com');
        $this->command->info('🔑 Password: password123');
    }
}


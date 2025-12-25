<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Package;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();
        $packages = Package::all();

        if ($users->count() == 0 || $packages->count() == 0) {
            return;
        }

        $bookingCounter = 1;
        
        foreach ($users as $user) {
            // Create 2 bookings for each user
            for ($i = 0; $i < 2; $i++) {
                $package = $packages->random();
                $totalAmount = $package->base_price;
                $advanceAmount = $totalAmount * 0.3; // 30% advance
                
                $booking = Booking::create([
                    'booking_number' => 'BK' . date('Ymd') . str_pad($bookingCounter++, 4, '0', STR_PAD_LEFT),
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'customer_name' => $user->name,
                    'customer_email' => $user->email,
                    'customer_phone' => $user->phone ?? '9999999999',
                    'customer_address' => fake()->streetAddress(),
                    'city' => fake()->city(),
                    'state' => fake()->randomElement(['Rajasthan', 'Gujarat', 'Maharashtra', 'Delhi', 'Punjab']),
                    'pincode' => fake()->numerify('######'),
                    'total_amount' => $totalAmount,
                    'advance_amount' => $advanceAmount,
                    'pending_amount' => $totalAmount - $advanceAmount,
                    'discount_amount' => 0,
                    'status' => fake()->randomElement(['pending', 'confirmed', 'processing', 'delivered']),
                    'payment_status' => fake()->randomElement(['unpaid', 'partially_paid', 'paid']),
                    'delivery_date' => now()->addDays(rand(7, 30)),
                ]);
            }
        }
    }
}

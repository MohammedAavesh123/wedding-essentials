<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Booking;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            // 80% chance of having a payment
            if (rand(1, 100) <= 80) {
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_amount,
                    'payment_method' => fake()->randomElement(['razorpay', 'paytm', 'cash']),
                    'transaction_id' => 'TXN_' . strtoupper(uniqid()),
                    'status' => fake()->randomElement(['completed', 'pending', 'failed']),
                ]);
            }
        }
    }
}

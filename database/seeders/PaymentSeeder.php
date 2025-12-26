<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Booking;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $bookings = Booking::all();

        if ($bookings->isEmpty()) {
            $this->command->warn('⚠️ No bookings found. Run BookingSeeder first.');
            return;
        }

        $paymentMethods = ['cash', 'card', 'upi', 'netbanking'];
        $statuses = ['pending', 'completed', 'failed'];

        foreach ($bookings as $booking) {
            // Create payment based on booking payment status
            if ($booking->payment_status === 'paid') {
                // Full payment
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_amount,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'status' => 'completed',
                    'transaction_id' => 'TXN' . strtoupper(uniqid()),
                    'paid_at' => $booking->created_at->addHours(2),
                    'notes' => 'Full payment received',
                ]);
            } elseif ($booking->payment_status === 'partially_paid') {
                // Advance payment
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->advance_amount,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'status' => 'completed',
                    'transaction_id' => 'TXN' . strtoupper(uniqid()),
                    'paid_at' => $booking->created_at->addHours(1),
                    'notes' => 'Advance payment received',
                ]);
            } else {
                // Pending payment
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_amount,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'status' => 'pending',
                    'transaction_id' => null,
                    'paid_at' => null,
                    'notes' => 'Payment pending',
                ]);
            }
        }

        $this->command->info('✅ Created ' . Payment::count() . ' payment records');
    }
}

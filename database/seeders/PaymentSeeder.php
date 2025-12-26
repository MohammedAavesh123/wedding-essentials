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
        $paymentStatuses = ['pending', 'completed', 'failed', 'refunded'];

        foreach ($bookings as $booking) {
            // Create initial payment based on booking payment status
            if ($booking->payment_status === 'paid') {
                // Full payment
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_amount,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'payment_status' => 'completed',
                    'transaction_id' => 'TXN' . strtoupper(uniqid()),
                    'payment_date' => $booking->created_at->addHours(2),
                    'notes' => 'Full payment received',
                ]);
            } elseif ($booking->payment_status === 'partial') {
                // Advance payment (50%)
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_amount * 0.5,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'payment_status' => 'completed',
                    'transaction_id' => 'TXN' . strtoupper(uniqid()),
                    'payment_date' => $booking->created_at->addHours(1),
                    'notes' => 'Advance payment (50%)',
                ]);
            } else {
                // Pending payment
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_amount,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'payment_status' => 'pending',
                    'transaction_id' => null,
                    'payment_date' => null,
                    'notes' => 'Payment pending',
                ]);
            }
        }

        $this->command->info('✅ Created ' . Payment::count() . ' payment records');
    }
}

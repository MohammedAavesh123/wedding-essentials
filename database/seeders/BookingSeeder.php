<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\User;
use App\Models\Package;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $users = User::whereNotIn('email', ['admin@dahejsaman.com'])->get();
        $packages = Package::all();

        if ($users->isEmpty() || $packages->isEmpty()) {
            $this->command->warn('⚠️ No users or packages found. Run CustomerSeeder and PackageSeeder first.');
            return;
        }

        $statuses = ['pending', 'confirmed', 'processing', 'completed', 'cancelled'];
        $paymentStatuses = ['pending', 'partial', 'paid'];

        foreach ($users->take(10) as $index => $user) {
            $package = $packages->random();
            $status = $statuses[array_rand($statuses)];
            $paymentStatus = $paymentStatuses[array_rand($paymentStatuses)];
            
            // Create booking
            $booking = Booking::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'booking_number' => 'BK' . date('Ymd') . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'total_amount' => $package->base_price,
                'paid_amount' => $paymentStatus === 'paid' ? $package->base_price : ($paymentStatus === 'partial' ? $package->base_price * 0.5 : 0),
                'status' => $status,
                'payment_status' => $paymentStatus,
                'delivery_address' => $user->address,
                'delivery_date' => Carbon::now()->addDays(rand(7, 30)),
                'notes' => 'Sample booking for testing purposes',
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            // Add booking items from package
            foreach ($package->items as $packageItem) {
                BookingItem::create([
                    'booking_id' => $booking->id,
                    'product_id' => $packageItem->product_id,
                    'quantity' => $packageItem->quantity,
                    'price' => $packageItem->product->price,
                    'subtotal' => $packageItem->product->price * $packageItem->quantity,
                ]);
            }

            $this->command->info("✅ Created booking #{$booking->booking_number} for {$user->name}");
        }

        $this->command->info('✅ Created 10 sample bookings with items');
    }
}

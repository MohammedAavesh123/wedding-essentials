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
            
            // Calculate amounts
            $totalAmount = $package->base_price;
            $advanceAmount = $paymentStatus === 'paid' ? $totalAmount : ($paymentStatus === 'partial' ? $totalAmount * 0.5 : 0);
            $pendingAmount = $totalAmount - $advanceAmount;
            
            // Create booking with correct schema
            $booking = Booking::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'booking_number' => 'BK' . date('Ymd') . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => $user->phone,
                'customer_address' => $user->address,
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'pincode' => '400001',
                'total_amount' => $totalAmount,
                'advance_amount' => $advanceAmount,
                'pending_amount' => $pendingAmount,
                'discount_amount' => 0,
                'delivery_date' => Carbon::now()->addDays(rand(7, 30)),
                'special_instructions' => 'Sample booking for testing purposes',
                'status' => $status,
                'payment_status' => $paymentStatus,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            // Add booking items from package (correct schema: item_name, item_type, price)
            foreach ($package->items as $packageItem) {
                BookingItem::create([
                    'booking_id' => $booking->id,
                    'product_id' => $packageItem->product_id,
                    'item_name' => $packageItem->product->name,
                    'item_type' => $packageItem->type,
                    'price' => $packageItem->product->price,
                ]);
            }

            $this->command->info("✅ Created booking #{$booking->booking_number} for {$user->name}");
        }

        $this->command->info('✅ Created 10 sample bookings with items');
    }
}

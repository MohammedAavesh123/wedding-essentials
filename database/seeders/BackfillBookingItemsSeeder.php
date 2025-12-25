<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Package;

class BackfillBookingItemsSeeder extends Seeder
{
    public function run()
    {
        $bookings = Booking::with('package.items.product')->get();

        foreach ($bookings as $booking) {
            // Check if booking already has items to avoid duplicates
            if ($booking->items()->exists()) {
                continue;
            }

            $package = $booking->package;
            if (!$package) continue;

            foreach ($package->items as $packageItem) {
                BookingItem::create([
                    'booking_id' => $booking->id,
                    'product_id' => $packageItem->product_id,
                    'item_name' => $packageItem->product->name ?? 'Unknown Item',
                    'item_type' => 'main',
                    'price' => $packageItem->price_override ?? $packageItem->product->price ?? 0,
                    'created_at' => $booking->created_at,
                    'updated_at' => $booking->updated_at,
                ]);
            }
        }
    }
}

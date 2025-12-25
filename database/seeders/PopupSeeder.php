<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PopupNotification;
use App\Models\Package;

class PopupSeeder extends Seeder
{
    public function run(): void
    {
        $luxuryPackage = Package::where('slug', 'luxury-marriage-package')->first();
        $premiumPackage = Package::where('slug', 'premium-marriage-package')->first();
        $budgetPackage = Package::where('slug', 'budget-marriage-package')->first();

        $popups = [
            [
                'package_id' => $luxuryPackage?->id,
                'title' => '🎉 Special Offer on Luxury Package!',
                'message' => 'Get 10% OFF on our Luxury Marriage Package. Complete home setup worth ₹4,00,000 now at ₹3,60,000!',
                'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600',
                'link' => null,
                'display_duration' => 5,
                'display_interval' => 20,
                'status' => true,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
            ],
            [
                'package_id' => $premiumPackage?->id,
                'title' => '💰 Best Value Package!',
                'message' => 'Premium Marriage Package - Most Popular Choice! Complete furniture setup starting at ₹1,50,000 with FREE delivery.',
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?w=600',
                'link' => null,
                'display_duration' => 5,
                'display_interval' => 20,
                'status' => true,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
            ],
            [
                'package_id' => $budgetPackage?->id,
                'title' => '🏠 Budget-Friendly Package!',
                'message' => 'Start your new home with our Budget Package at just ₹50,000. Essential furniture for every room!',
                'image' => 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=600',
                'link' => null,
                'display_duration' => 5,
                'display_interval' => 20,
                'status' => true,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
            ],
            [
                'package_id' => null,
                'title' => '🚚 FREE Delivery & Installation!',
                'message' => 'All packages include FREE delivery and installation. Book now and get your furniture delivered within 7 days!',
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600',
                'link' => null,
                'display_duration' => 5,
                'display_interval' => 20,
                'status' => true,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
            ],
        ];

        foreach ($popups as $popup) {
            PopupNotification::create($popup);
        }

        $this->command->info('✅ Popup Notifications seeded: ' . count($popups));
    }
}

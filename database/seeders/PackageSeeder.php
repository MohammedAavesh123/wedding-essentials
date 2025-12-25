<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\Product;
use App\Models\PackageItem;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        // Create 6 distinct marriage packages with furniture collection images
        $packages = [
            [
                'name' => 'Luxury Marriage Package',
                'slug' => 'luxury-marriage-package',
                'description' => 'Ultimate luxury package with premium furniture and all appliances. Perfect for those who want the best.',
                'base_price' => 400000,
                'features' => 'Free Delivery, Free Installation, 2 Year Warranty, Premium Quality',
                'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?w=1200&q=80',
                'status' => true,
                'is_featured' => true,
                'order' => 1,
                'auto_calculate_price' => true,
                'items' => [
                    'default' => ['king-size-bed-storage', 'mattress-king', '4-door-almirah', 'dressing-table-mirror', 'bedside-table-set',
                                  'l-shape-sofa', 'glass-center-table', 'tv-unit-storage', 'recliner-chair',
                                  '6-seater-dining-set', 'dining-buffet', 'modular-kitchen',
                                  'smart-led-tv-43', 'double-door-fridge', 'washing-machine-auto', 'microwave-oven'],
                    'optional' => ['study-table-chair', 'shoe-rack-cabinet', 'bar-cabinet', 'premium-curtains', 'wall-art-set'],
                ],
            ],
            [
                'name' => 'Deluxe Marriage Package',
                'slug' => 'deluxe-marriage-package',
                'description' => 'Premium furniture package with essential appliances. Ideal for modern families.',
                'base_price' => 250000,
                'features' => 'Free Delivery, Free Installation, 1.5 Year Warranty',
                'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1200&q=80',
                'status' => true,
                'is_featured' => true,
                'order' => 2,
                'auto_calculate_price' => true,
                'items' => [
                    'default' => ['king-size-bed-storage', 'mattress-king', '4-door-almirah', 'dressing-table-mirror',
                                  '5-seater-sofa-set', 'glass-center-table', 'tv-unit-storage',
                                  '6-seater-dining-set', 'smart-led-tv-43', 'double-door-fridge', 'washing-machine-auto'],
                    'optional' => ['bedside-table-set', 'recliner-chair', 'dining-buffet', 'microwave-oven', 'premium-curtains'],
                ],
            ],
            [
                'name' => 'Premium Marriage Package',
                'slug' => 'premium-marriage-package',
                'description' => 'Complete furniture set with select appliances for a comfortable home.',
                'base_price' => 180000,
                'features' => 'Free Delivery, Free Installation, 1 Year Warranty',
                'image' => 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=1200&q=80',
                'status' => true,
                'is_featured' => true,
                'order' => 3,
                'auto_calculate_price' => true,
                'items' => [
                    'default' => ['king-size-bed-storage', '3-door-wardrobe', 'dressing-table-mirror',
                                  '5-seater-sofa-set', 'wooden-center-table', 'tv-unit-storage',
                                  '6-seater-dining-set'],
                    'optional' => ['mattress-king', 'smart-led-tv-43', 'double-door-fridge', 'washing-machine-auto', 'premium-curtains'],
                ],
            ],
            [
                'name' => 'Classic Marriage Package',
                'slug' => 'classic-marriage-package',
                'description' => 'Essential furniture package perfect for starting a new home.',
                'base_price' => 120000,
                'features' => 'Free Delivery, 1 Year Warranty',
                'image' => 'https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=1200&q=80',
                'status' => true,
                'is_featured' => false,
                'order' => 4,
                'auto_calculate_price' => true,
                'items' => [
                    'default' => ['queen-size-bed', '3-door-wardrobe', 'dressing-table-mirror',
                                  '3-seater-sofa', 'wooden-center-table', 'wall-tv-unit',
                                  '6-seater-dining-set'],
                    'optional' => ['mattress-queen', 'bedside-table-set', 'smart-led-tv-43', 'double-door-fridge', 'premium-curtains'],
                ],
            ],
            [
                'name' => 'Standard Marriage Package',
                'slug' => 'standard-marriage-package',
                'description' => 'Basic furniture package with all necessary items for a new couple.',
                'base_price' => 80000,
                'features' => 'Free Delivery, 6 Month Warranty',
                'image' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?w=1200&q=80',
                'status' => true,
                'is_featured' => false,
                'order' => 5,
                'auto_calculate_price' => true,
                'items' => [
                    'default' => ['queen-size-bed', '3-door-wardrobe', '3-seater-sofa', 'wooden-center-table', '4-seater-dining-table'],
                    'optional' => ['mattress-queen', 'dressing-table-mirror', 'wall-tv-unit', 'smart-led-tv-43', 'premium-curtains'],
                ],
            ],
            [
                'name' => 'Budget Marriage Package',
                'slug' => 'budget-marriage-package',
                'description' => 'Affordable starter package with essential furniture items.',
                'base_price' => 50000,
                'features' => 'Free Delivery, 3 Month Warranty',
                'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=1200&q=80',
                'status' => true,
                'is_featured' => false,
                'order' => 6,
                'auto_calculate_price' => true,
                'items' => [
                    'default' => ['queen-size-bed', '3-door-wardrobe', '3-seater-sofa', '4-seater-dining-table'],
                    'optional' => ['mattress-queen', 'wooden-center-table', 'wall-tv-unit', 'premium-curtains'],
                ],
            ],
        ];

        foreach ($packages as $packageData) {
            $items = $packageData['items'];
            unset($packageData['items']);
            
            $package = Package::create($packageData);
            
            // Add default items
            foreach ($items['default'] as $slug) {
                $this->addPackageItem($package, $slug, 'default');
            }
            
            // Add optional items
            foreach ($items['optional'] as $slug) {
                $this->addPackageItem($package, $slug, 'optional');
            }
        }

        $this->command->info('✅ Packages seeded: 6 (Luxury, Deluxe, Premium, Classic, Standard, Budget)');
    }

    private function addPackageItem($package, $productSlug, $type)
    {
        $product = Product::where('slug', $productSlug)->first();
        if ($product) {
            PackageItem::create([
                'package_id' => $package->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'type' => $type,
            ]);
        }
    }
}

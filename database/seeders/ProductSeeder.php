<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get categories
        $bedroom = Category::where('slug', 'bedroom-furniture')->first();
        $living = Category::where('slug', 'living-room')->first();
        $dining = Category::where('slug', 'dining')->first();
        $kitchen = Category::where('slug', 'kitchen')->first();
        $appliances = Category::where('slug', 'home-appliances')->first();
        $decor = Category::where('slug', 'decor-accessories')->first();

        $products = [
            // Bedroom Furniture (10 items)
            ['category_id' => $bedroom->id, 'name' => 'King Size Bed with Storage', 'slug' => 'king-size-bed-storage', 'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800', 'price' => 18000, 'package_price' => 16000, 'description' => 'Premium wooden king size bed with under-bed storage', 'specifications' => 'Material: Sheesham Wood, Size: 6x6 feet, Storage: Yes', 'in_stock' => true, 'is_featured' => true, 'sku' => 'BED-001'],
            ['category_id' => $bedroom->id, 'name' => 'Queen Size Bed', 'slug' => 'queen-size-bed', 'image' => 'https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=800', 'price' => 14000, 'package_price' => 12500, 'description' => 'Elegant queen size bed with headboard', 'specifications' => 'Material: Teak Wood, Size: 5x6 feet', 'in_stock' => true, 'sku' => 'BED-002'],
            ['category_id' => $bedroom->id, 'name' => '4-Door Almirah Wardrobe', 'slug' => '4-door-almirah', 'image' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?w=800', 'price' => 22000, 'package_price' => 20000, 'description' => 'Spacious 4-door wardrobe with mirror', 'specifications' => 'Material: Engineered Wood, Size: 7x6 feet, Doors: 4', 'in_stock' => true, 'is_featured' => true, 'sku' => 'WAR-001'],
            ['category_id' => $bedroom->id, 'name' => '3-Door Wardrobe', 'slug' => '3-door-wardrobe', 'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800', 'price' => 16000, 'package_price' => 14500, 'description' => 'Compact 3-door wardrobe', 'specifications' => 'Material: Wood, Size: 6x6 feet', 'in_stock' => true, 'sku' => 'WAR-002'],
            ['category_id' => $bedroom->id, 'name' => 'Dressing Table with Mirror', 'slug' => 'dressing-table-mirror', 'image' => 'https://images.unsplash.com/photo-1595515106969-1ce29566ff1c?w=800', 'price' => 9000, 'package_price' => 8000, 'description' => 'Modern dressing table with large mirror and drawers', 'specifications' => 'Material: Wood, Size: 3x5 feet, Drawers: 3', 'in_stock' => true, 'sku' => 'DRS-001'],
            ['category_id' => $bedroom->id, 'name' => 'Bedside Table Set (2 Pcs)', 'slug' => 'bedside-table-set', 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800', 'price' => 6000, 'package_price' => 5500, 'description' => 'Pair of bedside tables with drawers', 'specifications' => 'Material: Wood, Quantity: 2', 'in_stock' => true, 'sku' => 'BST-001'],
            ['category_id' => $bedroom->id, 'name' => 'Orthopedic Mattress King Size', 'slug' => 'mattress-king', 'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800', 'price' => 7000, 'package_price' => 6500, 'description' => 'Premium orthopedic mattress', 'specifications' => 'Type: Memory Foam, Size: 6x6 feet, Thickness: 8 inch', 'in_stock' => true, 'sku' => 'MAT-001'],
            ['category_id' => $bedroom->id, 'name' => 'Mattress Queen Size', 'slug' => 'mattress-queen', 'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800', 'price' => 5500, 'package_price' => 5000, 'description' => 'Comfortable queen size mattress', 'specifications' => 'Type: Spring, Size: 5x6 feet', 'in_stock' => true, 'sku' => 'MAT-002'],
            ['category_id' => $bedroom->id, 'name' => 'Study Table with Chair', 'slug' => 'study-table-chair', 'image' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=800', 'price' => 8500, 'package_price' => 7500, 'description' => 'Ergonomic study table with chair', 'specifications' => 'Material: Wood, Size: 4x2 feet', 'in_stock' => true, 'sku' => 'STD-001'],
            ['category_id' => $bedroom->id, 'name' => 'Shoe Rack Cabinet', 'slug' => 'shoe-rack-cabinet', 'image' => 'https://images.unsplash.com/photo-1600585152915-d208bec867a1?w=800', 'price' => 4500, 'package_price' => 4000, 'description' => 'Multi-tier shoe storage cabinet', 'specifications' => 'Material: Engineered Wood, Capacity: 15 pairs', 'in_stock' => true, 'sku' => 'SHO-001'],
            
            // Living Room (8 items)
            ['category_id' => $living->id, 'name' => '5 Seater Sofa Set', 'slug' => '5-seater-sofa-set', 'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800', 'price' => 28000, 'package_price' => 25000, 'description' => 'Luxurious 5 seater sofa with cushions', 'specifications' => 'Material: Fabric, Color: Brown, Seating: 3+1+1', 'in_stock' => true, 'is_featured' => true, 'sku' => 'SOF-001'],
            ['category_id' => $living->id, 'name' => '3 Seater Sofa', 'slug' => '3-seater-sofa', 'image' => 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=800', 'price' => 16000, 'package_price' => 14500, 'description' => 'Compact 3 seater sofa', 'specifications' => 'Material: Leather, Color: Black', 'in_stock' => true, 'sku' => 'SOF-002'],
            ['category_id' => $living->id, 'name' => 'L-Shape Sofa', 'slug' => 'l-shape-sofa', 'image' => 'https://images.unsplash.com/photo-1550254478-ead40cc54513?w=800', 'price' => 32000, 'package_price' => 29000, 'description' => 'Modern L-shaped sectional sofa', 'specifications' => 'Material: Fabric, Color: Grey', 'in_stock' => true, 'is_featured' => true, 'sku' => 'SOF-003'],
            ['category_id' => $living->id, 'name' => 'Glass Top Center Table', 'slug' => 'glass-center-table', 'image' => 'https://images.unsplash.com/photo-1611269154421-4e27233ac5c7?w=800', 'price' => 7500, 'package_price' => 6800, 'description' => 'Elegant glass top center table', 'specifications' => 'Material: Glass & Wood, Size: 4x2 feet', 'in_stock' => true, 'sku' => 'TBL-001'],
            ['category_id' => $living->id, 'name' => 'Wooden Center Table', 'slug' => 'wooden-center-table', 'image' => 'https://images.unsplash.com/photo-1565191999001-551c187427bb?w=800', 'price' => 5500, 'package_price' => 5000, 'description' => 'Solid wood center table', 'specifications' => 'Material: Sheesham Wood, Size: 3x2 feet', 'in_stock' => true, 'sku' => 'TBL-002'],
            ['category_id' => $living->id, 'name' => 'TV Unit with Storage', 'slug' => 'tv-unit-storage', 'image' => 'https://images.unsplash.com/photo-1594026112284-02bb6f3352fe?w=800', 'price' => 14000, 'package_price' => 12500, 'description' => 'Modern TV unit with ample storage', 'specifications' => 'Material: Engineered Wood, Size: 6x2 feet, Shelves: 4', 'in_stock' => true, 'is_featured' => true, 'sku' => 'TVU-001'],
            ['category_id' => $living->id, 'name' => 'Wall Mounted TV Unit', 'slug' => 'wall-tv-unit', 'image' => 'https://images.unsplash.com/photo-1574269909862-7e1d70bb8078?w=800', 'price' => 10000, 'package_price' => 9000, 'description' => 'Space-saving wall mounted TV unit', 'specifications' => 'Material: Wood, Size: 5x1.5 feet', 'in_stock' => true, 'sku' => 'TVU-002'],
            ['category_id' => $living->id, 'name' => 'Recliner Chair', 'slug' => 'recliner-chair', 'image' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?w=800', 'price' => 12000, 'package_price' => 11000, 'description' => 'Comfortable recliner chair', 'specifications' => 'Material: Leather, Color: Brown', 'in_stock' => true, 'sku' => 'REC-001'],
            
            // Dining (4 items)
            ['category_id' => $dining->id, 'name' => '6 Seater Dining Table Set', 'slug' => '6-seater-dining-set', 'image' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=800', 'price' => 24000, 'package_price' => 22000, 'description' => 'Wooden dining table with 6 chairs', 'specifications' => 'Material: Sheesham Wood, Size: 6x3 feet, Chairs: 6', 'in_stock' => true, 'is_featured' => true, 'sku' => 'DIN-001'],
            ['category_id' => $dining->id, 'name' => '4 Seater Dining Table', 'slug' => '4-seater-dining-table', 'image' => 'https://images.unsplash.com/photo-1615066390971-03e4e1c36ddf?w=800', 'price' => 14000, 'package_price' => 12500, 'description' => 'Compact dining table for small families', 'specifications' => 'Material: Wood, Size: 4x3 feet, Chairs: 4', 'in_stock' => true, 'sku' => 'DIN-002'],
            ['category_id' => $dining->id, 'name' => 'Dining Buffet Cabinet', 'slug' => 'dining-buffet', 'image' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?w=800', 'price' => 18000, 'package_price' => 16500, 'description' => 'Elegant buffet cabinet for crockery storage', 'specifications' => 'Material: Wood, Size: 5x4 feet', 'in_stock' => true, 'sku' => 'BUF-001'],
            ['category_id' => $dining->id, 'name' => 'Bar Cabinet', 'slug' => 'bar-cabinet', 'image' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?w=800', 'price' => 15000, 'package_price' => 13500, 'description' => 'Stylish bar cabinet with glass holders', 'specifications' => 'Material: Wood, Size: 4x5 feet', 'in_stock' => true, 'sku' => 'BAR-001'],
            
            // Kitchen (2 items)
            ['category_id' => $kitchen->id, 'name' => 'Modular Kitchen Setup', 'slug' => 'modular-kitchen', 'image' => 'https://images.unsplash.com/photo-1556912173-3bb406ef7e77?w=800', 'price' => 45000, 'package_price' => 42000, 'description' => 'Complete modular kitchen with cabinets', 'specifications' => 'Material: Stainless Steel & Wood, Length: 10 feet', 'in_stock' => true, 'is_featured' => true, 'sku' => 'KIT-001'],
            ['category_id' => $kitchen->id, 'name' => 'Kitchen Trolley', 'slug' => 'kitchen-trolley', 'image' => 'https://images.unsplash.com/photo-1556911220-bff31c812dba?w=800', 'price' => 6000, 'package_price' => 5500, 'description' => 'Mobile kitchen storage trolley', 'specifications' => 'Material: Steel, Shelves: 3', 'in_stock' => true, 'sku' => 'TRL-001'],
            
            // Home Appliances (4 items)
            ['category_id' => $appliances->id, 'name' => 'Smart LED TV 43 inch', 'slug' => 'smart-led-tv-43', 'image' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=800', 'price' => 25000, 'package_price' => 23500, 'description' => 'Smart LED TV with 4K resolution', 'specifications' => 'Brand: Samsung, Size: 43 inch, Type: Smart', 'in_stock' => true, 'is_featured' => true, 'sku' => 'TV-001'],
            ['category_id' => $appliances->id, 'name' => 'Double Door Refrigerator', 'slug' => 'double-door-fridge', 'image' => 'https://images.unsplash.com/photo-1571175443880-49e1d25b2bc5?w=800', 'price' => 22000, 'package_price' => 20500, 'description' => 'Energy efficient double door refrigerator', 'specifications' => 'Brand: LG, Capacity: 260L, Type: Frost Free', 'in_stock' => true, 'is_featured' => true, 'sku' => 'FRG-001'],
            ['category_id' => $appliances->id, 'name' => 'Fully Automatic Washing Machine', 'slug' => 'washing-machine-auto', 'image' => 'https://images.unsplash.com/photo-1626806787461-102c1bfaaea1?w=800', 'price' => 18000, 'package_price' => 16500, 'description' => 'Fully automatic front load washing machine', 'specifications' => 'Brand: Samsung, Capacity: 7kg, Type: Front Load', 'in_stock' => true, 'sku' => 'WSH-001'],
            ['category_id' => $appliances->id, 'name' => 'Microwave Oven', 'slug' => 'microwave-oven', 'image' => 'https://images.unsplash.com/photo-1585659722983-3a675dabf23d?w=800', 'price' => 8000, 'package_price' => 7500, 'description' => 'Convection microwave oven', 'specifications' => 'Brand: LG, Capacity: 28L, Type: Convection', 'in_stock' => true, 'sku' => 'MIC-001'],
            
            // Decor & Accessories (4 items)
            ['category_id' => $decor->id, 'name' => 'Premium Curtains Set', 'slug' => 'premium-curtains', 'image' => 'https://images.unsplash.com/photo-1585128792020-803d29415281?w=800', 'price' => 4000, 'package_price' => 3700, 'description' => 'Premium silk curtains for 2 windows', 'specifications' => 'Material: Silk, Color: Cream, Quantity: 2 panels', 'in_stock' => true, 'sku' => 'CUR-001'],
            ['category_id' => $decor->id, 'name' => 'Designer Wall Clock', 'slug' => 'designer-wall-clock', 'image' => 'https://images.unsplash.com/photo-1563861826100-9cb868fdbe1c?w=800', 'price' => 2000, 'package_price' => 1800, 'description' => 'Modern designer wall clock', 'specifications' => 'Type: Analog, Size: 14 inch, Material: Wood', 'in_stock' => true, 'sku' => 'CLK-001'],
            ['category_id' => $decor->id, 'name' => 'Table Lamp Pair', 'slug' => 'table-lamp-pair', 'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=800', 'price' => 3500, 'package_price' => 3200, 'description' => 'Elegant table lamps set of 2', 'specifications' => 'Type: LED, Color: White, Quantity: 2', 'in_stock' => true, 'sku' => 'LMP-001'],
            ['category_id' => $decor->id, 'name' => 'Wall Art Set', 'slug' => 'wall-art-set', 'image' => 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?w=800', 'price' => 5000, 'package_price' => 4500, 'description' => 'Modern wall art paintings set of 3', 'specifications' => 'Type: Canvas, Size: 24x18 inch, Quantity: 3', 'in_stock' => true, 'sku' => 'ART-001'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('✅ Products seeded: ' . count($products));
    }
}

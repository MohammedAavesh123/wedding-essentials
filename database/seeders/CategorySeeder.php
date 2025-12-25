<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Bedroom Furniture', 'slug' => 'bedroom-furniture', 'icon' => 'fa-bed', 'description' => 'Beds, wardrobes, dressing tables', 'status' => true, 'order' => 1],
            ['name' => 'Living Room', 'slug' => 'living-room', 'icon' => 'fa-couch', 'description' => 'Sofas, center tables, TV units', 'status' => true, 'order' => 2],
            ['name' => 'Dining', 'slug' => 'dining', 'icon' => 'fa-utensils', 'description' => 'Dining tables, chairs', 'status' => true, 'order' => 3],
            ['name' => 'Kitchen', 'slug' => 'kitchen', 'icon' => 'fa-blender', 'description' => 'Kitchen cabinets, storage', 'status' => true, 'order' => 4],
            ['name' => 'Home Appliances', 'slug' => 'home-appliances', 'icon' => 'fa-tv', 'description' => 'TV, Fridge, Washing Machine', 'status' => true, 'order' => 5],
            ['name' => 'Decor & Accessories', 'slug' => 'decor-accessories', 'icon' => 'fa-lamp', 'description' => 'Lamps, curtains, decorative items', 'status' => true, 'order' => 6],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Categories seeded: ' . count($categories));
    }
}

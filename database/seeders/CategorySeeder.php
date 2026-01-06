<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Computers & Laptops',
            'Smartphones & Tablets',
            'Computer Accessories',
            'Smartwatches',
            'Cameras & Audio',
            'Networking Devices',
            'Gaming Gear',
            'Office Supplies'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}

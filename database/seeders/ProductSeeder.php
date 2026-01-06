<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Computers & Laptops (Category 1)
            [
                'name' => 'MacBook Air M2',
                'category_id' => 1,
                'stock' => 10,
                'buying_price' => 900,
                'selling_price' => 1100,
            ],
            [
                'name' => 'ASUS ROG Zephyrus G14',
                'category_id' => 1,
                'stock' => 5,
                'buying_price' => 1400,
                'selling_price' => 1700,
            ],
            // Smartphones & Tablets (Category 2)
            [
                'name' => 'iPhone 14 Pro Max',
                'category_id' => 2,
                'stock' => 15,
                'buying_price' => 1000,
                'selling_price' => 1200,
            ],
            [
                'name' => 'Samsung Galaxy Tab S9 Ultra',
                'category_id' => 2,
                'stock' => 8,
                'buying_price' => 1100,
                'selling_price' => 1300,
            ],
            // Computer Accessories (Category 3)
            [
                'name' => 'Logitech MX Master 3S',
                'category_id' => 3,
                'stock' => 50,
                'buying_price' => 80,
                'selling_price' => 100,
            ],
            [
                'name' => 'Keychron K2 Pro Mechanical Keyboard',
                'category_id' => 3,
                'stock' => 20,
                'buying_price' => 90,
                'selling_price' => 120,
            ],
            // Smartwatches (Category 4)
            [
                'name' => 'Apple Watch Series 9',
                'category_id' => 4,
                'stock' => 12,
                'buying_price' => 350,
                'selling_price' => 450,
            ],
            // Cameras & Audio (Category 5)
            [
                'name' => 'Sony Alpha a7 IV Body Only',
                'category_id' => 5,
                'stock' => 3,
                'buying_price' => 2200,
                'selling_price' => 2500,
            ],
            // Gaming Gear (Category 7)
            [
                'name' => 'SteelSeries Arctis Nova Pro',
                'category_id' => 7,
                'stock' => 10,
                'buying_price' => 300,
                'selling_price' => 350,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'code' => IdGenerator::generate([
                    'table' => 'products',
                    'field' => 'code',
                    'length' => 10,
                    'prefix' => 'PRD-'
                ]),
                'category_id' => $product['category_id'],
                'stock' => $product['stock'],
                'buying_price' => $product['buying_price'],
                'selling_price' => $product['selling_price'],
                'buying_date' => now()->subDays(rand(1, 30)),
                'expire_date' => now()->addYear(),
                'image' => null,
            ]);
        }
    }
}

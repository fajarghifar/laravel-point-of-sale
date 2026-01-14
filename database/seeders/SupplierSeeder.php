<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Future Tech Inc.',
                'email' => 'contact@futuretech.com',
                'phone' => '123-456-7890',
                'address' => '123 Tech Avenue, Silicon Valley, CA, USA'
            ],
            [
                'name' => 'Global Supplies LLC',
                'email' => 'sales@globalsupplies.com',
                'phone' => '987-654-3210',
                'address' => '456 Market Street, San Francisco, CA, USA'
            ],
            [
                'name' => 'Gadget World Ltd.',
                'email' => 'support@gadgetworld.com',
                'phone' => '555-123-4567',
                'address' => '789 Innovation Drive, Austin, TX, USA'
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}

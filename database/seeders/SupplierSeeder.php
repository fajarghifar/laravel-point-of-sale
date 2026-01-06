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
                'address' => '123 Tech Avenue, Silicon Valley, CA, USA',
                'shopname' => 'Future Tech Store',
                'type' => 'Distributor',
                'account_holder' => 'Michael Smith',
                'account_number' => '1234567890',
                'bank_name' => 'Chase Bank',
            ],
            [
                'name' => 'Global Supplies LLC',
                'email' => 'sales@globalsupplies.com',
                'phone' => '987-654-3210',
                'address' => '456 Market Street, San Francisco, CA, USA',
                'shopname' => 'Global Supplies',
                'type' => 'Wholesaler',
                'account_holder' => 'Sarah Johnson',
                'account_number' => '0987654321',
                'bank_name' => 'Wells Fargo',
            ],
            [
                'name' => 'Gadget World Ltd.',
                'email' => 'support@gadgetworld.com',
                'phone' => '555-123-4567',
                'address' => '789 Innovation Drive, Austin, TX, USA',
                'shopname' => 'Gadget World',
                'type' => 'Distributor',
                'account_holder' => 'David Wilson',
                'account_number' => '1122334455',
                'bank_name' => 'Bank of America',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}

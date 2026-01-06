<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Jane Doe',
                'email' => 'jane.doe@example.com',
                'phone' => '1234567890',
                'address' => '123 Main St, New York, NY, USA',
                'shopname' => 'Jane\'s Shop',
                'account_holder' => 'Jane Doe',
                'account_number' => '555111222',
                'bank_name' => 'Chase Bank',
            ],
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '0987654321',
                'address' => '456 Elm St, Los Angeles, CA, USA',
                'shopname' => null,
                'account_holder' => 'John Smith',
                'account_number' => '666222333',
                'bank_name' => 'Wells Fargo',
            ],
            [
                'name' => 'Emily Johnson',
                'email' => 'emily.j@example.com',
                'phone' => '1122334455',
                'address' => '789 Oak Ave, Chicago, IL, USA',
                'shopname' => 'Emily Boutique',
                'account_holder' => 'Emily Johnson',
                'account_number' => '777333444',
                'bank_name' => 'City Bank',
            ],
            [
                'name' => 'Walk-in Customer',
                'email' => 'walkin@store.com',
                'phone' => '0000000000',
                'address' => 'Store Location',
                'shopname' => null,
                'account_holder' => null,
                'account_number' => null,
                'bank_name' => null,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}

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
                'address' => '123 Main St, New York, NY, USA'
            ],
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '0987654321',
                'address' => '456 Elm St, Los Angeles, CA, USA'
            ],
            [
                'name' => 'Emily Johnson',
                'email' => 'emily.j@example.com',
                'phone' => '1122334455',
                'address' => '789 Oak Ave, Chicago, IL, USA'
            ],
            [
                'name' => 'Walk-in Customer',
                'email' => 'walkin@store.com',
                'phone' => '0000000000',
                'address' => 'Store Location'
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'name' => 'Michael Brown',
                'email' => 'michael.b@store.com',
                'phone' => '1231231234',
                'address' => '100 Broadway, New York, NY',
                'experience' => '2 Years',
                'salary' => '5000',
                'vacation' => '12',
                'city' => 'New York',
            ],
            [
                'name' => 'Sarah Wilson',
                'email' => 'sarah.w@store.com',
                'phone' => '3213214321',
                'address' => '200 High St, Columbus, OH',
                'experience' => '1 Year',
                'salary' => '4500',
                'vacation' => '12',
                'city' => 'Columbus',
            ],
            [
                'name' => 'David Lee',
                'email' => 'david.l@store.com',
                'phone' => '5556667777',
                'address' => '300 Market St, Philadelphia, PA',
                'experience' => '3 Years',
                'salary' => '6000',
                'vacation' => '14',
                'city' => 'Philadelphia',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}

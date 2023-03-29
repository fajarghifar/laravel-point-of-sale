<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@gmail.com',
        ]);

        Employee::factory(15)->create();
    }
}

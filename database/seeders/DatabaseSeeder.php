<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\AdvanceSalary;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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

        Employee::factory(5)->create();
        // AdvanceSalary::factory(25)->create();

        Customer::factory(25)->create();
        Supplier::factory(10)->create();

        Product::factory(5)->create();
        Category::factory(5)->create();

        // Create Permission and Role
        Permission::create([
            'name' => 'pos.menu',
            'group_name' => 'pos',
        ]);

        Permission::create([
            'name' => 'employee.menu',
            'group_name' => 'employee',
        ]);
        Permission::create([
            'name' => 'employee.all',
            'group_name' => 'employee',
        ]);
        Permission::create([
            'name' => 'employee.create',
            'group_name' => 'employee',
        ]);
        Permission::create([
            'name' => 'employee.edit',
            'group_name' => 'employee',
        ]);
        Permission::create([
            'name' => 'employee.delete',
            'group_name' => 'employee',
        ]);

        Permission::create([
            'name' => 'customer.menu',
            'group_name' => 'customer',
        ]);
        Permission::create([
            'name' => 'customer.all',
            'group_name' => 'customer',
        ]);
        Permission::create([
            'name' => 'customer.create',
            'group_name' => 'customer',
        ]);
        Permission::create([
            'name' => 'customer.edit',
            'group_name' => 'customer',
        ]);
        Permission::create([
            'name' => 'customer.delete',
            'group_name' => 'customer',
        ]);

        Permission::create([
            'name' => 'supplier.menu',
            'group_name' => 'supplier',
        ]);
        Permission::create([
            'name' => 'supplier.all',
            'group_name' => 'supplier',
        ]);
        Permission::create([
            'name' => 'supplier.create',
            'group_name' => 'supplier',
        ]);
        Permission::create([
            'name' => 'supplier.edit',
            'group_name' => 'supplier',
        ]);
        Permission::create([
            'name' => 'supplier.delete',
            'group_name' => 'supplier',
        ]);

        Permission::create([
            'name' => 'salary.menu',
            'group_name' => 'salary',
        ]);
        Permission::create([
            'name' => 'salary.all',
            'group_name' => 'salary',
        ]);
        Permission::create([
            'name' => 'salary.create',
            'group_name' => 'salary',
        ]);
        Permission::create([
            'name' => 'salary.pay',
            'group_name' => 'salary',
        ]);
        Permission::create([
            'name' => 'salary.paid',
            'group_name' => 'salary',
        ]);

        Permission::create([
            'name' => 'attendence.menu',
            'group_name' => 'attendence',
        ]);
        Permission::create([
            'name' => 'category.menu',
            'group_name' => 'category',
        ]);
        Permission::create([
            'name' => 'product.menu',
            'group_name' => 'product',
        ]);
        Permission::create([
            'name' => 'orders.menu',
            'group_name' => 'orders',
        ]);
        Permission::create([
            'name' => 'stock.menu',
            'group_name' => 'stock',
        ]);
        Permission::create([
            'name' => 'roles.menu',
            'group_name' => 'roles',
        ]);

    }
}

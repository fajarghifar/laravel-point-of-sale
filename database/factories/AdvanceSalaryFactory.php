<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdvanceSalary>
 */
class AdvanceSalaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => fake()->numberBetween(1, 5),
            'date' => fake()->date('Y-m-d'),
            'advance_salary' => fake()->randomNumber(3, false)
        ];
    }
}

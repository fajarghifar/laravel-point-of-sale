<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'experience' => fake()->numberBetween(1, 10) . ' Year',
            'photo' => null,
            'salary' => fake()->randomFloat(2, 3000, 10000),
            'vacation' => fake()->numberBetween(0, 50) . ' Days',
            'city' => fake()->city(),
        ];
    }
}

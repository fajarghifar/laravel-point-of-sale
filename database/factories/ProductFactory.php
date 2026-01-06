<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);
        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'code' => fake()->ean8(),
            'category_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'stock' => fake()->randomNumber(3),
            'buying_price' => fake()->numberBetween(100, 1000),
            'selling_price' => fake()->numberBetween(1000, 2000),
            'buying_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addYears(2),
        ];
    }
}

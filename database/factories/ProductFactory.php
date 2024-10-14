<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'category_id' => Category::factory(),
            'image' => fake()->imageUrl(),
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'price' => fake()->numberBetween(600, 1000),
            'color' => fake()->colorName(),
            'discountpercentage' => fake()->numberBetween(0, 100),
        ];
    }
}

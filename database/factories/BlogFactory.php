<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'title' => fake()->sentence(6),
            'slug' => fake()->slug(),
            'image' => 'https://picsum.photos/seed/' . fake()->word() . '/401/188',
            'content' => fake()->paragraph(5),
        ];
    }
}

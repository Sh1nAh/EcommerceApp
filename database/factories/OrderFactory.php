<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_amount' => fake()->numberBetween(100, 1000),
            // 'shipping_address' => fake()->address(),
            'status' => fake()->randomElement(['pending', 'processing', 'delivered', 'cancelled']), // Valid statuses
        ];
    }
}

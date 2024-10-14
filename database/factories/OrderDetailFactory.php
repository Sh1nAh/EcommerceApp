<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    public function definition()
    {
        return [
            'order_id' => \App\Models\Order::factory(), // Ensure you have an Order factory
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'township' => $this->faker->city,
            'city' => $this->faker->city,
            'notes' => $this->faker->sentence,
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'payment_receipt' => $this->faker->uuid,
        ];
    }
}

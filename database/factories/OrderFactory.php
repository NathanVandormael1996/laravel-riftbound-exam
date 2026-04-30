<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
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
            'order_number' => 'ORD-' . strtoupper(\Illuminate\Support\Str::random(8)),
            'total_amount' => fake()->randomFloat(2, 10, 500),
            'status' => \App\Enums\OrderStatus::PENDING,
            'billing_name' => fake()->name(),
            'billing_email' => fake()->safeEmail(),
            'billing_address' => fake()->address(),
            'shipping_name' => fake()->name(),
            'shipping_address' => fake()->address(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Customer;
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

    protected $model = Order::class;
    
    public function definition(): array
    {
        $statuses = ['Pending', 'In process', 'Loaded', 'Delivered'];

        return [
            'invoice_number' => 'INV-' . $this->faker->unique()->numberBetween(10000, 99999),
            'customer_id' => Customer::inRandomOrder()->first()->id ?? Customer::factory(),
            'order_date' => $this->faker->date(),
            'status' => $this->faker->randomElement($statuses),
            'description' => $this->faker->sentence(),
            'processed_by' => null,
            'delivered_by' => null,
        ];
    }
}

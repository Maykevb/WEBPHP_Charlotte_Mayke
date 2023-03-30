<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->text,
            'stars' => $this->faker->numberBetween(1, 5),
            'shipment_id' => $this->faker->unique()->numberBetween(1, 10),
            'account_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}

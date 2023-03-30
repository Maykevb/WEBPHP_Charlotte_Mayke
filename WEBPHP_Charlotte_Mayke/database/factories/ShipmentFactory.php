<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'place' => $this->faker->city,
            'streetName' => $this->faker->streetName,
            'houseNumber' => $this->faker->numberBetween(1, 100),
            'postalCode' => $this->faker->postcode,
            'webshop' => 'Amazon'
        ];
    }
}

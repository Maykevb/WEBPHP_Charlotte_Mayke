<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PickUpRequest>
 */
class PickUpRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->date;

        return [
            'start' => $date,
            'end' => $date,
            'time' => $this->faker->time,
            'title' => $this->faker->word,
            'postcode' => $this->faker->postcode,
            'huisnummer' => $this->faker->numberBetween(1, 100),
            'webshop' => 'Amazon'
        ];
    }
}

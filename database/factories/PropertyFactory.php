<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rooms = $this->faker->numberBetween(2, 10);

        return [
            'title' => $this->faker->sentence(6, true),
            'surface' => $this->faker->numberBetween(20, 350),
            'price' => $this->faker->numberBetween(80000, 2500000),
            'description' => $this->faker->sentences(4, true),
            'room' => $rooms,
            'bedroom' => $this->faker->numberBetween(1, $rooms),
            'floor' => $this->faker->numberBetween(0, 9),
            'town' => $this->faker->city,
            'address' => $this->faker->streetAddress,
            'zip' => $this->faker->postcode,
            'sell' => false
        ];
    }

    public function sell():static
    {
        return $this->state(fn (array $attributes) => [
            'sell' => true
        ]);
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hymn>
 */
class HymnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->numberBetween(1, 999),
            'title' => $this->faker->sentence(3),
            'duration' => $this->faker->numberBetween(1, 4).':'.str_pad((string) $this->faker->numberBetween(0, 59), 2, '0', STR_PAD_LEFT),
            'time_signature' => $this->faker->randomElement(['4/4', '3/4', '2/2', '6/8', '3/2']),
        ];
    }
}

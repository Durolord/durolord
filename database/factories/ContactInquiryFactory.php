<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactInquiry>
 */
class ContactInquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'company' => fake()->optional()->company(),
            'project_type' => fake()->randomElement(array_keys(config('portfolio.project_types'))),
            'budget' => fake()->randomElement(array_keys(config('portfolio.budgets'))),
            'message' => fake()->paragraphs(2, true),
            'ip_address' => fake()->ipv4(),
            'read_at' => null,
        ];
    }

    /**
     * Indicate that the inquiry has been read.
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'read_at' => now(),
        ]);
    }
}

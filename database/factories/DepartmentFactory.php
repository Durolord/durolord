<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Engineering',
            'Human Resources',
            'Finance',
            'Operations',
            'Sales',
            'Marketing',
        ]);

        return [
            'name'        => $name,
            'code'        => strtoupper(Str::slug($name, '_')),
            'slug'        => Str::slug($name),
            'description' => $this->faker->sentence(),
            'is_active'   => true,
        ];
    }
}

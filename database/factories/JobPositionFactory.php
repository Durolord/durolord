<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosition>
 */
class JobPositionFactory extends Factory
{
    public function definition(): array
    {
        $titles = ['Developer', 'HR Manager', 'Accountant', 'Product Manager', 'Designer'];

        return [
            'department_id' => Department::factory(),
            'title'         => $this->faker->randomElement($titles),
            'level'         => $this->faker->randomElement(['Junior', 'Mid', 'Senior']),
            'code'          => strtoupper($this->faker->bothify('POS-###')),
            'description'   => $this->faker->sentence(8),
            'is_active'     => true,
        ];
    }
}

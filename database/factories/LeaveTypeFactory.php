<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveType>
 */
class LeaveTypeFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Annual Leave',
            'Sick Leave',
            'Maternity Leave',
            'Paternity Leave',
            'Casual Leave',
        ]);

        return [
            'name'         => $name,
            'code'         => strtoupper(Str::slug($name, '_')),
            'default_days' => $this->faker->numberBetween(5, 30),
            'is_paid'      => $this->faker->boolean(80),
            'description'  => $this->faker->sentence(),
            'is_active'    => true,
        ];
    }
}

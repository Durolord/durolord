<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
use App\Models\JobPosition;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'        => User::factory(),
            'department_id'  => Department::factory(),
            'job_position_id'=> JobPosition::factory(),
            'employee_code'  => strtoupper($this->faker->bothify('EMP-####')),
            'first_name'     => $this->faker->firstName(),
            'last_name'      => $this->faker->lastName(),
            'other_names'    => $this->faker->optional()->firstName(),
            'gender'         => $this->faker->randomElement(['male', 'female']),
            'date_of_birth'  => $this->faker->dateTimeBetween('-45 years', '-20 years'),
            'hire_date'      => $this->faker->dateTimeBetween('-5 years', 'now'),
            'employment_type'=> $this->faker->randomElement(['full_time', 'part_time', 'contract']),
            'status'         => 'active',
            'phone'          => $this->faker->phoneNumber(),
            'alt_phone'      => $this->faker->optional()->phoneNumber(),
            'email'          => $this->faker->unique()->safeEmail(),
            'address'        => $this->faker->address(),
            'city'           => $this->faker->city(),
            'state'          => $this->faker->state(),
            'country'        => 'Nigeria',
            'base_salary'    => $this->faker->numberBetween(150000, 800000),
            'currency'       => 'NGN',
            'meta'           => [],
        ];
    }
}


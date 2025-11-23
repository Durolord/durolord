<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\LeaveType;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $days  = $this->faker->numberBetween(1, 14);
        $end   = (clone $start)->modify("+{$days} days");

        return [
            'employee_id' => Employee::factory(),
            'leave_type_id' => LeaveType::factory(),
            'start_date'  => $start,
            'end_date'    => $end,
            'total_days'  => $days,
            'reason'      => $this->faker->sentence(),
            'status'      => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}


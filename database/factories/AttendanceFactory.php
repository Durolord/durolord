<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-30 days', 'now');
        $status = $this->faker->randomElement(['present', 'absent', 'late', 'half_day']);

        return [
            'employee_id'    => Employee::factory(),
            'date'           => $date,
            'check_in_time'  => $status === 'absent' ? null : '09:00:00',
            'check_out_time' => $status === 'absent' ? null : '17:00:00',
            'status'         => $status,
            'notes'          => $this->faker->optional()->sentence(),
        ];
    }
}


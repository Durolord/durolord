<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\JobPosition;
use App\Models\Department;
class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $departments  = Department::all();
        $positions    = JobPosition::all();

        // Create 20 employees with linked users
        Employee::factory()->count(20)->create()->each(function ($employee) use ($departments, $positions) {
            $employee->department_id   = $departments->random()->id;
            $employee->job_position_id = $positions->where('department_id', $employee->department_id)->random()->id ?? $positions->random()->id;
            $employee->save();
        });
    }
}


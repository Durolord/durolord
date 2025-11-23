<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveRequest;
class LeaveRequestSeeder extends Seeder
{
    public function run(): void
    {
        $employees  = Employee::all();
        $leaveTypes = LeaveType::all();

        foreach ($employees as $employee) {
            LeaveRequest::factory()->count(2)->create([
                'employee_id'  => $employee->id,
                'leave_type_id'=> $leaveTypes->random()->id,
            ]);
        }
    }
}

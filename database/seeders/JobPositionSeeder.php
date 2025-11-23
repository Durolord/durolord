<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\JobPosition;
class JobPositionSeeder extends Seeder
{
    public function run(): void
    {
        $departments = Department::all();

        foreach ($departments as $department) {
            JobPosition::factory()->count(3)->create([
                'department_id' => $department->id,
            ]);
        }
    }
}


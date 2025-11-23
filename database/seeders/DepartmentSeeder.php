<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Engineering',
            'Human Resources',
            'Finance',
            'Operations',
            'Sales',
            'Marketing',
        ];

        foreach ($names as $name) {
            Department::factory()->create([
                'name' => $name,
            ]);
        }
    }
}

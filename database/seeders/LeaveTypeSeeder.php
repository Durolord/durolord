<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveType;
class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Annual Leave', 'default_days' => 21, 'is_paid' => true],
            ['name' => 'Sick Leave',   'default_days' => 10, 'is_paid' => true],
            ['name' => 'Maternity Leave', 'default_days' => 90, 'is_paid' => true],
            ['name' => 'Paternity Leave', 'default_days' => 7,  'is_paid' => true],
            ['name' => 'Unpaid Leave', 'default_days' => 0, 'is_paid' => false],
        ];

        foreach ($types as $data) {
            LeaveType::factory()->create($data);
        }
    }
}


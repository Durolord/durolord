<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'slug',
        'description',
        'is_active',
    ];

    public function positions()
    {
        return $this->hasMany(JobPosition::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

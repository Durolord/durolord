<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    /** @use HasFactory<\Database\Factories\JobPositionFactory> */
    use HasFactory;
    protected $fillable = [
        'department_id',
        'title',
        'level',
        'code',
        'description',
        'is_active',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * @return HasMany<Designation>
     */
    public function designations(): HasMany
    {
        return $this->hasMany(Designation::class);
    }

    /**
     * @return HasMany<Employee>
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * @return HasMany<Opening>
     */
    public function openings(): HasMany
    {
        return $this->hasMany(Opening::class);
    }

    /**
     * @return BelongsToMany<Employee>
     */
    public function heads(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'department_heads')
            ->withPivot('branch_id')
            ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayScale extends Model
{
    /** @use HasFactory<\Database\Factories\PayScaleFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'basic_salary',
        'active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'basic_salary' => 'float',
            'active' => 'boolean',
        ];
    }

    /**
     * @return HasMany<Allowance>
     */
    public function allowances(): HasMany
    {
        return $this->hasMany(Allowance::class);
    }

    /**
     * @return HasMany<Designation>
     */
    public function designations(): HasMany
    {
        return $this->hasMany(Designation::class);
    }
}

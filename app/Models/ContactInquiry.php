<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    /** @use HasFactory<\Database\Factories\ContactInquiryFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'company',
        'project_type',
        'budget',
        'message',
        'ip_address',
        'read_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    /**
     * @param  Builder<ContactInquiry>  $query
     */
    public function scopeUnread(Builder $query): void
    {
        $query->whereNull('read_at');
    }

    public function projectTypeLabel(): string
    {
        return config('portfolio.project_types.'.$this->project_type, $this->project_type);
    }

    public function budgetLabel(): string
    {
        return config('portfolio.budgets.'.$this->budget, $this->budget);
    }
}

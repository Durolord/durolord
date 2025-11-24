<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HymnUsage extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'service_id',
        'hymn_id',
        'hymn_number',
        'hymn_type',
    ];

    /**
     * @return BelongsTo<Service, HymnUsage>
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return BelongsTo<Hymn, HymnUsage>
     */
    public function hymn(): BelongsTo
    {
        return $this->belongsTo(Hymn::class);
    }
}

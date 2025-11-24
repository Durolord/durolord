<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpeakerActivity extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'service_id',
        'speaker_name',
        'activity',
    ];

    /**
     * @return BelongsTo<Service, SpeakerActivity>
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventProceeding extends Model
{
    protected $fillable = [
        'event_id', 'content', 'learning_points', 'activities_description', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(EventProceedingImage::class, 'event_proceeding_id')->orderBy('display_order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventProceedingImage extends Model
{
    protected $fillable = [
        'event_proceeding_id', 'image_path', 'caption', 'display_order',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
        ];
    }

    public function eventProceeding(): BelongsTo
    {
        return $this->belongsTo(EventProceeding::class);
    }
}

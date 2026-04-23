<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventDocument extends Model
{
    protected $fillable = ['event_id', 'name', 'file_path', 'mime_type', 'file_size'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getFormattedSizeAttribute(): string
    {
        if (!$this->file_size) return '';
        $kb = $this->file_size / 1024;
        if ($kb < 1024) return round($kb, 1) . ' KB';
        return round($kb / 1024, 1) . ' MB';
    }
}

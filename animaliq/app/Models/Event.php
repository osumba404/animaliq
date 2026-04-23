<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'program_id', 'title', 'slug', 'description', 'location',
        'start_datetime', 'end_datetime', 'capacity', 'banner_image', 'status',
    ];

    /** Computed display status based on dates. */
    public function getDisplayStatusAttribute(): string
    {
        if ($this->status === 'archived') return 'archived';
        if ($this->start_datetime && $this->start_datetime->isFuture()) return 'upcoming';
        if ($this->end_datetime && $this->end_datetime->isFuture()) return 'ongoing';
        if ($this->start_datetime && $this->start_datetime->isPast()) return 'completed';
        return 'active';
    }

    protected function casts(): array
    {
        return [
            'start_datetime' => 'datetime',
            'end_datetime' => 'datetime',
        ];
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function volunteerHours(): HasMany
    {
        return $this->hasMany(VolunteerHour::class);
    }

    public function proceeding(): HasOne
    {
        return $this->hasOne(EventProceeding::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(EventDocument::class);
    }

    /** Whether this event is in the past (start date has passed). */
    public function isPast(): bool
    {
        if ($this->status === 'archived') return false;
        return $this->start_datetime && $this->start_datetime->isPast()
            && (!$this->end_datetime || $this->end_datetime->isPast());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'active')
            ->where('start_datetime', '>', now());
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'program_id', 'title', 'slug', 'description', 'location',
        'start_datetime', 'end_datetime', 'capacity', 'banner_image', 'status',
    ];

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

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')
            ->where('start_datetime', '>', now());
    }
}

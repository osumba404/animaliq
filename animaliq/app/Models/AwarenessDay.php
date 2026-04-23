<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwarenessDay extends Model
{
    protected $fillable = ['title', 'celebration_date', 'body', 'image', 'active'];

    protected function casts(): array
    {
        return [
            'celebration_date' => 'date',
            'active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeToday($query)
    {
        return $query->where('celebration_date', today());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('celebration_date', '>=', today())->orderBy('celebration_date');
    }
}

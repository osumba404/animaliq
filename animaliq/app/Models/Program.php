<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'image', 'department_id', 'status'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}

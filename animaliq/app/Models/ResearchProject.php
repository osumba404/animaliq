<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchProject extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'summary', 'banner_image', 'department_id', 'start_date', 'end_date', 'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(ResearchReport::class, 'project_id');
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'image', 'start_date', 'end_date'];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}

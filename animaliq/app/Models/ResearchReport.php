<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchReport extends Model
{
    protected $fillable = ['project_id', 'title', 'file_path', 'banner_image', 'published_at'];

    protected function casts(): array
    {
        return ['published_at' => 'date'];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(ResearchProject::class, 'project_id');
    }
}

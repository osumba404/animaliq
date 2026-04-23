<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'author_id', 'title', 'slug', 'content', 'featured_image',
        'status', 'published_at',
    ];

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at');
    }

    public function views(): HasMany
    {
        return $this->hasMany(PostView::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(PostBookmark::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class)->whereNull('parent_id')->with('user', 'replies', 'likes')->withCount('likes')->latest();
    }
}

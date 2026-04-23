<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ForumPost extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'body', 'image', 'views_count'];

    protected static function booted(): void
    {
        static::creating(function (ForumPost $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title) . '-' . Str::random(6);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(ForumPostLike::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(ForumPostBookmark::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ForumComment::class)->whereNull('parent_id')->with('user', 'replies.user', 'likes')->withCount('likes')->latest();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

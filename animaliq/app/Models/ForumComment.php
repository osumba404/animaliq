<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumComment extends Model
{
    protected $fillable = ['forum_post_id', 'user_id', 'parent_id', 'body'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function forumPost(): BelongsTo
    {
        return $this->belongsTo(ForumPost::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ForumComment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ForumComment::class, 'parent_id')->with('user', 'likes')->withCount('likes');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(ForumCommentLike::class);
    }
}

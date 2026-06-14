<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPoint extends Model
{
    protected $fillable = ['user_id', 'action', 'points', 'source_type', 'source_id', 'occurred_at'];

    protected $casts = ['occurred_at' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Point values for every action
    public static function pointsFor(string $action): int
    {
        return match($action) {
            'account_created'    => 5,
            'blog_view'          => 1,
            'blog_like'          => 2,
            'blog_bookmark'      => 3,
            'blog_comment'       => 5,
            'blog_comment_like'  => 1,
            'forum_post'         => 10,
            'forum_like'         => 2,
            'forum_bookmark'     => 3,
            'forum_comment'      => 5,
            'forum_comment_like' => 1,
            'event_register'     => 8,
            'donation'           => 15,
            default              => 0,
        };
    }

    /**
     * Record a point event, ignoring duplicates silently.
     */
    public static function record(int $userId, string $action, string $sourceType = null, int $sourceId = null, \Carbon\Carbon $occurredAt = null): void
    {
        $points = self::pointsFor($action);
        if ($points === 0) return;

        try {
            self::firstOrCreate(
                [
                    'user_id'     => $userId,
                    'action'      => $action,
                    'source_type' => $sourceType,
                    'source_id'   => $sourceId,
                ],
                [
                    'points'      => $points,
                    'occurred_at' => $occurredAt ?? now(),
                ]
            );
        } catch (\Illuminate\Database\QueryException) {
            // Duplicate — silently ignore
        }
    }
}

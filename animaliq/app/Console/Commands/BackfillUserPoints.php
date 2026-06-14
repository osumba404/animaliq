<?php

namespace App\Console\Commands;

use App\Models\Donation;
use App\Models\EventRegistration;
use App\Models\ForumComment;
use App\Models\ForumCommentLike;
use App\Models\ForumPost;
use App\Models\ForumPostBookmark;
use App\Models\ForumPostLike;
use App\Models\PostBookmark;
use App\Models\PostComment;
use App\Models\PostCommentLike;
use App\Models\PostLike;
use App\Models\PostView;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Console\Command;

class BackfillUserPoints extends Command
{
    protected $signature   = 'animaliq:backfill-points';
    protected $description = 'Score all historical activity into user_points';

    public function handle(): int
    {
        $this->info('Backfilling user points from historical data...');

        // Account created
        $this->info('  account_created...');
        User::whereNotNull('id')->get()->each(fn($u) =>
            UserPoint::record($u->id, 'account_created', 'User', $u->id, $u->created_at)
        );

        // Blog views (logged-in users only)
        $this->info('  blog_view...');
        PostView::whereNotNull('user_id')->get()->each(fn($v) =>
            UserPoint::record($v->user_id, 'blog_view', 'PostView', $v->post_id, $v->created_at)
        );

        // Blog likes
        $this->info('  blog_like...');
        PostLike::all()->each(fn($l) =>
            UserPoint::record($l->user_id, 'blog_like', 'PostLike', $l->post_id, $l->created_at)
        );

        // Blog bookmarks
        $this->info('  blog_bookmark...');
        PostBookmark::all()->each(fn($b) =>
            UserPoint::record($b->user_id, 'blog_bookmark', 'PostBookmark', $b->post_id, $b->created_at)
        );

        // Blog comments
        $this->info('  blog_comment...');
        PostComment::all()->each(fn($c) =>
            UserPoint::record($c->user_id, 'blog_comment', 'PostComment', $c->id, $c->created_at)
        );

        // Blog comment likes
        $this->info('  blog_comment_like...');
        PostCommentLike::all()->each(fn($l) =>
            UserPoint::record($l->user_id, 'blog_comment_like', 'PostCommentLike', $l->post_comment_id, $l->created_at)
        );

        // Forum posts
        $this->info('  forum_post...');
        ForumPost::all()->each(fn($p) =>
            UserPoint::record($p->user_id, 'forum_post', 'ForumPost', $p->id, $p->created_at)
        );

        // Forum likes
        $this->info('  forum_like...');
        ForumPostLike::all()->each(fn($l) =>
            UserPoint::record($l->user_id, 'forum_like', 'ForumPostLike', $l->forum_post_id, $l->created_at)
        );

        // Forum bookmarks
        $this->info('  forum_bookmark...');
        ForumPostBookmark::all()->each(fn($b) =>
            UserPoint::record($b->user_id, 'forum_bookmark', 'ForumPostBookmark', $b->forum_post_id, $b->created_at)
        );

        // Forum comments
        $this->info('  forum_comment...');
        ForumComment::all()->each(fn($c) =>
            UserPoint::record($c->user_id, 'forum_comment', 'ForumComment', $c->id, $c->created_at)
        );

        // Forum comment likes
        $this->info('  forum_comment_like...');
        ForumCommentLike::all()->each(fn($l) =>
            UserPoint::record($l->user_id, 'forum_comment_like', 'ForumCommentLike', $l->forum_comment_id, $l->created_at)
        );

        // Event registrations
        $this->info('  event_register...');
        EventRegistration::all()->each(fn($r) =>
            UserPoint::record($r->user_id, 'event_register', 'Event', $r->event_id, $r->created_at)
        );

        // Donations
        $this->info('  donation...');
        Donation::whereNotNull('user_id')->get()->each(fn($d) =>
            UserPoint::record($d->user_id, 'donation', 'Donation', $d->id, $d->donated_at ?? $d->created_at)
        );

        $total = UserPoint::count();
        $this->info("Done. Total point records: {$total}");
        return 0;
    }
}

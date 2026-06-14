<?php

namespace App\Console\Commands;

use App\Models\Donation;
use App\Models\EventRegistration;
use App\Models\ForumComment;
use App\Models\ForumCommentLike;
use App\Models\ForumPost;
use App\Models\ForumPostBookmark;
use App\Models\ForumPostLike;
use App\Models\Post;
use App\Models\PostBookmark;
use App\Models\PostComment;
use App\Models\PostCommentLike;
use App\Models\PostLike;
use App\Models\PostView;
use App\Models\ResearchProject;
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

        // Posts published
        $this->info('  post_published...');
        Post::where('status', 'published')->whereNotNull('author_id')->get()->each(fn($p) =>
            UserPoint::record($p->author_id, 'post_published', 'Post', $p->id, $p->published_at ?? $p->created_at)
        );

        // Research published
        $this->info('  research_published...');
        ResearchProject::join('department_members', function($join) {
                $join->on('department_members.department_id', '=', 'research_projects.department_id')
                     ->where('department_members.is_lead', true);
            })
            ->select('research_projects.id', 'research_projects.created_at', 'department_members.user_id')
            ->get()->each(fn($r) =>
                UserPoint::record($r->user_id, 'research_published', 'ResearchProject', $r->id, $r->created_at)
            );

        // Account created
        $this->info('  account_created...');
        User::whereNotNull('id')->get()->each(fn($u) =>
            UserPoint::record($u->id, 'account_created', 'User', $u->id, $u->created_at)
        );

        // Blog likes
        $this->info('  blog_like...');
        PostLike::all()->each(fn($l) =>
            UserPoint::record($l->user_id, 'blog_like', 'PostLike', $l->post_id, $l->created_at)
        );

        // Blog author received likes
        $this->info('  post_received_like...');
        PostLike::join('posts', 'posts.id', '=', 'post_likes.post_id')
            ->select('post_likes.user_id', 'post_likes.post_id', 'post_likes.created_at', 'posts.author_id')
            ->get()->each(function($l) {
                if ($l->author_id && $l->author_id !== $l->user_id) {
                    UserPoint::record($l->author_id, 'post_received_like', 'PostLike', $l->post_id.'_'.$l->user_id, $l->created_at);
                }
            });

        // Blog bookmarks
        $this->info('  blog_bookmark...');
        PostBookmark::all()->each(fn($b) =>
            UserPoint::record($b->user_id, 'blog_bookmark', 'PostBookmark', $b->post_id, $b->created_at)
        );

        // Blog author received bookmarks
        $this->info('  post_received_bookmark...');
        PostBookmark::join('posts', 'posts.id', '=', 'post_bookmarks.post_id')
            ->select('post_bookmarks.user_id', 'post_bookmarks.post_id', 'post_bookmarks.created_at', 'posts.author_id')
            ->get()->each(function($b) {
                if ($b->author_id && $b->author_id !== $b->user_id) {
                    UserPoint::record($b->author_id, 'post_received_bookmark', 'PostBookmark', $b->post_id.'_'.$b->user_id, $b->created_at);
                }
            });

        // Blog comments
        $this->info('  blog_comment...');
        PostComment::all()->each(fn($c) =>
            UserPoint::record($c->user_id, 'blog_comment', 'PostComment', $c->id, $c->created_at)
        );

        // Blog author received comments
        $this->info('  post_received_comment...');
        PostComment::join('posts', 'posts.id', '=', 'post_comments.post_id')
            ->select('post_comments.user_id', 'post_comments.id', 'post_comments.created_at', 'posts.author_id')
            ->get()->each(function($c) {
                if ($c->author_id && $c->author_id !== $c->user_id) {
                    UserPoint::record($c->author_id, 'post_received_comment', 'PostComment', $c->id, $c->created_at);
                }
            });

        // Blog views
        $this->info('  blog_view + post_received_view...');
        PostView::whereNotNull('user_id')
            ->join('posts', 'posts.id', '=', 'post_views.post_id')
            ->select('post_views.user_id', 'post_views.post_id', 'post_views.created_at', 'posts.author_id')
            ->get()->each(function($v) {
                UserPoint::record($v->user_id, 'blog_view', 'PostView', $v->post_id, $v->created_at);
                if ($v->author_id && $v->author_id !== $v->user_id) {
                    UserPoint::record($v->author_id, 'post_received_view', 'PostView', $v->post_id.'_'.$v->user_id, $v->created_at);
                }
            });

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
        $this->info('  forum_like + forum_received_like...');
        ForumPostLike::join('forum_posts', 'forum_posts.id', '=', 'forum_post_likes.forum_post_id')
            ->select('forum_post_likes.user_id', 'forum_post_likes.forum_post_id', 'forum_post_likes.created_at', 'forum_posts.user_id as owner_id')
            ->get()->each(function($l) {
                UserPoint::record($l->user_id, 'forum_like', 'ForumPostLike', $l->forum_post_id, $l->created_at);
                if ($l->owner_id && $l->owner_id !== $l->user_id) {
                    UserPoint::record($l->owner_id, 'forum_received_like', 'ForumPostLike', $l->forum_post_id.'_'.$l->user_id, $l->created_at);
                }
            });

        // Forum bookmarks
        $this->info('  forum_bookmark + forum_received_bookmark...');
        ForumPostBookmark::join('forum_posts', 'forum_posts.id', '=', 'forum_post_bookmarks.forum_post_id')
            ->select('forum_post_bookmarks.user_id', 'forum_post_bookmarks.forum_post_id', 'forum_post_bookmarks.created_at', 'forum_posts.user_id as owner_id')
            ->get()->each(function($b) {
                UserPoint::record($b->user_id, 'forum_bookmark', 'ForumPostBookmark', $b->forum_post_id, $b->created_at);
                if ($b->owner_id && $b->owner_id !== $b->user_id) {
                    UserPoint::record($b->owner_id, 'forum_received_bookmark', 'ForumPostBookmark', $b->forum_post_id.'_'.$b->user_id, $b->created_at);
                }
            });

        // Forum comments
        $this->info('  forum_comment + forum_received_comment...');
        ForumComment::join('forum_posts', 'forum_posts.id', '=', 'forum_comments.forum_post_id')
            ->select('forum_comments.user_id', 'forum_comments.id', 'forum_comments.created_at', 'forum_posts.user_id as owner_id')
            ->get()->each(function($c) {
                UserPoint::record($c->user_id, 'forum_comment', 'ForumComment', $c->id, $c->created_at);
                if ($c->owner_id && $c->owner_id !== $c->user_id) {
                    UserPoint::record($c->owner_id, 'forum_received_comment', 'ForumComment', $c->id, $c->created_at);
                }
            });

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

<?php

namespace App\Http\Controllers;

use App\Mail\CommentNotification;
use App\Mail\LikeNotification;
use App\Mail\NewForumPostNotification;
use App\Models\ForumComment;
use App\Models\ForumCommentLike;
use App\Models\ForumPost;
use App\Models\ForumPostBookmark;
use App\Models\ForumPostLike;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = ForumPost::with('user')->withCount(['likes', 'bookmarks', 'comments'])->latest();

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        }

        $posts = $query->paginate(15)->withQueryString();
        return view('public.forum.index', compact('posts'));
    }

    public function create()
    {
        return view('public.forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string|min:10|max:10000',
            'image' => 'nullable|image|max:2048',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = \App\Services\ImageService::handleUpload($request->file('image'), 'forum');
        }

        $post = ForumPost::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'body'    => $request->body,
            'image'   => $image,
        ]);

        // Broadcast in-app + email to all other users
        $url    = route('forum.show', $post);
        $poster = auth()->user();
        User::whereNotNull('email')->where('id', '!=', auth()->id())->get()
            ->each(function (User $user) use ($post, $url, $poster) {
                Notification::create([
                    'user_id' => $user->id,
                    'type'    => 'post',
                    'title'   => $poster->first_name . ' started a new forum discussion',
                    'body'    => Str::limit($post->title, 80),
                    'url'     => $url,
                ]);
                try {
                    Mail::to($user->email)->queue(new NewForumPostNotification($post, $user->first_name, $poster->first_name . ' ' . $poster->last_name));
                } catch (\Exception $e) {
                    \Log::error('Forum post email failed: ' . $e->getMessage());
                }
            });

        return redirect()->route('forum.show', $post)->with('success', 'Post created!');
    }

    public function show(ForumPost $post)
    {
        $post->increment('views_count');
        $post->load('user', 'comments.user', 'comments.replies.user', 'comments.likes', 'comments.replies.likes');
        $post->loadCount(['likes', 'bookmarks', 'comments']);

        $userLiked      = auth()->check() && ForumPostLike::where('forum_post_id', $post->id)->where('user_id', auth()->id())->exists();
        $userBookmarked = auth()->check() && ForumPostBookmark::where('forum_post_id', $post->id)->where('user_id', auth()->id())->exists();

        return view('public.forum.show', compact('post', 'userLiked', 'userBookmarked'));
    }

    public function destroy(ForumPost $post)
    {
        if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }
        if ($post->image) \App\Services\ImageService::delete($post->image);
        $post->delete();
        return redirect()->route('forum.index')->with('success', 'Post deleted.');
    }

    public function like(Request $request, ForumPost $post)
    {
        $existing = ForumPostLike::where('forum_post_id', $post->id)->where('user_id', auth()->id())->first();
        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            ForumPostLike::create(['forum_post_id' => $post->id, 'user_id' => auth()->id()]);
            $liked = true;

            if ($post->user_id !== auth()->id()) {
                $liker = auth()->user();
                $url   = route('forum.show', $post);

                Notification::create([
                    'user_id' => $post->user_id,
                    'type'    => 'post',
                    'title'   => $liker->first_name . ' liked your forum post',
                    'body'    => Str::limit($post->title, 80),
                    'url'     => $url,
                ]);

                $post->load('user');
                try {
                    Mail::to($post->user->email)->queue(new LikeNotification(
                        recipientName: $post->user->first_name,
                        likerName:     $liker->first_name . ' ' . $liker->last_name,
                        contentTitle:  $post->title,
                        url:           $url,
                        context:       'forum post'
                    ));
                } catch (\Exception $e) {
                    \Log::error('Forum like email failed: ' . $e->getMessage());
                }
            }
        }

        return response()->json(['liked' => $liked, 'count' => ForumPostLike::where('forum_post_id', $post->id)->count()]);
    }

    public function bookmark(Request $request, ForumPost $post)
    {
        $existing = ForumPostBookmark::where('forum_post_id', $post->id)->where('user_id', auth()->id())->first();
        if ($existing) {
            $existing->delete();
            $bookmarked = false;
        } else {
            ForumPostBookmark::create(['forum_post_id' => $post->id, 'user_id' => auth()->id()]);
            $bookmarked = true;
        }
        return response()->json(['bookmarked' => $bookmarked, 'count' => ForumPostBookmark::where('forum_post_id', $post->id)->count()]);
    }

    public function comment(Request $request, ForumPost $post)
    {
        $request->validate(['body' => 'required|string|max:2000', 'parent_id' => 'nullable|exists:forum_comments,id']);

        $comment = ForumComment::create([
            'forum_post_id' => $post->id,
            'user_id'       => auth()->id(),
            'parent_id'     => $request->parent_id,
            'body'          => $request->body,
        ]);

        $comment->load('user');

        $notified  = collect();
        $commenter = auth()->user();

        // Notify post author
        if ($post->user_id !== auth()->id()) {
            $notified->push($post->user_id);
            $post->load('user');
            $url = route('forum.show', $post) . '#forum-comment-' . $comment->id;

            Notification::create([
                'user_id' => $post->user_id,
                'type'    => 'post',
                'title'   => $commenter->first_name . ' commented on your forum post',
                'body'    => Str::limit($comment->body, 80),
                'url'     => $url,
            ]);

            try {
                Mail::to($post->user->email)->queue(new CommentNotification(
                    recipientName: $post->user->first_name,
                    commenterName: $commenter->first_name . ' ' . $commenter->last_name,
                    contentTitle:  $post->title,
                    commentBody:   $comment->body,
                    url:           $url,
                    context:       'forum post'
                ));
            } catch (\Exception $e) {
                \Log::error('Forum comment email failed: ' . $e->getMessage());
            }
        }

        // Notify parent comment author (reply)
        if ($comment->parent_id) {
            $parent = ForumComment::with('user')->find($comment->parent_id);
            if ($parent && $parent->user_id !== auth()->id() && !$notified->contains($parent->user_id)) {
                $notified->push($parent->user_id);
                $url = route('forum.show', $post) . '#forum-comment-' . $comment->id;

                Notification::create([
                    'user_id' => $parent->user_id,
                    'type'    => 'post',
                    'title'   => $commenter->first_name . ' replied to your comment',
                    'body'    => Str::limit($comment->body, 80),
                    'url'     => $url,
                ]);

                try {
                    Mail::to($parent->user->email)->queue(new CommentNotification(
                        recipientName: $parent->user->first_name,
                        commenterName: $commenter->first_name . ' ' . $commenter->last_name,
                        contentTitle:  $post->title,
                        commentBody:   $comment->body,
                        url:           $url,
                        context:       'reply'
                    ));
                } catch (\Exception $e) {
                    \Log::error('Forum reply email failed: ' . $e->getMessage());
                }
            }
        }

        return response()->json([
            'comment' => [
                'id'          => $comment->id,
                'body'        => $comment->body,
                'parent_id'   => $comment->parent_id,
                'created_at'  => $comment->created_at->diffForHumans(),
                'likes_count' => 0,
                'user'        => [
                    'name'  => $comment->user->first_name . ' ' . $comment->user->last_name,
                    'photo' => $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : null,
                ],
            ],
        ]);
    }

    public function likeComment(Request $request, ForumComment $comment)
    {
        $existing = ForumCommentLike::where('forum_comment_id', $comment->id)->where('user_id', auth()->id())->first();
        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            ForumCommentLike::create(['forum_comment_id' => $comment->id, 'user_id' => auth()->id()]);
            $liked = true;

            // Notify comment author
            if ($comment->user_id !== auth()->id()) {
                $comment->load('user', 'forumPost');
                $liker = auth()->user();
                $post  = $comment->forumPost;
                $url   = $post ? route('forum.show', $post) . '#forum-comment-' . $comment->id : route('forum.index');

                Notification::create([
                    'user_id' => $comment->user_id,
                    'type'    => 'post',
                    'title'   => $liker->first_name . ' liked your comment',
                    'body'    => Str::limit($comment->body, 80),
                    'url'     => $url,
                ]);

                try {
                    Mail::to($comment->user->email)->queue(new LikeNotification(
                        recipientName: $comment->user->first_name,
                        likerName:     $liker->first_name . ' ' . $liker->last_name,
                        contentTitle:  $post ? $post->title : 'Forum comment',
                        url:           $url,
                        context:       'comment'
                    ));
                } catch (\Exception $e) {
                    \Log::error('Forum comment like email failed: ' . $e->getMessage());
                }
            }
        }

        return response()->json(['liked' => $liked, 'count' => ForumCommentLike::where('forum_comment_id', $comment->id)->count()]);
    }
}

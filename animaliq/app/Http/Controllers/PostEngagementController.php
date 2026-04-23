<?php

namespace App\Http\Controllers;

use App\Mail\CommentNotification;
use App\Mail\LikeNotification;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostBookmark;
use App\Models\PostComment;
use App\Models\PostCommentLike;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PostEngagementController extends Controller
{
    public function like(Request $request, Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Login required'], 401);
        }

        $existing = PostLike::where('post_id', $post->id)->where('user_id', auth()->id())->first();
        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            PostLike::create(['post_id' => $post->id, 'user_id' => auth()->id()]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => PostLike::where('post_id', $post->id)->count(),
        ]);
    }

    public function bookmark(Request $request, Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Login required'], 401);
        }

        $existing = PostBookmark::where('post_id', $post->id)->where('user_id', auth()->id())->first();
        if ($existing) {
            $existing->delete();
            $bookmarked = false;
        } else {
            PostBookmark::create(['post_id' => $post->id, 'user_id' => auth()->id()]);
            $bookmarked = true;
        }

        return response()->json([
            'bookmarked' => $bookmarked,
            'count'      => PostBookmark::where('post_id', $post->id)->count(),
        ]);
    }

    public function comment(Request $request, Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Login required'], 401);
        }

        $request->validate(['body' => 'required|string|max:2000', 'parent_id' => 'nullable|exists:post_comments,id']);

        $comment = PostComment::create([
            'post_id'   => $post->id,
            'user_id'   => auth()->id(),
            'parent_id' => $request->parent_id,
            'body'      => $request->body,
        ]);

        $comment->load('user');
        $this->notifyCommentRecipients($comment, $post);

        return response()->json([
            'comment' => $this->formatComment($comment),
        ]);
    }

    public function likeComment(Request $request, PostComment $comment)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Login required'], 401);
        }

        $existing = PostCommentLike::where('post_comment_id', $comment->id)->where('user_id', auth()->id())->first();
        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            PostCommentLike::create(['post_comment_id' => $comment->id, 'user_id' => auth()->id()]);
            $liked = true;

            // Notify the comment author (in-app + email)
            if ($comment->user_id !== auth()->id()) {
                $comment->load('user', 'post');
                $post   = $comment->post;
                $liker  = auth()->user();
                $url    = route('blog.show', $post) . '#comment-' . $comment->id;

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
                        contentTitle:  Str::limit($comment->body, 80),
                        url:           $url,
                        context:       'comment'
                    ));
                } catch (\Exception $e) {
                    \Log::error('Comment like email failed: ' . $e->getMessage());
                }
            }
        }

        return response()->json([
            'liked' => $liked,
            'count' => PostCommentLike::where('post_comment_id', $comment->id)->count(),
        ]);
    }

    private function notifyCommentRecipients(PostComment $comment, Post $post): void
    {
        $notified  = collect();
        $commenter = auth()->user();
        $url       = route('blog.show', $post) . '#comment-' . $comment->id;

        // Notify post author
        if ($post->author_id && $post->author_id !== auth()->id()) {
            $notified->push($post->author_id);
            $author = $post->author;

            Notification::create([
                'user_id' => $post->author_id,
                'type'    => 'post',
                'title'   => $commenter->first_name . ' commented on your article',
                'body'    => Str::limit($comment->body, 80),
                'url'     => $url,
            ]);

            try {
                Mail::to($author->email)->queue(new CommentNotification(
                    recipientName: $author->first_name,
                    commenterName: $commenter->first_name . ' ' . $commenter->last_name,
                    contentTitle:  $post->title,
                    commentBody:   $comment->body,
                    url:           $url,
                    context:       'article'
                ));
            } catch (\Exception $e) {
                \Log::error('Article comment email failed: ' . $e->getMessage());
            }
        }

        // Notify parent comment author (reply scenario)
        if ($comment->parent_id) {
            $parent = PostComment::with('user')->find($comment->parent_id);
            if ($parent && $parent->user_id !== auth()->id() && !$notified->contains($parent->user_id)) {
                $notified->push($parent->user_id);

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
                    \Log::error('Article reply email failed: ' . $e->getMessage());
                }
            }
        }
    }

    private function formatComment(PostComment $comment): array
    {
        return [
            'id'          => $comment->id,
            'body'        => $comment->body,
            'parent_id'   => $comment->parent_id,
            'created_at'  => $comment->created_at->diffForHumans(),
            'likes_count' => 0,
            'user' => [
                'name'  => $comment->user->first_name . ' ' . $comment->user->last_name,
                'photo' => $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : null,
            ],
        ];
    }
}

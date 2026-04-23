<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostBookmark;
use App\Models\PostLike;
use App\Models\PostView;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with('author')->withCount(['views', 'likes', 'bookmarks', 'comments']);

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->query('sort', 'latest');
        if ($sort === 'oldest') {
            $query->orderBy('published_at', 'asc');
        } else {
            $query->orderBy('published_at', 'desc');
        }

        $posts = $query->paginate(12)->withQueryString();

        return view('public.blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }
        $post->load('author', 'comments.replies.user');
        $post->loadCount(['views', 'likes', 'bookmarks', 'comments']);

        // Track view (once per session)
        $viewKey = 'post_viewed_' . $post->id;
        if (!session()->has($viewKey)) {
            PostView::create([
                'post_id'    => $post->id,
                'ip_address' => request()->ip(),
                'user_id'    => auth()->id(),
            ]);
            session()->put($viewKey, true);
        }

        $userLiked     = auth()->check() && PostLike::where('post_id', $post->id)->where('user_id', auth()->id())->exists();
        $userBookmarked= auth()->check() && PostBookmark::where('post_id', $post->id)->where('user_id', auth()->id())->exists();

        return view('public.blog.show', compact('post', 'userLiked', 'userBookmarked'));
    }
}

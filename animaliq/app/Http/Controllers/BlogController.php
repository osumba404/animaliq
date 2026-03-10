<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with('author');

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
        $post->load('author');

        return view('public.blog.show', compact('post'));
    }
}

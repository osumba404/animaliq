<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()->with('author', 'campaign')->latest('published_at')->paginate(12);

        return view('public.blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }
        $post->load('author', 'campaign');

        return view('public.blog.show', compact('post'));
    }
}

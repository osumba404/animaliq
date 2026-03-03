<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author', 'campaign')->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $campaigns = Campaign::orderBy('title')->get();
        return view('admin.posts.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => 'nullable|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|string|max:255',
            'status' => 'in:draft,published',
            'published_at' => 'nullable|date',
        ]);
        $validated['author_id'] = auth()->id();
        Post::create($validated);
        return redirect()->route('admin.posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        $campaigns = Campaign::orderBy('title')->get();
        return view('admin.posts.edit', compact('post', 'campaigns'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'campaign_id' => 'nullable|exists:campaigns,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|string|max:255',
            'status' => 'in:draft,published',
            'published_at' => 'nullable|date',
        ]);
        $post->update($validated);
        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }
}

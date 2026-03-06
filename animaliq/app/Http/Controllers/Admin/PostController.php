<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'in:draft,published',
            'published_at' => 'nullable|date',
        ]);
        $validated['author_id'] = auth()->id();
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        } else {
            $validated['featured_image'] = null;
        }
        if (! $request->filled('slug')) {
            unset($validated['slug']);
        }
        Post::create($validated);
        return redirect()->route('admin.posts.index')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'in:draft,published',
            'published_at' => 'nullable|date',
        ]);
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        } else {
            unset($validated['featured_image']);
        }
        if (! $request->filled('slug')) {
            unset($validated['slug']);
        }
        $post->update($validated);
        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate(['image' => 'required|image|max:2048']);
        $path = $request->file('image')->store('posts', 'public');
        return response()->json(['url' => asset('storage/' . $path)]);
    }
}

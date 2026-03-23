<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewPostNotification;
use App\Models\Post;
use App\Services\NotificationService;
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
            $validated['featured_image'] = \App\Services\ImageService::handleUpload($request->file('featured_image'), 'posts');
        } else {
            $validated['featured_image'] = null;
        }
        if (! $request->filled('slug')) {
            unset($validated['slug']);
        }
        $post = Post::create($validated);
        if ($post->status === 'published') {
            $post->load('author', 'campaign');
            app(NotificationService::class)->broadcast(
                type:   'post',
                title:  'New Post: ' . $post->title,
                body:   $post->content ? \Illuminate\Support\Str::limit(strip_tags($post->content), 120) : '',
                url:    route('blog.show', $post),
                mailer: fn($user) => new NewPostNotification($post, $user->first_name ?: 'there'),
            );
        }
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
            if ($post->featured_image) {
                \App\Services\ImageService::delete($post->featured_image);
            }
            $validated['featured_image'] = \App\Services\ImageService::handleUpload($request->file('featured_image'), 'posts');
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
        if ($post->featured_image) {
            \App\Services\ImageService::delete($post->featured_image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate(['image' => 'required|image|max:2048']);
        $path = \App\Services\ImageService::handleUpload($request->file('image'), 'posts');
        return response()->json(['url' => asset('storage/' . $path)]);
    }
}

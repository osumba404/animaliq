@extends('layouts.admin')

@section('title', 'Posts')
@section('heading', 'Posts')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="theme-btn">Add Post</a>
    </div>

    @if($posts->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No posts yet.</p>
            <a href="{{ route('admin.posts.create') }}" class="theme-btn">Add your first post</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($posts as $p)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <h2 class="font-semibold theme-text-primary text-lg">{{ $p->title }}</h2>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                <span><span class="font-medium">Status:</span> <span class="theme-badge">{{ $p->status ?? '—' }}</span></span>
                                @if($p->author)
                                    <span><span class="font-medium">Author:</span> {{ $p->author->first_name }} {{ $p->author->last_name }}</span>
                                @endif
                                @if($p->published_at)
                                    <span><span class="font-medium">Published:</span> {{ $p->published_at->format('M j, Y') }}</span>
                                @endif
                            </div>
                            @if($p->content)
                                <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit(strip_tags($p->content), 140) }}</p>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            <a href="{{ route('admin.posts.edit', $p) }}" class="theme-link font-medium">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $posts->links() }}
    @endif
@endsection

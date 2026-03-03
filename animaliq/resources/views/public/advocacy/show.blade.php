@extends('layouts.public')

@section('title', $campaign->title)

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $campaign->title }}</h1>
    <div class="prose dark:prose-invert max-w-none mb-8">{!! nl2br(e($campaign->description ?? '')) !!}</div>
    <h2 class="text-xl font-semibold mb-4">Related Posts</h2>
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="block p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-[#19140035]">
                <h3 class="font-semibold">{{ $post->title }}</h3>
                <p class="text-sm text-[#706f6c]">{{ $post->published_at?->format('M j, Y') }}</p>
            </a>
        @empty
            <p class="text-[#706f6c]">No posts yet.</p>
        @endforelse
    </div>
    {{ $posts->links() }}
@endsection

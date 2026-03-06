@extends('layouts.public')

@section('title', $campaign->title)

@section('content')
    <div class="max-w-4xl">
        <p class="text-sm font-semibold theme-accent mb-2">Campaign</p>
        <h1 class="text-4xl font-bold theme-text-primary mb-6">{{ $campaign->title }}</h1>
        @if($campaign->start_date || $campaign->end_date)
            <p class="text-sm theme-text-secondary mb-6">
                @if($campaign->start_date) {{ $campaign->start_date->format('F j, Y') }} @endif
                @if($campaign->end_date) → {{ $campaign->end_date->format('F j, Y') }} @endif
            </p>
        @endif
        <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed mb-12">{!! nl2br(e($campaign->description ?? '')) !!}</div>

        <h2 class="text-2xl font-bold theme-text-primary mb-6">Related Posts</h2>
        <div class="grid md:grid-cols-2 gap-6">
            @forelse($posts as $post)
                <a href="{{ route('blog.show', $post) }}" class="block theme-card rounded-2xl overflow-hidden transition hover:shadow-xl group">
                    @if($post->featured_image)
                        <div class="h-40 overflow-hidden">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                    @endif
                    <div class="p-5">
                        <h3 class="font-bold theme-text-primary group-hover:theme-accent transition">{{ $post->title }}</h3>
                        <p class="text-sm theme-text-secondary mt-2">{{ $post->published_at?->format('M j, Y') }}</p>
                    </div>
                </a>
            @empty
                <p class="theme-text-secondary col-span-full">No posts yet for this campaign.</p>
            @endforelse
        </div>
        {{ $posts->links() }}
    </div>
@endsection

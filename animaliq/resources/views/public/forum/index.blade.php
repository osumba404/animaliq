@extends('layouts.public')

@section('title', 'Community Forum – Animal IQ Initiative')

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16 mb-8">
        <div class="max-w-3xl mx-auto flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Community</p>
                <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Forum</h1>
                <p class="text-lg theme-text-secondary mt-3">Start and join discussions with the Animal IQ community.</p>
                <div class="mt-4 accent-bar"></div>
            </div>
            @auth
            <a href="{{ route('forum.create') }}" class="theme-btn flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Post
            </a>
            @else
            <a href="{{ route('login') }}" class="theme-btn">Log in to post</a>
            @endauth
        </div>
    </section>

    <div class="max-w-3xl mx-auto">
        <form method="GET" class="mb-6">
            <div class="relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search discussions..." class="theme-input w-full pl-9">
                <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none"><svg class="w-4 h-4 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></span>
            </div>
        </form>

        @if(session('success'))
            <div class="mb-4 p-3 rounded theme-alert-success text-sm">{{ session('success') }}</div>
        @endif

        <div class="space-y-4">
            @forelse($posts as $post)
            <article class="theme-card rounded-2xl p-5 hover-lift transition reveal">
                <div class="flex gap-3">
                    {{-- Avatar --}}
                    <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold theme-bg-secondary theme-accent overflow-hidden">
                        @if($post->user->profile_photo)
                            <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(mb_substr($post->user->first_name ?? '?', 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                            <span class="font-semibold theme-text-primary text-sm">{{ $post->user->first_name }} {{ $post->user->last_name }}</span>
                            <span class="text-xs theme-text-secondary">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <h2 class="text-lg font-bold theme-text-primary mb-2 hover:theme-accent transition">
                            <a href="{{ route('forum.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="theme-text-secondary text-sm line-clamp-2 mb-3">{{ Str::limit(strip_tags($post->body), 160) }}</p>
                        @if($post->image)
                        <div class="h-36 rounded-xl overflow-hidden mb-3">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        </div>
                        @endif
                        <div class="flex items-center gap-4 text-xs theme-text-secondary">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ number_format($post->views_count) }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                {{ number_format($post->likes_count) }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                {{ number_format($post->comments_count) }}
                            </span>
                            <a href="{{ route('forum.show', $post) }}" class="ml-auto theme-link font-medium">Read →</a>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="theme-card rounded-2xl p-12 text-center">
                <p class="theme-text-secondary text-lg mb-4">No discussions yet.</p>
                @auth
                <a href="{{ route('forum.create') }}" class="theme-btn inline-block">Start a discussion</a>
                @else
                <a href="{{ route('login') }}" class="theme-btn inline-block">Log in to post</a>
                @endauth
            </div>
            @endforelse
        </div>

        <div class="mt-8">{{ $posts->links() }}</div>
    </div>
@endsection

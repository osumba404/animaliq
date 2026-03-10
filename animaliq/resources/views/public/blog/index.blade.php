@extends('layouts.public')

@section('title', 'Blog')

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-4xl">
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Stories & updates</p>
            <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Blog</h1>
            <p class="text-lg theme-text-secondary mt-2">News, stories, and updates from the Animal IQ community.</p>
        </div>
    </section>

    <div class="py-12">
        <div class="mb-8 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
            <form method="GET" class="flex-1 flex flex-col md:flex-row gap-3 md:items-center">
                <div class="flex-1 flex gap-2">
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search blog posts..."
                            class="theme-input w-full pl-9"
                        >
                        <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none" aria-hidden="true">
                        <svg class="w-5 h-5 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <label for="sort-blog" class="text-sm theme-text-secondary">Sort by</label>
                    <select id="sort-blog" name="sort" class="theme-input text-sm">
                        <option value="latest" @selected(request('sort', 'latest') === 'latest')>Newest first</option>
                        <option value="oldest" @selected(request('sort') === 'oldest')>Oldest first</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="theme-card rounded-2xl overflow-hidden transition hover:shadow-xl group flex flex-col">
                    <a href="{{ route('blog.show', $post) }}" class="block flex-1 flex flex-col">
                        <div class="h-52 bg-[var(--bg-secondary)] overflow-hidden">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-14 h-14 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></div>
                            @endif
                        </div>
                        <div class="p-5 flex-1 flex flex-col">
                            <h2 class="text-lg font-bold theme-text-primary group-hover:theme-accent transition line-clamp-2">{{ $post->title }}</h2>
                            <p class="text-sm theme-text-secondary mt-2">By {{ $post->author->first_name }} {{ $post->author->last_name }} · {{ $post->published_at?->format('M j, Y') }}</p>
                            @if($post->content)
                                <p class="text-sm theme-text-secondary mt-3 line-clamp-2">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                            @endif
                        </div>
                    </a>
                </article>
            @empty
                <div class="col-span-full theme-card rounded-2xl p-12 text-center">
                    <p class="theme-text-secondary text-lg">No posts yet. Check back soon.</p>
                </div>
            @endforelse
        </div>
        {{ $posts->links() }}
    </div>
@endsection

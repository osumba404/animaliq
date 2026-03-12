@extends('layouts.public')

@section('title', 'Research & Knowledge Hub')

@section('meta')
@php
    $seoTitle = 'Research & Knowledge Hub – Animal IQ';
    $seoDescription = 'Youth-led research, reports, and knowledge sharing at Animal IQ. Explore research projects and published reports.';
    $seoCanonical = route('research.index');
@endphp
@include('partials.seo')
@endsection

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Knowledge hub</p>
                <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Research & Innovation</h1>
                <p class="text-lg theme-text-secondary mt-2">Youth-led research, reports, and knowledge sharing.</p>
            </div>
            <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => 'Research & Innovation – Animal IQ', 'url' => route('research.index')])</div>
        </div>
    </section>

    @if($sectionBanner)
        <div class="rounded-2xl overflow-hidden my-8 -mx-4 md:mx-0 h-56 md:h-72">
            <img src="{{ asset('storage/' . $sectionBanner) }}" alt="Research" class="w-full h-full object-cover">
        </div>
    @endif

    <div class="py-8">
        <div class="max-w-6xl mx-auto mb-8">
            <form method="GET" class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
                <div class="flex-1 flex gap-2">
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search research projects..."
                            class="theme-input w-full pl-9"
                        >
                        <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none" aria-hidden="true">
                        <svg class="w-5 h-5 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <label for="sort-research" class="text-sm theme-text-secondary">Sort by</label>
                    <select id="sort-research" name="sort" class="theme-input text-sm">
                        <option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest first</option>
                        <option value="oldest" @selected(request('sort') === 'oldest')>Oldest first</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            @forelse($projects as $project)
                <article class="theme-card rounded-2xl overflow-hidden transition hover:shadow-xl group flex flex-col">
                    <a href="{{ route('research.show', $project) }}" class="block flex-1">
                        <div class="h-52 bg-[var(--bg-secondary)] overflow-hidden">
                            @if($project->banner_image)
                                <img src="{{ asset('storage/' . $project->banner_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-16 h-16 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
                            @endif
                        </div>
                        <div class="p-6">
                            @if($project->department)
                                <p class="text-xs font-semibold theme-accent uppercase tracking-wide mb-2">{{ $project->department->name }}</p>
                            @endif
                            <h2 class="text-xl font-bold theme-text-primary group-hover:theme-accent transition">{{ $project->title }}</h2>
                            <p class="text-sm theme-text-secondary mt-2 flex items-center gap-2">
                                <span class="theme-badge">{{ $project->status }}</span>
                                @if($project->start_date) {{ $project->start_date->format('Y') }} @endif
                            </p>
                            @if($project->summary)
                                <p class="text-sm theme-text-secondary mt-3 line-clamp-2">{{ Str::limit($project->summary, 120) }}</p>
                            @endif
                        </div>
                    </a>
                    <div class="p-6 pt-0 flex flex-wrap items-center justify-between gap-2">
                        <a href="{{ route('research.show', $project) }}" class="theme-link font-medium">View project →</a>
                        @include('partials.share-button', ['shareTitle' => $project->title . ' – Animal IQ', 'url' => route('research.show', $project)])
                    </div>
                </article>
            @empty
                <div class="col-span-full theme-card rounded-2xl p-12 text-center">
                    <p class="theme-text-secondary text-lg">No research projects yet. Check back soon.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $projects->links() }}
        </div>
    </div>
@endsection

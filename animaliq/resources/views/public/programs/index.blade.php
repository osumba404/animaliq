@extends('layouts.public')

@section('title', 'Wildlife Education & Conservation Programs – Animal IQ')

@section('meta')
@php
    $seoTitle       = 'Wildlife Education & Conservation Programs – Animal IQ';
    $seoDescription = 'Explore Animal IQ’s programs in wildlife education, youth conservation clubs, school outreach, leadership training, and community conservation across Kenya.';
    $seoCanonical   = route('programs.index');
    $jsonLd = [
        '@context'         => 'https://schema.org',
        '@type'            => 'CollectionPage',
        'name'             => 'Animal IQ Programs',
        'url'              => route('programs.index'),
        'description'      => 'Wildlife education, youth engagement, and conservation programs by Animal IQ.',
        'publisher'        => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'breadcrumb'       => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',     'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Programs', 'item' => route('programs.index')],
            ],
        ],
    ];
@endphp
@include('partials.seo')
@if($programs->previousPageUrl())
<link rel="prev" href="{{ $programs->previousPageUrl() }}">
@endif
@if($programs->nextPageUrl())
<link rel="next" href="{{ $programs->nextPageUrl() }}">
@endif
@endsection

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-6xl mx-auto">
            <div class="animate-fade-in-up">
                <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">What we do</p>
                <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Our Programs</h1>
                <p class="text-lg theme-text-secondary mt-2 animate-fade-in-up animate-delay-1">Explore our initiatives in wildlife education, youth engagement, and conservation.</p>
                <div class="mt-4 accent-bar"></div>
            </div>
        </div>
    </section>

    <div class="py-12 max-w-6xl mx-auto">
        <form method="GET" class="mb-8 flex flex-col md:flex-row gap-3 md:items-center md:justify-between reveal">
            <div class="flex-1 flex gap-2">
                <div class="relative flex-1">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search programs..."
                        class="theme-input w-full pl-9"
                    >
                    <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none" aria-hidden="true">
                        <svg class="w-5 h-5 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <label for="sort-programs" class="text-sm theme-text-secondary">Sort by</label>
                <select id="sort-programs" name="sort" class="theme-input text-sm">
                    <option value="title" @selected(request('sort', 'title') === 'title')>Title A–Z</option>
                    <option value="newest" @selected(request('sort') === 'newest')>Newest first</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest first</option>
                </select>
            </div>
        </form>

        @forelse($programs as $program)
            @php $img = $program->image ?? $program->events->first()?->banner_image; @endphp
            <article class="theme-card rounded-2xl overflow-hidden mb-8 hover-lift group flex flex-col md:flex-row reveal">
                <a href="{{ route('programs.show', $program) }}" class="md:w-2/5 flex-shrink-0 block h-56 md:h-auto min-h-[200px] bg-[var(--bg-secondary)] img-zoom">
                        @if($img)
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->title }}" class="w-full h-full object-cover" loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center theme-text-secondary">
                                <svg class="w-16 h-16 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            </div>
                        @endif
                </a>
                <div class="md:flex-1 p-6 md:p-8 flex flex-col justify-center flex-wrap md:flex-nowrap md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        @if($program->department)
                            <p class="text-sm font-semibold theme-accent mb-2">{{ $program->department->name }}</p>
                        @endif
                        <h2 class="text-2xl font-bold theme-text-primary group-hover:theme-accent transition"><a href="{{ route('programs.show', $program) }}" class="hover:theme-accent">{{ $program->title }}</a></h2>
                        <p class="theme-text-secondary mt-2 line-clamp-3">{{ Str::limit($program->description, 180) }}</p>
                        @if($program->events_count > 0)
                        <p class="text-xs font-semibold theme-accent mt-2">{{ $program->events_count }} {{ Str::plural('event', $program->events_count) }} hosted</p>
                        @endif
                        <a href="{{ route('programs.show', $program) }}" class="inline-flex items-center gap-2 mt-4 theme-link font-medium">View program →</a>
                    </div>
                    <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => $program->title . ' – Animal IQ', 'url' => route('programs.show', $program)])</div>
                </div>
            </article>
        @empty
            <div class="theme-card rounded-2xl p-12 text-center">
                <p class="theme-text-secondary text-lg">No programs yet. Check back soon.</p>
            </div>
        @endforelse

        <div class="mt-8">
            {{ $programs->links() }}
        </div>
    </div>
@endsection

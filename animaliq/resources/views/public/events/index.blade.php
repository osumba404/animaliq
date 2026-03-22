@extends('layouts.public')

@section('title', 'Events & Experiences')

@section('meta')
@php
    $seoTitle       = 'Upcoming Events & Wildlife Experiences – Animal IQ';
    $seoDescription = 'Find and register for Animal IQ events: wildlife workshops, school field trips, community conservation activities, and youth engagement experiences across Kenya.';
    $seoCanonical   = route('events.index');
    $jsonLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'CollectionPage',
        'name'        => 'Animal IQ Events',
        'url'         => route('events.index'),
        'description' => 'Wildlife workshops, field trips, and community events by Animal IQ.',
        'publisher'   => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'breadcrumb'  => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',   'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Events', 'item' => route('events.index')],
            ],
        ],
    ];
@endphp
@include('partials.seo')
@endsection

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-6xl mx-auto">
            <div>
                <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Get involved</p>
                <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Events & Experiences</h1>
                <p class="text-lg theme-text-secondary mt-2">Join workshops, field trips, and community activities.</p>
            </div>
        </div>
    </section>

    <div class="py-12 max-w-6xl mx-auto">
        <form method="GET" class="mb-8 flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
            <div class="flex-1 flex gap-2">
                <div class="relative flex-1">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search events (title, location, description)..."
                        class="theme-input w-full pl-9"
                    >
                    <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none" aria-hidden="true">
                        <svg class="w-5 h-5 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <label for="sort-events" class="text-sm theme-text-secondary">Sort by</label>
                <select id="sort-events" name="sort" class="theme-input text-sm">
                    <option value="soonest" @selected(request('sort', 'soonest') === 'soonest')>Soonest first</option>
                    <option value="latest" @selected(request('sort') === 'latest')>Latest first</option>
                </select>
            </div>
        </form>

        <h2 class="text-2xl font-bold theme-text-primary mb-6">Upcoming</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($upcoming as $event)
                <article class="theme-card rounded-2xl overflow-hidden transition hover:shadow-xl group flex flex-col">
                    <div class="h-48 bg-[var(--bg-secondary)] overflow-hidden">
                        @if($event->banner_image)
                            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-14 h-14 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                        @endif
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        @if($event->program)
                            <p class="text-xs font-semibold theme-accent uppercase tracking-wide mb-2">{{ $event->program->title }}</p>
                        @endif
                        <h3 class="font-bold text-lg theme-text-primary">{{ $event->title }}</h3>
                        <p class="text-sm theme-text-secondary mt-2 flex-1 line-clamp-2">{{ Str::limit(strip_tags($event->description ?? ''), 100) }}</p>
                        <p class="text-sm theme-text-secondary mt-3">{{ $event->start_datetime?->format('l, M j, Y') }}</p>
                        @if($event->location)
                            <p class="text-xs theme-text-secondary mt-1">{{ Str::limit($event->location, 40) }}</p>
                        @endif
                        <div class="flex flex-wrap items-center justify-between gap-2 mt-4">
                        <a href="{{ route('events.show', $event) }}" class="theme-btn inline-block">@include('partials.event-view-label', ['event' => $event])</a>
                        @include('partials.share-button', ['shareTitle' => $event->title . ' – Animal IQ', 'url' => route('events.show', $event)])
                    </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full theme-card rounded-2xl p-12 text-center">
                    <p class="theme-text-secondary text-lg">No upcoming events. Check back soon.</p>
                </div>
            @endforelse
        </div>
        {{ $upcoming->links() }}

        @if($past->isNotEmpty())
            <h2 class="text-2xl font-bold theme-text-primary mb-4 mt-12">Past Events</h2>
            <ul class="space-y-3">
                @foreach($past as $event)
                    <li class="flex flex-wrap items-center justify-between gap-2 theme-card rounded-xl px-4 py-3 transition hover:shadow-md">
                        <a href="{{ route('events.show', $event) }}#proceedings" class="flex-1 min-w-0 theme-link font-medium">
                            <span>{{ $event->title }}</span>
                            <span class="text-sm theme-text-secondary font-normal ml-2">{{ $event->start_datetime?->format('M j, Y') }}</span>
                        </a>
                        @include('partials.share-button', ['shareTitle' => $event->title . ' – Animal IQ', 'url' => route('events.show', $event)])
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

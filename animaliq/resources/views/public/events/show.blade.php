@extends('layouts.public')

@section('title', $event->title . ' – Animal IQ Event')

@section('meta')
@php
    $seoTitle       = $event->title . ' – Animal IQ Event';
    $seoDescription = $event->description
        ? Str::limit(strip_tags($event->description), 155)
        : 'Join ' . $event->title . ' – an Animal IQ event' . ($event->location ? ' at ' . $event->location : '') . ($event->start_datetime ? ' on ' . $event->start_datetime->format('F j, Y') : '') . '.';
    $seoCanonical   = route('events.show', $event);
    $seoImage       = $event->banner_image;
    $jsonLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Event',
        'name'        => $event->title,
        'url'         => route('events.show', $event),
        'description' => strip_tags($event->description ?? ''),
        'eventStatus' => 'https://schema.org/EventScheduled',
        'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
        'startDate'   => $event->start_datetime?->toIso8601String(),
        'endDate'     => $event->end_datetime?->toIso8601String(),
        'location'    => $event->location ? ['@type' => 'Place', 'name' => $event->location] : null,
        'organizer'   => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'image'       => $event->banner_image ? asset('storage/' . $event->banner_image) : null,
        'breadcrumb'  => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',   'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Events', 'item' => route('events.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $event->title, 'item' => route('events.show', $event)],
            ],
        ],
    ];
@endphp
@include('partials.seo')
@endsection

@push('styles')
<style>
/* Blog / CMS content – typography for HTML from editor */
.blog-content { color: var(--text-secondary); line-height: 1.75; }
.blog-content h1 { font-size: 1.875rem; font-weight: 700; margin-top: 2rem; margin-bottom: 0.75rem; color: var(--text-primary); line-height: 1.3; }
.blog-content h1:first-child { margin-top: 0; }
.blog-content h2 { font-size: 1.5rem; font-weight: 700; margin-top: 1.75rem; margin-bottom: 0.5rem; color: var(--text-primary); border-bottom: 1px solid var(--border-color); padding-bottom: 0.25rem; }
.blog-content h3 { font-size: 1.25rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.5rem; color: var(--text-primary); }
.blog-content h4 { font-size: 1.125rem; font-weight: 600; margin-top: 1.25rem; margin-bottom: 0.5rem; color: var(--text-primary); }
.blog-content p { margin-top: 0.75rem; margin-bottom: 0.75rem; }
.blog-content p:first-child { margin-top: 0; }
.blog-content ul { margin: 0.75rem 0; padding-left: 1.5rem; list-style-type: disc; }
.blog-content ol { margin: 0.75rem 0; padding-left: 1.5rem; list-style-type: decimal; }
.blog-content li { margin: 0.25rem 0; }
.blog-content li > ul, .blog-content li > ol { margin: 0.25rem 0; }
.blog-content blockquote { margin: 1rem 0; padding: 0.75rem 1rem; border-left: 4px solid var(--accent-orange); background: var(--bg-warm); color: var(--text-secondary); font-style: italic; border-radius: 0 0.25rem 0.25rem 0; }
.blog-content a { color: var(--accent-orange); text-decoration: none; }
.blog-content a:hover { text-decoration: underline; }
.blog-content strong { font-weight: 700; color: var(--text-primary); }
.blog-content em { font-style: italic; }
.blog-content hr { margin: 1.5rem 0; border: none; border-top: 1px solid var(--border-color); }
.blog-content img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1rem 0; }
.blog-content pre, .blog-content code { font-family: ui-monospace, monospace; font-size: 0.875em; background: var(--bg-secondary); padding: 0.125rem 0.375rem; border-radius: 0.25rem; }
.blog-content pre { padding: 1rem; overflow-x: auto; margin: 1rem 0; }
.blog-content pre code { padding: 0; background: transparent; }
</style>
@endpush

@section('content')
    <nav aria-label="Breadcrumb" class="mb-4 text-sm">
        <ol class="flex flex-wrap items-center gap-1 theme-text-secondary">
            <li><a href="{{ route('home') }}" class="hover:underline">Home</a> <span aria-hidden="true" class="opacity-40">›</span></li>
            <li><a href="{{ route('events.index') }}" class="hover:underline">Events</a> <span aria-hidden="true" class="opacity-40">›</span></li>
            <li class="theme-text-primary font-medium">{{ $event->title }}</li>
        </ol>
    </nav>
    <article class="max-w-3xl mx-auto">
        {{-- Hero / banner --}}
        @if($event->banner_image)
            <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-64 md:h-96 shadow-lg">
                <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
            </div>
        @else
            <div class="rounded-2xl theme-bg-secondary h-40 md:h-56 flex items-center justify-center mb-8 mx-4 md:mx-0">
                <svg class="w-20 h-20 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        @endif

        {{-- Event header --}}
        <header class="mb-8 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 reveal">
            <div>
            @if($event->program)
                <p class="text-sm font-semibold theme-accent uppercase tracking-wide mb-2">{{ $event->program->title }}</p>
            @endif
            <h1 class="text-3xl md:text-4xl font-bold theme-text-primary mb-4">{{ $event->title }}</h1>
            <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm theme-text-secondary">
                <span>{{ $event->start_datetime?->format('l, F j, Y \a\t g:i A') }}</span>
                @if($event->end_datetime)
                    <span>→ {{ $event->end_datetime->format('M j, g:i A') }}</span>
                @endif
                @if($event->location)
                    <span>· {{ $event->location }}</span>
                @endif
            </div>
            @if($event->capacity)
                <p class="text-sm theme-text-secondary mt-2">Capacity: {{ $event->registrations_count ?? 0 }} / {{ $event->capacity }} registered</p>
            @endif
            </div>
            <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => $event->title . ' – Animal IQ', 'url' => route('events.show', $event)])</div>
        </header>

        {{-- Original event description --}}
        <section class="mb-10 reveal">
            <h2 class="text-xl font-bold theme-text-primary mb-3">About this event</h2>
            <div class="blog-content mb-10">{!! nl2br(e($event->description ?? 'No description.')) !!}</div>
        </section>

        {{-- Registration (upcoming only) --}}
        @if($event->status === 'upcoming' && $event->start_datetime && $event->start_datetime->isFuture())
            <section class="mb-10">
                @auth
                    @if($isRegistered)
                        <div class="theme-card rounded-xl p-4 theme-bg-warm border-l-4 border-l-[var(--accent-orange)]">
                            <p class="font-semibold theme-text-primary">You're registered for this event.</p>
                        </div>
                    @else
                        <form action="{{ route('events.register', $event) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="theme-btn">Register for this event</button>
                        </form>
                    @endif
                @else
                    <p class="theme-text-secondary mb-2">Log in or register to sign up for this event.</p>
                    <a href="{{ route('login') }}" class="theme-btn inline-block">Log in</a>
                    <a href="{{ route('register') }}" class="theme-btn-outline inline-block ml-2">Sign up</a>
                @endauth
            </section>
        @endif

        {{-- Post-event proceedings --}}
        @if($event->proceeding)
            <section class="pt-10 border-t theme-border" id="proceedings">
                <h2 class="text-2xl font-bold theme-text-primary mb-6">What happened</h2>
                <p class="text-sm theme-text-secondary mb-6">A look back at the event: activities, highlights, and takeaways.</p>

                @if($event->proceeding->content)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold theme-text-primary mb-2">Summary</h3>
                        <div class="blog-content mb-10">{!! nl2br(e($event->proceeding->content)) !!}</div>
                    </div>
                @endif

                @if($event->proceeding->activities_description)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold theme-text-primary mb-2">Activities of the day</h3>
                        <div class="blog-content mb-10">{!! nl2br(e($event->proceeding->activities_description)) !!}</div>
                    </div>
                @endif

                @if($event->proceeding->learning_points)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold theme-text-primary mb-2">Learning areas & takeaways</h3>
                        <div class="blog-content mb-10">{!! nl2br(e($event->proceeding->learning_points)) !!}</div>
                    </div>
                @endif

                @if($event->proceeding->images->isNotEmpty())
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold theme-text-primary mb-4">Gallery</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($event->proceeding->images as $img)
                                <figure class="theme-card rounded-xl overflow-hidden">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->caption ?? 'Event photo' }}" class="w-full h-48 object-cover">
                                    @if($img->caption)
                                        <figcaption class="p-3 text-sm theme-text-secondary">{{ $img->caption }}</figcaption>
                                    @endif
                                </figure>
                            @endforeach
                        </div>
                    </div>
                @endif
            </section>
        @endif
    </article>
@endsection

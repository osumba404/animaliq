@extends('layouts.public')

@section('title', $program->title . ' – Animal IQ Program')

@section('meta')
@php
    $seoTitle       = $program->title . ' – Animal IQ Program';
    $seoDescription = $program->description
        ? Str::limit(strip_tags($program->description), 155)
        : 'Learn about the ' . $program->title . ' program at Animal IQ – wildlife education and conservation in action.';
    $seoCanonical   = route('programs.show', $program);
    $seoImage       = $program->image ?? $program->events->first()?->banner_image;
    $jsonLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Course',
        'name'        => $program->title,
        'url'         => route('programs.show', $program),
        'description' => strip_tags($program->description ?? ''),
        'provider'    => ['@type' => 'Organization', 'name' => 'Animal IQ', 'url' => url('/')],
        'breadcrumb'  => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',     'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Programs', 'item' => route('programs.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $program->title, 'item' => route('programs.show', $program)],
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
            <li><a href="{{ route('programs.index') }}" class="hover:underline">Programs</a> <span aria-hidden="true" class="opacity-40">›</span></li>
            <li class="theme-text-primary font-medium">{{ $program->title }}</li>
        </ol>
    </nav>
    <article class="max-w-3xl mx-auto">
        @php $img = $program->image ?? $program->events->first()?->banner_image; @endphp
        @if($img)
            <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-64 md:h-96 shadow-lg">
                <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
            </div>
        @endif
        <header class="mb-8 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 reveal">
            <div>
                @if($program->department)
                    <p class="text-sm font-semibold theme-accent uppercase tracking-wide mb-2">{{ $program->department->name }}</p>
                @endif
                <h1 class="text-3xl md:text-4xl font-bold theme-text-primary">{{ $program->title }}</h1>
                @if($program->start_date || $program->end_date)
                    <p class="text-sm theme-text-secondary mt-2">
                        @if($program->start_date) {{ $program->start_date->format('F j, Y') }} @endif
                        @if($program->start_date && $program->end_date) – @endif
                        @if($program->end_date) {{ $program->end_date->format('F j, Y') }} @endif
                    </p>
                @endif
            </div>
            <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => $program->title . ' – Animal IQ', 'url' => route('programs.show', $program)])</div>
        </header>
        <div class="blog-content mb-10">{!! nl2br(e($program->description ?? '')) !!}</div>

        <section class="pt-10 border-t theme-border">
            <h2 class="text-2xl font-bold theme-text-primary mb-4">Related Events</h2>
            @forelse($program->events as $event)
                <a href="{{ route('events.show', $event) }}{{ $event->isPast() ? '#proceedings' : '' }}" class="flex flex-wrap items-center justify-between gap-4 theme-card rounded-xl p-4 mb-3 transition hover:shadow-lg block">
                    <span class="font-semibold theme-text-primary">{{ $event->title }}</span>
                    <span class="text-sm theme-text-secondary">{{ $event->start_datetime?->format('M j, Y') }} · @include('partials.event-view-label', ['event' => $event])</span>
                </a>
            @empty
                <p class="theme-text-secondary">No upcoming or past events for this program.</p>
            @endforelse
        </section>
    </article>
@endsection

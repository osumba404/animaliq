@extends('layouts.public')

@section('title', $program->title)

@section('meta')
@php
    $seoTitle = $program->title . ' – Animal IQ';
    $seoDescription = Str::limit(strip_tags($program->description ?? ''), 160);
    $seoCanonical = route('programs.show', $program);
    $seoImage = $program->image ?? $program->events->first()?->banner_image;
@endphp
@include('partials.seo')
@endsection

@section('content')
    @php $img = $program->image ?? $program->events->first()?->banner_image; @endphp
    @if($img)
        <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-56 md:h-80">
            <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
        </div>
    @endif

    <div class="max-w-4xl mx-auto">
        <header class="mb-8 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
                @if($program->department)
                    <p class="text-sm font-semibold theme-accent uppercase tracking-wide mb-2">{{ $program->department->name }}</p>
                @endif
                <h1 class="text-3xl md:text-4xl font-bold theme-text-primary">{{ $program->title }}</h1>
            </div>
            <div class="flex-shrink-0">@include('partials.share-button', ['shareTitle' => $program->title . ' – Animal IQ', 'url' => route('programs.show', $program)])</div>
        </header>
        <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed mb-10">{!! nl2br(e($program->description ?? '')) !!}</div>

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
    </div>
@endsection

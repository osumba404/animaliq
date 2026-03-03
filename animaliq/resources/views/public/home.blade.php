@extends('layouts.public')

@section('title', 'Home')

@section('content')
    <section class="mb-12">
        @if($slides->isNotEmpty())
            <div class="rounded-lg overflow-hidden theme-bg-warm theme-border border aspect-[3/1] flex items-center justify-center">
                @foreach($slides->take(1) as $slide)
                    <div class="p-8 text-center">
                        @if($slide->image_path)
                            <img src="{{ asset('storage/' . $slide->image_path) }}" alt="{{ $slide->title }}" class="max-h-64 mx-auto mb-4">
                        @endif
                        <h1 class="text-3xl font-bold theme-text-primary">{{ $slide->title ?? 'Welcome to Animal IQ' }}</h1>
                        @if($slide->subtitle)
                            <p class="mt-2 text-lg theme-text-secondary">{{ $slide->subtitle }}</p>
                        @endif
                        @if($slide->cta_text && $slide->cta_link)
                            <div class="flex flex-wrap gap-3 justify-center mt-4">
                                <a href="{{ $slide->cta_link }}" class="theme-btn px-6 py-2">{{ $slide->cta_text }}</a>
                                @if($slide->cta_secondary_text && $slide->cta_secondary_link)
                                    <a href="{{ $slide->cta_secondary_link }}" class="theme-btn-outline px-6 py-2">{{ $slide->cta_secondary_text }}</a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-lg overflow-hidden theme-bg-warm theme-border border aspect-[3/1] flex items-center justify-center">
                <div class="p-8 text-center">
                    <h1 class="text-3xl font-bold theme-text-primary">The Wild Window</h1>
                    <p class="mt-2 text-lg theme-text-secondary">Connecting youth with wildlife and environmental education.</p>
                </div>
            </div>
        @endif
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 theme-section-title">Our Mission</h2>
        <p class="text-lg theme-text-secondary">{{ $mission }}</p>
    </section>

    <section class="mb-12 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="p-4 rounded-lg theme-card text-center">
            <p class="text-3xl font-bold theme-accent">{{ number_format($youthReached) }}</p>
            <p class="text-sm theme-text-secondary">Youth Reached</p>
        </div>
        <div class="p-4 rounded-lg theme-card text-center">
            <p class="text-3xl font-bold theme-accent">{{ number_format($membersActive) }}</p>
            <p class="text-sm theme-text-secondary">Members Active</p>
        </div>
        <div class="p-4 rounded-lg theme-card text-center">
            <p class="text-3xl font-bold theme-accent">{{ number_format($eventsHosted) }}</p>
            <p class="text-sm theme-text-secondary">Events Hosted</p>
        </div>
        <div class="p-4 rounded-lg theme-card text-center">
            <p class="text-3xl font-bold theme-accent">{{ number_format($partnershipsFormed) }}</p>
            <p class="text-sm theme-text-secondary">Partnerships Formed</p>
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 theme-section-title">Core Programs</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($programs as $program)
                <a href="{{ route('programs.show', $program) }}" class="block p-4 rounded-lg theme-card hover:border-[var(--accent-orange)] transition-colors">
                    <h3 class="font-semibold theme-text-primary">{{ $program->title }}</h3>
                    <p class="text-sm theme-text-secondary mt-1 line-clamp-2">{{ $program->description }}</p>
                </a>
            @empty
                <p class="theme-text-secondary">Programs will be listed here.</p>
            @endforelse
        </div>
    </section>

    @if($upcomingEvent)
    <section class="mb-12 p-6 rounded-lg theme-bg-warm theme-border border">
        <h2 class="text-2xl font-semibold mb-4 theme-section-title">Upcoming Event</h2>
        <h3 class="text-xl font-medium theme-text-primary">{{ $upcomingEvent->title }}</h3>
        <p class="theme-text-secondary">{{ $upcomingEvent->start_datetime?->format('l, F j, Y \a\t g:i A') }}</p>
        <a href="{{ route('events.show', $upcomingEvent) }}" class="inline-block mt-4 theme-btn px-6 py-2">View Event</a>
    </section>
    @endif

    <section class="flex flex-wrap gap-4">
        <a href="{{ route('community.dashboard') }}" class="theme-btn-outline px-6 py-2">Join the Community</a>
        <a href="{{ route('events.index') }}" class="theme-btn-outline px-6 py-2">Attend an Event</a>
        <a href="{{ route('donations.index') }}" class="theme-btn px-6 py-2">Support the Mission</a>
    </section>
@endsection

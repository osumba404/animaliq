@extends('layouts.public')

@section('title', 'Events & Experiences')

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-4xl">
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Get involved</p>
            <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Events & Experiences</h1>
            <p class="text-lg theme-text-secondary mt-2">Join workshops, field trips, and community activities.</p>
        </div>
    </section>

    <div class="py-12">
        <h2 class="text-2xl font-bold theme-text-primary mb-6">Upcoming</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($upcoming as $event)
                <article class="theme-card rounded-2xl overflow-hidden transition hover:shadow-xl group flex flex-col">
                    <div class="h-48 bg-[var(--bg-secondary)] overflow-hidden">
                        @if($event->banner_image)
                            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center theme-text-secondary"><span class="text-5xl opacity-30">📅</span></div>
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
                        <a href="{{ route('events.show', $event) }}" class="theme-btn inline-block text-center mt-4">View event</a>
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
                    <li>
                        <a href="{{ route('events.show', $event) }}" class="flex flex-wrap items-center justify-between gap-2 theme-card rounded-xl px-4 py-3 transition hover:shadow-md theme-link font-medium block">
                            <span>{{ $event->title }}</span>
                            <span class="text-sm theme-text-secondary font-normal">{{ $event->start_datetime?->format('M j, Y') }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

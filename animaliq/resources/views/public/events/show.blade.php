@extends('layouts.public')

@section('title', $event->title)

@section('content')
    @if($event->banner_image)
        <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-64 md:h-96">
            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
        </div>
    @else
        <div class="rounded-2xl theme-bg-secondary h-48 md:h-64 flex items-center justify-center mb-8">
            <span class="text-7xl opacity-30">📅</span>
        </div>
    @endif

    <div class="max-w-3xl">
        @if($event->program)
            <p class="text-sm font-semibold theme-accent mb-2">{{ $event->program->title }}</p>
        @endif
        <h1 class="text-4xl font-bold theme-text-primary mb-4">{{ $event->title }}</h1>
        <div class="flex flex-wrap gap-4 text-sm theme-text-secondary mb-6">
            <span>{{ $event->start_datetime?->format('l, F j, Y \a\t g:i A') }}</span>
            @if($event->end_datetime)
                <span>→ {{ $event->end_datetime->format('M j, g:i A') }}</span>
            @endif
            @if($event->location)
                <span>· {{ $event->location }}</span>
            @endif
        </div>
        @if($event->capacity)
            <p class="text-sm theme-text-secondary mb-4">Capacity: {{ $event->registrations_count ?? 0 }} / {{ $event->capacity }} registered</p>
        @endif

        <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed mb-8">{!! nl2br(e($event->description ?? '')) !!}</div>

        @if($event->status === 'upcoming' && $event->start_datetime && $event->start_datetime->isFuture())
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
        @endif
    </div>
@endsection

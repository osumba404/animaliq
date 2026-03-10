@extends('layouts.public')

@section('title', $event->title)

@section('content')
    {{-- Hero / banner --}}
    @if($event->banner_image)
        <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-56 md:h-80">
            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
        </div>
    @else
        <div class="rounded-2xl theme-bg-secondary h-40 md:h-56 flex items-center justify-center mb-8">
            <svg class="w-20 h-20 opacity-30 theme-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
    @endif

    <div class="max-w-4xl mx-auto">
        {{-- Event header --}}
        <header class="mb-8">
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
        </header>

        {{-- Original event description --}}
        <section class="mb-10">
            <h2 class="text-xl font-bold theme-text-primary mb-3">About this event</h2>
            <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed">{!! nl2br(e($event->description ?? 'No description.')) !!}</div>
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
                        <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed">{!! nl2br(e($event->proceeding->content)) !!}</div>
                    </div>
                @endif

                @if($event->proceeding->activities_description)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold theme-text-primary mb-2">Activities of the day</h3>
                        <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed">{!! nl2br(e($event->proceeding->activities_description)) !!}</div>
                    </div>
                @endif

                @if($event->proceeding->learning_points)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold theme-text-primary mb-2">Learning areas & takeaways</h3>
                        <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed">{!! nl2br(e($event->proceeding->learning_points)) !!}</div>
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
    </div>
@endsection

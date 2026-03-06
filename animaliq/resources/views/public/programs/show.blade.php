@extends('layouts.public')

@section('title', $program->title)

@section('content')
    @php $img = $program->image ?? $program->events->first()?->banner_image; @endphp
    @if($img)
        <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-64 md:h-80">
            <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
        </div>
    @endif

    <div class="max-w-3xl">
        @if($program->department)
            <p class="text-sm font-semibold theme-accent mb-2">Department: {{ $program->department->name }}</p>
        @endif
        <h1 class="text-4xl font-bold theme-text-primary mb-6">{{ $program->title }}</h1>
        <div class="prose prose-lg max-w-none theme-text-secondary leading-relaxed">{!! nl2br(e($program->description ?? '')) !!}</div>

        <section class="mt-12 pt-8 border-t theme-border">
            <h2 class="text-2xl font-bold theme-text-primary mb-4">Related Events</h2>
            @forelse($program->events as $event)
                <a href="{{ route('events.show', $event) }}" class="flex flex-wrap items-center justify-between gap-4 theme-card rounded-xl p-4 mb-3 transition hover:shadow-lg block">
                    <span class="font-semibold theme-text-primary">{{ $event->title }}</span>
                    <span class="text-sm theme-text-secondary">{{ $event->start_datetime?->format('M j, Y') }} · {{ $event->status }}</span>
                </a>
            @empty
                <p class="theme-text-secondary">No upcoming or past events for this program.</p>
            @endforelse
        </section>
    </div>
@endsection

@extends('layouts.public')

@section('title', $program->title)

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $program->title }}</h1>
    @if($program->department)
        <p class="text-[#706f6c] mb-4">Department: {{ $program->department->name }}</p>
    @endif
    <div class="prose dark:prose-invert max-w-none mb-8">{!! nl2br(e($program->description ?? '')) !!}</div>
    <h2 class="text-xl font-semibold mb-2">Related Events</h2>
    <ul class="space-y-2">
        @forelse($program->events as $event)
            <li><a href="{{ route('events.show', $event) }}" class="text-[#f53003] hover:underline">{{ $event->title }}</a> – {{ $event->start_datetime?->format('M j, Y') }}</li>
        @empty
            <li class="text-[#706f6c]">No upcoming or past events.</li>
        @endforelse
    </ul>
@endsection

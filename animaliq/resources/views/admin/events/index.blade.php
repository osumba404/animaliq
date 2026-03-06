@extends('layouts.admin')

@section('title', 'Events')
@section('heading', 'Events')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold theme-text-primary">Events</h1>
        <a href="{{ route('admin.events.create') }}" class="theme-btn">Add Event</a>
    </div>

    @if($events->isEmpty())
        <div class="theme-card rounded-lg p-8 text-center">
            <p class="theme-text-secondary mb-4">No events yet.</p>
            <a href="{{ route('admin.events.create') }}" class="theme-btn">Add your first event</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($events as $e)
                <article class="theme-card rounded-lg p-4 transition hover:shadow-lg">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="min-w-0 flex-1">
                            <h2 class="font-semibold theme-text-primary text-lg">{{ $e->title }}</h2>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-2 text-sm theme-text-secondary">
                                <span><span class="font-medium">Date:</span> {{ $e->start_datetime?->format('M j, Y') ?? '—' }}@if($e->end_datetime) → {{ $e->end_datetime->format('M j, Y') }}@endif</span>
                                <span><span class="font-medium">Status:</span> <span class="theme-badge">{{ $e->status ?? '—' }}</span></span>
                                @if($e->program)
                                    <span><span class="font-medium">Program:</span> {{ $e->program->title }}</span>
                                @endif
                                <span><span class="font-medium">Registrations:</span> {{ $e->registrations_count ?? 0 }}@if($e->capacity) / {{ $e->capacity }} capacity@endif</span>
                                @if($e->location)
                                    <span><span class="font-medium">Location:</span> {{ Str::limit($e->location, 30) }}</span>
                                @endif
                            </div>
                            @isset($e->description)
                                <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit(strip_tags($e->description), 140) }}</p>
                            @endisset
                        </div>
                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            <a href="{{ route('admin.events.show', $e) }}" class="theme-link font-medium">View</a>
                            <a href="{{ route('admin.events.edit', $e) }}" class="theme-link font-medium">Edit</a>
                            <form action="{{ route('admin.events.destroy', $e) }}" method="POST" class="inline" onsubmit="return confirm('Delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        {{ $events->links() }}
    @endif
@endsection

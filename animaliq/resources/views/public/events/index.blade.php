@extends('layouts.public')

@section('title', 'Events & Experiences')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Events & Experiences</h1>
    <h2 class="text-xl font-semibold mb-4">Upcoming</h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @forelse($upcoming as $event)
            <a href="{{ route('events.show', $event) }}" class="block p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-[#19140035]">
                <h3 class="font-semibold">{{ $event->title }}</h3>
                <p class="text-sm text-[#706f6c]">{{ $event->start_datetime?->format('l, F j, Y') }}</p>
            </a>
        @empty
            <p class="text-[#706f6c] col-span-full">No upcoming events.</p>
        @endforelse
    </div>
    {{ $upcoming->links() }}
    @if($past->isNotEmpty())
        <h2 class="text-xl font-semibold mb-4">Past Events</h2>
        <ul class="space-y-2">
            @foreach($past as $event)
                <li><a href="{{ route('events.show', $event) }}" class="text-[#f53003] hover:underline">{{ $event->title }}</a> – {{ $event->start_datetime?->format('M j, Y') }}</li>
            @endforeach
        </ul>
    @endif
@endsection

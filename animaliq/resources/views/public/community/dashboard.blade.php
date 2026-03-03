@extends('layouts.public')

@section('title', 'Community Dashboard')

@section('content')
    <h1 class="text-3xl font-bold mb-6">My Dashboard</h1>
    @if($membership)
        <section class="mb-8 p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A]">
            <h2 class="text-xl font-semibold mb-2">Membership</h2>
            <p>Status: {{ $membership->status }}</p>
            <p>Type: {{ $membership->membership_type }}</p>
            <p>Joined: {{ $membership->join_date?->format('F j, Y') }}</p>
        </section>
    @endif
    <section class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Registered Events</h2>
        <ul class="space-y-2">
            @forelse($registrations as $reg)
                <li><a href="{{ route('events.show', $reg->event) }}" class="text-[#f53003] hover:underline">{{ $reg->event->title }}</a> – {{ $reg->status }}</li>
            @empty
                <li class="text-[#706f6c]">No registrations yet.</li>
            @endforelse
        </ul>
    </section>
    <section>
        <h2 class="text-xl font-semibold mb-2">Volunteer Hours</h2>
        <p class="text-[#706f6c]">Total: {{ number_format($totalHours, 1) }} hours</p>
    </section>
@endsection

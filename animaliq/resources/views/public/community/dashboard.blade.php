@extends('layouts.public')

@section('title', 'Community Dashboard')

@section('content')
    <h1 class="text-3xl font-bold mb-6 theme-text-primary">My Dashboard</h1>

    {{-- Personal stats --}}
    <section class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="theme-card rounded-lg p-4 text-center">
            <p class="text-2xl font-bold theme-accent">{{ $registrationsCount }}</p>
            <p class="text-sm theme-text-secondary">Events registered</p>
        </div>
        <div class="theme-card rounded-lg p-4 text-center">
            <p class="text-2xl font-bold theme-accent">{{ number_format($totalHours, 1) }}</p>
            <p class="text-sm theme-text-secondary">Volunteer hours</p>
        </div>
        <div class="theme-card rounded-lg p-4 text-center">
            <p class="text-2xl font-bold theme-accent">{{ $donationsCount }}</p>
            <p class="text-sm theme-text-secondary">Donations made</p>
        </div>
        <div class="theme-card rounded-lg p-4 text-center">
            <p class="text-2xl font-bold theme-accent">{{ number_format($donationsTotal ?? 0, 0) }}</p>
            <p class="text-sm theme-text-secondary">Total donated</p>
        </div>
    </section>

    {{-- Profile card --}}
    <section class="theme-card rounded-lg p-6 mb-8">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="flex gap-4">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="" class="w-20 h-20 rounded-full object-cover">
                @else
                    <div class="w-20 h-20 rounded-full theme-bg-warm flex items-center justify-center text-2xl theme-accent font-bold">{{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}</div>
                @endif
                <div>
                    <h2 class="text-xl font-semibold theme-text-primary">{{ $user->first_name }} {{ $user->last_name }}</h2>
                    <p class="theme-text-secondary">{{ $user->email }}</p>
                    @if($user->phone)<p class="text-sm theme-text-secondary">{{ $user->phone }}</p>@endif
                    @if($user->bio)<p class="text-sm theme-text-secondary mt-2">{{ $user->bio }}</p>@endif
                </div>
            </div>
            <a href="{{ route('community.profile') }}" class="theme-btn-outline">Edit account</a>
        </div>
    </section>

    @if($membership)
        <section class="theme-card rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-2 theme-section-title">Membership</h2>
            <p class="theme-text-primary">Status: <span class="theme-accent">{{ $membership->status }}</span></p>
            <p class="theme-text-secondary">Type: {{ $membership->membership_type }}</p>
            <p class="theme-text-secondary">Joined: {{ $membership->join_date?->format('F j, Y') }}</p>
        </section>
    @endif

    <section class="theme-card rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4 theme-section-title">Registered Events</h2>
        <ul class="space-y-2">
            @forelse($registrations as $reg)
                <li>
                    <a href="{{ route('events.show', $reg->event) }}" class="theme-link">{{ $reg->event->title }}</a>
                    <span class="theme-text-secondary"> – {{ $reg->status }}</span>
                </li>
            @empty
                <li class="theme-text-secondary">No registrations yet.</li>
            @endforelse
        </ul>
        @if($registrationsCount > 10)
            <p class="text-sm theme-text-secondary mt-2">Showing latest 10 of {{ $registrationsCount }}.</p>
        @endif
    </section>

    <section class="theme-card rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 theme-section-title">Volunteer Hours</h2>
        <p class="theme-text-primary text-lg">Total: <span class="theme-accent font-bold">{{ number_format($totalHours, 1) }}</span> hours</p>
        @if($volunteerHours->isNotEmpty())
            <ul class="mt-4 space-y-2">
                @foreach($volunteerHours->take(5) as $vh)
                    <li class="theme-text-secondary text-sm">{{ $vh->hours_logged }}h @if($vh->event) – {{ $vh->event->title }} @endif</li>
                @endforeach
            </ul>
        @endif
    </section>
@endsection

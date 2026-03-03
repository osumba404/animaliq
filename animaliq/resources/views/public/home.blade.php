@extends('layouts.public')

@section('title', 'Home')

@section('content')
    <section class="mb-12">
        @if($slides->isNotEmpty())
            <div class="rounded-lg overflow-hidden bg-[#fff2f2] dark:bg-[#1D0002] aspect-[3/1] flex items-center justify-center">
                @foreach($slides->take(1) as $slide)
                    <div class="p-8 text-center">
                        @if($slide->image_path)
                            <img src="{{ asset('storage/' . $slide->image_path) }}" alt="{{ $slide->title }}" class="max-h-64 mx-auto mb-4">
                        @endif
                        <h1 class="text-3xl font-bold">{{ $slide->title ?? 'Welcome to Animal IQ' }}</h1>
                        @if($slide->subtitle)
                            <p class="mt-2 text-lg">{{ $slide->subtitle }}</p>
                        @endif
                        @if($slide->cta_text && $slide->cta_link)
                            <a href="{{ $slide->cta_link }}" class="inline-block mt-4 px-6 py-2 bg-[#1b1b18] text-white rounded">{{ $slide->cta_text }}</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-lg overflow-hidden bg-[#fff2f2] dark:bg-[#1D0002] aspect-[3/1] flex items-center justify-center">
                <div class="p-8 text-center">
                    <h1 class="text-3xl font-bold">The Wild Window</h1>
                    <p class="mt-2 text-lg">Connecting youth with wildlife and environmental education.</p>
                </div>
            </div>
        @endif
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
        <p class="text-lg">{{ $mission }}</p>
    </section>

    <section class="mb-12 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] text-center">
            <p class="text-3xl font-bold text-[#f53003]">{{ number_format($youthReached) }}</p>
            <p class="text-sm text-[#706f6c]">Youth Reached</p>
        </div>
        <div class="p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] text-center">
            <p class="text-3xl font-bold text-[#f53003]">{{ number_format($membersActive) }}</p>
            <p class="text-sm text-[#706f6c]">Members Active</p>
        </div>
        <div class="p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] text-center">
            <p class="text-3xl font-bold text-[#f53003]">{{ number_format($eventsHosted) }}</p>
            <p class="text-sm text-[#706f6c]">Events Hosted</p>
        </div>
        <div class="p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] text-center">
            <p class="text-3xl font-bold text-[#f53003]">{{ number_format($partnershipsFormed) }}</p>
            <p class="text-sm text-[#706f6c]">Partnerships Formed</p>
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">Core Programs</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($programs as $program)
                <a href="{{ route('programs.show', $program) }}" class="block p-4 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:border-[#19140035]">
                    <h3 class="font-semibold">{{ $program->title }}</h3>
                    <p class="text-sm text-[#706f6c] mt-1 line-clamp-2">{{ $program->description }}</p>
                </a>
            @empty
                <p class="text-[#706f6c]">Programs will be listed here.</p>
            @endforelse
        </div>
    </section>

    @if($upcomingEvent)
    <section class="mb-12 p-6 rounded-lg bg-[#fff2f2] dark:bg-[#1D0002]">
        <h2 class="text-2xl font-semibold mb-4">Upcoming Event</h2>
        <h3 class="text-xl font-medium">{{ $upcomingEvent->title }}</h3>
        <p class="text-[#706f6c]">{{ $upcomingEvent->start_datetime?->format('l, F j, Y \a\t g:i A') }}</p>
        <a href="{{ route('events.show', $upcomingEvent) }}" class="inline-block mt-4 px-6 py-2 bg-[#1b1b18] text-white rounded">View Event</a>
    </section>
    @endif

    <section class="flex flex-wrap gap-4">
        <a href="{{ route('community.dashboard') }}" class="inline-block px-6 py-2 border border-[#19140035] rounded hover:bg-[#1914000a">Join the Community</a>
        <a href="{{ route('events.index') }}" class="inline-block px-6 py-2 border border-[#19140035] rounded hover:bg-[#1914000a">Attend an Event</a>
        <a href="{{ route('donations.index') }}" class="inline-block px-6 py-2 bg-[#f53003] text-white rounded hover:opacity-90">Support the Mission</a>
    </section>
@endsection

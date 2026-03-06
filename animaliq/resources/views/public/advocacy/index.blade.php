@extends('layouts.public')

@section('title', 'Advocacy & Campaigns')

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-4xl">
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Voice for change</p>
            <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Advocacy & Campaigns</h1>
            <p class="text-lg theme-text-secondary mt-2">Awareness campaigns and environmental advocacy.</p>
        </div>
    </section>
    <div class="py-12">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($campaigns as $campaign)
                <a href="{{ route('advocacy.show', $campaign) }}" class="block theme-card rounded-2xl p-6 transition hover:shadow-xl border-l-4 border-l-[var(--accent-orange)]">
                    <h2 class="text-xl font-bold theme-text-primary">{{ $campaign->title }}</h2>
                    @if($campaign->start_date || $campaign->end_date)
                        <p class="text-xs theme-text-secondary mt-2">
                            @if($campaign->start_date) {{ $campaign->start_date->format('M Y') }} @endif
                            @if($campaign->end_date) → {{ $campaign->end_date->format('M Y') }} @endif
                        </p>
                    @endif
                    @if($campaign->description)
                        <p class="text-sm theme-text-secondary mt-3 line-clamp-3">{{ Str::limit($campaign->description, 140) }}</p>
                    @endif
                    <span class="inline-flex items-center gap-2 mt-4 theme-link font-medium">Explore campaign →</span>
                </a>
            @empty
                <div class="col-span-full theme-card rounded-2xl p-12 text-center">
                    <p class="theme-text-secondary text-lg">No campaigns yet. Check back soon.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

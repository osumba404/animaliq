@extends('layouts.public')

@section('title', 'Research & Knowledge Hub')

@section('content')
    <h1 class="text-3xl font-bold mb-6 theme-text-primary">Research & Knowledge Hub</h1>
    @if($sectionBanner)
        <div class="rounded-lg overflow-hidden mb-8">
            <img src="{{ asset('storage/' . $sectionBanner) }}" alt="Research" class="w-full h-48 object-cover">
        </div>
    @endif
    <p class="mb-8 theme-text-secondary">Youth-led research, reports, and knowledge sharing.</p>
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($projects as $project)
            <a href="{{ route('research.show', $project) }}" class="block rounded-lg overflow-hidden theme-card hover:border-[var(--accent-orange)] transition-colors">
                @if($project->banner_image)
                    <img src="{{ asset('storage/' . $project->banner_image) }}" alt="{{ $project->title }}" class="w-full h-40 object-cover">
                @endif
                <div class="p-4">
                    <h2 class="font-semibold theme-text-primary">{{ $project->title }}</h2>
                    <p class="text-sm theme-accent">{{ $project->status }} · {{ $project->start_date?->format('Y') }}</p>
                    <p class="text-sm theme-text-secondary mt-1 line-clamp-2">{{ $project->summary }}</p>
                </div>
            </a>
        @empty
            <p class="theme-text-secondary col-span-full">No research projects yet.</p>
        @endforelse
    </div>
@endsection

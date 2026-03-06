@extends('layouts.public')

@section('title', 'Research & Knowledge Hub')

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-4xl">
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">Knowledge hub</p>
            <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Research & Innovation</h1>
            <p class="text-lg theme-text-secondary mt-2">Youth-led research, reports, and knowledge sharing.</p>
        </div>
    </section>

    @if($sectionBanner)
        <div class="rounded-2xl overflow-hidden my-8 -mx-4 md:mx-0 h-56 md:h-72">
            <img src="{{ asset('storage/' . $sectionBanner) }}" alt="Research" class="w-full h-full object-cover">
        </div>
    @endif

    <div class="py-8">
        <div class="grid md:grid-cols-2 gap-8">
            @forelse($projects as $project)
                <a href="{{ route('research.show', $project) }}" class="block theme-card rounded-2xl overflow-hidden transition hover:shadow-xl group">
                    <div class="h-52 bg-[var(--bg-secondary)] overflow-hidden">
                        @if($project->banner_image)
                            <img src="{{ asset('storage/' . $project->banner_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center theme-text-secondary"><span class="text-6xl opacity-30">📚</span></div>
                        @endif
                    </div>
                    <div class="p-6">
                        @if($project->department)
                            <p class="text-xs font-semibold theme-accent uppercase tracking-wide mb-2">{{ $project->department->name }}</p>
                        @endif
                        <h2 class="text-xl font-bold theme-text-primary group-hover:theme-accent transition">{{ $project->title }}</h2>
                        <p class="text-sm theme-text-secondary mt-2 flex items-center gap-2">
                            <span class="theme-badge">{{ $project->status }}</span>
                            @if($project->start_date) {{ $project->start_date->format('Y') }} @endif
                        </p>
                        @if($project->summary)
                            <p class="text-sm theme-text-secondary mt-3 line-clamp-2">{{ Str::limit($project->summary, 120) }}</p>
                        @endif
                        <span class="inline-flex items-center gap-2 mt-4 theme-link font-medium">View project →</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full theme-card rounded-2xl p-12 text-center">
                    <p class="theme-text-secondary text-lg">No research projects yet. Check back soon.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

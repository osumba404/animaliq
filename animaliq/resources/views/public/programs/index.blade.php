@extends('layouts.public')

@section('title', 'Our Programs')

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16">
        <div class="max-w-4xl animate-fade-in-up">
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2">What we do</p>
            <h1 class="text-4xl md:text-5xl font-bold theme-text-primary">Our Programs</h1>
            <p class="text-lg theme-text-secondary mt-2 animate-fade-in-up animate-delay-1">Explore our initiatives in wildlife education, youth engagement, and conservation.</p>
        </div>
    </section>

    <div class="py-12">
        @forelse($programs as $program)
            @php $img = $program->image ?? $program->events->first()?->banner_image; @endphp
            <a href="{{ route('programs.show', $program) }}" class="block theme-card rounded-2xl overflow-hidden mb-8 hover-lift group">
                <div class="grid md:grid-cols-5 gap-0">
                    <div class="md:col-span-2 h-56 md:h-auto min-h-[200px] bg-[var(--bg-secondary)] img-zoom">
                        @if($img)
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center theme-text-secondary">
                                <span class="text-6xl opacity-30">🌿</span>
                            </div>
                        @endif
                    </div>
                    <div class="md:col-span-3 p-6 md:p-8 flex flex-col justify-center">
                        @if($program->department)
                            <p class="text-sm font-semibold theme-accent mb-2">{{ $program->department->name }}</p>
                        @endif
                        <h2 class="text-2xl font-bold theme-text-primary group-hover:theme-accent transition">{{ $program->title }}</h2>
                        <p class="theme-text-secondary mt-2 line-clamp-3">{{ Str::limit($program->description, 180) }}</p>
                        <span class="inline-flex items-center gap-2 mt-4 theme-link font-medium">View program →</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="theme-card rounded-2xl p-12 text-center">
                <p class="theme-text-secondary text-lg">No programs yet. Check back soon.</p>
            </div>
        @endforelse
    </div>
@endsection

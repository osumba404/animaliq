@extends('layouts.public')

@section('title', 'Home')

@section('content')
    {{-- Full-width hero carousel --}}
    <section class="hero-full-width mb-0 overflow-hidden" style="margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%); width: 100vw;">
        @if($slides->isNotEmpty())
            <div class="relative">
                <div id="hero-track" class="flex transition-transform duration-500 ease-out" style="width: {{ $slides->count() * 100 }}vw;">
                    @foreach($slides as $slide)
                        <div class="hero-slide flex-shrink-0 w-full min-h-[70vmin] md:min-h-[500px] flex items-center justify-center relative bg-[var(--bg-warm)]" style="width: 100vw;">
                            @if($slide->image_path)
                                <div class="absolute inset-0 z-0">
                                    <img src="{{ asset('storage/' . $slide->image_path) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 z-10"></div>
                                </div>
                            @endif
                            <div class="relative z-20 p-6 md:p-12 text-center max-w-4xl mx-auto">
                                <h1 class="text-3xl md:text-5xl font-bold theme-text-primary drop-shadow-sm">{{ $slide->title ?? 'Welcome to Animal IQ' }}</h1>
                                @if($slide->subtitle)
                                    <p class="mt-4 text-lg md:text-xl theme-text-secondary">{{ $slide->subtitle }}</p>
                                @endif
                                @if($slide->cta_text && $slide->cta_link)
                                    <div class="flex flex-wrap gap-3 justify-center mt-6">
                                        <a href="{{ $slide->cta_link }}" class="theme-btn px-6 py-3">{{ $slide->cta_text }}</a>
                                        @if($slide->cta_secondary_text && $slide->cta_secondary_link)
                                            <a href="{{ $slide->cta_secondary_link }}" class="theme-btn-outline px-6 py-3">{{ $slide->cta_secondary_text }}</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($slides->count() > 1)
                    <div class="absolute bottom-4 left-0 right-0 z-30 flex justify-center gap-2">
                        @foreach($slides as $i => $slide)
                            <button type="button" class="hero-dot w-2.5 h-2.5 rounded-full border-2 border-white/80 bg-white/40 hover:bg-white/70 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--accent-orange)]" aria-label="Go to slide {{ $i + 1 }}" data-index="{{ $i }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="min-h-[70vmin] md:min-h-[500px] flex items-center justify-center theme-bg-warm border-b theme-border">
                <div class="p-8 text-center">
                    <h1 class="text-3xl md:text-5xl font-bold theme-text-primary">The Wild Window</h1>
                    <p class="mt-4 text-lg theme-text-secondary">Connecting youth with wildlife and environmental education.</p>
                </div>
            </div>
        @endif
    </section>

    @if($slides->isNotEmpty() && $slides->count() > 1)
    <script>
    (function() {
        var track = document.getElementById('hero-track');
        if (!track) return;
        var dots = document.querySelectorAll('.hero-dot');
        var total = track.querySelectorAll('.hero-slide').length;
        var current = 0;
        function goTo(i) {
            current = (i + total) % total;
            track.style.transform = 'translateX(-' + (current * 100) + 'vw)';
            dots.forEach(function(d, j) { d.classList.toggle('bg-white', j === current); d.classList.toggle('bg-white/40', j !== current); });
        }
        dots.forEach(function(dot, i) {
            dot.addEventListener('click', function() { goTo(i); });
        });
        goTo(0);
        var interval = setInterval(function() { goTo(current + 1); }, 5000);
        track.closest('.hero-full-width').addEventListener('mouseenter', function() { clearInterval(interval); });
    })();
    </script>
    @endif

    {{-- Intro: mission / teaser --}}
    <section class="py-12 md:py-16 theme-bg-secondary -mx-4 px-4 md:rounded-2xl md:mx-0 animate-fade-in-up animate-slow">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-4">What we do</h2>
            <p class="text-lg md:text-xl theme-text-secondary leading-relaxed">
                {{ $missionTeaser ?: $mission }}
            </p>
            @if($vision)
                <p class="mt-6 text-base theme-text-secondary max-w-2xl mx-auto">{{ Str::limit($vision, 160) }}</p>
            @endif
            <a href="{{ route('about') }}" class="inline-block mt-8 theme-link font-semibold">Learn more about us →</a>
        </div>
    </section>

    {{-- Impact stats --}}
    <section class="py-12 md:py-16">
        <h2 class="text-2xl md:text-3xl font-bold theme-text-primary text-center mb-10 animate-fade-in-up">Our impact</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 stagger-children">
            <div class="theme-card rounded-2xl p-6 md:p-8 text-center hover-lift border-l-4 border-l-[var(--accent-orange)]">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums">{{ number_format($youthReached) }}</p>
                <p class="text-sm md:text-base theme-text-secondary mt-1">Youth reached</p>
            </div>
            <div class="theme-card rounded-2xl p-6 md:p-8 text-center hover-lift border-l-4 border-l-[var(--orange-500)]">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums">{{ number_format($membersActive) }}</p>
                <p class="text-sm md:text-base theme-text-secondary mt-1">Members active</p>
            </div>
            <div class="theme-card rounded-2xl p-6 md:p-8 text-center hover-lift border-l-4 border-l-[var(--orange-600)]">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums">{{ number_format($eventsHosted) }}</p>
                <p class="text-sm md:text-base theme-text-secondary mt-1">Events hosted</p>
            </div>
            <div class="theme-card rounded-2xl p-6 md:p-8 text-center hover-lift border-l-4 border-l-[var(--orange-700)]">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums">{{ number_format($partnershipsFormed) }}</p>
                <p class="text-sm md:text-base theme-text-secondary mt-1">Partnerships</p>
            </div>
        </div>
    </section>

    {{-- Core programs --}}
    <section class="py-12 md:py-16 theme-bg-warm -mx-4 px-4 md:rounded-2xl md:mx-0">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-2 animate-fade-in-up">Core programs</h2>
            <p class="theme-text-secondary mb-8 max-w-2xl animate-fade-in-up animate-delay-1">Education, youth engagement, and conservation at the heart of what we do.</p>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 stagger-children">
                @forelse($programs as $program)
                    @php $img = $program->image ?? $program->events->first()?->banner_image; @endphp
                    <a href="{{ route('programs.show', $program) }}" class="block theme-card rounded-2xl overflow-hidden hover-lift group">
                        <div class="h-40 bg-[var(--bg-secondary)] overflow-hidden img-zoom">
                            @if($img)
                                <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center theme-text-secondary"><span class="text-5xl opacity-30">🌿</span></div>
                            @endif
                        </div>
                        <div class="p-5">
                            @if($program->department)
                                <p class="text-xs font-semibold theme-accent uppercase tracking-wide mb-1">{{ $program->department->name }}</p>
                            @endif
                            <h3 class="font-bold text-lg theme-text-primary group-hover:theme-accent transition">{{ $program->title }}</h3>
                            <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($program->description, 100) }}</p>
                            <span class="inline-block mt-3 theme-link font-medium text-sm">Learn more →</span>
                        </div>
                    </a>
                @empty
                    <p class="theme-text-secondary col-span-full">Programs will be listed here.</p>
                @endforelse
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('programs.index') }}" class="theme-btn-outline px-6 py-2">View all programs</a>
            </div>
        </div>
    </section>

    {{-- Upcoming events --}}
    <section class="py-12 md:py-16">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-2">Upcoming events</h2>
            <p class="theme-text-secondary mb-8">Join workshops, field trips, and community activities.</p>
            @if(isset($upcomingEvents) && $upcomingEvents->isNotEmpty())
                <div class="grid md:grid-cols-3 gap-6 stagger-children">
                    @foreach($upcomingEvents as $event)
                        <a href="{{ route('events.show', $event) }}" class="block theme-card rounded-2xl overflow-hidden hover-lift group">
                            <div class="h-36 bg-[var(--bg-secondary)] overflow-hidden img-zoom">
                                @if($event->banner_image)
                                    <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center theme-text-secondary"><span class="text-4xl opacity-30">📅</span></div>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-sm theme-accent font-medium">{{ $event->start_datetime?->format('M j, Y') }}</p>
                                <h3 class="font-bold theme-text-primary group-hover:theme-accent transition">{{ $event->title }}</h3>
                                @if($event->program)
                                    <p class="text-xs theme-text-secondary mt-1">{{ $event->program->title }}</p>
                                @endif
                                <span class="inline-block mt-2 theme-link text-sm font-medium">View event →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-8 text-center">
                    <a href="{{ route('events.index') }}" class="theme-btn-outline px-6 py-2">See all events</a>
                </div>
            @else
                <div class="theme-card rounded-2xl p-8 text-center">
                    <p class="theme-text-secondary">No upcoming events right now. Check back soon.</p>
                    <a href="{{ route('events.index') }}" class="inline-block mt-4 theme-link font-medium">Browse events</a>
                </div>
            @endif
        </div>
    </section>

    {{-- Latest from blog --}}
    @if(isset($recentPosts) && $recentPosts->isNotEmpty())
    <section class="py-12 md:py-16 theme-bg-secondary -mx-4 px-4 md:rounded-2xl md:mx-0">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-2">Latest from the blog</h2>
            <p class="theme-text-secondary mb-8">Stories and updates from our community.</p>
            <div class="grid md:grid-cols-3 gap-6 stagger-children">
                @foreach($recentPosts as $post)
                    <a href="{{ route('blog.show', $post) }}" class="block theme-card rounded-2xl overflow-hidden hover-lift group">
                        <div class="h-44 bg-[var(--bg-primary)] overflow-hidden img-zoom">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center theme-text-secondary"><span class="text-5xl opacity-30">✏️</span></div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold theme-text-primary group-hover:theme-accent transition line-clamp-2">{{ $post->title }}</h3>
                            <p class="text-sm theme-text-secondary mt-1">{{ $post->author->first_name }} {{ $post->author->last_name }} · {{ $post->published_at?->format('M j, Y') }}</p>
                            @if($post->content)
                                <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit(strip_tags($post->content), 80) }}</p>
                            @endif
                            <span class="inline-block mt-2 theme-link text-sm font-medium">Read more →</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('blog.index') }}" class="theme-link font-semibold">View all posts</a>
            </div>
        </div>
    </section>
    @endif

    {{-- Research highlight --}}
    @if(isset($featuredResearch) && $featuredResearch)
    <section class="py-12 md:py-16">
        <div class="max-w-6xl mx-auto">
            <div class="theme-card rounded-2xl overflow-hidden flex flex-col md:flex-row hover-lift">
                <div class="md:w-2/5 h-56 md:h-auto min-h-[200px] bg-[var(--bg-secondary)]">
                    @if($featuredResearch->banner_image)
                        <img src="{{ asset('storage/' . $featuredResearch->banner_image) }}" alt="{{ $featuredResearch->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center theme-text-secondary"><span class="text-6xl opacity-30">📚</span></div>
                    @endif
                </div>
                <div class="md:w-3/5 p-6 md:p-8 flex flex-col justify-center">
                    <p class="text-sm font-semibold theme-accent uppercase tracking-wide mb-2">Research & knowledge hub</p>
                    <h2 class="text-2xl font-bold theme-text-primary">{{ $featuredResearch->title }}</h2>
                    @if($featuredResearch->summary)
                        <p class="theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($featuredResearch->summary, 150) }}</p>
                    @endif
                    <a href="{{ route('research.show', $featuredResearch) }}" class="inline-block mt-4 theme-btn">Explore research</a>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Main CTAs --}}
    <section class="py-12 md:py-16 theme-bg-warm -mx-4 px-4 md:rounded-2xl md:mx-0">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-4 animate-fade-in-up">Get involved</h2>
            <p class="theme-text-secondary mb-8 animate-fade-in-up animate-delay-1">Join the community, attend events, or support our mission.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="theme-btn px-8 py-3">Join the community</a>
                <a href="{{ route('events.index') }}" class="theme-btn-outline px-8 py-3">Attend an event</a>
                <a href="{{ route('donations.index') }}" class="theme-btn-outline px-8 py-3 border-2 border-[var(--accent-orange)]">Support the mission</a>
            </div>
        </div>
    </section>
@endsection

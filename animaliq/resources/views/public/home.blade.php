@extends('layouts.public')

@section('title', 'Animal IQ – Wildlife Education, Conservation & Community in Kenya')

@section('meta')
@php
    $seoTitle       = 'Animal IQ – Wildlife Education, Conservation & Community';
    $seoDescription = 'Animal IQ connects youth and communities with wildlife education, conservation programs, events, and research in Kenya. Join us to protect and celebrate nature.';
    $seoCanonical   = route('home');
    $seoImage       = $seoImage ?? null;
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'        => 'Organization',
                '@id'          => url('/') . '#organization',
                'name'         => 'Animal IQ',
                'url'          => url('/'),
                'logo'         => $seoImage ? asset('storage/' . $seoImage) : url('/favicon.ico'),
                'description'  => 'Wildlife and environmental education organization connecting youth with conservation, programs, events, and research.',
                'email'        => 'info@animaliq.co.ke',
                'sameAs'       => [],
                'contactPoint' => [
                    '@type'       => 'ContactPoint',
                    'contactType' => 'customer support',
                    'email'       => 'info@animaliq.co.ke',
                ],
            ],
            [
                '@type'           => 'WebSite',
                '@id'             => url('/') . '#website',
                'url'             => url('/'),
                'name'            => 'Animal IQ',
                'publisher'       => ['@id' => url('/') . '#organization'],
                'potentialAction' => [
                    '@type'       => 'SearchAction',
                    'target'      => [
                        '@type'       => 'EntryPoint',
                        'urlTemplate' => url('/blog') . '?q={search_term_string}',
                    ],
                    'query-input' => 'required name=search_term_string',
                ],
            ],
        ],
    ];
@endphp
@include('partials.seo')
@endsection

@section('content')
@push('styles')
<style>
.hero-flush { margin-top: calc(-1.5rem - 1px); }
@media (min-width: 768px) { .hero-flush { margin-top: calc(-2rem - 1px); } }
</style>
@endpush
    {{-- Full-width hero carousel --}}
    <section class="hero-full-width hero-flush mb-0 overflow-hidden" style="margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%); width: 100vw;">
        @if($slides->isNotEmpty())
            <div class="relative">
                <div id="hero-track" class="flex transition-transform duration-500 ease-out" style="width: {{ $slides->count() * 100 }}vw;">
                    @foreach($slides as $slide)
                        <div class="hero-slide flex-shrink-0 w-full min-h-[85vmin] md:min-h-[580px] flex items-center justify-center relative bg-[var(--bg-warm)] {{ $slide->image_path ? 'hero-slide--with-image' : '' }}" style="width: 100vw;">
                            @if($slide->image_path)
                                <div class="absolute inset-0 z-0">
                                    <img src="{{ asset('storage/' . $slide->image_path) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 z-10"></div>
                                </div>
                            @endif
                            <div class="hero-slide-content relative z-20 p-6 md:p-12 text-center max-w-4xl mx-auto">
                                <h1 class="text-3xl md:text-5xl font-bold drop-shadow-md {{ $slide->image_path ? 'text-white' : 'theme-text-primary' }}">{{ $slide->title ?? 'Welcome to Animal IQ' }}</h1>
                                @if($slide->subtitle)
                                    <p class="mt-4 text-lg md:text-xl drop-shadow-sm {{ $slide->image_path ? 'text-white/90' : 'theme-text-secondary' }}">{{ $slide->subtitle }}</p>
                                @endif
                                @if($slide->cta_text && $slide->cta_link)
                                    <div class="flex flex-wrap gap-3 justify-center mt-6">
                                        <a href="{{ $slide->cta_link }}" class="theme-btn px-6 py-3">{{ $slide->cta_text }}</a>
                                        @if($slide->cta_secondary_text && $slide->cta_secondary_link)
                                            <a href="{{ $slide->cta_secondary_link }}" class="theme-btn-outline px-6 py-3 {{ $slide->image_path ? 'border-white text-white hover:bg-white/20' : '' }}">{{ $slide->cta_secondary_text }}</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($slides->count() > 1)
                    <button type="button" class="hero-arrow hero-arrow-prev absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/40 hover:bg-black/60 text-white flex items-center justify-center transition focus:outline-none focus:ring-2 focus:ring-white/50" aria-label="Previous slide">
                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" class="hero-arrow hero-arrow-next absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/40 hover:bg-black/60 text-white flex items-center justify-center transition focus:outline-none focus:ring-2 focus:ring-white/50" aria-label="Next slide">
                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                    <div class="absolute bottom-4 left-0 right-0 z-30 flex justify-center gap-2">
                        @foreach($slides as $i => $slide)
                            <button type="button" class="hero-dot w-2.5 h-2.5 rounded-full border-2 border-white/80 bg-white/40 hover:bg-white/70 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--accent-orange)]" aria-label="Go to slide {{ $i + 1 }}" data-index="{{ $i }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="min-h-[85vmin] md:min-h-[580px] flex items-center justify-center theme-bg-warm border-b theme-border">
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
        var wrapper = track.closest('.hero-full-width');
        var dots = document.querySelectorAll('.hero-dot');
        var prevBtn = wrapper.querySelector('.hero-arrow-prev');
        var nextBtn = wrapper.querySelector('.hero-arrow-next');
        var total = track.querySelectorAll('.hero-slide').length;
        var current = 0;
        var intervalId = null;
        function goTo(i) {
            current = (i + total) % total;
            track.style.transform = 'translateX(-' + (current * 100) + 'vw)';
            dots.forEach(function(d, j) { d.classList.toggle('bg-white', j === current); d.classList.toggle('bg-white/40', j !== current); });
        }
        function startAuto() {
            if (intervalId) clearInterval(intervalId);
            intervalId = setInterval(function() { goTo(current + 1); }, 5000);
        }
        dots.forEach(function(dot, i) {
            dot.addEventListener('click', function() { goTo(i); startAuto(); });
        });
        if (prevBtn) prevBtn.addEventListener('click', function() { goTo(current - 1); startAuto(); });
        if (nextBtn) nextBtn.addEventListener('click', function() { goTo(current + 1); startAuto(); });
        goTo(0);
        startAuto();
        wrapper.addEventListener('mouseenter', function() { if (intervalId) { clearInterval(intervalId); intervalId = null; } });
        wrapper.addEventListener('mouseleave', function() { if (total > 1) startAuto(); });
    })();
    </script>
    @endif

    {{-- Intro: mission / teaser --}}
    <section class="py-12 md:py-16 theme-bg-secondary -mx-4 px-4 md:rounded-2xl md:mx-0 reveal">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-4">What we do</h2>
            <p class="text-lg md:text-xl theme-text-secondary leading-relaxed">
                {{ $missionTeaser ?: $mission }}
            </p>
            @if($vision)
                <p class="mt-6 text-base theme-text-secondary max-w-2xl mx-auto">{{ Str::limit($vision, 160) }}</p>
            @endif
            @if(isset($founderStory) && $founderStory)
                <div class="mt-8 pt-8 border-t theme-border text-left">
                    <h3 class="text-xl font-bold theme-text-primary mb-3 text-center">Our Founder Story</h3>
                    <div class="prose max-w-none theme-text-secondary mx-auto text-center">
                        {!! nl2br(e($founderStory)) !!}
                    </div>
                </div>
            @endif
            <div class="flex flex-wrap items-center justify-center gap-4 mt-8">
                <a href="{{ route('about') }}" class="theme-link font-semibold">Learn more about us →</a>
            </div>
        </div>
    </section>

    {{-- Impact stats – one row on desktop, equal width --}}
    <section class="py-12 md:py-16">
        <h2 class="text-2xl md:text-3xl font-bold theme-text-primary text-center mb-10 reveal">Our impact</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6 px-4 max-w-[1400px] mx-auto">
            <div class="theme-card rounded-2xl p-4 lg:p-6 text-center hover-lift border-l-4 border-[var(--accent-orange)] reveal reveal-delay-1">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums stat-number">{{ number_format($activePrograms) }}</p>
                <p class="text-xs md:text-sm theme-text-secondary mt-1">Active programs</p>
            </div>
            <div class="theme-card rounded-2xl p-4 lg:p-6 text-center hover-lift border-l-4 border-[var(--orange-500)] reveal reveal-delay-2">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums stat-number">{{ number_format($membersActive) }}</p>
                <p class="text-xs md:text-sm theme-text-secondary mt-1">Members active</p>
            </div>
            <div class="theme-card rounded-2xl p-4 lg:p-6 text-center hover-lift border-l-4 border-[var(--orange-600)] reveal reveal-delay-3">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums stat-number">{{ number_format($eventsHosted) }}</p>
                <p class="text-xs md:text-sm theme-text-secondary mt-1">Events hosted</p>
            </div>
            <div class="theme-card rounded-2xl p-4 lg:p-6 text-center hover-lift border-l-4 border-[var(--orange-700)] reveal reveal-delay-4">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums stat-number">{{ number_format($researchConducted) }}</p>
                <p class="text-xs md:text-sm theme-text-secondary mt-1">Research Conducted</p>
            </div>
            <div class="theme-card rounded-2xl p-4 lg:p-6 text-center hover-lift border-l-4 border-[var(--orange-400)] reveal reveal-delay-5">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums stat-number">{{ number_format($upcomingEventsCount) }}</p>
                <p class="text-xs md:text-sm theme-text-secondary mt-1">Upcoming events</p>
            </div>
            <div class="theme-card rounded-2xl p-4 lg:p-6 text-center hover-lift border-l-4 border-[var(--orange-300)] reveal reveal-delay-6">
                <p class="text-3xl md:text-4xl font-bold theme-accent tabular-nums stat-number">{{ number_format($publishedArticles) }}</p>
                <p class="text-xs md:text-sm theme-text-secondary mt-1">Published Articles</p>
            </div>
        </div>
    </section>

    {{-- Core programs --}}
    <section class="py-12 md:py-16 theme-bg-warm -mx-4 px-4 md:rounded-2xl md:mx-0">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-2 animate-fade-in-up text-center">Core programs</h2>
            <p class="theme-text-secondary mb-8 max-w-2xl animate-fade-in-up animate-delay-1 text-center mx-auto">Education, youth engagement, and conservation at the heart of what we do.</p>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 stagger-children">
                @forelse($programs as $program)
                    @php $img = $program->image ?? $program->events->first()?->banner_image; @endphp
                    <a href="{{ route('programs.show', $program) }}" class="block theme-card rounded-2xl overflow-hidden hover-lift group">
                        <div class="h-40 bg-[var(--bg-secondary)] overflow-hidden img-zoom">
                            @if($img)
                                <img src="{{ asset('storage/' . $img) }}" alt="{{ $program->title }}" class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-16 h-16 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg></div>
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
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-2 text-center">Upcoming events</h2>
            <p class="theme-text-secondary mb-8 text-center mx-auto">Join workshops, field trips, and community activities.</p>
            @if(isset($upcomingEvents) && $upcomingEvents->isNotEmpty())
                <div class="grid md:grid-cols-3 gap-6 stagger-children">
                    @foreach($upcomingEvents as $event)
                        <a href="{{ route('events.show', $event) }}" class="block theme-card rounded-2xl overflow-hidden hover-lift group">
                            <div class="h-36 bg-[var(--bg-secondary)] overflow-hidden img-zoom">
                                @if($event->banner_image)
                                    <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover" loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-14 h-14 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-sm theme-accent font-medium">{{ $event->start_datetime?->format('M j, Y') }}</p>
                                <h3 class="font-bold theme-text-primary group-hover:theme-accent transition">{{ $event->title }}</h3>
                                @if($event->program)
                                    <p class="text-xs theme-text-secondary mt-1">{{ $event->program->title }}</p>
                                @endif
                                <span class="inline-block mt-2 theme-link text-sm font-medium">@include('partials.event-view-label', ['event' => $event]) →</span>
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
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-2 text-center">Latest from the blog</h2>
            <p class="theme-text-secondary mb-8 text-center mx-auto">Stories and updates from our community.</p>
            <div class="grid md:grid-cols-3 gap-6 stagger-children">
                @foreach($recentPosts as $post)
                    <a href="{{ route('blog.show', $post) }}" class="block theme-card rounded-2xl overflow-hidden hover-lift group">
                        <div class="h-44 bg-[var(--bg-primary)] overflow-hidden img-zoom">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-14 h-14 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></div>
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
                <a href="{{ route('blog.index') }}" class="theme-btn-outline px-6 py-2">View all posts</a>
            </div>
        </div>
    </section>
    @endif

    {{-- Latest research --}}
    @if(isset($latestResearch) && $latestResearch->isNotEmpty())
    <section class="py-12 md:py-16">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold theme-text-primary mb-2 text-center">Research & knowledge hub</h2>
            <p class="theme-text-secondary mb-8 text-center mx-auto">Discover our latest findings and conservation studies.</p>
            <div class="grid md:grid-cols-3 gap-6 stagger-children">
                @foreach($latestResearch as $research)
                    <a href="{{ route('research.show', $research) }}" class="block theme-card rounded-2xl overflow-hidden hover-lift group">
                        <div class="h-44 bg-[var(--bg-primary)] overflow-hidden img-zoom">
                            @if($research->banner_image)
                                <img src="{{ asset('storage/' . $research->banner_image) }}" alt="{{ $research->title }}" class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center theme-text-secondary"><svg class="w-14 h-14 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
                            @endif
                        </div>
                        <div class="p-4">
                            @if($research->department)
                                <p class="text-xs font-semibold theme-accent uppercase tracking-wide mb-1">{{ $research->department->name }}</p>
                            @endif
                            <h3 class="font-bold theme-text-primary group-hover:theme-accent transition line-clamp-2">{{ $research->title }}</h3>
                            @if($research->summary)
                                <p class="text-sm theme-text-secondary mt-2 line-clamp-2">{{ Str::limit($research->summary, 80) }}</p>
                            @endif
                            <span class="inline-block mt-2 theme-link text-sm font-medium">Explore research →</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('research.index') }}" class="theme-btn-outline px-6 py-2">View all research</a>
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
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    if (target.classList.contains('counted')) return;
                    target.classList.add('counted');
                    const finalValStr = target.innerText.replace(/,/g, '');
                    const finalVal = parseInt(finalValStr, 10) || 0;
                    
                    if (finalVal === 0) return;
                    
                    target.innerText = '0';
                    let startVal = 0;
                    const duration = 2000;
                    const stepTime = Math.max(Math.floor(duration / finalVal), 20);
                    const steps = duration / stepTime;
                    const increment = finalVal / steps;

                    const timer = setInterval(() => {
                        startVal += increment;
                        if (startVal >= finalVal) {
                            target.innerText = Number(finalVal).toLocaleString();
                            clearInterval(timer);
                        } else {
                            target.innerText = Math.floor(startVal).toLocaleString();
                        }
                    }, stepTime);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.stat-number').forEach(el => observer.observe(el));
    });
    </script>
@endsection

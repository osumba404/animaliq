@extends('layouts.public')

@section('title', 'Podcasts – Animal IQ Initiative')

@section('meta')
@php
    $seoTitle    = 'Podcasts – Animal IQ Initiative';
    $seoDescription = 'Listen to Animal IQ Initiative podcasts on wildlife education, conservation, and environmental topics.';
    $seoCanonical = route('podcasts.index');
@endphp
@include('partials.seo')
@endsection

@push('styles')
<style>
.podcast-card .yt-embed { position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:0.75rem; background:#000; }
.podcast-card .yt-embed iframe { position:absolute; top:0; left:0; width:100%; height:100%; border:0; border-radius:0.75rem; }
</style>
@endpush

@section('content')
    <section class="theme-bg-warm border-b theme-border -mx-4 px-4 py-12 md:py-16 mb-8">
        <div class="max-w-6xl mx-auto">
            <p class="text-sm font-semibold tracking-wider uppercase theme-accent mb-2 animate-fade-in-up">Listen & Watch</p>
            <h1 class="text-4xl md:text-5xl font-bold theme-text-primary animate-fade-in-up animate-delay-1">Our Podcasts</h1>
            <p class="text-lg theme-text-secondary mt-3 max-w-2xl animate-fade-in-up animate-delay-2">Wildlife education and conservation conversations – watch here or on YouTube.</p>
            <div class="mt-4 accent-bar"></div>
        </div>
    </section>

    <div class="max-w-6xl mx-auto">
        @forelse($podcasts as $podcast)
        <article class="podcast-card theme-card rounded-2xl overflow-hidden mb-10 reveal hover-lift">
            <div class="flex flex-col lg:flex-row gap-0">
                @if($podcast->youtube_embed_url)
                <div class="lg:w-3/5 flex-shrink-0 p-4 lg:p-6">
                    <div class="yt-embed">
                        <iframe
                            src="{{ $podcast->youtube_embed_url }}"
                            title="{{ $podcast->title }}"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
                @endif
                <div class="flex-1 p-6 flex flex-col justify-center">
                    <h2 class="text-xl md:text-2xl font-bold theme-text-primary mb-3">{{ $podcast->title }}</h2>
                    @if($podcast->description)
                    <p class="theme-text-secondary leading-relaxed mb-4">{{ $podcast->description }}</p>
                    @endif
                    <div class="flex flex-wrap gap-3 mt-2">
                        @if($podcast->youtube_embed_url)
                        <a href="{{ $podcast->youtube_watch_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 theme-btn-outline text-sm px-4 py-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            Watch on YouTube
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </article>
        @empty
        <div class="theme-card rounded-2xl p-12 text-center">
            <p class="theme-text-secondary text-lg">No podcasts yet. Check back soon!</p>
        </div>
        @endforelse
    </div>
@endsection

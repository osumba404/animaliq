@extends('layouts.public')

@section('title', $post->title)

@section('content')
    <article class="max-w-3xl">
        @if($post->featured_image)
            <div class="rounded-2xl overflow-hidden mb-8 -mx-4 md:mx-0 h-64 md:h-96">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        @endif
        @if($post->campaign)
            <p class="text-sm font-semibold theme-accent mb-2">{{ $post->campaign->title }}</p>
        @endif
        <h1 class="text-4xl font-bold theme-text-primary mb-4">{{ $post->title }}</h1>
        <p class="theme-text-secondary mb-8">By {{ $post->author->first_name }} {{ $post->author->last_name }} · {{ $post->published_at?->format('F j, Y') }}</p>
        <div class="prose prose-lg max-w-none theme-text-secondary">{!! $post->content !!}</div>
    </article>
@endsection

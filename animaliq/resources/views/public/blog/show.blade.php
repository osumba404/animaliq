@extends('layouts.public')

@section('title', $post->title)

@section('content')
    <article>
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="text-[#706f6c] mb-6">By {{ $post->author->first_name }} {{ $post->author->last_name }} · {{ $post->published_at?->format('F j, Y') }}</p>
        <div class="prose dark:prose-invert max-w-none">{!! $post->content !!}</div>
    </article>
@endsection

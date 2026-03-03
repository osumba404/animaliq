@extends('layouts.public')

@section('title', $event->title)

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>
    <p class="text-[#706f6c] mb-4">
        {{ $event->start_datetime?->format('l, F j, Y \a\t g:i A') }}
        @if($event->location) · {{ $event->location }} @endif
    </p>
    <div class="prose dark:prose-invert max-w-none mb-8">{!! nl2br(e($event->description ?? '')) !!}</div>
    {{-- Registration form can be added here --}}
@endsection

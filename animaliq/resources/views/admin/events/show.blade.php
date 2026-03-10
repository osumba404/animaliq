@extends('layouts.admin')

@section('title', $event->title)
@section('content')
    <h1 class="text-2xl font-bold mb-4 theme-text-primary">{{ $event->title }}</h1>
    @if(session('success'))
        <p class="mb-4 p-3 rounded bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">{{ session('success') }}</p>
    @endif
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('admin.events.edit', $event) }}" class="theme-btn-outline">Edit event</a>
        @if($event->proceeding)
            <a href="{{ route('admin.events.proceedings.edit', $event) }}" class="theme-btn">Edit proceedings</a>
        @else
            <a href="{{ route('admin.events.proceedings.create', $event) }}" class="theme-btn">Add post-event proceedings</a>
        @endif
    </div>
    <p class="theme-text-secondary">Registrations: {{ $event->registrations->count() }}</p>
    <ul class="mt-2 space-y-1">@foreach($event->registrations as $r)<li class="theme-text-secondary">{{ $r->user->first_name }} {{ $r->user->last_name }} – {{ $r->status }}</li>@endforeach</ul>
@endsection

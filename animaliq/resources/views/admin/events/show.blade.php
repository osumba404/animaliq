@extends('layouts.admin') @section('title', $event->title) @section('content')
<h1 class="text-2xl font-bold mb-4">{{ $event->title }}</h1>
<p><a href="{{ route('admin.events.edit', $event) }}" class="text-blue-600 hover:underline">Edit</a></p>
<p class="mt-2">Registrations: {{ $event->registrations->count() }}</p>
<ul class="mt-2">@foreach($event->registrations as $r)<li>{{ $r->user->first_name }} {{ $r->user->last_name }} – {{ $r->status }}</li>@endforeach</ul>
@endsection

@extends('layouts.admin') @section('title', 'Events') @section('content')
<h1 class="text-2xl font-bold mb-4">Events</h1>
<p><a href="{{ route('admin.events.create') }}" class="text-blue-600 hover:underline">Add Event</a></p>
<ul class="mt-4 space-y-2">@foreach($events as $e)
<li class="flex justify-between py-2 border-b"><span>{{ $e->title }} ({{ $e->start_datetime?->format('Y-m-d') }})</span><span><a href="{{ route('admin.events.show', $e) }}" class="text-blue-600 hover:underline">View</a> | <a href="{{ route('admin.events.edit', $e) }}" class="text-blue-600 hover:underline">Edit</a> | <form action="{{ route('admin.events.destroy', $e) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Delete</button></form></span></li>
@endforeach</ul>
{{ $events->links() }} @endsection

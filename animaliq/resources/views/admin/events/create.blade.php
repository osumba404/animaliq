@extends('layouts.admin') @section('title', 'Create Event') @section('content')
<h1 class="text-2xl font-bold mb-4">Create Event</h1>
<form action="{{ route('admin.events.store') }}" method="POST" class="max-w-md">@csrf
<div class="mb-4"><label class="block">Program</label><select name="program_id" class="w-full border rounded px-2 py-1"><option value="">—</option>@foreach($programs as $p)<option value="{{ $p->id }}">{{ $p->title }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Start</label><input type="datetime-local" name="start_datetime" value="{{ old('start_datetime') }}" class="w-full border rounded px-2 py-1"></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="upcoming">Upcoming</option><option value="completed">Completed</option><option value="cancelled">Cancelled</option></select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button></form>
@endsection

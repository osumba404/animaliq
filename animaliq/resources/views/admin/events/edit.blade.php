@extends('layouts.admin') @section('title', 'Edit Event') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit Event</h1>
<form action="{{ route('admin.events.update', $event) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">Program</label><select name="program_id" class="w-full border rounded px-2 py-1"><option value="">—</option>@foreach($programs as $p)<option value="{{ $p->id }}" {{ $event->program_id == $p->id ? 'selected' : '' }}>{{ $p->title }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title', $event->title) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Start</label><input type="datetime-local" name="start_datetime" value="{{ old('start_datetime', $event->start_datetime?->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-2 py-1"></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1">@foreach(['upcoming','completed','cancelled'] as $s)<option value="{{ $s }}" {{ $event->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>@endforeach</select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection

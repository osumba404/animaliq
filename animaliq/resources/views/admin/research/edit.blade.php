@extends('layouts.admin') @section('title', 'Edit Research Project') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit Research Project</h1>
<form action="{{ route('admin.research.update', $researchProject) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title', $researchProject->title) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Summary</label><textarea name="summary" class="w-full border rounded px-2 py-1">{{ old('summary', $researchProject->summary) }}</textarea></div>
<div class="mb-4"><label class="block">Department</label><select name="department_id" class="w-full border rounded px-2 py-1"><option value="">—</option>@foreach($departments as $d)<option value="{{ $d->id }}" {{ $researchProject->department_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="ongoing" {{ $researchProject->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option><option value="completed" {{ $researchProject->status == 'completed' ? 'selected' : '' }}>Completed</option></select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection

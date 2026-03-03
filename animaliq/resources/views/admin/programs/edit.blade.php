@extends('layouts.admin') @section('title', 'Edit Program') @section('content')
<h1 class="text-2xl font-bold mb-4">Edit Program</h1>
<form action="{{ route('admin.programs.update', $program) }}" method="POST" class="max-w-md">@csrf @method('PUT')
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title', $program->title) }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Description</label><textarea name="description" class="w-full border rounded px-2 py-1">{{ old('description', $program->description) }}</textarea></div>
<div class="mb-4"><label class="block">Department</label><select name="department_id" class="w-full border rounded px-2 py-1"><option value="">—</option>@foreach($departments as $d)<option value="{{ $d->id }}" {{ old('department_id', $program->department_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="active" {{ $program->status == 'active' ? 'selected' : '' }}>Active</option><option value="archived" {{ $program->status == 'archived' ? 'selected' : '' }}>Archived</option></select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button></form>
@endsection

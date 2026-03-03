@extends('layouts.admin') @section('title', 'Create Research Project') @section('content')
<h1 class="text-2xl font-bold mb-4">Create Research Project</h1>
<form action="{{ route('admin.research.store') }}" method="POST" class="max-w-md">@csrf
<div class="mb-4"><label class="block">Title</label><input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-2 py-1" required></div>
<div class="mb-4"><label class="block">Summary</label><textarea name="summary" class="w-full border rounded px-2 py-1">{{ old('summary') }}</textarea></div>
<div class="mb-4"><label class="block">Department</label><select name="department_id" class="w-full border rounded px-2 py-1"><option value="">—</option>@foreach($departments as $d)<option value="{{ $d->id }}">{{ $d->name }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border rounded px-2 py-1"><option value="ongoing">Ongoing</option><option value="completed">Completed</option></select></div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button></form>
@endsection

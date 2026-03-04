@extends('layouts.admin')
@section('title', 'Create Research Project')
@section('heading', 'Create Research Project')
@section('content')
<h1 class="text-2xl font-bold mb-4 theme-text-primary">Create Research Project</h1>
<form action="{{ route('admin.research.store') }}" method="POST" class="max-w-md" enctype="multipart/form-data">@csrf
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Title</label><input type="text" name="title" value="{{ old('title') }}" class="theme-input w-full" required></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Summary</label><textarea name="summary" class="theme-input w-full" rows="4">{{ old('summary') }}</textarea></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Banner image</label><input type="file" name="banner_image" accept="image/*" class="theme-input w-full"></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Department</label><select name="department_id" class="theme-input w-full"><option value="">—</option>@foreach($departments as $d)<option value="{{ $d->id }}">{{ $d->name }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Start date</label><input type="date" name="start_date" value="{{ old('start_date') }}" class="theme-input w-full"></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">End date</label><input type="date" name="end_date" value="{{ old('end_date') }}" class="theme-input w-full"></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Status</label><select name="status" class="theme-input w-full"><option value="ongoing">Ongoing</option><option value="completed">Completed</option></select></div>
<button type="submit" class="theme-btn">Save</button>
<a href="{{ route('admin.research.index') }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection

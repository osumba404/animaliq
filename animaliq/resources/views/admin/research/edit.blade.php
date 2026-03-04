@extends('layouts.admin')
@section('title', 'Edit Research Project')
@section('heading', 'Edit Research Project')
@section('content')
<h1 class="text-2xl font-bold mb-4 theme-text-primary">Edit Research Project</h1>
<form action="{{ route('admin.research.update', $researchProject) }}" method="POST" class="max-w-md" enctype="multipart/form-data">@csrf @method('PUT')
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Title</label><input type="text" name="title" value="{{ old('title', $researchProject->title) }}" class="theme-input w-full" required></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Summary</label><textarea name="summary" class="theme-input w-full" rows="4">{{ old('summary', $researchProject->summary) }}</textarea></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Banner image</label>@if($researchProject->banner_image)<p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $researchProject->banner_image) }}" alt="" class="inline-block h-10 max-w-[120px] object-cover rounded"></p>@endif<input type="file" name="banner_image" accept="image/*" class="theme-input w-full"><span class="text-xs theme-text-secondary">Leave empty to keep current</span></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Department</label><select name="department_id" class="theme-input w-full"><option value="">—</option>@foreach($departments as $d)<option value="{{ $d->id }}" {{ $researchProject->department_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>@endforeach</select></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Start date</label><input type="date" name="start_date" value="{{ old('start_date', $researchProject->start_date?->format('Y-m-d')) }}" class="theme-input w-full"></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">End date</label><input type="date" name="end_date" value="{{ old('end_date', $researchProject->end_date?->format('Y-m-d')) }}" class="theme-input w-full"></div>
<div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Status</label><select name="status" class="theme-input w-full"><option value="ongoing" {{ $researchProject->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option><option value="completed" {{ $researchProject->status == 'completed' ? 'selected' : '' }}>Completed</option></select></div>
<button type="submit" class="theme-btn">Update</button>
<a href="{{ route('admin.research.index') }}" class="ml-2 theme-link">Cancel</a>
</form>

@if($researchProject->reports->isNotEmpty())
<h2 class="text-xl font-semibold mt-8 mb-2 theme-text-primary">Reports</h2>
<ul class="space-y-2">
    @foreach($researchProject->reports as $report)
    <li class="flex justify-between items-center py-2 theme-table-cell border-b">
        <span class="theme-text-primary">{{ $report->title }}</span>
        <span class="text-sm theme-text-secondary">{{ $report->published_at?->format('M j, Y') }}</span>
    </li>
    @endforeach
</ul>
@endif
@endsection

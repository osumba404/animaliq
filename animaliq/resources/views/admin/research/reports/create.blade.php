@extends('layouts.admin')
@section('title', 'Add Report')
@section('heading', 'Add Report')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.research.edit', $researchProject) }}" class="theme-link text-sm">← Back to {{ $researchProject->title }}</a>
</div>
<h1 class="text-2xl font-bold mb-6 theme-text-primary">Add Report</h1>
<form action="{{ route('admin.research.reports.store', $researchProject) }}" method="POST" class="max-w-lg" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" class="theme-input w-full" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">File <span class="text-xs">(PDF, Word, Excel, PowerPoint — max 10 MB)</span></label>
        <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="theme-input w-full">
    </div>
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Published date <span class="text-xs">(optional)</span></label>
        <input type="date" name="published_at" value="{{ old('published_at') }}" class="theme-input w-full">
    </div>
    <button type="submit" class="theme-btn">Save Report</button>
    <a href="{{ route('admin.research.edit', $researchProject) }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection

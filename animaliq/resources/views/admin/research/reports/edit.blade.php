@extends('layouts.admin')
@section('title', 'Edit Report')
@section('heading', 'Edit Report')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.research.edit', $researchProject) }}" class="theme-link text-sm">← Back to {{ $researchProject->title }}</a>
</div>
<h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Report</h1>
<form action="{{ route('admin.research.reports.update', [$researchProject, $report]) }}" method="POST" class="max-w-lg" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $report->title) }}" class="theme-input w-full" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">File <span class="text-xs">(PDF, Word, Excel, PowerPoint — max 10 MB)</span></label>
        @if($report->file_path)
            <p class="text-sm theme-text-secondary mb-1">
                Current: <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank" class="theme-link">{{ basename($report->file_path) }}</a>
            </p>
        @endif
        <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="theme-input w-full">
        <span class="text-xs theme-text-secondary">Leave empty to keep current file</span>
    </div>
    <div class="mb-4">
        <label class="block font-medium theme-text-secondary mb-1">Published date <span class="text-xs">(optional)</span></label>
        <input type="date" name="published_at" value="{{ old('published_at', $report->published_at?->format('Y-m-d')) }}" class="theme-input w-full">
    </div>
    <button type="submit" class="theme-btn">Update Report</button>
    <a href="{{ route('admin.research.edit', $researchProject) }}" class="ml-2 theme-link">Cancel</a>
</form>
@endsection

@extends('layouts.admin')

@section('title', 'Create Campaign')
@section('heading', 'Create Campaign')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Create Campaign</h1>
    <form action="{{ route('admin.campaigns.store') }}" method="POST" class="max-w-md" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Image</label>
            <input type="file" name="image" accept="image/*" class="theme-input w-full">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Start date</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}" class="theme-input w-full">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">End date</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}" class="theme-input w-full">
        </div>
        <button type="submit" class="theme-btn">Save</button>
        <a href="{{ route('admin.campaigns.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

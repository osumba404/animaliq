@extends('layouts.admin')

@section('title', 'Edit Podcast')
@section('heading', 'Podcasts')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Podcast</h1>
    <form action="{{ route('admin.podcasts.update', $podcast) }}" method="POST" class="max-w-lg">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Podcast Name <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $podcast->title) }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">YouTube URL <span class="text-red-500">*</span></label>
            <input type="url" name="youtube_url" value="{{ old('youtube_url', $podcast->youtube_url) }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="3">{{ old('description', $podcast->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Display Order</label>
            <input type="number" name="display_order" value="{{ old('display_order', $podcast->display_order) }}" class="theme-input w-full" min="0">
        </div>
        <div class="mb-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="active" value="1" {{ old('active', $podcast->active) ? 'checked' : '' }} class="w-4 h-4">
                <span class="theme-text-primary">Active</span>
            </label>
        </div>
        <button type="submit" class="theme-btn">Update</button>
        <a href="{{ route('admin.podcasts.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

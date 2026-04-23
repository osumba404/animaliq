@extends('layouts.admin')

@section('title', 'Add Podcast')
@section('heading', 'Podcasts')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Add Podcast</h1>
    <form action="{{ route('admin.podcasts.store') }}" method="POST" class="max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Podcast Name <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="theme-input w-full" required placeholder="e.g. Wildlife Conservation Talk Ep.1">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">YouTube URL <span class="text-red-500">*</span></label>
            <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" class="theme-input w-full" required placeholder="https://www.youtube.com/watch?v=...">
            @error('youtube_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs theme-text-secondary mt-1">Paste the full YouTube video link.</p>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="3" placeholder="Brief description of this episode...">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Display Order</label>
            <input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="theme-input w-full" min="0">
            <p class="text-xs theme-text-secondary mt-1">Lower numbers appear first.</p>
        </div>
        <div class="mb-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="active" value="1" {{ old('active', '1') ? 'checked' : '' }} class="w-4 h-4">
                <span class="theme-text-primary">Active (visible to users)</span>
            </label>
        </div>
        <button type="submit" class="theme-btn">Save</button>
        <a href="{{ route('admin.podcasts.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

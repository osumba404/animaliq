@extends('layouts.admin')

@section('title', 'Add event proceedings – ' . $event->title)
@section('heading', 'Post-event proceedings')

@section('content')
    <div class="max-w-3xl">
        <p class="theme-text-secondary mb-6">Event: <strong class="theme-text-primary">{{ $event->title }}</strong> ({{ $event->start_datetime?->format('M j, Y') }})</p>
        @if(session('info'))
            <p class="mb-4 p-3 rounded theme-bg-warm theme-text-secondary">{{ session('info') }}</p>
        @endif
        <form action="{{ route('admin.events.proceedings.store', $event) }}" method="POST" enctype="multipart/form-data" class="theme-card rounded-2xl p-6 md:p-8">
            @csrf
            <div class="mb-6">
                <label class="block font-medium theme-text-primary mb-1">What happened (summary)</label>
                <textarea name="content" class="theme-input w-full" rows="5" placeholder="Post-event summary, highlights...">{{ old('content') }}</textarea>
                @error('content')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label class="block font-medium theme-text-primary mb-1">Activities of the day</label>
                <textarea name="activities_description" class="theme-input w-full" rows="4" placeholder="Key activities...">{{ old('activities_description') }}</textarea>
                @error('activities_description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label class="block font-medium theme-text-primary mb-1">Learning areas / key takeaways</label>
                <textarea name="learning_points" class="theme-input w-full" rows="4" placeholder="Learning points, takeaways...">{{ old('learning_points') }}</textarea>
                @error('learning_points')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label class="block font-medium theme-text-primary mb-1">Images (multiple allowed)</label>
                <input type="file" name="images[]" accept="image/*" multiple class="theme-input w-full">
                <p class="text-sm theme-text-secondary mt-1">Optional: add captions below (one per line, in same order as selected files).</p>
                <textarea name="captions" class="theme-input w-full mt-2" rows="3" placeholder="Caption for image 1&#10;Caption for image 2">{{ old('captions') }}</textarea>
                @error('images.*')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="theme-btn">Save proceedings</button>
                <a href="{{ route('admin.events.show', $event) }}" class="theme-btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection

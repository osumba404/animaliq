@extends('layouts.admin')

@section('title', 'Edit proceedings – ' . $event->title)
@section('heading', 'Edit event proceedings')

@section('content')
    <div class="max-w-3xl">
        <p class="theme-text-secondary mb-6">Event: <strong class="theme-text-primary">{{ $event->title }}</strong> ({{ $event->start_datetime?->format('M j, Y') }})</p>
        @if(session('success'))
            <p class="mb-4 p-3 rounded bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">{{ session('success') }}</p>
        @endif
        <form action="{{ route('admin.events.proceedings.update', $event) }}" method="POST" enctype="multipart/form-data" class="theme-card rounded-2xl p-6 md:p-8 mb-8">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label class="block font-medium theme-text-primary mb-1">What happened (summary)</label>
                <textarea name="content" class="theme-input w-full" rows="5">{{ old('content', $proceeding->content) }}</textarea>
                @error('content')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label class="block font-medium theme-text-primary mb-1">Activities of the day</label>
                <textarea name="activities_description" class="theme-input w-full" rows="4">{{ old('activities_description', $proceeding->activities_description) }}</textarea>
                @error('activities_description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label class="block font-medium theme-text-primary mb-1">Learning areas / key takeaways</label>
                <textarea name="learning_points" class="theme-input w-full" rows="4">{{ old('learning_points', $proceeding->learning_points) }}</textarea>
                @error('learning_points')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label class="block font-medium theme-text-primary mb-1">Add more images</label>
                <input type="file" name="images[]" accept="image/*" multiple class="theme-input w-full">
                <p class="text-sm theme-text-secondary mt-1">Optional: captions for new images (one per line).</p>
                <textarea name="captions" class="theme-input w-full mt-2" rows="2" placeholder="Caption for new image 1&#10;Caption for new image 2">{{ old('captions') }}</textarea>
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="theme-btn">Update proceedings</button>
                <a href="{{ route('admin.events.show', $event) }}" class="theme-btn-outline">Back to event</a>
            </div>
        </form>

        @if($proceeding->images->isNotEmpty())
            <h2 class="text-lg font-bold theme-text-primary mb-3">Current images</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($proceeding->images as $img)
                    <div class="theme-card rounded-xl overflow-hidden">
                        <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->caption ?? 'Event image' }}" class="w-full h-40 object-cover">
                        @if($img->caption)
                            <p class="p-2 text-sm theme-text-secondary line-clamp-2">{{ $img->caption }}</p>
                        @endif
                        <form action="{{ route('admin.events.proceedings.images.destroy', [$event, $img]) }}" method="POST" class="p-2" onsubmit="return confirm('Remove this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

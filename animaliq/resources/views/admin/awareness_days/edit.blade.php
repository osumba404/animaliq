@extends('layouts.admin')

@section('title', 'Edit Awareness Day')
@section('heading', 'Awareness Days')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Awareness Day</h1>
    <form action="{{ route('admin.awareness-days.update', $awarenessDay) }}" method="POST" class="max-w-lg" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $awarenessDay->title) }}" class="theme-input w-full" required>
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Date of Celebration <span class="text-red-500">*</span></label>
            <input type="date" name="celebration_date" value="{{ old('celebration_date', $awarenessDay->celebration_date->format('Y-m-d')) }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description / Body</label>
            <textarea name="body" class="theme-input w-full" rows="5">{{ old('body', $awarenessDay->body) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Image</label>
            @if($awarenessDay->image)
                <p class="text-sm theme-text-secondary mb-1">Current:</p>
                <img src="{{ asset('storage/' . $awarenessDay->image) }}" alt="" class="h-24 w-auto object-cover rounded-lg mb-2">
            @endif
            <input type="file" name="image" accept="image/*" class="theme-input w-full">
            <span class="text-xs theme-text-secondary">Leave empty to keep current image</span>
        </div>
        <div class="mb-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="active" value="1" {{ old('active', $awarenessDay->active) ? 'checked' : '' }} class="w-4 h-4">
                <span class="theme-text-primary">Active (visible to users)</span>
            </label>
        </div>
        <button type="submit" class="theme-btn">Update</button>
        <a href="{{ route('admin.awareness-days.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

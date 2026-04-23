@extends('layouts.admin')

@section('title', 'Add Awareness Day')
@section('heading', 'Awareness Days')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Add Awareness Day / Environmental Holiday</h1>
    <form action="{{ route('admin.awareness-days.store') }}" method="POST" class="max-w-lg" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="theme-input w-full" required placeholder="e.g. World Wildlife Day">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Date of Celebration <span class="text-red-500">*</span></label>
            <input type="date" name="celebration_date" value="{{ old('celebration_date') }}" class="theme-input w-full" required>
            @error('celebration_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description / Body</label>
            <textarea name="body" class="theme-input w-full" rows="5" placeholder="Briefly describe what is celebrated...">{{ old('body') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Image</label>
            <input type="file" name="image" accept="image/*" class="theme-input w-full">
        </div>
        <div class="mb-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="active" value="1" {{ old('active', '1') ? 'checked' : '' }} class="w-4 h-4">
                <span class="theme-text-primary">Active (visible to users)</span>
            </label>
        </div>
        <button type="submit" class="theme-btn">Save</button>
        <a href="{{ route('admin.awareness-days.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

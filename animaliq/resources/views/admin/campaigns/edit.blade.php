@extends('layouts.admin')

@section('title', 'Edit Campaign')
@section('heading', 'Edit Campaign')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Campaign</h1>
    <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" class="max-w-md" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $campaign->title) }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="4">{{ old('description', $campaign->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Image</label>
            @if($campaign->image ?? null)
                <p class="text-sm theme-text-secondary mb-1">Current: <img src="{{ asset('storage/' . $campaign->image) }}" alt="" class="inline-block h-12 w-12 object-cover rounded"></p>
            @endif
            <input type="file" name="image" accept="image/*" class="theme-input w-full">
            <span class="text-xs theme-text-secondary">Leave empty to keep current</span>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Start date</label>
            <input type="date" name="start_date" value="{{ old('start_date', $campaign->start_date?->format('Y-m-d')) }}" class="theme-input w-full">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">End date</label>
            <input type="date" name="end_date" value="{{ old('end_date', $campaign->end_date?->format('Y-m-d')) }}" class="theme-input w-full">
        </div>
        <button type="submit" class="theme-btn">Update</button>
        <a href="{{ route('admin.campaigns.index') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

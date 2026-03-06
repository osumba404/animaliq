@extends('layouts.admin')

@section('title', 'Create Donation Campaign')
@section('heading', 'Create Donation Campaign')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Create Donation Campaign</h1>
    <form action="{{ route('admin.donations.store') }}" method="POST" class="max-w-lg">
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
            <label class="block font-medium theme-text-secondary mb-1">Target amount</label>
            <input type="number" name="target_amount" value="{{ old('target_amount') }}" class="theme-input w-full" step="0.01" min="0" placeholder="Optional">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium theme-text-secondary mb-1">Start date</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" class="theme-input w-full">
            </div>
            <div>
                <label class="block font-medium theme-text-secondary mb-1">End date</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" class="theme-input w-full">
            </div>
        </div>
        <button type="submit" class="theme-btn">Save</button>
        <a href="{{ route('admin.donations.campaigns') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

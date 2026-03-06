@extends('layouts.admin')

@section('title', 'Edit Donation Campaign')
@section('heading', 'Edit Donation Campaign')

@section('content')
    <h1 class="text-2xl font-bold mb-6 theme-text-primary">Edit Donation Campaign</h1>
    <form action="{{ route('admin.donations.update', $donationCampaign) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $donationCampaign->title) }}" class="theme-input w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Description</label>
            <textarea name="description" class="theme-input w-full" rows="4">{{ old('description', $donationCampaign->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Target amount</label>
            <input type="number" name="target_amount" value="{{ old('target_amount', $donationCampaign->target_amount) }}" class="theme-input w-full" step="0.01" min="0" placeholder="Optional">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium theme-text-secondary mb-1">Start date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $donationCampaign->start_date?->format('Y-m-d')) }}" class="theme-input w-full">
            </div>
            <div>
                <label class="block font-medium theme-text-secondary mb-1">End date</label>
                <input type="date" name="end_date" value="{{ old('end_date', $donationCampaign->end_date?->format('Y-m-d')) }}" class="theme-input w-full">
            </div>
        </div>
        <button type="submit" class="theme-btn">Update</button>
        <a href="{{ route('admin.donations.campaigns') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

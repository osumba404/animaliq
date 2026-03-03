@extends('layouts.public')

@section('title', 'Edit profile')

@section('content')
    <h1 class="text-3xl font-bold mb-6 theme-text-primary">Edit account</h1>
    <form action="{{ route('community.profile.update') }}" method="POST" class="max-w-xl theme-card rounded-lg p-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium theme-text-secondary mb-1">First name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="theme-input w-full" required>
            </div>
            <div>
                <label class="block font-medium theme-text-secondary mb-1">Last name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="theme-input w-full" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Email</label>
            <input type="email" value="{{ $user->email }}" class="theme-input w-full" disabled>
            <p class="text-xs theme-text-secondary mt-1">Email cannot be changed here.</p>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="theme-input w-full" placeholder="Optional">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Profile photo path</label>
            <input type="text" name="profile_photo" value="{{ old('profile_photo', $user->profile_photo) }}" class="theme-input w-full" placeholder="e.g. profiles/photo.jpg">
        </div>
        <div class="mb-6">
            <label class="block font-medium theme-text-secondary mb-1">Bio</label>
            <textarea name="bio" rows="3" class="theme-input w-full" placeholder="Short bio (optional)">{{ old('bio', $user->bio) }}</textarea>
        </div>
        <h2 class="text-lg font-semibold theme-text-primary mb-2">Change password (optional)</h2>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Current password</label>
            <input type="password" name="current_password" class="theme-input w-full" autocomplete="current-password">
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">New password</label>
            <input type="password" name="password" class="theme-input w-full" autocomplete="new-password">
        </div>
        <div class="mb-6">
            <label class="block font-medium theme-text-secondary mb-1">Confirm new password</label>
            <input type="password" name="password_confirmation" class="theme-input w-full" autocomplete="new-password">
        </div>
        <button type="submit" class="theme-btn">Save changes</button>
        <a href="{{ route('community.dashboard') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

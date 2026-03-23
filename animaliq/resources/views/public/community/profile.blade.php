@extends('layouts.public')

@section('title', 'Edit profile')

@section('content')
    <h1 class="text-3xl font-bold mb-6 theme-text-primary">Edit account</h1>
    <form action="{{ route('community.profile.update') }}" method="POST" enctype="multipart/form-data" class="max-w-xl theme-card rounded-lg p-6">
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
            <label class="block font-medium theme-text-secondary mb-1">Profile photo</label>
            @if($user->profile_photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="w-20 h-20 rounded-full object-cover border theme-border">
                </div>
            @endif
            <input type="file" name="profile_photo" accept="image/*" class="theme-input w-full text-sm">
        </div>
        <div class="mb-6">
            <label class="block font-medium theme-text-secondary mb-1">Bio</label>
            <textarea name="bio" rows="3" class="theme-input w-full" placeholder="Short bio (optional)">{{ old('bio', $user->bio) }}</textarea>
        </div>
        <h2 class="text-lg font-semibold theme-text-primary mb-2">Change password (optional)</h2>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">Current password</label>
            <div class="relative">
                <input type="password" id="current_password" name="current_password" class="theme-input w-full pr-10 js-password" autocomplete="current-password">
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 theme-text-secondary hover:theme-accent focus:outline-none js-toggle-password">
                    <svg class="w-5 h-5 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg class="w-5 h-5 eye-slash-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-medium theme-text-secondary mb-1">New password</label>
            <div class="relative">
                <input type="password" id="password" name="password" class="theme-input w-full pr-10 js-password" autocomplete="new-password">
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 theme-text-secondary hover:theme-accent focus:outline-none js-toggle-password">
                    <svg class="w-5 h-5 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg class="w-5 h-5 eye-slash-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
        </div>
        <div class="mb-6">
            <label class="block font-medium theme-text-secondary mb-1">Confirm new password</label>
            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation" class="theme-input w-full pr-10 js-password" autocomplete="new-password">
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 theme-text-secondary hover:theme-accent focus:outline-none js-toggle-password">
                    <svg class="w-5 h-5 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg class="w-5 h-5 eye-slash-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
        </div>
        <button type="submit" class="theme-btn">Save changes</button>
        <a href="{{ route('community.dashboard') }}" class="ml-2 theme-link">Cancel</a>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.js-toggle-password').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var wrapper = this.closest('.relative');
                var input = wrapper.querySelector('.js-password');
                var eyeIcon = wrapper.querySelector('.eye-icon');
                var eyeSlashIcon = wrapper.querySelector('.eye-slash-icon');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                } else {
                    input.type = 'password';
                    eyeIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('hidden');
                }
            });
        });
    });
</script>
@endpush

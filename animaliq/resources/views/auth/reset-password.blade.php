@extends('layouts.auth')

@section('title', 'Set New Password')

@push('styles')
<style>
.theme-card { animation: ani-scale-in 0.5s var(--anim-ease-out) both; }
</style>
@endpush

@push('scripts')
<script>
function togglePwd(id, btn) {
    var inp = document.getElementById(id);
    var isText = inp.type === 'text';
    inp.type = isText ? 'password' : 'text';
    btn.querySelector('svg').innerHTML = isText
        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
}
</script>
@endpush

@section('content')
<div class="theme-card rounded-lg p-8">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--accent-orange), #CC5500);">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-semibold theme-text-primary">Set New Password</h1>
    </div>
    <p class="theme-text-secondary text-sm mb-6">Create a new password for your account. It must be at least 8 characters.</p>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-sm font-medium theme-text-secondary mb-1">New Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" required autocomplete="new-password" class="theme-input pr-10">
                <button type="button" onclick="togglePwd('password',this)" class="absolute inset-y-0 right-0 flex items-center px-3 theme-text-secondary hover:text-[var(--accent-orange)] transition" tabindex="-1" aria-label="Toggle visibility">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1 text-sm" style="color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium theme-text-secondary mb-1">Confirm New Password</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" class="theme-input pr-10">
                <button type="button" onclick="togglePwd('password_confirmation',this)" class="absolute inset-y-0 right-0 flex items-center px-3 theme-text-secondary hover:text-[var(--accent-orange)] transition" tabindex="-1" aria-label="Toggle visibility">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
        </div>

        <button type="submit" class="w-full theme-btn py-2.5 px-4">
            Reset Password
        </button>
    </form>
</div>
@endsection

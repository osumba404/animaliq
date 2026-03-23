@extends('layouts.auth')

@section('title', 'Log in')

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
    <h1 class="text-2xl font-semibold mb-2 theme-text-primary">Log in</h1>
    <p class="theme-text-secondary text-sm mb-6">Sign in to your Animal IQ account.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium theme-text-secondary mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="theme-input">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium theme-text-secondary mb-1">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" required autocomplete="current-password" class="theme-input pr-10">
                <button type="button" onclick="togglePwd('password',this)" class="absolute inset-y-0 right-0 flex items-center px-3 theme-text-secondary hover:text-[var(--accent-orange)] transition" tabindex="-1" aria-label="Toggle password visibility">
                    <svg id="password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember" class="rounded theme-border text-[var(--accent-orange)] focus:ring-[var(--accent-orange)]">
            <label for="remember" class="ml-2 text-sm theme-text-secondary">Remember me</label>
        </div>

        <button type="submit" class="w-full theme-btn py-2.5 px-4">
            Log in
        </button>
    </form>

    <p class="mt-6 text-center text-sm theme-text-secondary">
        Don't have an account? <a href="{{ route('register') }}" class="theme-link font-medium">Register</a>
    </p>
</div>
@endsection

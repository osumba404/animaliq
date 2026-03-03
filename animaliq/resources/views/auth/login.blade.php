@extends('layouts.auth')

@section('title', 'Log in')

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
            <input type="password" name="password" id="password" required autocomplete="current-password" class="theme-input">
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

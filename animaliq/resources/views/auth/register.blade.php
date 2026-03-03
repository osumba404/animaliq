@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="theme-card rounded-lg p-8">
    <h1 class="text-2xl font-semibold mb-2 theme-text-primary">Create an account</h1>
    <p class="theme-text-secondary text-sm mb-6">Join the Animal IQ community.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="first_name" class="block text-sm font-medium theme-text-secondary mb-1">First name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="given-name" class="theme-input">
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium theme-text-secondary mb-1">Last name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required autocomplete="family-name" class="theme-input">
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium theme-text-secondary mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" class="theme-input">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium theme-text-secondary mb-1">Password</label>
            <input type="password" name="password" id="password" required autocomplete="new-password" class="theme-input" aria-describedby="password-requirements">
            <p id="password-requirements" class="mt-1 text-xs theme-text-secondary">Minimum 8 characters.</p>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium theme-text-secondary mb-1">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" class="theme-input">
        </div>

        <button type="submit" class="w-full theme-btn py-2.5 px-4">
            Register
        </button>
    </form>

    <p class="mt-6 text-center text-sm theme-text-secondary">
        Already have an account? <a href="{{ route('login') }}" class="theme-link font-medium">Log in</a>
    </p>
</div>
@endsection

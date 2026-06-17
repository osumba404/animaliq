@extends('layouts.auth')

@section('title', 'Forgot Password')

@push('styles')
<style>
.theme-card { animation: ani-scale-in 0.5s var(--anim-ease-out) both; }
</style>
@endpush

@section('content')
<div class="theme-card rounded-lg p-8">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--accent-orange), #CC5500);">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-semibold theme-text-primary">Forgot Password</h1>
    </div>
    <p class="theme-text-secondary text-sm mb-6">Enter the email address you used to register and we'll send you a 4-digit code to reset your password.</p>

    @if (session('status'))
        <div class="mb-5 p-4 rounded-lg text-sm" style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #16a34a;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.send-otp') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium theme-text-secondary mb-1">Email address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="theme-input" placeholder="you@example.com">
        </div>

        <button type="submit" class="w-full theme-btn py-2.5 px-4">
            Send Reset Code
        </button>
    </form>

    <p class="mt-6 text-center text-sm theme-text-secondary">
        Remember your password? <a href="{{ route('login') }}" class="theme-link font-medium">Log in</a>
    </p>
</div>
@endsection

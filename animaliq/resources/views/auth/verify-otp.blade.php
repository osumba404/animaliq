@extends('layouts.auth')

@section('title', 'Enter Reset Code')

@push('styles')
<style>
.theme-card { animation: ani-scale-in 0.5s var(--anim-ease-out) both; }
.otp-inputs { display: flex; gap: 12px; justify-content: center; }
.otp-digit {
    width: 64px; height: 72px;
    text-align: center; font-size: 28px; font-weight: 700;
    border-radius: 10px; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.otp-digit:focus {
    border-color: var(--accent-orange) !important;
    box-shadow: 0 0 0 3px rgba(255,117,24,0.2);
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    const digits = document.querySelectorAll('.otp-digit');
    const hidden = document.getElementById('otp-hidden');

    function syncHidden() {
        hidden.value = Array.from(digits).map(d => d.value).join('');
    }

    digits.forEach((el, i) => {
        el.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(-1);
            syncHidden();
            if (this.value && i < digits.length - 1) digits[i + 1].focus();
        });

        el.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !this.value && i > 0) {
                digits[i - 1].focus();
            }
        });

        el.addEventListener('paste', function (e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 4);
            text.split('').forEach((ch, idx) => { if (digits[idx]) digits[idx].value = ch; });
            syncHidden();
            const next = Math.min(text.length, digits.length - 1);
            digits[next].focus();
        });
    });
})();
</script>
@endpush

@section('content')
<div class="theme-card rounded-lg p-8">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--accent-orange), #CC5500);">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-semibold theme-text-primary">Enter Reset Code</h1>
    </div>
    <p class="theme-text-secondary text-sm mb-6">
        We sent a 4-digit code to <strong class="theme-text-primary">{{ session('otp_email') }}</strong>. Enter it below. The code expires in 10 minutes.
    </p>

    <form method="POST" action="{{ route('password.verify-otp') }}" class="space-y-6">
        @csrf

        <div>
            <div class="otp-inputs mb-1">
                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit theme-input" aria-label="Digit 1" autofocus>
                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit theme-input" aria-label="Digit 2">
                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit theme-input" aria-label="Digit 3">
                <input type="text" inputmode="numeric" maxlength="1" class="otp-digit theme-input" aria-label="Digit 4">
            </div>
            <input type="hidden" name="otp" id="otp-hidden">
            @error('otp')
                <p class="mt-2 text-sm text-center" style="color: #dc2626;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full theme-btn py-2.5 px-4">
            Verify Code
        </button>
    </form>

    <p class="mt-6 text-center text-sm theme-text-secondary">
        Didn't receive the code?
        <a href="{{ route('password.request') }}" class="theme-link font-medium">Try again</a>
    </p>
</div>
@endsection

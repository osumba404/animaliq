<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtp;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function showEmailForm(): View
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        $throttleKey = 'otp-send|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors(['email' => "Too many attempts. Please wait {$seconds} seconds."]);
        }

        $user = User::where('email', $request->email)->first();

        // Always show success message to prevent user enumeration
        if ($user) {
            $otp = str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);

            DB::table('password_reset_otps')->where('email', $request->email)->delete();
            DB::table('password_reset_otps')->insert([
                'email'      => $request->email,
                'otp'        => $otp,
                'expires_at' => now()->addMinutes(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Mail::to($request->email)->send(new PasswordResetOtp($otp));
        }

        RateLimiter::hit($throttleKey, 60);

        session(['otp_email' => $request->email]);

        return redirect()->route('password.otp')->with('status', 'If an account with that email exists, a 4-digit code has been sent to your inbox.');
    }

    public function showOtpForm(): View|RedirectResponse
    {
        if (! session('otp_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate(['otp' => ['required', 'string', 'size:4', 'regex:/^\d{4}$/']]);

        $email = session('otp_email');

        if (! $email) {
            return redirect()->route('password.request')->withErrors(['otp' => 'Session expired. Please start again.']);
        }

        $throttleKey = 'otp-verify|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors(['otp' => "Too many attempts. Please wait {$seconds} seconds."]);
        }

        $record = DB::table('password_reset_otps')
            ->where('email', $email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (! $record) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withErrors(['otp' => 'The code is invalid or has expired. Please try again.']);
        }

        RateLimiter::clear($throttleKey);
        session(['otp_verified' => true]);

        return redirect()->route('password.reset-form');
    }

    public function showResetForm(): View|RedirectResponse
    {
        if (! session('otp_email') || ! session('otp_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $email = session('otp_email');

        if (! $email || ! session('otp_verified')) {
            return redirect()->route('password.request')->withErrors(['password' => 'Session expired. Please start over.']);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect()->route('password.request')->withErrors(['password' => 'Account not found.']);
        }

        $user->forceFill(['password' => Hash::make($request->password)])->save();

        DB::table('password_reset_otps')->where('email', $email)->delete();

        session()->forget(['otp_email', 'otp_verified']);

        return redirect()->route('login')->with('status', 'Your password has been reset successfully. You can now log in.');
    }
}

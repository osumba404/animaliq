<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function create(): Response|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->intended(route('community.dashboard'));
        }

        return response()
            ->view('auth.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Handle a login request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = \Illuminate\Support\Str::transliterate(\Illuminate\Support\Str::lower($validated['email']) . '|' . $request->ip());

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => __('Too many login attempts. Please try again in :seconds seconds.', ['seconds' => $seconds]),
            ]);
        }

        $remember = $request->boolean('remember');

        if (! Auth::attempt($validated, $remember)) {
            \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 60);

            throw ValidationException::withMessages([
                'email' => __('These credentials do not match our records.'),
            ]);
        }

        \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);

        $request->session()->regenerate();

        return redirect()->intended(route('community.dashboard'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeNotification;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Response;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create(): Response|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('community.dashboard');
        }

        return response()
            ->view('auth.register')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Handle a registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        Notification::create([
            'user_id' => $user->id,
            'type'    => 'welcome',
            'title'   => 'Welcome to Animal IQ!',
            'body'    => 'Your account has been created. Explore programs, events, and more.',
            'url'     => route('community.dashboard'),
        ]);

        Mail::to($user->email)->send(new WelcomeNotification($user));

        return redirect()->route('community.dashboard')->with('success', 'Welcome! Your account has been created.');
    }
}

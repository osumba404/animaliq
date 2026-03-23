<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\Membership;
use App\Models\VolunteerHour;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CommunityController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $membership = Membership::where('user_id', $user->id)->first();
        $registrations = EventRegistration::where('user_id', $user->id)->with('event')->latest()->take(10)->get();
        $volunteerHours = VolunteerHour::where('user_id', $user->id)->with('event')->get();
        $totalHours = $volunteerHours->sum('hours_logged');
        $registrationsCount = EventRegistration::where('user_id', $user->id)->count();
        $donationsCount = Donation::where('user_id', $user->id)->count();
        $donationsTotal = Donation::where('user_id', $user->id)->sum('amount');

        return view('public.community.dashboard', compact(
            'user', 'membership', 'registrations', 'volunteerHours', 'totalHours',
            'registrationsCount', 'donationsCount', 'donationsTotal'
        ));
    }

    public function profileEdit()
    {
        $user = auth()->user();
        return view('public.community.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|max:2048',
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        unset($validated['current_password']);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $validated['profile_photo'] = $path;
        } else {
            unset($validated['profile_photo']);
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        $user->update($validated);
        return redirect()->route('community.dashboard')->with('success', 'Profile updated.');
    }
}

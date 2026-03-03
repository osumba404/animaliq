<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\Membership;
use App\Models\VolunteerHour;

class CommunityController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $membership = Membership::where('user_id', $user->id)->first();
        $registrations = EventRegistration::where('user_id', $user->id)->with('event')->latest()->take(10)->get();
        $volunteerHours = VolunteerHour::where('user_id', $user->id)->with('event')->get();
        $totalHours = $volunteerHours->sum('hours_logged');

        return view('public.community.dashboard', compact(
            'membership', 'registrations', 'volunteerHours', 'totalHours'
        ));
    }
}

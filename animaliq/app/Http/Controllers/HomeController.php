<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\HomepageSlide;
use App\Models\Program;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HomepageSlide::active()->orderBy('display_order')->get();
        $mission = SiteSetting::getByKey('mission_statement', 'Connecting youth with wildlife and environmental education.');
        $youthReached = (int) SiteSetting::getByKey('impact_youth_reached', 0);
        $membersActive = (int) SiteSetting::getByKey('impact_members_active', 0);
        $eventsHosted = (int) SiteSetting::getByKey('impact_events_hosted', 0);
        $partnershipsFormed = (int) SiteSetting::getByKey('impact_partnerships_formed', 0);
        $programs = Program::active()->with('department')->take(6)->get();
        $upcomingEvent = Event::upcoming()->with('program')->first();

        return view('public.home', compact(
            'slides', 'mission', 'youthReached', 'membersActive',
            'eventsHosted', 'partnershipsFormed', 'programs', 'upcomingEvent'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\HomepageSlide;
use App\Models\Post;
use App\Models\Program;
use App\Models\ResearchProject;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HomepageSlide::active()->orderBy('display_order')->get();
        $mission = SiteSetting::getByKey('mission_statement', 'Connecting youth with wildlife and environmental education.');
        $missionTeaser = SiteSetting::getByKey('homepage_mission_teaser', '');
        $vision = SiteSetting::getByKey('vision_statement', '');
        $youthReached = (int) SiteSetting::getByKey('impact_youth_reached', 0);
        $membersActive = (int) SiteSetting::getByKey('impact_members_active', 0);
        $eventsHosted = (int) SiteSetting::getByKey('impact_events_hosted', 0);
        $partnershipsFormed = (int) SiteSetting::getByKey('impact_partnerships_formed', 0);
        $programs = Program::active()->with('department', 'events')->take(6)->get();
        $upcomingEvent = Event::upcoming()->with('program')->first();
        $upcomingEvents = Event::upcoming()->with('program')->orderBy('start_datetime')->take(3)->get();
        $recentPosts = Post::published()->with('author')->latest('published_at')->take(3)->get();
        $featuredResearch = ResearchProject::with('department')->orderByDesc('start_date')->first();

        return view('public.home', compact(
            'slides', 'mission', 'missionTeaser', 'vision',
            'youthReached', 'membersActive', 'eventsHosted', 'partnershipsFormed',
            'programs', 'upcomingEvent', 'upcomingEvents', 'recentPosts', 'featuredResearch'
        ));
    }
}

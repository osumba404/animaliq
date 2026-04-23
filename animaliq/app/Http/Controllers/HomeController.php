<?php

namespace App\Http\Controllers;

use App\Models\AwarenessDay;
use App\Models\Event;
use App\Models\HomepageSlide;
use App\Models\Post;
use App\Models\Program;
use App\Models\Product;
use App\Models\ResearchProject;
use App\Models\SiteSetting;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HomepageSlide::active()->orderBy('display_order')->get();
        $mission = SiteSetting::getByKey('mission_statement', 'Connecting youth with wildlife and environmental education.');
        $missionTeaser = SiteSetting::getByKey('homepage_mission_teaser', '');
        $vision = SiteSetting::getByKey('vision_statement', '');
        $activePrograms = Program::active()->count();
        $membersActive = User::count();
        $eventsHosted = Event::count();
        $researchConducted = ResearchProject::count();
        $merchandiseCount = Product::count();
        $publishedArticles = Post::published()->count();
        $programs = Program::active()->with('department', 'events')->latest()->take(3)->get();
        $upcomingEvent = Event::upcoming()->with('program')->first();
        $upcomingEvents = Event::upcoming()->with('program')->orderBy('start_datetime')->take(3)->get();
        $recentPosts = Post::published()->with('author')->latest('published_at')->take(3)->get();
        $latestResearch = ResearchProject::with('department')->latest('start_date')->take(3)->get();
        $founderStory = SiteSetting::getByKey('about_founder_story', '');
        $todayAwarenessDay = AwarenessDay::active()->today()->first();

        $seoImage = $slides->first()?->image_path;

        return view('public.home', compact(
            'slides', 'mission', 'missionTeaser', 'vision',
            'activePrograms', 'membersActive', 'eventsHosted', 'researchConducted', 'merchandiseCount', 'publishedArticles',
            'programs', 'upcomingEvent', 'upcomingEvents', 'recentPosts', 'latestResearch', 'founderStory', 'seoImage',
            'todayAwarenessDay'
        ));
    }
}

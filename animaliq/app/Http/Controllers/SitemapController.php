<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use App\Models\Program;
use App\Models\ResearchProject;

class SitemapController extends Controller
{
    public function index()
    {
        $programs  = Program::active()->latest()->get(['id', 'updated_at']);
        $events    = Event::where('status', 'active')->latest('updated_at')->get(['id', 'updated_at']);
        $posts     = Post::published()->latest('published_at')->get(['id', 'slug', 'published_at', 'updated_at']);
        $research  = ResearchProject::latest('updated_at')->get(['id', 'updated_at']);

        return response()->view('sitemap', compact('programs', 'events', 'posts', 'research'))
            ->header('Content-Type', 'application/xml');
    }
}

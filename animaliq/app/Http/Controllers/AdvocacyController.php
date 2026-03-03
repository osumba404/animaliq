<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Post;

class AdvocacyController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderByDesc('start_date')->get();

        return view('public.advocacy.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $posts = Post::published()->where('campaign_id', $campaign->id)->latest('published_at')->paginate(12);

        return view('public.advocacy.show', compact('campaign', 'posts'));
    }
}

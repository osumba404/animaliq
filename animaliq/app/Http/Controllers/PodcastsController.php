<?php

namespace App\Http\Controllers;

use App\Models\Podcast;

class PodcastsController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::active()->orderBy('display_order')->orderByDesc('created_at')->get();
        return view('public.podcasts.index', compact('podcasts'));
    }
}

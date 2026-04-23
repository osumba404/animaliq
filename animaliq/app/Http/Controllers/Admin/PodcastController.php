<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewPodcastNotification;
use App\Models\Notification;
use App\Models\Podcast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::orderBy('display_order')->orderByDesc('created_at')->paginate(20);
        return view('admin.podcasts.index', compact('podcasts'));
    }

    public function create()
    {
        return view('admin.podcasts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'youtube_url'   => 'required|url|max:500',
            'description'   => 'nullable|string',
            'active'        => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);
        $validated['active']        = $request->boolean('active', true);
        $validated['display_order'] = $request->input('display_order', 0);
        $podcast = Podcast::create($validated);

        // Broadcast in-app + email notification to all users
        $url = route('podcasts.index');
        User::whereNotNull('email')->get()->each(function (User $user) use ($podcast, $url) {
            Notification::create([
                'user_id' => $user->id,
                'type'    => 'post',
                'title'   => 'New Podcast: ' . $podcast->title,
                'body'    => $podcast->description ? \Illuminate\Support\Str::limit($podcast->description, 80) : 'A new podcast episode has been published.',
                'url'     => $url,
            ]);
            try {
                Mail::to($user->email)->queue(new NewPodcastNotification($podcast, $user->first_name));
            } catch (\Exception $e) {
                \Log::error('Podcast notification email failed: ' . $e->getMessage());
            }
        });

        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast added.');
    }

    public function edit(Podcast $podcast)
    {
        return view('admin.podcasts.edit', compact('podcast'));
    }

    public function update(Request $request, Podcast $podcast)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'youtube_url'   => 'required|url|max:500',
            'description'   => 'nullable|string',
            'active'        => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);
        $validated['active']        = $request->boolean('active');
        $validated['display_order'] = $request->input('display_order', 0);
        $podcast->update($validated);
        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast updated.');
    }

    public function destroy(Podcast $podcast)
    {
        $podcast->delete();
        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast deleted.');
    }
}

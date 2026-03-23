<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewEventNotification;
use App\Models\Event;
use App\Models\Program;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('program')->withCount('registrations')->orderByDesc('start_datetime')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $programs = Program::active()->orderBy('title')->get();
        return view('admin.events.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'nullable|exists:programs,id',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_datetime' => 'nullable|date',
            'end_datetime' => 'nullable|date|after_or_equal:start_datetime',
            'capacity' => 'nullable|integer|min:0',
            'banner_image' => 'nullable|image|max:2048',
            'status' => 'in:active,archived',
        ]);
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = \App\Services\ImageService::handleUpload($request->file('banner_image'), 'events');
        } else {
            $validated['banner_image'] = null;
        }
        $event = Event::create($validated);
        $event->load('program');
        app(NotificationService::class)->broadcast(
            type:   'event',
            title:  'New Event: ' . $event->title,
            body:   $event->description ? \Illuminate\Support\Str::limit(strip_tags($event->description), 120) : '',
            url:    route('events.show', $event),
            mailer: fn($user) => new NewEventNotification($event, $user->first_name ?: 'there'),
        );
        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function show(Event $event)
    {
        $event->load('program', 'registrations.user', 'proceeding');
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $programs = Program::active()->orderBy('title')->get();
        return view('admin.events.edit', compact('event', 'programs'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'program_id' => 'nullable|exists:programs,id',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_datetime' => 'nullable|date',
            'end_datetime' => 'nullable|date|after_or_equal:start_datetime',
            'capacity' => 'nullable|integer|min:0',
            'banner_image' => 'nullable|image|max:2048',
            'status' => 'in:active,archived',
        ]);
        if ($request->hasFile('banner_image')) {
            if ($event->banner_image) {
                \App\Services\ImageService::delete($event->banner_image);
            }
            $validated['banner_image'] = \App\Services\ImageService::handleUpload($request->file('banner_image'), 'events');
        } else {
            unset($validated['banner_image']);
        }
        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        if ($event->banner_image) {
            \App\Services\ImageService::delete($event->banner_image);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Program;
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
            'status' => 'in:upcoming,completed,cancelled',
        ]);
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('events', 'public');
        } else {
            $validated['banner_image'] = null;
        }
        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function show(Event $event)
    {
        $event->load('program', 'registrations.user');
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
            'status' => 'in:upcoming,completed,cancelled',
        ]);
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('events', 'public');
        } else {
            unset($validated['banner_image']);
        }
        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }
}

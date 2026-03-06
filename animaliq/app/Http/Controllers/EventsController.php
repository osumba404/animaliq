<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $upcoming = Event::upcoming()->with('program')->orderBy('start_datetime')->paginate(9);
        $past = Event::where('status', 'completed')->with('program')->orderByDesc('start_datetime')->take(6)->get();

        return view('public.events.index', compact('upcoming', 'past'));
    }

    public function show(Event $event)
    {
        $event->load('program');
        $event->loadCount('registrations');
        $isRegistered = auth()->check() && $event->registrations()->where('user_id', auth()->id())->whereIn('status', ['registered', 'attended'])->exists();

        return view('public.events.show', compact('event', 'isRegistered'));
    }

    public function register(Request $request, Event $event)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to register for this event.');
        }
        if ($event->status !== 'upcoming') {
            return back()->with('error', 'Registration is not available for this event.');
        }
        if ($event->registrations()->where('user_id', auth()->id())->whereIn('status', ['registered', 'attended'])->exists()) {
            return back()->with('info', 'You are already registered for this event.');
        }
        if ($event->capacity && $event->registrations()->whereIn('status', ['registered', 'attended'])->count() >= $event->capacity) {
            return back()->with('error', 'This event is full.');
        }
        $event->registrations()->create([
            'user_id' => auth()->id(),
            'status' => 'registered',
        ]);
        return back()->with('success', 'You are now registered for this event.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;

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

        return view('public.events.show', compact('event'));
    }
}

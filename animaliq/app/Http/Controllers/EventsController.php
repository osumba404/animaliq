<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::upcoming()->with('program');

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->query('sort', 'soonest');
        if ($sort === 'latest') {
            $query->orderByDesc('start_datetime');
        } else {
            // default: soonest first
            $query->orderBy('start_datetime');
        }

        $upcoming = $query->paginate(9)->withQueryString();
        $past = Event::where('status', 'active')
            ->where(function($q) { $q->where('start_datetime', '<', now())->where(function($q2) { $q2->whereNull('end_datetime')->orWhere('end_datetime', '<', now()); }); })
            ->with('program')->orderByDesc('start_datetime')->take(6)->get();

        return view('public.events.index', compact('upcoming', 'past'));
    }

    public function show(Event $event)
    {
        $event->load('program', 'proceeding.images');
        $event->loadCount('registrations');
        $isRegistered = auth()->check() && $event->registrations()->where('user_id', auth()->id())->whereIn('status', ['registered', 'attended'])->exists();

        return view('public.events.show', compact('event', 'isRegistered'));
    }

    public function register(Request $request, Event $event)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to register for this event.');
        }
        if ($event->status === 'archived') {
            return back()->with('error', 'Registration is not available for this event.');
        }
        if ($event->start_datetime && $event->start_datetime->isPast()) {
            return back()->with('error', 'This event has already passed.');
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

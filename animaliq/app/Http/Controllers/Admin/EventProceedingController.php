<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventProceeding;
use App\Models\EventProceedingImage;
use Illuminate\Http\Request;

class EventProceedingController extends Controller
{
    public function create(Event $event)
    {
        if ($event->proceeding) {
            return redirect()->route('admin.events.proceedings.edit', $event)
                ->with('info', 'This event already has proceedings. Edit instead.');
        }
        return view('admin.events.proceedings.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        if ($event->proceeding) {
            return redirect()->route('admin.events.proceedings.edit', $event);
        }
        $validated = $request->validate([
            'content' => 'nullable|string',
            'learning_points' => 'nullable|string',
            'activities_description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:4096',
            'captions' => 'nullable|string',
        ]);
        $proceeding = $event->proceeding()->create([
            'content' => $validated['content'] ?? null,
            'learning_points' => $validated['learning_points'] ?? null,
            'activities_description' => $validated['activities_description'] ?? null,
            'published_at' => now(),
        ]);
        $this->storeImages($request, $proceeding);
        return redirect()->route('admin.events.show', $event)->with('success', 'Event proceedings saved.');
    }

    public function edit(Event $event)
    {
        $proceeding = $event->proceeding;
        if (!$proceeding) {
            return redirect()->route('admin.events.proceedings.create', $event);
        }
        $proceeding->load('images');
        return view('admin.events.proceedings.edit', compact('event', 'proceeding'));
    }

    public function update(Request $request, Event $event)
    {
        $proceeding = $event->proceeding;
        if (!$proceeding) {
            return redirect()->route('admin.events.proceedings.create', $event);
        }
        $validated = $request->validate([
            'content' => 'nullable|string',
            'learning_points' => 'nullable|string',
            'activities_description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:4096',
            'captions' => 'nullable|string',
        ]);
        $proceeding->update([
            'content' => $validated['content'] ?? null,
            'learning_points' => $validated['learning_points'] ?? null,
            'activities_description' => $validated['activities_description'] ?? null,
        ]);
        $this->storeImages($request, $proceeding);
        return redirect()->route('admin.events.show', $event)->with('success', 'Event proceedings updated.');
    }

    public function destroyImage(Event $event, EventProceedingImage $image)
    {
        if ($image->event_proceeding_id !== $event->proceeding?->id) {
            abort(404);
        }
        $image->delete();
        return back()->with('success', 'Image removed.');
    }

    protected function storeImages(Request $request, EventProceeding $proceeding): void
    {
        if (!$request->hasFile('images')) {
            return;
        }
        $captionLines = $request->filled('captions')
            ? array_map('trim', preg_split('/\r\n|\r|\n/', $request->input('captions')))
            : [];
        $order = (int) $proceeding->images()->max('display_order');
        foreach ($request->file('images') as $i => $file) {
            $path = $file->store('event-proceedings', 'public');
            $proceeding->images()->create([
                'image_path' => $path,
                'caption' => $captionLines[$i] ?? null,
                'display_order' => ++$order,
            ]);
        }
    }
}

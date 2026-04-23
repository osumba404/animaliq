<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwarenessDay;
use Illuminate\Http\Request;

class AwarenessDayController extends Controller
{
    public function index()
    {
        $days = AwarenessDay::orderBy('celebration_date')->paginate(20);
        return view('admin.awareness_days.index', compact('days'));
    }

    public function create()
    {
        return view('admin.awareness_days.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'celebration_date' => 'required|date',
            'body'             => 'nullable|string',
            'image'            => 'nullable|image|max:2048',
            'active'           => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = \App\Services\ImageService::handleUpload($request->file('image'), 'awareness-days');
        }

        $validated['active'] = $request->boolean('active', true);
        AwarenessDay::create($validated);

        return redirect()->route('admin.awareness-days.index')->with('success', 'Awareness day created.');
    }

    public function edit(AwarenessDay $awarenessDay)
    {
        return view('admin.awareness_days.edit', compact('awarenessDay'));
    }

    public function update(Request $request, AwarenessDay $awarenessDay)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'celebration_date' => 'required|date',
            'body'             => 'nullable|string',
            'image'            => 'nullable|image|max:2048',
            'active'           => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($awarenessDay->image) \App\Services\ImageService::delete($awarenessDay->image);
            $validated['image'] = \App\Services\ImageService::handleUpload($request->file('image'), 'awareness-days');
        } else {
            unset($validated['image']);
        }

        $validated['active'] = $request->boolean('active');
        $awarenessDay->update($validated);

        return redirect()->route('admin.awareness-days.index')->with('success', 'Awareness day updated.');
    }

    public function destroy(AwarenessDay $awarenessDay)
    {
        if ($awarenessDay->image) \App\Services\ImageService::delete($awarenessDay->image);
        $awarenessDay->delete();
        return redirect()->route('admin.awareness-days.index')->with('success', 'Awareness day deleted.');
    }
}

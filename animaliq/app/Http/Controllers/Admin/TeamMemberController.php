<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('display_order')->orderBy('name')->paginate(15);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function formCreate()
    {
        return view('admin.team._form', ['member' => null]);
    }

    public function formEdit(TeamMember $team)
    {
        return view('admin.team._form', ['member' => $team]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'image' => 'nullable|image|max:2048',
            'role' => 'required|string|max:150',
            'remarks' => 'nullable|string',
            'role_description' => 'nullable|string',
            'socials' => 'nullable|array',
            'socials.twitter' => 'nullable|string|max:255',
            'socials.instagram' => 'nullable|string|max:255',
            'socials.facebook' => 'nullable|string|max:255',
            'socials.linkedin' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer',
        ]);
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);
        $validated['socials'] = array_filter($validated['socials'] ?? []);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('team', 'public');
        } else {
            $validated['image'] = null;
        }
        TeamMember::create($validated);
        return redirect()->route('admin.team.index')->with('success', 'Team member created.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'image' => 'nullable|image|max:2048',
            'role' => 'required|string|max:150',
            'remarks' => 'nullable|string',
            'role_description' => 'nullable|string',
            'socials' => 'nullable|array',
            'socials.twitter' => 'nullable|string|max:255',
            'socials.instagram' => 'nullable|string|max:255',
            'socials.facebook' => 'nullable|string|max:255',
            'socials.linkedin' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer',
        ]);
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);
        $validated['socials'] = array_filter($validated['socials'] ?? []);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('team', 'public');
        } else {
            unset($validated['image']);
        }
        $team->update($validated);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewProgramNotification;
use App\Models\Department;
use App\Models\Program;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('department')->withCount('events')->orderBy('title')->paginate(15);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.programs.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'department_id' => 'nullable|exists:departments,id',
            'status' => 'in:active,archived',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('programs', 'public');
        } else {
            $validated['image'] = null;
        }
        $program = Program::create($validated);
        $program->load('department');
        app(NotificationService::class)->broadcast(
            type:   'program',
            title:  'New Program: ' . $program->title,
            body:   $program->description ? \Illuminate\Support\Str::limit(strip_tags($program->description), 120) : '',
            url:    route('programs.show', $program),
            mailer: fn($user) => new NewProgramNotification($program, $user->first_name ?: 'there'),
        );
        return redirect()->route('admin.programs.index')->with('success', 'Program created.');
    }

    public function edit(Program $program)
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.programs.edit', compact('program', 'departments'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'department_id' => 'nullable|exists:departments,id',
            'status' => 'in:active,archived',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('programs', 'public');
        } else {
            unset($validated['image']);
        }
        $program->update($validated);
        return redirect()->route('admin.programs.index')->with('success', 'Program updated.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted.');
    }
}

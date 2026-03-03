<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Program;
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
            'department_id' => 'nullable|exists:departments,id',
            'status' => 'in:active,archived',
        ]);
        Program::create($validated);
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
            'department_id' => 'nullable|exists:departments,id',
            'status' => 'in:active,archived',
        ]);
        $program->update($validated);
        return redirect()->route('admin.programs.index')->with('success', 'Program updated.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted.');
    }
}

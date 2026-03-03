<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\ResearchProject;
use Illuminate\Http\Request;

class ResearchProjectController extends Controller
{
    public function index()
    {
        $projects = ResearchProject::with('department')->withCount('reports')->orderByDesc('start_date')->paginate(15);
        return view('admin.research.index', compact('projects'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.research.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'in:ongoing,completed',
        ]);
        ResearchProject::create($validated);
        return redirect()->route('admin.research.index')->with('success', 'Research project created.');
    }

    public function edit(ResearchProject $researchProject)
    {
        $departments = Department::orderBy('name')->get();
        $researchProject->load('reports');
        return view('admin.research.edit', compact('researchProject', 'departments'));
    }

    public function update(Request $request, ResearchProject $researchProject)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'in:ongoing,completed',
        ]);
        $researchProject->update($validated);
        return redirect()->route('admin.research.index')->with('success', 'Research project updated.');
    }

    public function destroy(ResearchProject $researchProject)
    {
        $researchProject->delete();
        return redirect()->route('admin.research.index')->with('success', 'Research project deleted.');
    }
}

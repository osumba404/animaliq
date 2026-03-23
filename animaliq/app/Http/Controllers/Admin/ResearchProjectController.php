<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewResearchNotification;
use App\Models\Department;
use App\Models\ResearchProject;
use App\Services\NotificationService;
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
            'banner_image' => 'nullable|image|max:2048',
            'department_id' => 'nullable|exists:departments,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'in:ongoing,completed',
        ]);
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = \App\Services\ImageService::handleUpload($request->file('banner_image'), 'research');
        } else {
            $validated['banner_image'] = null;
        }
        $project = ResearchProject::create($validated);
        $project->load('department');
        app(NotificationService::class)->broadcast(
            type:   'research',
            title:  'New Research: ' . $project->title,
            body:   $project->summary ? \Illuminate\Support\Str::limit(strip_tags($project->summary), 120) : '',
            url:    route('research.show', $project),
            mailer: fn($user) => new NewResearchNotification($project, $user->first_name ?: 'there'),
        );
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
            'banner_image' => 'nullable|image|max:2048',
            'department_id' => 'nullable|exists:departments,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'in:ongoing,completed',
        ]);
        if ($request->hasFile('banner_image')) {
            if ($researchProject->banner_image) {
                \App\Services\ImageService::delete($researchProject->banner_image);
            }
            $validated['banner_image'] = \App\Services\ImageService::handleUpload($request->file('banner_image'), 'research');
        } else {
            unset($validated['banner_image']);
        }
        $researchProject->update($validated);
        return redirect()->route('admin.research.index')->with('success', 'Research project updated.');
    }

    public function destroy(ResearchProject $researchProject)
    {
        if ($researchProject->banner_image) {
            \App\Services\ImageService::delete($researchProject->banner_image);
        }
        $researchProject->delete();
        return redirect()->route('admin.research.index')->with('success', 'Research project deleted.');
    }
}

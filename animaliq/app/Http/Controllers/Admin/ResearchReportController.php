<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchProject;
use App\Models\ResearchReport;
use Illuminate\Http\Request;

class ResearchReportController extends Controller
{
    public function create(ResearchProject $researchProject)
    {
        return view('admin.research.reports.create', compact('researchProject'));
    }

    public function store(Request $request, ResearchProject $researchProject)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'file'         => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'published_at' => 'nullable|date',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('research/reports', 'public');
        }

        $researchProject->reports()->create([
            'title'        => $validated['title'],
            'file_path'    => $filePath,
            'published_at' => $validated['published_at'] ?? null,
        ]);

        return redirect()->route('admin.research.edit', $researchProject)->with('success', 'Report added.');
    }

    public function edit(ResearchProject $researchProject, ResearchReport $report)
    {
        abort_if($report->project_id !== $researchProject->id, 404);
        return view('admin.research.reports.edit', compact('researchProject', 'report'));
    }

    public function update(Request $request, ResearchProject $researchProject, ResearchReport $report)
    {
        abort_if($report->project_id !== $researchProject->id, 404);

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'file'         => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('research/reports', 'public');
        }
        unset($validated['file']);

        $report->update($validated);

        return redirect()->route('admin.research.edit', $researchProject)->with('success', 'Report updated.');
    }

    public function destroy(ResearchProject $researchProject, ResearchReport $report)
    {
        abort_if($report->project_id !== $researchProject->id, 404);
        $report->delete();
        return back()->with('success', 'Report deleted.');
    }
}

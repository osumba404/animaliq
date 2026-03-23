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
            $filePath = \App\Services\ImageService::handleUpload($request->file('file'), 'research/reports');
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
            if ($report->file_path) {
                \App\Services\ImageService::delete($report->file_path);
            }
            $validated['file_path'] = \App\Services\ImageService::handleUpload($request->file('file'), 'research/reports');
        }
        unset($validated['file']);

        $report->update($validated);

        return redirect()->route('admin.research.edit', $researchProject)->with('success', 'Report updated.');
    }

    public function destroy(ResearchProject $researchProject, ResearchReport $report)
    {
        abort_if($report->project_id !== $researchProject->id, 404);
        if ($report->file_path) {
            \App\Services\ImageService::delete($report->file_path);
        }
        $report->delete();
        return back()->with('success', 'Report deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramsController extends Controller
{
    public function index()
    {
        $programs = Program::active()->with('department', 'events')->orderBy('title')->get();

        return view('public.programs.index', compact('programs'));
    }

    public function show(Program $program)
    {
        if ($program->status !== 'active') {
            abort(404);
        }
        $program->load(['department', 'events' => fn ($q) => $q->whereIn('status', ['upcoming', 'completed'])->orderBy('start_datetime')]);

        return view('public.programs.show', compact('program'));
    }
}

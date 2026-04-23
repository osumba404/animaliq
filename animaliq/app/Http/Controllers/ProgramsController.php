<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::active()
            ->with('department', 'events')
            ->withCount('events');

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->query('sort', 'title');
        if ($sort === 'newest') {
            $query->latest();
        } elseif ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->orderBy('title');
        }

        $programs = $query->paginate(9)->withQueryString();

        return view('public.programs.index', compact('programs'));
    }

    public function show(Program $program)
    {
        if ($program->status !== 'active') {
            abort(404);
        }
        $program->load(['department', 'events' => fn ($q) => $q->orderBy('start_datetime')]);

        return view('public.programs.show', compact('program'));
    }
}

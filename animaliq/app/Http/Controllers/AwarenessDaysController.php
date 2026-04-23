<?php

namespace App\Http\Controllers;

use App\Models\AwarenessDay;

class AwarenessDaysController extends Controller
{
    public function index()
    {
        $upcomingDays = AwarenessDay::active()->upcoming()->get();
        $allDays = AwarenessDay::active()->orderBy('celebration_date')->get();
        $todayDay = AwarenessDay::active()->today()->first();

        return view('public.awareness_days.index', compact('upcomingDays', 'allDays', 'todayDay'));
    }
}

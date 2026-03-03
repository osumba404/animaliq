<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Membership;
use App\Models\Program;

class DashboardController extends Controller
{
    public function index()
    {
        $membersCount = Membership::active()->count();
        $eventsCount = Event::where('status', 'upcoming')->count();
        $registrationsCount = EventRegistration::where('status', 'registered')->count();
        $donationsTotal = Donation::sum('amount');
        $programsActive = Program::active()->count();

        return view('admin.dashboard', compact(
            'membersCount', 'eventsCount', 'registrationsCount', 'donationsTotal', 'programsActive'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Membership;
use App\Models\Post;
use App\Models\Program;
use App\Models\ResearchProject;
use App\Models\User;
use App\Models\VolunteerHour;

class DashboardController extends Controller
{
    public function index()
    {
        $membersCount = Membership::active()->count();
        $eventsCount = Event::where('status', 'upcoming')->where('start_datetime', '>', now())->count();
        $registrationsCount = EventRegistration::where('status', 'registered')->count();
        $donationsTotal = Donation::sum('amount');
        $programsActive = Program::active()->count();

        // Extra stats for premium dashboard
        $totalUsers = User::count();
        $researchProjectsCount = ResearchProject::count();
        $postsCount = Post::count();
        $postsPublished = Post::where('status', 'published')->count();
        $volunteerHoursTotal = VolunteerHour::sum('hours_logged');
        $donationsThisMonth = Donation::whereMonth('donated_at', now()->month)
            ->whereYear('donated_at', now()->year)
            ->sum('amount');
        $donationsCount = Donation::count();

        // Last 6 months donations for chart (label + total per month)
        $donationsByMonth = Donation::query()
            ->selectRaw('YEAR(donated_at) as year, MONTH(donated_at) as month, COALESCE(SUM(amount), 0) as total')
            ->where('donated_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(fn ($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));

        $last6MonthsLabels = [];
        $last6MonthsData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $key = $date->format('Y-m');
            $last6MonthsLabels[] = $date->format('M Y');
            $last6MonthsData[] = (float) ($donationsByMonth->get($key)?->total ?? 0);
        }

        // Events by status for chart
        $eventsByStatus = Event::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->all();

        // Recent activity
        $recentDonations = Donation::with('campaign', 'user')
            ->latest('donated_at')
            ->take(5)
            ->get();
        $recentRegistrations = EventRegistration::with('event', 'user')
            ->where('status', 'registered')
            ->latest()
            ->take(5)
            ->get();
        $upcomingEvents = Event::with('program')
            ->where('status', 'upcoming')
            ->where('start_datetime', '>', now())
            ->orderBy('start_datetime')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'membersCount',
            'eventsCount',
            'registrationsCount',
            'donationsTotal',
            'programsActive',
            'totalUsers',
            'researchProjectsCount',
            'postsCount',
            'postsPublished',
            'volunteerHoursTotal',
            'donationsThisMonth',
            'donationsCount',
            'last6MonthsLabels',
            'last6MonthsData',
            'eventsByStatus',
            'recentDonations',
            'recentRegistrations',
            'upcomingEvents'
        ));
    }
}

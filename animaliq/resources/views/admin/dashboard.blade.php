@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    {{-- Welcome --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold theme-text-primary">Welcome back{{ auth()->user()->first_name ? ', ' . auth()->user()->first_name : '' }}</h1>
        <p class="text-sm theme-text-secondary mt-1">Here’s what’s happening across your platform.</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-8">
        <div class="theme-card p-5 rounded-xl border-l-4 border-l-[var(--accent-orange)] transition hover:shadow-lg">
            <p class="text-3xl font-bold theme-accent tabular-nums">{{ number_format($membersCount) }}</p>
            <p class="text-sm theme-text-secondary mt-1">Active Members</p>
        </div>
        <div class="theme-card p-5 rounded-xl border-l-4 border-l-[var(--orange-400)] transition hover:shadow-lg">
            <p class="text-3xl font-bold theme-accent tabular-nums">{{ $eventsCount }}</p>
            <p class="text-sm theme-text-secondary mt-1">Upcoming Events</p>
        </div>
        <div class="theme-card p-5 rounded-xl border-l-4 border-l-[var(--orange-500)] transition hover:shadow-lg">
            <p class="text-3xl font-bold theme-accent tabular-nums">{{ number_format($registrationsCount) }}</p>
            <p class="text-sm theme-text-secondary mt-1">Event Registrations</p>
        </div>
        <div class="theme-card p-5 rounded-xl border-l-4 border-l-[var(--orange-600)] transition hover:shadow-lg">
            <p class="text-3xl font-bold theme-accent tabular-nums">{{ number_format($donationsTotal ?? 0, 0) }}</p>
            <p class="text-sm theme-text-secondary mt-1">Total Donations</p>
            @if(isset($donationsThisMonth) && $donationsThisMonth > 0)
                <p class="text-xs theme-text-secondary mt-0.5">+{{ number_format($donationsThisMonth, 0) }} this month</p>
            @endif
        </div>
        <div class="theme-card p-5 rounded-xl border-l-4 border-l-[var(--orange-700)] transition hover:shadow-lg">
            <p class="text-3xl font-bold theme-accent tabular-nums">{{ $programsActive }}</p>
            <p class="text-sm theme-text-secondary mt-1">Active Programs</p>
        </div>
    </div>

    {{-- Secondary stats row --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8">
        <div class="theme-card p-4 rounded-lg">
            <p class="text-xl font-semibold theme-text-primary tabular-nums">{{ $totalUsers ?? 0 }}</p>
            <p class="text-xs theme-text-secondary">Users</p>
        </div>
        <div class="theme-card p-4 rounded-lg">
            <p class="text-xl font-semibold theme-text-primary tabular-nums">{{ $researchProjectsCount ?? 0 }}</p>
            <p class="text-xs theme-text-secondary">Research Projects</p>
        </div>
        <div class="theme-card p-4 rounded-lg">
            <p class="text-xl font-semibold theme-text-primary tabular-nums">{{ $postsPublished ?? 0 }}/{{ $postsCount ?? 0 }}</p>
            <p class="text-xs theme-text-secondary">Posts (published)</p>
        </div>
        <div class="theme-card p-4 rounded-lg">
            <p class="text-xl font-semibold theme-text-primary tabular-nums">{{ number_format($volunteerHoursTotal ?? 0, 1) }}</p>
            <p class="text-xs theme-text-secondary">Volunteer hrs</p>
        </div>
    </div>

    {{-- Charts row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="theme-card rounded-xl p-5">
            <h2 class="text-lg font-semibold theme-text-primary mb-4">Donations (last 6 months)</h2>
            <div class="h-64 relative">
                <canvas id="chart-donations" width="400" height="256"></canvas>
            </div>
        </div>
        <div class="theme-card rounded-xl p-5">
            <h2 class="text-lg font-semibold theme-text-primary mb-4">Events by status</h2>
            <div class="h-64 relative flex items-center justify-center">
                <canvas id="chart-events" width="280" height="256"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent activity + Upcoming events --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="theme-card rounded-xl p-5">
            <h2 class="text-lg font-semibold theme-text-primary mb-4">Recent donations</h2>
            @if(isset($recentDonations) && $recentDonations->isNotEmpty())
                <ul class="space-y-3">
                    @foreach($recentDonations as $d)
                        <li class="flex justify-between items-start text-sm border-b theme-border pb-3 last:border-0 last:pb-0">
                            <span class="theme-text-primary">{{ number_format($d->amount ?? 0, 0) }} — {{ $d->campaign?->title ?? 'Campaign' }}</span>
                            <span class="theme-text-secondary shrink-0 ml-2">{{ $d->donated_at?->diffForHumans() ?? '—' }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm theme-text-secondary">No recent donations.</p>
            @endif
        </div>
        <div class="theme-card rounded-xl p-5">
            <h2 class="text-lg font-semibold theme-text-primary mb-4">Upcoming events</h2>
            @if(isset($upcomingEvents) && $upcomingEvents->isNotEmpty())
                <ul class="space-y-3">
                    @foreach($upcomingEvents as $e)
                        <li class="flex justify-between items-start text-sm border-b theme-border pb-3 last:border-0 last:pb-0">
                            <a href="{{ route('admin.events.show', $e) }}" class="theme-link font-medium">{{ $e->title }}</a>
                            <span class="theme-text-secondary shrink-0 ml-2">{{ $e->start_datetime?->format('M j, Y') ?? '—' }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm theme-text-secondary">No upcoming events.</p>
            @endif
        </div>
    </div>

    {{-- Recent registrations --}}
    <div class="theme-card rounded-xl p-5 mb-8">
        <h2 class="text-lg font-semibold theme-text-primary mb-4">Recent event registrations</h2>
        @if(isset($recentRegistrations) && $recentRegistrations->isNotEmpty())
            <ul class="space-y-3">
                @foreach($recentRegistrations as $r)
                    <li class="flex justify-between items-center text-sm border-b theme-border pb-3 last:border-0 last:pb-0">
                        <span class="theme-text-primary">{{ $r->user?->first_name }} {{ $r->user?->last_name }} → {{ $r->event?->title ?? 'Event' }}</span>
                        <span class="theme-text-secondary">{{ $r->created_at?->diffForHumans() ?? '—' }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm theme-text-secondary">No recent registrations.</p>
        @endif
    </div>

    {{-- Quick links --}}
    <div class="mb-4">
        <h2 class="text-lg font-semibold theme-text-primary mb-3">Quick links</h2>
    </div>
    <nav class="flex flex-wrap gap-3">
        @php $sections = $adminAllowedSections ?? []; @endphp
        @if(in_array('departments', $sections))<a href="{{ route('admin.departments.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Departments</a>@endif
        @if(in_array('programs', $sections))<a href="{{ route('admin.programs.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Programs</a>@endif
        @if(in_array('events', $sections))<a href="{{ route('admin.events.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Events</a>@endif
        @if(in_array('users', $sections))<a href="{{ route('admin.users.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Users</a>@endif
        @if(in_array('settings', $sections))<a href="{{ route('admin.settings.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Settings</a>@endif
        @if(in_array('research', $sections))<a href="{{ route('admin.research.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Research</a>@endif
        @if(in_array('campaigns', $sections))<a href="{{ route('admin.campaigns.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Campaigns</a>@endif
        @if(in_array('posts', $sections))<a href="{{ route('admin.posts.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Posts</a>@endif
        @if(in_array('donations', $sections))<a href="{{ route('admin.donations.campaigns') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Donations</a>@endif
        @if(in_array('products', $sections))<a href="{{ route('admin.products.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Products</a>@endif
        @if(in_array('team', $sections))<a href="{{ route('admin.team.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Team</a>@endif
        @if(in_array('audit', $sections))<a href="{{ route('admin.audit.index') }}" class="theme-card px-4 py-3 rounded-lg hover:shadow-md hover:border-[var(--accent-orange)] transition-all inline-flex items-center gap-2">Audit Log</a>@endif
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
    (function() {
        var accent = getComputedStyle(document.documentElement).getPropertyValue('--accent-orange').trim() || '#FF7518';
        var orangeShades = [
            getComputedStyle(document.documentElement).getPropertyValue('--orange-200').trim() || '#FFB347',
            getComputedStyle(document.documentElement).getPropertyValue('--orange-400').trim() || '#F28500',
            getComputedStyle(document.documentElement).getPropertyValue('--orange-500').trim() || '#FF7518',
            getComputedStyle(document.documentElement).getPropertyValue('--orange-600').trim() || '#CC5500',
            getComputedStyle(document.documentElement).getPropertyValue('--orange-700').trim() || '#B7410E'
        ];
        var borderColor = getComputedStyle(document.documentElement).getPropertyValue('--border-color').trim() || '#ccc';
        var textSecondary = getComputedStyle(document.documentElement).getPropertyValue('--text-secondary').trim() || '#666';

        var labelsDonations = @json($last6MonthsLabels ?? []);
        var dataDonations = @json($last6MonthsData ?? []);

        if (document.getElementById('chart-donations') && typeof Chart !== 'undefined') {
            new Chart(document.getElementById('chart-donations'), {
                type: 'line',
                data: {
                    labels: labelsDonations,
                    datasets: [{
                        label: 'Donations',
                        data: dataDonations,
                        borderColor: accent,
                        backgroundColor: accent + '20',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: borderColor }, ticks: { color: textSecondary } },
                        x: { grid: { display: false }, ticks: { color: textSecondary } }
                    }
                }
            });
        }

        var eventsByStatus = @json($eventsByStatus ?? []);
        var eventLabels = Object.keys(eventsByStatus).map(function(s) { return s.charAt(0).toUpperCase() + s.slice(1); });
        var eventData = Object.values(eventsByStatus);

        if (document.getElementById('chart-events') && typeof Chart !== 'undefined' && eventData.length) {
            new Chart(document.getElementById('chart-events'), {
                type: 'doughnut',
                data: {
                    labels: eventLabels,
                    datasets: [{
                        data: eventData,
                        backgroundColor: orangeShades.slice(0, eventLabels.length),
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { color: textSecondary, padding: 12 } }
                    }
                }
            });
        }
    })();
    </script>
@endsection

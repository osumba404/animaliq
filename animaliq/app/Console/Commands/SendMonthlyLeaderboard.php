<?php

namespace App\Console\Commands;

use App\Mail\MonthlyLeaderboardMail;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMonthlyLeaderboard extends Command
{
    protected $signature   = 'animaliq:monthly-leaderboard';
    protected $description = 'Send monthly leaderboard results to all users';

    public function handle(): int
    {
        $lastMonth = now()->subMonth();
        $start     = $lastMonth->copy()->startOfMonth();
        $end       = $lastMonth->copy()->endOfMonth();

        $rows = UserPoint::query()
            ->whereBetween('occurred_at', [$start, $end])
            ->selectRaw('user_id, SUM(points) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->get();

        if ($rows->isEmpty()) {
            $this->info('No activity last month.');
            return 0;
        }

        $top = $rows->take(10)->map(fn($r, $i) => [
            'rank'  => $i + 1,
            'name'  => $r->user->first_name . ' ' . $r->user->last_name,
            'points'=> $r->total,
        ])->values()->all();

        $winner = $rows->first();

        User::whereNotNull('email')->get()->each(function (User $user) use ($top, $winner, $lastMonth) {
            try {
                Mail::to($user->email)->send(new MonthlyLeaderboardMail($user, $top, $winner->user, $winner->total, $lastMonth->format('F Y')));
            } catch (\Exception $e) {
                \Log::error('Monthly leaderboard email failed for ' . $user->email . ': ' . $e->getMessage());
            }
        });

        $this->info('Monthly leaderboard sent to ' . User::whereNotNull('email')->count() . ' users.');
        return 0;
    }
}

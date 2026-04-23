<?php

namespace App\Console\Commands;

use App\Mail\AwarenessDayNotification;
use App\Models\AwarenessDay;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAwarenessDayEmails extends Command
{
    protected $signature   = 'animaliq:awareness-day-emails';
    protected $description = 'Send awareness day emails to all users for today\'s celebrations';

    public function handle(): int
    {
        $todayDays = AwarenessDay::active()->today()->get();

        if ($todayDays->isEmpty()) {
            $this->info('No awareness days for today.');
            return 0;
        }

        $users = User::whereNotNull('email')->get();

        foreach ($todayDays as $day) {
            $this->info("Sending emails for: {$day->title}");

            foreach ($users as $user) {
                // In-app notification
                Notification::create([
                    'user_id' => $user->id,
                    'type'    => 'awareness_day',
                    'title'   => '🌍 Today is ' . $day->title . '!',
                    'body'    => $day->body ? \Illuminate\Support\Str::limit(strip_tags($day->body), 100) : '',
                    'url'     => route('awareness-days.index'),
                ]);

                // Email
                Mail::to($user->email)->queue(
                    new AwarenessDayNotification($day, $user->first_name ?: 'there')
                );
            }

            $this->info("Notifications sent for {$day->title} to {$users->count()} users.");
        }

        return 0;
    }
}

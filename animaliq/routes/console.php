<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Send awareness day emails every day at 8:00 AM
Schedule::command('animaliq:awareness-day-emails')->dailyAt('08:00');

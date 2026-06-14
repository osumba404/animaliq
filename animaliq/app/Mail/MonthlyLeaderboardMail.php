<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonthlyLeaderboardMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public User   $recipient,
        public array  $topUsers,
        public User   $winner,
        public int    $winnerPoints,
        public string $monthLabel,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Animal IQ ' . $this->monthLabel . ' Leaderboard Results');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.monthly_leaderboard');
    }
}

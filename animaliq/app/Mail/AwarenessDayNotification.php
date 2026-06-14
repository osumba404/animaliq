<?php

namespace App\Mail;

use App\Models\AwarenessDay;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AwarenessDayNotification extends Mailable
{
    use SerializesModels;

    public function __construct(
        public AwarenessDay $day,
        public string $firstName = 'there'
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Today is ' . $this->day->title . '!');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.awareness_day');
    }
}

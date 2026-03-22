<?php

namespace App\Mail;

use App\Models\ResearchProject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewResearchNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public ResearchProject $research,
        public string $recipientName
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New Research: ' . $this->research->title);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_research',
            with: ['research' => $this->research, 'recipientName' => $this->recipientName],
        );
    }
}

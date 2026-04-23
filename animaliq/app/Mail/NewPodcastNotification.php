<?php

namespace App\Mail;

use App\Models\Podcast;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPodcastNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Podcast $podcast,
        public string $recipientName
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New Podcast: ' . $this->podcast->title);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_podcast',
            with: ['podcast' => $this->podcast, 'recipientName' => $this->recipientName],
        );
    }
}

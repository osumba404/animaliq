<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewEventNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Event $event,
        public string $recipientName
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New Event: ' . $this->event->title);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_event',
            with: ['event' => $this->event, 'recipientName' => $this->recipientName],
        );
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LikeNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $recipientName,
        public string $likerName,
        public string $contentTitle,
        public string $url,
        public string $context  // e.g. "forum post", "article", "comment"
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->likerName . ' liked your ' . $this->context . ' on Animal IQ');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.like_notification',
            with: [
                'recipientName' => $this->recipientName,
                'likerName'     => $this->likerName,
                'contentTitle'  => $this->contentTitle,
                'url'           => $this->url,
                'context'       => $this->context,
            ],
        );
    }
}

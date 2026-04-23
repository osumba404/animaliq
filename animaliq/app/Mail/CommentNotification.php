<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommentNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $recipientName,
        public string $commenterName,
        public string $contentTitle,
        public string $commentBody,
        public string $url,
        public string $context  // e.g. "article", "forum post", "comment"
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->commenterName . ' ' . $this->actionLabel() . ' on Animal IQ');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.comment_notification',
            with: [
                'recipientName' => $this->recipientName,
                'commenterName' => $this->commenterName,
                'contentTitle'  => $this->contentTitle,
                'commentBody'   => $this->commentBody,
                'url'           => $this->url,
                'context'       => $this->context,
                'actionLabel'   => $this->actionLabel(),
            ],
        );
    }

    private function actionLabel(): string
    {
        return match($this->context) {
            'reply' => 'replied to your comment',
            default => 'commented on your ' . $this->context,
        };
    }
}

<?php

namespace App\Mail;

use App\Models\ForumPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewForumPostNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public ForumPost $post,
        public string $recipientName,
        public string $posterName
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->posterName . ' started a new forum discussion');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_forum_post',
            with: [
                'post'          => $this->post,
                'recipientName' => $this->recipientName,
                'posterName'    => $this->posterName,
            ],
        );
    }
}

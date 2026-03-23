<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeNotification extends Mailable
{
    use SerializesModels;

    public function __construct(public User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Welcome to Animal IQ!');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
            with: ['user' => $this->user],
        );
    }
}

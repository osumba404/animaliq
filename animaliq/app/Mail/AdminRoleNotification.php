<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminRoleNotification extends Mailable
{
    use SerializesModels;

    public function __construct(public User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Your Animal IQ Admin Access');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_role',
            with: ['user' => $this->user],
        );
    }
}

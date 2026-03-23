<?php

namespace App\Mail;

use App\Models\Department;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DepartmentAddedNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public Department $department,
        public ?string $positionTitle = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'You\'ve been added to a department – Animal IQ');
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.department_added',
            with: [
                'user'          => $this->user,
                'department'    => $this->department,
                'positionTitle' => $this->positionTitle,
            ],
        );
    }
}

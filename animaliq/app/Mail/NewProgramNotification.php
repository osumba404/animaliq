<?php

namespace App\Mail;

use App\Models\Program;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewProgramNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Program $program,
        public string $recipientName
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New Program: ' . $this->program->title);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_program',
            with: ['program' => $this->program, 'recipientName' => $this->recipientName],
        );
    }
}

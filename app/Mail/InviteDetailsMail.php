<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InviteDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $project;
    public $inviter;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $project, $inviter, $url)
    {
        $this->user = $user;
        $this->project = $project;
        $this->inviter = $inviter;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build() {
        return $this->markdown('emails.invite_details')->subject(config('app.name'). ', Invite Details');
    }
}

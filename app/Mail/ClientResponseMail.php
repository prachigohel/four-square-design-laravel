<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\DesignRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public DesignRequest $designRequest,
        public Comment $comment
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Client Responded to Approval Request – #CAB-2026-' . $this->designRequest->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.client-response',
        );
    }
}

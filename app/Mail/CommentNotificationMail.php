<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\DesignRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public DesignRequest $designRequest,
        public Comment $comment,
        public string $recipientName
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Comment on Request #CAB-2026-' . $this->designRequest->id . ' – ' . $this->designRequest->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.comment-notification',
        );
    }
}

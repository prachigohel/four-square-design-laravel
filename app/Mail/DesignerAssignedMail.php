<?php

namespace App\Mail;

use App\Models\DesignRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DesignerAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public DesignRequest $designRequest,
        public User $designer
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Request Assigned to You – #CAB-2026-' . $this->designRequest->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.designer-assigned',
        );
    }
}

<?php

namespace App\Mail;

use App\Models\DesignRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DesignErrorMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public DesignRequest $designRequest) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Design Error – #CAB-2026-' . $this->designRequest->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.design-error',
        );
    }
}

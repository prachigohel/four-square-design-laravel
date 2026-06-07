<?php

namespace App\Mail;

use App\Models\DesignRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NeedsInfoManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public DesignRequest $designRequest) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Information Requested from Client – #CAB-2026-' . $this->designRequest->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.needs-info-manager',
        );
    }
}

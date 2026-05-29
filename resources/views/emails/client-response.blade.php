@extends('emails.layout')

@section('email-body')
<p class="greeting">Hi {{ $designRequest->designer->name ?? 'Designer' }},</p>
<p class="message">
    The client has responded to the approval request for the design you submitted. Please review their feedback and take the appropriate action.
</p>

<div class="info-box">
    <div class="info-row">
        <span class="info-label">Request #</span>
        <span class="info-value">CAB-2026-{{ $designRequest->id }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Project Title</span>
        <span class="info-value">{{ $designRequest->title }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Client</span>
        <span class="info-value">{{ $designRequest->client->name ?? 'N/A' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Responded At</span>
        <span class="info-value">{{ $comment->created_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<div style="background: #fff9f0; border-left: 4px solid #fab133; border-radius: 8px; padding: 20px 24px; margin-bottom: 28px;">
    <p style="font-weight: 700; color: #020617; margin-bottom: 10px; font-size: 0.9rem;">CLIENT'S MESSAGE</p>
    <p style="font-size: 0.95rem; color: #334155; line-height: 1.7; margin: 0;">{{ $comment->message }}</p>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View Full Conversation</a>

<hr class="divider">
<p class="message" style="margin-bottom: 0; font-size: 0.85rem; color: #94a3b8;">
    Please log in to the portal to view the full conversation and respond to the client's feedback.
</p>
@endsection

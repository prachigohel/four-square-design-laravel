@extends('emails.layout')

@section('email-body')
<p class="greeting">New Comment Added</p>
<p class="message">
    Hi {{ $recipientName }}, a new comment has been added to your project request. Please review it and respond if needed.
</p>

<div class="info-box">
    <div class="info-row">
        <span class="info-label">Request #</span>
        <span class="info-value">{{ $designRequest->request_number }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Project Title</span>
        <span class="info-value">{{ $designRequest->title }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Comment By</span>
        <span class="info-value">{{ $comment->user->name ?? 'Unknown' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Message</span>
        <span class="info-value">{{ $comment->message ?? '(attachment only)' }}</span>
    </div>
    @if(!empty($comment->attachments))
    <div class="info-row">
        <span class="info-label">Attachments</span>
        <span class="info-value">{{ count($comment->attachments) }} file(s) attached</span>
    </div>
    @endif
    <div class="info-row">
        <span class="info-label">Date</span>
        <span class="info-value">{{ $comment->created_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View Request</a>

<hr class="divider">
<p class="message" style="margin-bottom: 0; font-size: 0.85rem; color: #94a3b8;">
    You are receiving this because you are involved in this project on the Four Square Designs Portal.
</p>
@endsection

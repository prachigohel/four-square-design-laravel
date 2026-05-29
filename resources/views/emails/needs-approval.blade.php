@extends('emails.layout')

@section('email-body')
<p class="greeting">Hi {{ $designRequest->client->name ?? 'Valued Client' }},</p>
<p class="message">
    Your design request is ready for your review and approval. Our designer has completed the work and is waiting for your feedback. Please log in to the portal to review the design and either approve it or request any revisions.
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
        <span class="info-label">Project Type</span>
        <span class="info-value">{{ $designRequest->project_type ?? 'N/A' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Designer</span>
        <span class="info-value">{{ $designRequest->designer->name ?? 'N/A' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Ready Since</span>
        <span class="info-value">{{ $designRequest->updated_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<p class="message">
    To approve the design or leave feedback, simply click the button below and post a comment in the request thread.
</p>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">Review & Approve Design</a>

<hr class="divider">
<p class="message" style="margin-bottom: 0; font-size: 0.85rem; color: #94a3b8;">
    If you have questions, please reply to this email or post a comment directly in the portal. Our team will get back to you shortly.
</p>
@endsection

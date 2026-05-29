@extends('emails.layout')

@section('email-body')
<p class="greeting">Request Closed</p>
<p class="message">
    A design request has been marked as <strong>Closed</strong> by the assigned designer.
</p>

<div class="info-box">
    <div class="info-row">
        <span class="info-label">Request #</span>
        <span class="info-value">CAB-2026-{{ $designRequest->id }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Title</span>
        <span class="info-value">{{ $designRequest->title }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Client</span>
        <span class="info-value">{{ $designRequest->client->name ?? ($designRequest->full_name ?? 'N/A') }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Designer</span>
        <span class="info-value">{{ $designRequest->designer->name ?? 'N/A' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Project Type</span>
        <span class="info-value">{{ $designRequest->project_type ?? 'N/A' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Closed At</span>
        <span class="info-value">{{ $designRequest->updated_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View Request</a>

<hr class="divider">
<p class="message" style="margin-bottom: 0; font-size: 0.85rem; color: #94a3b8;">
    This request has been completed. Please log in to the portal to review the final deliverables.
</p>
@endsection

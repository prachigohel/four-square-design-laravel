@extends('emails.layout')

@section('email-body')
<p class="greeting">New Design Request Submitted</p>
<p class="message">
    A new design request has been submitted through the portal and is awaiting assignment.
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
        <span class="info-label">Submitted By</span>
        <span class="info-value">{{ $designRequest->client->name ?? ($designRequest->full_name ?? 'N/A') }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Client Email</span>
        <span class="info-value">{{ $designRequest->client->email ?? ($designRequest->email ?? 'N/A') }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Project Type</span>
        <span class="info-value">{{ $designRequest->project_type ?? 'N/A' }}</span>
    </div>
    @if($designRequest->expected_date)
    <div class="info-row">
        <span class="info-label">Due Date</span>
        <span class="info-value">{{ $designRequest->expected_date->format('d M, Y') }}</span>
    </div>
    @endif
    <div class="info-row">
        <span class="info-label">Status</span>
        <span class="info-value">{{ $designRequest->status }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Submitted At</span>
        <span class="info-value">{{ $designRequest->created_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View & Assign Request</a>

<hr class="divider">
<p class="message" style="margin-bottom: 0; font-size: 0.85rem; color: #94a3b8;">
    Please log in to the portal to review the details and assign a designer.
</p>
@endsection

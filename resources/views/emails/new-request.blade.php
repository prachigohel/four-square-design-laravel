@extends('emails.layout')

@section('email-body')
<p class="greeting">New Project Received</p>
<p class="message">
    A new project has been received and is awaiting assignment. Please review the project details and assign it to a designer.
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
        <span class="info-label">Client</span>
        <span class="info-value">{{ $designRequest->client->name ?? ($designRequest->full_name ?? 'N/A') }}</span>
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
        <span class="info-label">Submitted At</span>
        <span class="info-value">{{ $designRequest->created_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View & Assign Request</a>
@endsection

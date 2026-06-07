@extends('emails.layout')

@section('email-body')
<p class="greeting">Hi {{ $designRequest->client->name ?? ($designRequest->full_name ?? 'Valued Client') }},</p>
<p class="message">
    Your project has been assigned to a designer and work will begin shortly. We will keep you informed throughout the process.
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
    @if($designRequest->expected_date)
    <div class="info-row">
        <span class="info-label">Due Date</span>
        <span class="info-value">{{ $designRequest->expected_date->format('d M, Y') }}</span>
    </div>
    @endif
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View Request</a>
@endsection

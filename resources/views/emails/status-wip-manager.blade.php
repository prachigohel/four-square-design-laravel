@extends('emails.layout')

@section('email-body')
<p class="greeting">Project In Progress</p>
<p class="message">
    The assigned designer has started working on the project. Progress updates will be shared as the project moves forward.
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
        <span class="info-value">{{ $designRequest->client->name ?? ($designRequest->full_name ?? 'N/A') }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Designer</span>
        <span class="info-value">{{ $designRequest->designer->name ?? 'N/A' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Started At</span>
        <span class="info-value">{{ $designRequest->updated_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View Request</a>
@endsection

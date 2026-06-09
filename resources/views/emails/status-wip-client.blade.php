@extends('emails.layout')

@section('email-body')
<p class="greeting">Hi {{ $designRequest->client->name ?? ($designRequest->full_name ?? 'Valued Client') }},</p>
<p class="message">
    We are pleased to inform you that work on your project is now in progress. We will keep you updated on any important developments.
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
        <span class="info-label">Project Type</span>
        <span class="info-value">{{ $designRequest->project_type ?? 'N/A' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Designer</span>
        <span class="info-value">{{ $designRequest->designer->name ?? 'N/A' }}</span>
    </div>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View Request</a>
@endsection

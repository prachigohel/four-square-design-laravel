@extends('emails.layout')

@section('email-body')
<p class="greeting">Hi {{ $designRequest->designer->name ?? 'Designer' }},</p>
<p class="message">
    The client has requested revisions to the submitted design. Please review the feedback and proceed with the necessary updates.
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
        <span class="info-value">{{ $designRequest->client->name ?? 'N/A' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Requested At</span>
        <span class="info-value">{{ $designRequest->updated_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View Feedback</a>
@endsection

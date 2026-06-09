@extends('emails.layout')

@section('email-body')
<p class="greeting">Hi {{ $designRequest->designer->name ?? 'Designer' }},</p>
<p class="message">
    The submitted design has an error or requires correction as per client feedback. Please review the feedback and update the design accordingly.
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
        <span class="info-label">Reported At</span>
        <span class="info-value">{{ $designRequest->updated_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<a href="{{ url('/portal/view-request/' . $designRequest->id) }}" class="btn">View Feedback</a>
@endsection

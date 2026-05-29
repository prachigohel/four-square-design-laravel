@extends('emails.layout')

@section('email-body')
<p class="greeting">New Lead from Website</p>
<p class="message">
    Someone has submitted a contact form on the Four Square Design website. Please follow up with them promptly.
</p>

<div class="info-box">
    <div class="info-row">
        <span class="info-label">Name</span>
        <span class="info-value">{{ $contact->name }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Email</span>
        <span class="info-value"><a href="mailto:{{ $contact->email }}" style="color: #fab133;">{{ $contact->email }}</a></span>
    </div>
    <div class="info-row">
        <span class="info-label">Submitted At</span>
        <span class="info-value">{{ $contact->created_at->format('d M, Y h:i A') }}</span>
    </div>
</div>

<div style="background: #fff9f0; border-left: 4px solid #fab133; border-radius: 8px; padding: 20px 24px; margin-bottom: 28px;">
    <p style="font-weight: 700; color: #020617; margin-bottom: 10px; font-size: 0.9rem;">MESSAGE</p>
    <p style="font-size: 0.95rem; color: #334155; line-height: 1.7; margin: 0;">{{ $contact->message }}</p>
</div>

<a href="mailto:{{ $contact->email }}" class="btn">Reply to Lead</a>

<hr class="divider">
<p class="message" style="margin-bottom: 0; font-size: 0.85rem; color: #94a3b8;">
    You can also view all leads in the <a href="{{ url('/portal/leads') }}" style="color: #fab133;">Leads section</a> of the portal.
</p>
@endsection

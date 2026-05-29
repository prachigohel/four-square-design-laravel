@extends('layouts.portal')
@section('title', 'Open Requests - Four Square Portal')
@section('content')
<div class="page-header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    @if(Auth::user()->role && Auth::user()->role->name === 'Client')
    <a href="{{ route('portal.submit-request') }}" style="text-decoration: none;">
        <button class="new-request-btn"><i class="fas fa-plus"></i> NEW REQUEST</button>
    </a>
    @endif
    <div class="filters-bar" style="margin: 0;">
        <div class="sort-group">
            <label>Sort By:</label>
            <select class="select-input"><option>Created Date</option></select>
            <i class="fas fa-arrow-down-long"></i>
        </div>
        <button class="filter-btn"><i class="fas fa-sliders"></i> Filter & Refine</button>
    </div>
</div>
<div class="request-list">

    @foreach($requests as $req)
    @php
        $statusColors = [
            'Open'              => ['bg' => '#dbeafe', 'text' => '#1e40af'],
            'Assigned'          => ['bg' => '#fef3c7', 'text' => '#92400e'],
            'WIP'               => ['bg' => '#e0e7ff', 'text' => '#3730a3'],
            'Needs Information' => ['bg' => '#fde68a', 'text' => '#78350f'],
            'Needs Approval'    => ['bg' => '#fee2e2', 'text' => '#991b1b'],
            'Closed'            => ['bg' => '#d1fae5', 'text' => '#065f46'],
        ];
        $sColor = $statusColors[$req->status] ?? ['bg' => '#f1f5f9', 'text' => '#475569'];
    @endphp
    <div class="request-item">
        <div class="request-meta-header">
            <div>Request #CAB-2026-{{ $req->id }} | <span class="company-name">{{ $req->client->name ?? $req->full_name ?? 'Website Visitor' }}</span>@if(!$req->client_id) <span style="display: inline-block; background: #e0f2fe; color: #0369a1; font-size: 0.65rem; font-weight: 700; padding: 0.1rem 0.45rem; border-radius: 4px; margin-left: 0.3rem; vertical-align: middle; letter-spacing: 0.3px;">Website</span>@endif</div>
            <div style="color: #008fa0; font-weight: 600;"><i class="fas fa-clock" style="margin-right: 0.3rem; font-size: 0.7rem;"></i>Created on: {{ $req->created_at->format('d M, Y h:i A') }}</div>
        </div>
        <div class="request-card" style="display: block; padding: 0;">
            <div style="display: flex; gap: 1.5rem; padding: 1.25rem 1.5rem; align-items: center;">
                <div class="request-icon"><i class="fas fa-box-open" style="font-size: 1.75rem;"></i></div>
                <div class="request-info">
                    <h3 class="request-title" style="margin: 0; font-size: 1rem;">
                        <a href="{{ route('portal.view-request', ['id' => $req->id]) }}" style="color: inherit; text-decoration: none;">{{ $req->title }}</a>
                    </h3>
                </div>
                <div style="display: flex; align-items: center; gap: 0; margin-left: auto;">
                    <!-- Info column: Added By + Assign Designer -->
                    <div style="text-align: right; padding-right: 1.25rem; margin-right: 1.25rem; border-right: 1px solid var(--border-color);">
                        <div style="font-size: 0.72rem; color: var(--text-muted); margin-bottom: 0.4rem;">
                            Added By: <span style="font-weight: 600; color: var(--text-main);">{{ $req->client->name ?? $req->full_name ?? 'Website Visitor' }}</span>
                            @if(!$req->client_id)
                                <span style="display: inline-block; background: #e0f2fe; color: #0369a1; font-size: 0.62rem; font-weight: 700; padding: 0.05rem 0.4rem; border-radius: 4px; margin-left: 0.2rem; vertical-align: middle;">Website</span>
                            @endif
                        </div>
                        @if(in_array($role, ['Admin', 'Manager']))
                            <form action="{{ route('portal.requests.assign', $req->id) }}" method="POST">
                                @csrf
                                <select name="designer_id" onchange="this.form.submit()" style="padding: 0.3rem 0.5rem; font-size: 0.72rem; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; color: #334155; cursor: pointer; outline: none; width: 140px;">
                                    <option value="">Assign Designer</option>
                                    @foreach($designers as $designer)
                                        <option value="{{ $designer->id }}" {{ $req->designer_id == $designer->id ? 'selected' : '' }}>
                                            {{ $designer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <div style="font-size: 0.72rem; color: var(--text-muted);">Designer: <span style="font-weight: 600; color: var(--text-main);">{{ $req->designer->name ?? 'Unassigned' }}</span></div>
                        @endif
                    </div>
                    <!-- Status + actions -->
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="display: inline-block; background: {{ $sColor['bg'] }}; color: {{ $sColor['text'] }}; font-size: 0.72rem; font-weight: 700; padding: 0.3rem 0.9rem; border-radius: 999px; white-space: nowrap; letter-spacing: 0.3px;">{{ $req->status }}</span>
                        <a href="{{ route('portal.view-request', ['id' => $req->id]) }}" style="display: inline-flex; align-items: center; gap: 0.4rem; background: var(--primary-color); color: #020617; font-size: 0.78rem; font-weight: 700; padding: 0.4rem 1.1rem; border-radius: 7px; text-decoration: none; white-space: nowrap;">Open <i class="fas fa-arrow-right" style="font-size: 0.6rem;"></i></a>
                        <button class="expand-details-btn" onclick="toggleRequestDetails(this)" title="Show details" style="background: none; border: 1px solid var(--border-color); border-radius: 50%; width: 32px; height: 32px; cursor: pointer; color: var(--text-muted); display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: border-color 0.2s, color 0.2s;">
                            <i class="fas fa-plus" style="font-size: 0.7rem;"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hidden Details Section -->
            <div class="request-details-expanded" style="display: none; padding: 0 1.5rem 1.5rem; border-top: 1px solid #f1f5f9; background: #fafafa; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; padding-top: 1.5rem;">
                    <div class="info-item">
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 0.25rem;">Type</div>
                        <div style="font-size: 0.9rem; font-weight: 600;">{{ $req->request_type ?? 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 0.25rem;">Cabinet Brand</div>
                        <div style="font-size: 0.9rem; font-weight: 600;">{{ $req->cabinet_brand ?? 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 0.25rem;">Expected Date</div>
                        <div style="font-size: 0.9rem; font-weight: 600;">{{ $req->expected_date ? $req->expected_date->format('d M, Y') : 'N/A' }}</div>
                    </div>
                    @if($req->additional_info)
                        @foreach($req->additional_info as $key => $val)
                            @if($key === 'attachments') @continue @endif
                            <div class="info-item">
                                <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 0.25rem;">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                                <div style="font-size: 0.9rem; font-weight: 600;">{{ is_array($val) ? implode(', ', $val) : $val }}</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @if(count($requests) == 0)
        <p style="text-align: center; padding: 2rem;">No requests found.</p>
    @endif
</div>
@section('scripts')
<script>
    function toggleRequestDetails(btn) {
        const card = btn.closest('.request-card');
        const details = card.querySelector('.request-details-expanded');
        const icon = btn.querySelector('i');

        if (details.style.display === 'none') {
            details.style.display = 'block';
            icon.classList.replace('fa-plus', 'fa-minus');
            btn.style.borderColor = 'var(--primary-color)';
            btn.style.color = 'var(--primary-color)';
        } else {
            details.style.display = 'none';
            icon.classList.replace('fa-minus', 'fa-plus');
            btn.style.borderColor = 'var(--border-color)';
            btn.style.color = 'var(--text-muted)';
        }
    }
</script>
@endsection
@endsection

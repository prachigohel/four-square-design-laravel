@extends('layouts.portal')
@section('title', 'Prioritized Requests - FourSquareDesign Portal')
@section('content')

<div class="page-header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div style="display: flex; align-items: center; gap: 0.75rem;">
        <i class="fas fa-star" style="color: #008fa0; font-size: 1.1rem;"></i>
        <h2 style="font-size: 1.1rem; font-weight: 800; color: var(--secondary-color); margin: 0;">Prioritized Requests</h2>
        <span style="background: #1e40af; color: #fff; font-size: 0.7rem; font-weight: 700; padding: 0.15rem 0.55rem; border-radius: 999px;">{{ $requests->count() }}</span>
    </div>
</div>

@if($requests->isEmpty())
    <div class="empty-state-card">
        <div class="empty-state-content">
            <i class="far fa-star" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
            <h3>No prioritized requests</h3>
            <p>Open any request and click <strong>"Prioritize this Request"</strong> to pin it here.</p>
        </div>
    </div>
@else
    <div class="request-list">
        @foreach($requests as $req)
        @php
            $statusColors = [
                'Queued'               => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                'Assigned'             => ['bg' => '#e0f2fe', 'text' => '#0369a1'],
                'In Progress'          => ['bg' => '#e0e7ff', 'text' => '#3730a3'],
                'Needs Information'    => ['bg' => '#fde68a', 'text' => '#78350f'],
                'Information Submitted'=> ['bg' => '#d1fae5', 'text' => '#065f46'],
                'To Be Continued'      => ['bg' => '#fefce8', 'text' => '#a16207'],
                'Needs Approval'       => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                'Revision Requested'   => ['bg' => '#fff7ed', 'text' => '#c2410c'],
                'Design Error'         => ['bg' => '#fef2f2', 'text' => '#b91c1c'],
                'Approved'             => ['bg' => '#dcfce7', 'text' => '#166534'],
                'Project Completed'    => ['bg' => '#020617', 'text' => '#fab133'],
            ];
            $sColor = $statusColors[$req->status] ?? ['bg' => '#f1f5f9', 'text' => '#475569'];
        @endphp
        <div class="request-item" style="border-left: 3px solid #3b82f6;">
            <div class="request-meta-header">
                <div>
                    <i class="fas fa-star" style="color: #3b82f6; font-size: 0.75rem; margin-right: 0.3rem;"></i>
                    Request #{{ $req->request_number }} | <span class="company-name">{{ $req->client->name ?? $req->full_name ?? 'Website Visitor' }}</span>
                </div>
                <div style="color: #008fa0; font-weight: 600;">
                    <i class="fas fa-clock" style="margin-right: 0.3rem; font-size: 0.7rem;"></i>Created on: <span data-utc="{{ $req->created_at->toISOString() }}">{{ $req->created_at->format('d M, Y h:i A') }}</span>
                </div>
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
                        <div style="text-align: right; padding-right: 1.25rem; margin-right: 1.25rem; border-right: 1px solid var(--border-color);">
                            <div style="font-size: 0.72rem; color: var(--text-muted); margin-bottom: 0.4rem;">
                                Added By: <span style="font-weight: 600; color: var(--text-main);">{{ $req->client->name ?? $req->full_name ?? 'Website Visitor' }}</span>
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
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <span style="display: inline-block; background: {{ $sColor['bg'] }}; color: {{ $sColor['text'] }}; font-size: 0.72rem; font-weight: 700; padding: 0.3rem 0.9rem; border-radius: 999px; white-space: nowrap; letter-spacing: 0.3px;">{{ $req->status }}</span>
                            <a href="{{ route('portal.view-request', ['id' => $req->id]) }}" style="display: inline-flex; align-items: center; gap: 0.4rem; background: var(--primary-color); color: #020617; font-size: 0.78rem; font-weight: 700; padding: 0.4rem 1.1rem; border-radius: 7px; text-decoration: none; white-space: nowrap;">Open <i class="fas fa-arrow-right" style="font-size: 0.6rem;"></i></a>
                            <form action="{{ route('portal.requests.prioritize', $req->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" title="Remove from prioritized" style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 50%; width: 32px; height: 32px; cursor: pointer; color: #3b82f6; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-star" style="font-size: 0.7rem;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection

@section('styles')
<style>
    .empty-state-card {
        background: #f8fafc;
        border-radius: 12px;
        min-height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
    }
    .empty-state-content {
        text-align: center;
    }
    .empty-state-content h3 {
        font-size: 1.4rem;
        font-weight: 600;
        color: #020617;
        margin-bottom: 0.5rem;
    }
    .empty-state-content p {
        color: #64748b;
        font-size: 0.95rem;
    }
</style>
@endsection

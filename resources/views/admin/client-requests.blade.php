@extends('layouts.portal')

@section('title', ($client->company_name ?? $client->name) . ' - Requests')

@section('content')
@php $role = Auth::user()->role->name ?? ''; @endphp

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
    <div>
        <a href="{{ route('portal.clients') }}" style="font-size:0.82rem;color:var(--text-muted);text-decoration:none;">
            <i class="fas fa-arrow-left" style="margin-right:0.4rem;"></i>All Clients
        </a>
        <h2 style="font-family:var(--font-heading);color:var(--secondary-color);margin-top:0.4rem;font-size:1.8rem;">
            {{ $client->company_name ?? $client->name }}
        </h2>
        <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.2rem;">
            {{ $client->name }}
            @if($client->email) &nbsp;·&nbsp; {{ $client->email }} @endif
        </p>
    </div>
    <div style="display:flex;align-items:center;gap:1rem;">
        <div style="font-size:0.85rem;color:var(--text-muted);">
            <strong style="color:var(--secondary-color);">{{ $requests->count() }}</strong> total request(s)
        </div>
    </div>
</div>

@if($requests->isEmpty())
    <div style="text-align:center;padding:4rem;background:#fff;border-radius:12px;border:1px dashed var(--border-color);">
        <i class="fas fa-inbox" style="font-size:3rem;color:#cbd5e1;margin-bottom:1rem;display:block;"></i>
        <p style="color:var(--text-muted);">No requests found for this client.</p>
    </div>
@else
<div style="display:flex;flex-direction:column;gap:1rem;">
    @foreach($requests as $i => $req)
    @php
        $commentCount  = $req->comments->whereIn('type', ['comment'])->count();
        $revisionCount = $req->comments->where('type', 'revision')->count();
        $statusColors  = [
            'Queued'               => ['bg'=>'#f3f4f6','color'=>'#6b7280'],
            'Assigned'             => ['bg'=>'#ede9fe','color'=>'#7c3aed'],
            'In Progress'          => ['bg'=>'#eff6ff','color'=>'#3b82f6'],
            'Needs Information'    => ['bg'=>'#fffbeb','color'=>'#d97706'],
            'Information Submitted'=> ['bg'=>'#f0fdf4','color'=>'#15803d'],
            'To Be Continued'      => ['bg'=>'#fefce8','color'=>'#a16207'],
            'Needs Approval'       => ['bg'=>'#fff0f0','color'=>'#e11d48'],
            'Revision Requested'   => ['bg'=>'#fff7ed','color'=>'#c2410c'],
            'Design Error'         => ['bg'=>'#fef2f2','color'=>'#b91c1c'],
            'Approved'             => ['bg'=>'#f0fdf4','color'=>'#166534'],
            'Project Completed'    => ['bg'=>'#020617','color'=>'#fab133'],
            'Draft'                => ['bg'=>'#f9fafb','color'=>'#9ca3af'],
            'Open'                 => ['bg'=>'#e0f2fe','color'=>'#0369a1'],
        ];
        $sc = $statusColors[$req->status] ?? ['bg'=>'#f3f4f6','color'=>'#6b7280'];
    @endphp
    <div style="background:#fff;border-radius:12px;border:1px solid var(--border-color);overflow:hidden;box-shadow:0 2px 4px rgba(0,0,0,0.04);">

        {{-- Top bar --}}
        <div style="display:flex;justify-content:space-between;align-items:center;padding:0.6rem 1.25rem;background:#f8fafc;border-bottom:1px solid var(--border-color);font-size:0.75rem;color:var(--text-muted);flex-wrap:wrap;gap:0.5rem;">
            <span style="font-weight:700;color:var(--secondary-color);">Request #CAB-2026-{{ $req->id }}</span>
            <div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
                <span><strong>Created on:</strong> {{ $req->created_at->format('d M, Y h:i A') }}</span>
                @if($req->expected_date)
                <span style="{{ $req->expected_date->isPast() && $req->status !== 'Project Completed' ? 'color:#ef4444;font-weight:700;' : '' }}">
                    <strong>Due:</strong> {{ $req->expected_date->format('d M, Y') }}
                </span>
                @endif
                <span><strong>Last Updated:</strong> {{ $req->updated_at->format('d M, Y h:i A') }}</span>
            </div>
            <span style="background:#e2e8f0;color:#475569;font-weight:800;padding:0.15rem 0.6rem;border-radius:6px;">#{{ $i + 1 }}</span>
        </div>

        {{-- Request body --}}
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;flex-wrap:wrap;gap:1rem;">
            <div style="display:flex;align-items:center;gap:1rem;">
                <div style="width:52px;height:52px;background:#f1f5f9;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas fa-drafting-compass" style="font-size:1.4rem;color:#94a3b8;"></i>
                </div>
                <div>
                    <a href="{{ route('portal.view-request', $req->id) }}" style="font-size:1.05rem;font-weight:800;color:var(--secondary-color);text-decoration:none;">
                        {{ $req->title }}
                    </a>
                    <div style="margin-top:0.3rem;font-size:0.8rem;color:var(--text-muted);display:flex;gap:1rem;">
                        <span><i class="fas fa-comment" style="margin-right:0.3rem;color:var(--primary-color);"></i>{{ $commentCount }} Comment{{ $commentCount !== 1 ? 's' : '' }}</span>
                        <span>|</span>
                        <span><i class="fas fa-sync-alt" style="margin-right:0.3rem;color:#f59e0b;"></i>{{ $revisionCount }} Revision{{ $revisionCount !== 1 ? 's' : '' }}</span>
                    </div>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:0.4rem;">
                <span style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};font-size:0.78rem;font-weight:700;padding:0.3rem 0.85rem;border-radius:999px;display:inline-flex;align-items:center;gap:0.4rem;">
                    <span style="width:7px;height:7px;border-radius:50%;background:{{ $sc['color'] }};display:inline-block;"></span>
                    {{ $req->status }}
                </span>
                <span style="font-size:0.75rem;color:var(--text-muted);">Designer: <strong style="color:var(--secondary-color);">{{ $req->designer->name ?? 'Unassigned' }}</strong></span>
                <span style="font-size:0.75rem;color:var(--text-muted);">Added By: <strong style="color:var(--secondary-color);">{{ $req->client->name ?? '—' }}</strong></span>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection

@extends('layouts.portal')

@section('title', 'Dashboard - Four Square Design Portal')

@section('styles')
<style>
    .dash-wrap { padding: 2rem 2rem 3rem; }

    /* ── Stat cards ── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
        gap: 1.1rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.25rem 1.4rem;
        box-shadow: 0 1px 6px rgba(0,0,0,0.07);
        border-left: 4px solid var(--primary-color);
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }
    .stat-card.blue  { border-color: #3b82f6; }
    .stat-card.teal  { border-color: #14b8a6; }
    .stat-card.amber { border-color: #f59e0b; }
    .stat-card.rose  { border-color: #f43f5e; }
    .stat-card.violet{ border-color: #8b5cf6; }
    .stat-card.slate { border-color: #64748b; }
    .stat-card.green { border-color: #22c55e; }
    .stat-card.cyan  { border-color: #06b6d4; }

    .stat-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #64748b;
    }
    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
    }
    .stat-sub {
        font-size: 0.72rem;
        color: #94a3b8;
    }

    /* ── Section title ── */
    .dash-section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .dash-section-title i { color: var(--primary-color); }

    /* ── Table ── */
    .dash-table-wrap {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    .dash-table { width: 100%; border-collapse: collapse; font-size: 0.82rem; }
    .dash-table th {
        background: #f8fafc;
        padding: 0.75rem 1rem;
        text-align: left;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #64748b;
        border-bottom: 1px solid #e2e8f0;
    }
    .dash-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }
    .dash-table tr:last-child td { border-bottom: none; }
    .dash-table tr:hover td { background: #fafbff; }
    .dash-table a { color: #0f172a; text-decoration: none; font-weight: 600; }
    .dash-table a:hover { color: var(--primary-color); }

    /* ── Status badges ── */
    .badge {
        display: inline-block;
        padding: 0.2rem 0.65rem;
        border-radius: 999px;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        white-space: nowrap;
    }
    .badge-queued     { background:#dbeafe; color:#1e40af; }
    .badge-assigned   { background:#e0f2fe; color:#0369a1; }
    .badge-wip        { background:#fef3c7; color:#92400e; }
    .badge-info       { background:#ffedd5; color:#9a3412; }
    .badge-info-sub   { background:#f0fdf4; color:#15803d; }
    .badge-hold       { background:#fefce8; color:#a16207; }
    .badge-approval   { background:#ede9fe; color:#5b21b6; }
    .badge-revision   { background:#fff7ed; color:#c2410c; }
    .badge-error      { background:#fef2f2; color:#b91c1c; }
    .badge-approved   { background:#dcfce7; color:#166534; }
    .badge-completed  { background:#020617; color:#fab133; }
    .badge-open       { background:#dbeafe; color:#1e40af; }
    .badge-closed     { background:#020617; color:#fab133; }

    /* ── Two-col layout ── */
    .dash-two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    /* ── Quick actions (client) ── */
    .quick-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    .qa-card {
        flex: 1;
        min-width: 160px;
        background: #fff;
        border-radius: 12px;
        padding: 1.4rem 1.2rem;
        box-shadow: 0 1px 6px rgba(0,0,0,0.07);
        text-align: center;
        text-decoration: none;
        color: #0f172a;
        border: 2px solid transparent;
        transition: border-color 0.2s, transform 0.15s;
    }
    .qa-card:hover { border-color: var(--primary-color); transform: translateY(-2px); }
    .qa-card i { font-size: 1.6rem; color: var(--primary-color); margin-bottom: 0.6rem; display: block; }
    .qa-card span { font-size: 0.82rem; font-weight: 700; display: block; }

    /* ── Welcome banner ── */
    .dash-welcome {
        background: linear-gradient(135deg, #020617 0%, #1e293b 100%);
        border-radius: 14px;
        padding: 1.75rem 2rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .dash-welcome-text h2 {
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        margin: 0 0 0.25rem;
    }
    .dash-welcome-text p { color: #94a3b8; font-size: 0.85rem; margin: 0; }
    .dash-welcome-badge {
        background: var(--primary-color);
        color: #020617;
        font-weight: 800;
        font-size: 0.75rem;
        padding: 0.4rem 1rem;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        white-space: nowrap;
    }

    /* ── Mini list (overdue / recent) ── */
    .mini-list { list-style: none; padding: 0; margin: 0; }
    .mini-list li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.65rem 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.82rem;
        gap: 0.5rem;
    }
    .mini-list li:last-child { border-bottom: none; }
    .mini-list .ml-title { font-weight: 600; color: #0f172a; flex: 1; min-width: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .mini-list .ml-meta  { color: #94a3b8; font-size: 0.72rem; white-space: nowrap; }

    /* ── Donut placeholder ── */
    .status-bars { display: flex; flex-direction: column; gap: 0.65rem; }
    .sbar-row { display: flex; align-items: center; gap: 0.75rem; font-size: 0.8rem; }
    .sbar-label { width: 110px; color: #475569; font-weight: 600; flex-shrink: 0; }
    .sbar-track { flex: 1; height: 8px; background: #f1f5f9; border-radius: 999px; overflow: hidden; }
    .sbar-fill  { height: 100%; border-radius: 999px; }
    .sbar-count { width: 28px; text-align: right; color: #0f172a; font-weight: 700; font-size: 0.8rem; }

    /* ── Designer coming soon ── */
    .designer-soon {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 60vh;
        text-align: center;
        color: var(--text-muted);
    }
    .designer-soon i { font-size: 5rem; color: var(--primary-color); margin-bottom: 2rem; opacity: 0.5; }
    .designer-soon h2 { font-family: var(--font-heading); font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem; }
    .designer-soon p { font-size: 1.1rem; max-width: 480px; color: #64748b; }
    .designer-soon .cs-badge { margin-top: 2rem; padding: 0.5rem 1.5rem; background: #fffbeb; color: #92400e; border-radius: 999px; font-weight: 700; font-size: 0.9rem; letter-spacing: 1px; text-transform: uppercase; display: inline-block; }

    @media (max-width: 768px) {
        .dash-two-col { grid-template-columns: 1fr; }
        .stat-grid    { grid-template-columns: repeat(2, 1fr); }
        .dash-wrap    { padding: 1rem 1rem 2rem; }
    }
</style>
@endsection

@section('content')
<div class="dash-wrap">

{{-- ══════════════════════════════════════════════════ --}}
{{-- DESIGNER: Coming Soon --}}
{{-- ══════════════════════════════════════════════════ --}}
@if($role === 'Designer')
<div class="designer-soon">
    <i class="fas fa-drafting-compass"></i>
    <h2>Designer Dashboard</h2>
    <p>Your personalised workspace with assigned projects, timelines, and performance insights is on its way.</p>
    <span class="cs-badge">🚀 Coming Soon</span>
</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- CLIENT Dashboard --}}
{{-- ══════════════════════════════════════════════════ --}}
@elseif($role === 'Client')

{{-- Welcome banner --}}
<div class="dash-welcome">
    <div class="dash-welcome-text">
        <h2>Welcome back, {{ $user->name }}!</h2>
        <p>Here's a summary of your design requests.</p>
    </div>
    <a href="{{ route('portal.submit-request') }}" class="dash-welcome-badge">+ Submit New Request</a>
</div>

{{-- Stats --}}
<div class="stat-grid">
    <div class="stat-card blue">
        <div class="stat-label">Total Requests</div>
        <div class="stat-value">{{ $stats['total'] }}</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-label">Queued</div>
        <div class="stat-value">{{ $stats['open'] }}</div>
    </div>
    <div class="stat-card teal">
        <div class="stat-label">In Progress</div>
        <div class="stat-value">{{ $stats['wip'] }}</div>
    </div>
    <div class="stat-card violet">
        <div class="stat-label">Needs Approval</div>
        <div class="stat-value">{{ $stats['needs_approval'] }}</div>
    </div>
    <div class="stat-card rose">
        <div class="stat-label">Needs Info</div>
        <div class="stat-value">{{ $stats['needs_info'] }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-label">Completed</div>
        <div class="stat-value">{{ $stats['closed'] }}</div>
    </div>
</div>

{{-- Status breakdown + recent --}}
<div class="dash-two-col">
    {{-- Status breakdown --}}
    <div>
        <div class="dash-section-title"><i class="fas fa-chart-bar"></i> Request Status Breakdown</div>
        <div class="dash-table-wrap" style="padding: 1.25rem 1.4rem;">
            @php $total = max($stats['total'], 1); @endphp
            <div class="status-bars">
                <div class="sbar-row">
                    <div class="sbar-label">Queued</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['open']/$total*100) }}%;background:#3b82f6;"></div></div>
                    <div class="sbar-count">{{ $stats['open'] }}</div>
                </div>
                <div class="sbar-row">
                    <div class="sbar-label">In Progress</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['wip']/$total*100) }}%;background:#f59e0b;"></div></div>
                    <div class="sbar-count">{{ $stats['wip'] }}</div>
                </div>
                <div class="sbar-row">
                    <div class="sbar-label">Needs Approval</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['needs_approval']/$total*100) }}%;background:#8b5cf6;"></div></div>
                    <div class="sbar-count">{{ $stats['needs_approval'] }}</div>
                </div>
                <div class="sbar-row">
                    <div class="sbar-label">Needs Info</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['needs_info']/$total*100) }}%;background:#f43f5e;"></div></div>
                    <div class="sbar-count">{{ $stats['needs_info'] }}</div>
                </div>
                <div class="sbar-row">
                    <div class="sbar-label">Completed</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['closed']/$total*100) }}%;background:#22c55e;"></div></div>
                    <div class="sbar-count">{{ $stats['closed'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent requests --}}
    <div>
        <div class="dash-section-title"><i class="fas fa-clock"></i> Recent Requests</div>
        <div class="dash-table-wrap" style="padding: 0.5rem 0;">
            @if($stats['recent']->isEmpty())
                <p style="padding:1.5rem;text-align:center;color:#94a3b8;font-size:0.85rem;">No requests yet.</p>
            @else
            <ul class="mini-list" style="padding: 0 1.25rem;">
                @foreach($stats['recent'] as $req)
                <li>
                    <span class="ml-title">
                        <a href="{{ route('portal.view-request', $req->id) }}">{{ $req->title }}</a>
                    </span>
                    @php
                        $bMap = ['Queued'=>'queued','Assigned'=>'assigned','In Progress'=>'wip','Needs Information'=>'info','Information Submitted'=>'info-sub','To Be Continued'=>'hold','Needs Approval'=>'approval','Revision Requested'=>'revision','Design Error'=>'error','Approved'=>'approved','Project Completed'=>'completed'];
                        $bClass = $bMap[$req->status] ?? 'queued';
                    @endphp
                    <span class="badge badge-{{ $bClass }}">{{ $req->status }}</span>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="dash-section-title"><i class="fas fa-bolt"></i> Quick Actions</div>
<div class="quick-actions">
    <a class="qa-card" href="{{ route('portal.submit-request') }}">
        <i class="fas fa-plus-circle"></i>
        <span>Submit Request</span>
    </a>
    <a class="qa-card" href="{{ route('portal.open-requests') }}">
        <i class="fas fa-folder-open"></i>
        <span>All Requests</span>
    </a>
    <a class="qa-card" href="{{ route('portal.wip') }}">
        <i class="fas fa-clock"></i>
        <span>In Progress</span>
    </a>
    <a class="qa-card" href="{{ route('portal.needs-approval') }}">
        <i class="fas fa-check-circle"></i>
        <span>Needs Approval</span>
    </a>
    <a class="qa-card" href="{{ route('portal.closed') }}">
        <i class="fas fa-archive"></i>
        <span>Completed</span>
    </a>
</div>

{{-- ══════════════════════════════════════════════════ --}}
{{-- ADMIN / MANAGER Dashboard --}}
{{-- ══════════════════════════════════════════════════ --}}
@elseif(in_array($role, ['Admin', 'Manager']))

{{-- Welcome --}}
<div class="dash-welcome">
    <div class="dash-welcome-text">
        <h2>{{ $role }} Dashboard — {{ $user->name }}</h2>
        <p>Overview of all design requests and team activity.</p>
    </div>
    @if($stats['overdue'] > 0)
    <span class="dash-welcome-badge" style="background:#f43f5e;color:#fff;">
        ⚠ {{ $stats['overdue'] }} Overdue
    </span>
    @endif
</div>

{{-- Top stats --}}
<div class="stat-grid">
    <div class="stat-card blue">
        <div class="stat-label">Total Requests</div>
        <div class="stat-value">{{ $stats['total'] }}</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-label">Queued</div>
        <div class="stat-value">{{ $stats['open'] }}</div>
    </div>
    <div class="stat-card teal">
        <div class="stat-label">In Progress</div>
        <div class="stat-value">{{ $stats['wip'] }}</div>
    </div>
    <div class="stat-card violet">
        <div class="stat-label">Needs Approval</div>
        <div class="stat-value">{{ $stats['needs_approval'] }}</div>
    </div>
    <div class="stat-card rose">
        <div class="stat-label">Needs Info</div>
        <div class="stat-value">{{ $stats['needs_info'] }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-label">Completed</div>
        <div class="stat-value">{{ $stats['closed'] }}</div>
    </div>
    @if($role === 'Admin')
    <div class="stat-card cyan">
        <div class="stat-label">Total Clients</div>
        <div class="stat-value">{{ $stats['clients'] }}</div>
    </div>
    <div class="stat-card slate">
        <div class="stat-label">Designers</div>
        <div class="stat-value">{{ $stats['designers'] }}</div>
    </div>
    @endif
</div>

{{-- Status bars + recent table --}}
<div class="dash-two-col">
    {{-- Status breakdown --}}
    <div>
        <div class="dash-section-title"><i class="fas fa-chart-bar"></i> Status Breakdown</div>
        <div class="dash-table-wrap" style="padding: 1.25rem 1.4rem;">
            @php $total = max($stats['total'], 1); @endphp
            <div class="status-bars">
                <div class="sbar-row">
                    <div class="sbar-label">Queued</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['open']/$total*100) }}%;background:#3b82f6;"></div></div>
                    <div class="sbar-count">{{ $stats['open'] }}</div>
                </div>
                <div class="sbar-row">
                    <div class="sbar-label">In Progress</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['wip']/$total*100) }}%;background:#f59e0b;"></div></div>
                    <div class="sbar-count">{{ $stats['wip'] }}</div>
                </div>
                <div class="sbar-row">
                    <div class="sbar-label">Needs Approval</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['needs_approval']/$total*100) }}%;background:#8b5cf6;"></div></div>
                    <div class="sbar-count">{{ $stats['needs_approval'] }}</div>
                </div>
                <div class="sbar-row">
                    <div class="sbar-label">Needs Info</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['needs_info']/$total*100) }}%;background:#f43f5e;"></div></div>
                    <div class="sbar-count">{{ $stats['needs_info'] }}</div>
                </div>
                <div class="sbar-row">
                    <div class="sbar-label">Completed</div>
                    <div class="sbar-track"><div class="sbar-fill" style="width:{{ round($stats['closed']/$total*100) }}%;background:#22c55e;"></div></div>
                    <div class="sbar-count">{{ $stats['closed'] }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Overdue / attention needed --}}
    <div>
        <div class="dash-section-title"><i class="fas fa-exclamation-triangle" style="color:#f43f5e;"></i> Needs Attention</div>
        <div class="dash-table-wrap" style="padding: 0.5rem 0;">
            @php
                $attention = \App\Models\DesignRequest::with('client')
                    ->whereIn('status', ['Needs Approval', 'Needs Information'])
                    ->when($role === 'Manager', fn($q) => $q->whereHas('client', fn($q2) => $q2->where('manager_id', $user->id)))
                    ->orderBy('updated_at', 'asc')
                    ->limit(6)
                    ->get();
            @endphp
            @if($attention->isEmpty())
                <p style="padding:1.5rem;text-align:center;color:#94a3b8;font-size:0.85rem;">Nothing needs attention right now.</p>
            @else
            <ul class="mini-list" style="padding: 0 1.25rem;">
                @foreach($attention as $req)
                <li>
                    <span class="ml-title">
                        <a href="{{ route('portal.view-request', $req->id) }}">{{ $req->title }}</a>
                    </span>
                    @php $bMap=['Needs Approval'=>'approval','Needs Information'=>'info']; $bClass=$bMap[$req->status]??'queued'; @endphp
                    <span class="badge badge-{{ $bClass }}">{{ $req->status }}</span>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>

{{-- Recent requests table --}}
<div class="dash-section-title"><i class="fas fa-list"></i> Recent Requests</div>
<div class="dash-table-wrap">
    @if($stats['recent']->isEmpty())
        <p style="padding:2rem;text-align:center;color:#94a3b8;">No requests found.</p>
    @else
    <table class="dash-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Client</th>
                <th>Designer</th>
                <th>Status</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stats['recent'] as $req)
            @php
                $bMap = ['Queued'=>'queued','Assigned'=>'assigned','In Progress'=>'wip','Needs Information'=>'info','Information Submitted'=>'info-sub','To Be Continued'=>'hold','Needs Approval'=>'approval','Revision Requested'=>'revision','Design Error'=>'error','Approved'=>'approved','Project Completed'=>'completed'];
                $bClass = $bMap[$req->status] ?? 'queued';
                $overdue = $req->expected_date && $req->expected_date->isPast() && $req->status !== 'Project Completed';
            @endphp
            <tr>
                <td style="color:#94a3b8;font-size:0.75rem;">{{ $req->id }}</td>
                <td><a href="{{ route('portal.view-request', $req->id) }}">{{ Str::limit($req->title, 40) }}</a></td>
                <td>{{ $req->client->name ?? '—' }}</td>
                <td>{{ $req->designer->name ?? '<span style="color:#94a3b8;">Unassigned</span>' }}</td>
                <td><span class="badge badge-{{ $bClass }}">{{ $req->status }}</span></td>
                <td style="{{ $overdue ? 'color:#f43f5e;font-weight:700;' : 'color:#64748b;' }}">
                    {{ $req->expected_date ? $req->expected_date->format('M d, Y') : '—' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

{{-- Quick links --}}
<div class="dash-section-title"><i class="fas fa-bolt"></i> Quick Access</div>
<div class="quick-actions">
    <a class="qa-card" href="{{ route('portal.open-requests') }}">
        <i class="fas fa-folder-open"></i>
        <span>Open Requests</span>
    </a>
    <a class="qa-card" href="{{ route('portal.wip') }}">
        <i class="fas fa-clock"></i>
        <span>In Progress</span>
    </a>
    <a class="qa-card" href="{{ route('portal.needs-approval') }}">
        <i class="fas fa-check-circle"></i>
        <span>Needs Approval</span>
    </a>
    <a class="qa-card" href="{{ route('portal.design-requests') }}">
        <i class="fas fa-drafting-compass"></i>
        <span>All Requests</span>
    </a>
    @if($role === 'Admin')
    <a class="qa-card" href="{{ route('portal.clients') }}">
        <i class="fas fa-users"></i>
        <span>All Clients</span>
    </a>
    @endif
</div>

@else
{{-- Fallback for any unknown role --}}
<div class="designer-soon">
    <i class="fas fa-chart-line"></i>
    <h2>Dashboard</h2>
    <p>Your dashboard is being set up. Check back soon.</p>
    <span class="cs-badge">🚀 Coming Soon</span>
</div>
@endif

</div>
@endsection

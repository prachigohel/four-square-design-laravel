@extends('layouts.portal')

@section('title', 'Design Requests - FourSquareDesign Portal')

@section('content')
<div class="dr-page-head" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.75rem;">
    <div>
        <h2 style="font-family: var(--font-heading); font-size: 1.6rem; color: #020617; margin: 0;">Design Requests</h2>
        <p style="color: #64748b; font-size: 0.85rem; margin-top: 0.25rem;">All design requests submitted through the portal</p>
    </div>
    <span style="background: #f1f5f9; color: #475569; padding: 0.4rem 1rem; border-radius: 999px; font-size: 0.8rem; font-weight: 700;">{{ $requests->count() }} Results</span>
</div>

{{-- Filter Bar --}}
<form method="GET" action="{{ route('portal.design-requests') }}" id="filterForm">
    <div class="dr-filter-bar" style="background: #fff; border: 1px solid var(--border-color); border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: flex-end; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">

        {{-- Search --}}
        <div style="display: flex; flex-direction: column; gap: 0.3rem; flex: 1; min-width: 180px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Title or client name…"
                style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; outline: none; background: #f8fafc; width: 100%;">
        </div>

        {{-- Status --}}
        <div style="display: flex; flex-direction: column; gap: 0.3rem; min-width: 150px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">Status</label>
            <select name="status" style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; background: #f8fafc; outline: none;">
                <option value="">All Statuses</option>
                @foreach($statuses as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>

        @if(in_array($role, ['Admin', 'Manager']))
        {{-- Designer --}}
        <div style="display: flex; flex-direction: column; gap: 0.3rem; min-width: 160px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">Designer</label>
            <select name="designer_id" style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; background: #f8fafc; outline: none;">
                <option value="">All Designers</option>
                @foreach($designers as $d)
                    <option value="{{ $d->id }}" {{ request('designer_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        {{-- Project Type --}}
        @if($projectTypes->isNotEmpty())
        <div style="display: flex; flex-direction: column; gap: 0.3rem; min-width: 150px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">Type</label>
            <select name="type" style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; background: #f8fafc; outline: none;">
                <option value="">All Types</option>
                @foreach($projectTypes as $t)
                    <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>
        @endif

        {{-- Date From --}}
        <div style="display: flex; flex-direction: column; gap: 0.3rem; min-width: 140px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">From</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}"
                style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; background: #f8fafc; outline: none;">
        </div>

        {{-- Date To --}}
        <div style="display: flex; flex-direction: column; gap: 0.3rem; min-width: 140px;">
            <label style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">To</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}"
                style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.85rem; color: #020617; background: #f8fafc; outline: none;">
        </div>

        {{-- Buttons --}}
        <div style="display: flex; gap: 0.5rem; align-items: flex-end;">
            <button type="submit" style="background: var(--primary-color); color: #fff; border: none; border-radius: 8px; padding: 0.52rem 1.1rem; font-size: 0.82rem; font-weight: 700; cursor: pointer; white-space: nowrap;">
                <i class="fas fa-search" style="margin-right: 0.35rem;"></i> Apply
            </button>
            @if(request()->hasAny(['search','status','designer_id','type','date_from','date_to']))
            <a href="{{ route('portal.design-requests') }}" style="background: #f1f5f9; color: #475569; border-radius: 8px; padding: 0.52rem 1rem; font-size: 0.82rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                <i class="fas fa-times" style="margin-right: 0.3rem;"></i> Clear
            </a>
            @endif
        </div>
    </div>
</form>

@if($requests->isEmpty())
    <div style="text-align: center; padding: 4rem 2rem; background: #fff; border-radius: 12px; border: 1px solid var(--border-color);">
        <i class="fas fa-folder-open" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
        <p style="color: #94a3b8; font-size: 1rem;">No design requests match your filters.</p>
        @if(request()->hasAny(['search','status','designer_id','type','date_from','date_to']))
            <a href="{{ route('portal.design-requests') }}" style="color: var(--primary-color); font-size: 0.85rem; font-weight: 600;">Clear filters</a>
        @endif
    </div>
@else
    <div class="design-requests-table-wrap" style="background: #fff; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse; min-width: 700px;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Request ID</th>
                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Title</th>
                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Client</th>
                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Type</th>
                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Designer</th>
                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Status</th>
                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;">Submitted</th>
                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #475569;"></th>
                </tr>
            </thead>
            <tbody>
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
                    $color = $statusColors[$req->status] ?? ['bg' => '#f1f5f9', 'text' => '#475569'];
                @endphp
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='#fff'">
                    <td style="padding: 1rem 1.25rem;">
                        <span style="font-size: 0.75rem; font-weight: 700; color: #94a3b8;">{{ $req->request_number }}</span>
                    </td>
                    <td style="padding: 1rem 1.25rem; max-width: 220px;">
                        <div style="font-weight: 700; font-size: 0.9rem; color: #020617; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $req->title }}</div>
                    </td>
                    <td style="padding: 1rem 1.25rem;">
                        <div style="font-size: 0.875rem; font-weight: 600; color: #334155;">{{ $req->client->name ?? '—' }}</div>
                        @if($req->client->company_name ?? null)
                            <div style="font-size: 0.75rem; color: #94a3b8;">{{ $req->client->company_name }}</div>
                        @endif
                    </td>
                    <td style="padding: 1rem 1.25rem;">
                        <span style="font-size: 0.8rem; color: #475569;">{{ $req->project_type ?? $req->request_type ?? '—' }}</span>
                    </td>
                    <td style="padding: 1rem 1.25rem;">
                        <span style="font-size: 0.85rem; color: #334155; font-weight: 500;">{{ $req->designer->name ?? 'Unassigned' }}</span>
                    </td>
                    <td style="padding: 1rem 1.25rem;">
                        <span style="display: inline-block; background: {{ $color['bg'] }}; color: {{ $color['text'] }}; font-size: 0.72rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 999px; white-space: nowrap;">{{ $req->status }}</span>
                    </td>
                    <td style="padding: 1rem 1.25rem; white-space: nowrap;">
                        <div data-utc="{{ $req->created_at->toISOString() }}" data-utc-fmt="date" style="font-size: 0.8rem; color: #475569;">{{ $req->created_at->format('d M, Y') }}</div>
                        <div data-utc="{{ $req->created_at->toISOString() }}" data-utc-fmt="time" style="font-size: 0.72rem; color: #94a3b8;">{{ $req->created_at->format('h:i A') }}</div>
                    </td>
                    <td style="padding: 1rem 1.25rem;">
                        <a href="{{ route('portal.view-request', $req->id) }}" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.78rem; font-weight: 700; color: var(--primary-color); text-decoration: none; background: #f0fdf4; padding: 0.3rem 0.8rem; border-radius: 6px; transition: background 0.15s;" onmouseover="this.style.background='#dcfce7'" onmouseout="this.style.background='#f0fdf4'">
                            View <i class="fas fa-arrow-right" style="font-size: 0.65rem;"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection

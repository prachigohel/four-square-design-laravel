@extends('layouts.portal')

@section('title', 'My Requests - Four Square Design Portal')

@section('content')

<div class="page-header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <a href="{{ route('portal.submit-request') }}" style="text-decoration: none;">
        <button class="new-request-btn"><i class="fas fa-plus"></i> NEW REQUEST</button>
    </a>
    
    <div class="filters-bar" style="margin: 0; gap: 1rem;">
        <div class="sort-group">
            <label>Sort By:</label>
            <select class="select-input">
                <option>Created Date</option>
                <option>Due Date</option>
            </select>
            <i class="fas fa-arrow-down-long"></i>
        </div>
        <button class="filter-btn" style="margin: 0;">
            <i class="fas fa-sliders"></i> Filter & Refine
        </button>
    </div>
</div>

<div class="request-list">

    @foreach($requests as $req)
    <div class="request-item">
        <div class="request-meta-header">
            <div>Request #{{ $req->request_number }} | <span class="company-name">{{ $req->client->name ?? 'Unknown Client' }}</span></div>
            <div>Created on: <span data-utc="{{ $req->created_at->toISOString() }}">{{ $req->created_at->format('d M, Y h:i A') }}</span></div>
        </div>
        <div class="request-card">
            <div class="request-icon">
                <i class="fas fa-box-open" style="font-size: 2rem; color: #3b82f6;"></i>
            </div>
            <div class="request-info">
                <h3 class="request-title"><a href="{{ route('portal.view-request', ['id' => $req->id]) }}" style="color: inherit; text-decoration: none;">{{ $req->title }}</a></h3>
            </div>
            <div class="request-status-info" style="display: flex; flex-direction: column; align-items: flex-end; gap: 0.5rem;">
                <span class="status-badge" style="background: var(--primary-color); color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 700;">{{ $req->status }}</span>
                <div class="designer-info">Added By: <span>{{ $req->client->name ?? 'Unknown' }}</span></div>
                
                @if(in_array($role, ['Admin', 'Manager']))
                    <form action="{{ route('portal.requests.assign', $req->id) }}" method="POST" style="margin-top: 0.5rem;">
                        @csrf
                        <select name="designer_id" onchange="this.form.submit()" class="form-input mini" style="padding: 0.2rem; font-size: 0.8rem; width: 140px; border-radius: 4px; border: 1px solid #e2e8f0;">
                            <option value="">Assign Designer</option>
                            @foreach($designers as $designer)
                                <option value="{{ $designer->id }}" {{ $req->designer_id == $designer->id ? 'selected' : '' }}>
                                    {{ $designer->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                @else
                    <div class="designer-info">Designer: <span>{{ $req->designer->name ?? 'Unassigned' }}</span></div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    
    @if(count($requests) == 0)
        <p style="text-align: center; padding: 2rem; color: #64748b;">No requests found.</p>
    @endif
</div>
@endsection

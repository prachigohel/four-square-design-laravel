@extends('layouts.portal')
@section('title', 'Open Requests - Four Square Portal')
@section('content')
<div class="page-header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <a href="{{ route('portal.submit-request') }}" style="text-decoration: none;">
        <button class="new-request-btn"><i class="fas fa-plus"></i> NEW REQUEST</button>
    </a>
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
    <div class="request-item">
        <div class="request-meta-header">
            <div>Request #CAB-2450-72484 | <span class="company-name">Cabinet IQ of Charlotte</span></div>
            <div>Created on: 26 Mar, 2026 09:11 PM | Due: 1 Apr, 2026 | Last Updated: 9 Apr, 2026 10:46 PM | #1</div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-box-open" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title"><a href="{{ route('portal.view-request', ['id' => 72484]) }}" style="color: inherit; text-decoration: none;">AYM_Eve_Lala</a></h3>
                <div class="request-counts"><span>4 Comments</span> | <span>1 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge revision">● Revision Requested</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Sara Keating</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

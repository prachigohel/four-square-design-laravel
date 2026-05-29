@extends('layouts.portal')
@section('title', 'WIP - Four Square Portal')
@section('content')
<div class="filters-bar">
    <div class="sort-group">
        <label>Sort By:</label>
        <select class="select-input"><option>Created Date</option></select>
        <i class="fas fa-arrow-down-long"></i>
    </div>
    <button class="filter-btn"><i class="fas fa-sliders"></i> Filter & Refine</button>
</div>
<div class="request-list">
    <div class="request-item">
        <div class="request-meta-header">
            <div>Request #CAB-2450-72605 | <span class="company-name">Cabinet IQ of Charlotte</span></div>
            <div>Created on: 30 Mar, 2026 04:49 PM | Due: 3 Apr, 2026 | Last Updated: 9 Apr, 2026 10:33 PM | #1</div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-box-open" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">EB_Krause</h3>
                <div class="request-counts"><span>3 Comments</span> | <span>0 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge tbc">● To be Continued</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Matt Ruggiero</span></div>
            </div>
        </div>
    </div>
    <div class="request-item" style="margin-top: 2rem;">
        <div class="request-meta-header">
            <div>Request #CAB-2450-72950 | <span class="company-name">Cabinet IQ of Charlotte</span></div>
            <div>Created on: 3 Apr, 2026 04:49 AM | Due: 9 Apr, 2026 | Last Updated: 8 Apr, 2026 03:29 AM | #2</div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-box-open" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">Beacon LoSo</h3>
                <div class="request-counts"><span>0 Comments</span> | <span>0 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge tbc">● To be Continued</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Matt Ruggiero</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

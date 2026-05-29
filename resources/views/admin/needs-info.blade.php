@extends('layouts.portal')
@section('title', 'Needs Information - Four Square Portal')
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
    <!-- Item 1 -->
    <div class="request-item">
        <div class="request-meta-header">
            <div>Request #CON-1748-51750 | <span class="company-name">Construction crafters llc</span></div>
            <div>Created on: 31 Mar, 2025 11:30 PM | Due: 31 Mar, 2025 | Last Updated: 3 Apr, 2025 07:07 PM | #1</div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-box-open" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">2 d and 3d</h3>
                <div class="request-counts"><span>1 Comments</span> | <span>0 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge info">● Needs Information</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Omat armengolt</span></div>
            </div>
        </div>
    </div>
    <!-- Item 2 -->
    <div class="request-item" style="margin-top: 2rem;">
        <div class="request-meta-header">
            <div>Request #AME-1026-51935 | <span class="company-name">American Flooring, Cabinets & Granite</span></div>
            <div>Created on: 3 Apr, 2025 01:14 AM | Due: 31 Mar, 2025 | Last Updated: 17 Apr, 2025 09:16 PM | #2</div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-image" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">Rutherford, Shannon</h3>
                <div class="request-counts"><span>5 Comments</span> | <span>0 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge info">● Needs Information</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Ruby Knox</span></div>
            </div>
        </div>
    </div>
    <!-- Item 3 - Prioritized -->
    <div class="request-item" style="margin-top: 2rem;">
        <div class="request-meta-header">
            <div>
                <i class="fas fa-flag" style="color: #ea580c; margin-right: 0.5rem;"></i>
                Request #MAR-1370-55494 | <span class="priority-tag">PRIORITIZED</span> <span class="company-name">Mark Worley's Constuction</span>
            </div>
            <div>Created on: 6 Jun, 2025 03:38 AM | Due: 31 May, 2025 | Last Updated: 13 Mar, 2026 06:21 PM | #3</div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-box-open" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">Davidson Hall Tree Pantry Island</h3>
                <div class="request-counts"><span>10 Comments</span> | <span>2 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge info">● Needs Information</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Garett gordon</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

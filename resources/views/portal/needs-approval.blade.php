@extends('layouts.portal')
@section('title', 'Needs Approval - Four Square Portal')
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
            <div>Request #REN-797-36637 | <span class="company-name">Renovativ Remodeling, LLC</span></div>
            <div>Created on: 20 May, 2024 08:51 PM | Due: 17 May, 2024 | Last Updated: 1 Aug, 2024 07:52 PM | #1</div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-box-open" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">Rakowski master bath</h3>
                <div class="request-counts"><span>9 Comments</span> | <span>3 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge approval">● Needs Approval</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Erich lichtner</span></div>
            </div>
        </div>
    </div>
    <div class="request-item" style="margin-top: 2rem;">
        <div class="request-meta-header">
            <div>Request #FHG-870-38314 | <span class="company-name">FHG 4 LLC</span></div>
            <div>Created on: 27 Jun, 2024 04:23 AM | Due: 26 Jun, 2024 | Last Updated: 27 Jun, 2024 08:22 PM | #2</div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-image" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">Arlington AVE</h3>
                <div class="request-counts"><span>1 Comments</span> | <span>0 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge approval">● Needs Approval</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Demian Fraga</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.portal')

@section('title', 'My Requests - Kitchen365 Portal')

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
    <!-- Request Item 1 -->
    <div class="request-item">
        <div class="request-meta-header">
            <div>Request #REN-797-36637 | <span class="company-name">Renovativ Remodeling, LLC</span></div>
            <div>Created on: 20 May, 2024 08:51 PM | Due: 17 May, 2024 | Last Updated: 1 Aug, 2024 07:52 PM | #1</div>
        </div>
        <div class="request-card">
            <div class="request-icon">
                <i class="fas fa-box-open" style="font-size: 2rem; color: #3b82f6;"></i>
            </div>
            <div class="request-info">
                <h3 class="request-title"><a href="{{ route('portal.view-request', ['id' => 36637]) }}" style="color: inherit; text-decoration: none;">Rakowski master bath</a></h3>
                <div class="request-counts">
                    <span>9 Comments</span>
                    <span>3 Revisions</span>
                </div>
            </div>
            <div class="request-status-info">
                <span class="status-badge approval">Needs Approval</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Erich lichtner</span></div>
            </div>
        </div>
    </div>

    <!-- Request Item 2 -->
    <div class="request-item">
        <div class="request-meta-header">
            <div>Request #FHG-870-38314 | <span class="company-name">FHG 4 LLC</span></div>
            <div>Created on: 27 Jun, 2024 04:23 AM | Due: 26 Jun, 2024 | Last Updated: 27 Jun, 2024 08:22 PM | #2</div>
        </div>
        <div class="request-card">
            <div class="request-icon">
                <i class="fas fa-image" style="font-size: 2rem; color: #3b82f6;"></i>
            </div>
            <div class="request-info">
                <h3 class="request-title"><a href="{{ route('portal.view-request', ['id' => 38314]) }}" style="color: inherit; text-decoration: none;">Arlington AVE</a></h3>
                <div class="request-counts">
                    <span>1 Comments</span>
                    <span>0 Revisions</span>
                </div>
            </div>
            <div class="request-status-info">
                <span class="status-badge approval">Needs Approval</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Demian Fraga</span></div>
            </div>
        </div>
    </div>

    <!-- Request Item 3 -->
    <div class="request-item">
        <div class="request-meta-header">
            <div>Request #CON-1748-51750 | <span class="company-name">Construction crafters llc</span></div>
            <div>Created on: 31 Mar, 2025 11:30 PM | Due: 31 Mar, 2025 | Last Updated: 3 Apr, 2025 07:07 PM | #1</div>
        </div>
        <div class="request-card">
            <div class="request-icon">
                <i class="fas fa-bullhorn" style="font-size: 2rem; color: #3b82f6;"></i>
            </div>
            <div class="request-info">
                <h3 class="request-title"><a href="{{ route('portal.view-request', ['id' => 51750]) }}" style="color: inherit; text-decoration: none;">2 d and 3d</a></h3>
                <div class="request-counts">
                    <span>1 Comments</span>
                    <span>0 Revisions</span>
                </div>
            </div>
            <div class="request-status-info">
                <span class="status-badge info" style="background: #e0f2fe; color: #0284c7;">Needs Information</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Omat armengolt</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.portal')
@section('title', 'Closed - Four Square Portal')
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
            <div class="request-meta-row">
                <span>Request #CLI-14-33793 | <span class="company-name">CliqStudios</span></span>
                <div class="star-rating">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <span class="time-spent">Time Spent: 05h 27m</span>
            </div>
            <div>Created on: 20 Mar, 2024 11:55 PM | Due: 20 Mar, 2024 | Last Updated: 22 Mar, 2024 09:42 PM | #1 <i class="far fa-copy" style="margin-left: 10px;"></i></div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-image" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">Test Kitchen</h3>
                <div class="request-counts"><span>4 Comments</span> | <span>0 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge closed">● Approved</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Keisha Sexton</span></div>
            </div>
        </div>
    </div>
    <!-- Item 2 -->
    <div class="request-item" style="margin-top: 2rem;">
        <div class="request-meta-header">
            <div class="request-meta-row">
                <span>Request #CLI-14-33805 | <span class="company-name">CliqStudios</span></span>
                <div class="star-rating">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
                <span class="time-spent">Time Spent: 04h 26m</span>
            </div>
            <div>Created on: 21 Mar, 2024 01:03 AM | Due: 20 Mar, 2024 | Last Updated: 27 Mar, 2024 06:51 PM | #2 <i class="far fa-copy" style="margin-left: 10px;"></i></div>
        </div>
        <div class="request-card">
            <div class="request-icon"><i class="fas fa-image" style="font-size: 2rem; color: #3b82f6;"></i></div>
            <div class="request-info">
                <h3 class="request-title">Cruz Test Kitchen</h3>
                <div class="request-counts"><span>3 Comments</span> | <span>0 Revisions</span></div>
            </div>
            <div class="request-status-info">
                <span class="status-badge closed">● Approved</span>
                <div class="designer-info">Designer: <span>Rutvik Vithalani</span></div>
                <div class="designer-info">Added By: <span>Cruz Acosta</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

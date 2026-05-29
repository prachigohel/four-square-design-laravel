@php
    $filterProjectTypes = \App\Models\DesignRequest::whereNotNull('project_type')->distinct()->pluck('project_type')->sort()->values();
    $filterClients = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Client'))->orderBy('name')->get();
    $hasActiveFilters = request()->hasAny(['title', 'request_number', 'type', 'company', 'created_by', 'date_from', 'date_to', 'due_from', 'due_to']);
@endphp
<div id="filterPanel" class="horizontal-filter-panel" style="{{ $hasActiveFilters ? '' : 'display: none;' }}">
    <form method="GET" action="{{ request()->url() }}" id="filterForm">
        <div class="filter-header-row">
            <span></span>
            <button type="button" id="closeFilter" class="close-filter-text">
                <i class="fas fa-times"></i> Filter & Refine
            </button>
        </div>

        <div class="filter-main-grid">
            <div class="filter-row">
                <div class="filter-group">
                    <label>Request Title:</label>
                    <input type="text" name="title" value="{{ request('title') }}" placeholder="Eg. kitchen..." class="filter-input">
                </div>
                <div class="filter-group">
                    <label>Request Number:</label>
                    <input type="text" name="request_number" value="{{ request('request_number') }}" placeholder="Eg. 37" class="filter-input">
                </div>
                <div class="filter-group">
                    <label>Request Type:</label>
                    <select name="type" class="filter-select">
                        <option value="">Select</option>
                        @foreach($filterProjectTypes as $pt)
                            <option value="{{ $pt }}" {{ request('type') === $pt ? 'selected' : '' }}>{{ $pt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Company:</label>
                    <input type="text" name="company" value="{{ request('company') }}" placeholder="Company or name..." class="filter-input">
                </div>
                <div class="filter-group">
                    <label>Created By:</label>
                    <select name="created_by" class="filter-select">
                        <option value="">Select</option>
                        @foreach($filterClients as $u)
                            <option value="{{ $u->id }}" {{ request('created_by') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="filter-row align-end">
                <div class="filter-group">
                    <label>Created On:</label>
                    <div class="date-range">
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="filter-date">
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="filter-date">
                    </div>
                </div>
                <div class="filter-group">
                    <label>Due Date:</label>
                    <div class="date-range">
                        <input type="date" name="due_from" value="{{ request('due_from') }}" class="filter-date">
                        <input type="date" name="due_to" value="{{ request('due_to') }}" class="filter-date">
                    </div>
                </div>
                <div class="filter-group checkbox-only">
                    <div class="custom-checkbox">
                        <input type="checkbox" id="anyUpdates" name="any_updates" value="1" {{ request('any_updates') ? 'checked' : '' }}>
                        <label for="anyUpdates">Any Updates</label>
                    </div>
                </div>
                <div class="filter-group action-group" style="display: flex; gap: 0.5rem;">
                    <button type="submit" class="apply-filter-btn">APPLY</button>
                    @if($hasActiveFilters)
                        <a href="{{ request()->url() }}" style="display: flex; align-items: center; justify-content: center; padding: 0 1rem; background: #f1f5f9; color: #64748b; border-radius: 8px; font-size: 0.78rem; font-weight: 700; text-decoration: none; white-space: nowrap;">Clear</a>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>

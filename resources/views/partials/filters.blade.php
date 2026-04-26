<div id="filterPanel" class="horizontal-filter-panel" style="display: none;">
    <div class="filter-header-row">
        <span></span>
        <button id="closeFilter" class="close-filter-text">
            <i class="fas fa-times"></i> Filter & Refine
        </button>
    </div>
    
    <div class="filter-main-grid">
        <div class="filter-row">
            <div class="filter-group">
                <label>Request Title:</label>
                <input type="text" placeholder="Eg. kitchen..." class="filter-input">
            </div>
            <div class="filter-group">
                <label>Request Number:</label>
                <input type="text" placeholder="Eg. #CP-37-254..." class="filter-input">
            </div>
            <div class="filter-group">
                <label>Request Type:</label>
                <select class="filter-select">
                    <option>Select</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Company:</label>
                <select class="filter-select">
                    <option>Select</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Created By:</label>
                <select class="filter-select">
                    <option>Select</option>
                </select>
            </div>
        </div>

        <div class="filter-row align-end">
            <div class="filter-group">
                <label>Created On:</label>
                <div class="date-range">
                    <input type="date" class="filter-date">
                    <input type="date" class="filter-date">
                </div>
            </div>
            <div class="filter-group">
                <label>Due Date:</label>
                <div class="date-range">
                    <input type="date" class="filter-date">
                    <input type="date" class="filter-date">
                </div>
            </div>
            <div class="filter-group checkbox-only">
                <div class="custom-checkbox">
                    <input type="checkbox" id="anyUpdates">
                    <label for="anyUpdates">Any Updates</label>
                </div>
            </div>
            <div class="filter-group action-group">
                <button class="apply-filter-btn">APPLY</button>
            </div>
        </div>
    </div>
</div>

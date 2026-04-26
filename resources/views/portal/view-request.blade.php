@extends('layouts.portal')

@section('title', 'View Request #REN-797-36637 - Kitchen365 Portal')

@section('content')
<div class="view-request-container">
    <!-- Header Section -->
    <div class="view-header">
        <div class="header-main">
            <div class="project-info">
                <h1 class="project-title">Rakowski master bath</h1>
                <div class="request-meta">
                    <span class="request-id">Request #REN-797-36637</span>
                    <span class="meta-divider">|</span>
                    <span class="company-name">Renovativ Remodeling, LLC</span>
                </div>
            </div>
            <div class="header-actions">
                <span class="status-badge approval">● Needs Approval</span>
                <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;"><i class="fas fa-edit"></i> EDIT</button>
            </div>
        </div>
        <div class="header-dates">
            <div class="date-item">
                <span class="date-label">Created on:</span>
                <span class="date-value">20 May, 2024 08:51 PM</span>
            </div>
            <div class="date-item">
                <span class="date-label">Due Date:</span>
                <span class="date-value">17 May, 2024</span>
            </div>
            <div class="date-item">
                <span class="date-label">Last Updated:</span>
                <span class="date-value">1 Aug, 2024 07:52 PM</span>
            </div>
            <div class="rev-v">#1</div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="details-grid-wrapper">
        <div class="details-card main-details">
            <div class="card-header">
                <h3><i class="fas fa-info-circle"></i> Request Details</h3>
            </div>
            <div class="details-content">
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Request Type</span>
                        <span class="detail-value">Full Package</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Cabinet Brand</span>
                        <span class="detail-value">Legacy Cabinetry Presidential</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Door Style</span>
                        <span class="detail-value">Oxford FO-V Maple D</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Ceiling Height</span>
                        <span class="detail-value">96 inches</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Wall Cabinet Height</span>
                        <span class="detail-value">36 inches</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Soffits</span>
                        <span class="detail-value">No</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="details-card assets-card">
            <div class="card-header">
                <h3><i class="fas fa-paperclip"></i> Measurements & Assets</h3>
            </div>
            <div class="assets-content">
                <div class="asset-item">
                    <div class="asset-preview">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="asset-info">
                        <span class="asset-name">Floor_Plan.pdf</span>
                        <a href="#" class="asset-download"><i class="fas fa-download"></i></a>
                    </div>
                </div>
                <div class="asset-item">
                    <div class="asset-preview img-preview">
                        <img src="https://via.placeholder.com/100x100?text=K" alt="Kitchen Preview">
                    </div>
                    <div class="asset-info">
                        <span class="asset-name">Existing_Kitchen.jpg</span>
                        <a href="#" class="asset-download"><i class="fas fa-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info Sections -->
    <div class="form-section active" style="margin-top: 2rem;">
        <div class="section-header">
            <div class="section-title-group">
                <div class="status-icon"><i class="fas fa-list-check"></i></div>
                <div>
                    <h2 class="section-title">Additional Information</h2>
                    <p class="section-subtitle">Molding, Appliances, Storage, and Notes</p>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="info-grid">
                <div class="info-group">
                    <h4>Molding & Doors</h4>
                    <ul class="info-list">
                        <li><i class="fas fa-check"></i> Scribe Molding</li>
                        <li><i class="fas fa-check"></i> Scribe & Shoe Molding</li>
                        <li><i class="fas fa-check"></i> Base Molding</li>
                    </ul>
                </div>
                <div class="info-group">
                    <h4>Standard Appliances</h4>
                    <ul class="info-list">
                        <li><i class="fas fa-check"></i> Refrigerator</li>
                        <li><i class="fas fa-check"></i> Dishwasher</li>
                        <li><i class="fas fa-check"></i> Microwave</li>
                    </ul>
                </div>
                <div class="info-group">
                    <h4>Storage & Organizer</h4>
                    <ul class="info-list">
                        <li><i class="fas fa-check"></i> Waste Basket</li>
                        <li><i class="fas fa-check"></i> Lazy Susan</li>
                    </ul>
                </div>
                <div class="info-group full-width" style="margin-top: 1rem;">
                    <h4>Additional Notes</h4>
                    <div class="notes-content">
                        <p>Client wants the island to be a dark contrast to the perimeter cabinets. Please ensure 3D renderings show lighting clearly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Communication Pipeline -->
    <div class="communications-section">
        <div class="card-header">
            <h3><i class="fas fa-comments"></i> Communications & Activity</h3>
        </div>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-icon user-icon">YA</div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <span class="sender-name">Yakout B</span>
                        <span class="timestamp">9 Apr, 2026 10:46 PM</span>
                    </div>
                    <div class="timeline-body">
                        <p>Uploaded initial design for review. Please check the cabinet list and quote.</p>
                        <div class="timeline-attachments">
                            <a href="#" class="attachment-chip"><i class="fas fa-file-excel"></i> Cabinet_List.csv</a>
                            <a href="#" class="attachment-chip"><i class="fas fa-file-invoice-dollar"></i> Quote_73376.pdf</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-item revision-item">
                <div class="timeline-icon status-icon"><i class="fas fa-sync-alt"></i></div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <span class="sender-name">Revision Requested</span>
                        <span class="timestamp">11 Apr, 2026 09:12 AM</span>
                    </div>
                    <div class="timeline-body">
                        <p>Change requested by client:</p>
                        <ul class="revision-instructions">
                            <li>Move dishwasher to the right of the sink.</li>
                            <li>Increase wall cabinet height to 42".</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Comment Section -->
    <div class="add-comment-section">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Comment</h3>
        </div>
        <div class="comment-input-wrapper">
            <textarea placeholder="Write your comment here..." rows="4" class="form-input"></textarea>
            <div class="comment-actions">
                <button class="attachment-btn"><i class="fas fa-paperclip"></i> ATTACH FILE</button>
                <div class="comment-meta-switches">
                    <label class="custom-checkbox">
                        <input type="checkbox"> <span>Mark as Internal</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="view-footer">
        <a href="{{ route('portal.dashboard') }}" class="btn btn-outline">BACK TO LIST</a>
        <div class="action-group">
             <button class="btn btn-save">ADD COMMENT</button>
             <button class="btn btn-submit">APPROVE DESIGN</button>
        </div>
    </div>
</div>

<style>
    .view-request-container {
        max-width: 1200px;
        margin: 0 auto;
        padding-bottom: 5rem;
    }

    .view-header {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .header-main {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 1.5rem;
    }

    .project-title {
        font-size: 2rem;
        font-family: var(--font-heading);
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }

    .request-meta {
        font-size: 0.9rem;
        color: var(--text-muted);
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .company-name {
        color: var(--primary-color);
        font-weight: 700;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .header-dates {
        display: flex;
        gap: 3rem;
        font-size: 0.85rem;
        color: var(--text-muted);
        flex-wrap: wrap;
    }

    .date-label {
        font-weight: 700;
        color: var(--secondary-color);
        margin-right: 0.5rem;
    }

    .rev-v {
        margin-left: auto;
        font-weight: 900;
        background: #f1f5f9;
        padding: 0.2rem 0.6rem;
        border-radius: 4px;
        color: var(--secondary-color);
    }

    .details-grid-wrapper {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .details-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 1rem;
    }

    .card-header h3 {
        font-size: 1.1rem;
        font-family: var(--font-body);
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-header i {
        color: var(--primary-color);
    }

    .detail-row {
        display: flex;
        gap: 2rem;
        margin-bottom: 1.5rem;
    }

    .detail-item {
        flex: 1;
    }

    .detail-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 0.4rem;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 1rem;
        font-weight: 600;
        color: var(--secondary-color);
    }

    .assets-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .asset-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #f8fafc;
        padding: 0.75rem;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .asset-preview {
        width: 48px;
        height: 48px;
        background: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #ef4444;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .asset-preview.img-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .asset-info {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .asset-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--secondary-color);
    }

    .asset-download {
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .info-group h4 {
        font-size: 0.9rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: var(--secondary-color);
    }

    .info-list {
        list-style: none;
        padding: 0;
    }

    .info-list li {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-list li i {
        color: #10b981;
        font-size: 0.8rem;
    }

    .notes-content {
        background: #fff9f0;
        padding: 1rem;
        border-radius: 8px;
        border-left: 4px solid var(--primary-color);
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .communications-section {
        margin-top: 2rem;
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .timeline {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        position: relative;
        padding-left: 2rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #f1f5f9;
    }

    .timeline-item {
        position: relative;
    }

    .timeline-icon {
        position: absolute;
        left: -2.35rem;
        top: 0;
        width: 32px;
        height: 32px;
        background: #fff;
        border: 2px solid #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 800;
        z-index: 1;
    }

    .user-icon {
        background: #00e0c6;
        color: #fff;
        border-color: #00e0c6;
    }

    .timeline-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .sender-name {
        font-weight: 800;
        font-size: 0.95rem;
        color: var(--secondary-color);
    }

    .timestamp {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .timeline-body {
        font-size: 0.95rem;
        color: var(--text-main);
        line-height: 1.5;
    }

    .timeline-attachments {
        margin-top: 1rem;
        display: flex;
        gap: 0.75rem;
    }

    .attachment-chip {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #eff6ff;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #1e40af;
        text-decoration: none;
        border: 1px solid #dbeafe;
    }

    .attachment-chip i {
        font-size: 1rem;
    }

    .revision-item .timeline-icon {
        background: #fef3c7;
        color: #92400e;
        border-color: #fde68a;
    }

    .revision-instructions {
        margin: 1rem 0 0 1.5rem;
        color: #92400e;
        font-weight: 600;
    }

    .add-comment-section {
        margin-top: 2rem;
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .comment-input-wrapper {
        margin-top: 1rem;
    }

    .comment-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }

    .attachment-btn {
        background: #f1f5f9;
        border: 1px dashed var(--border-color);
        padding: 0.6rem 1rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--text-muted);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .attachment-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .view-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
    }

    .action-group {
        display: flex;
        gap: 1rem;
    }

    @media (max-width: 992px) {
        .details-grid-wrapper {
            grid-template-columns: 1fr;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

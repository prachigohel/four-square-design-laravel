@extends('layouts.portal')

@section('title', 'Manage POCs - Four Square Portal')

@section('content')
<div class="submit-request-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="font-family: var(--font-heading); color: var(--secondary-color);">Manage Point of Contacts</h2>
        <button class="new-request-btn" onclick="document.getElementById('addPocModal').style.display='block'">+ ADD POC</button>
    </div>

    <div class="request-list">
        @foreach($pocs as $poc)
        <div class="request-item">
            <div class="request-card" style="align-items: center;">
                <div class="request-icon" style="background: #f1f5f9;">
                    <i class="fas fa-user-tie" style="font-size: 1.5rem; color: var(--primary-color);"></i>
                </div>
                <div class="request-info">
                    <h3 class="request-title" style="margin-bottom: 0.25rem;">{{ $poc->name }}</h3>
                    <div style="font-size: 0.85rem; color: var(--text-muted);">
                        <i class="fas fa-envelope" style="width: 16px;"></i> {{ $poc->email }}
                        @if($poc->phone) | <i class="fas fa-phone" style="width: 16px;"></i> {{ $poc->phone }} @endif
                    </div>
                </div>
                <div class="request-status-info">
                    <span class="status-badge" style="background: #fef3c7; color: #92400e;">{{ $poc->tag ?? 'Project Manager' }}</span>
                    <form action="{{ route('portal.masters.pocs.destroy', $poc->id) }}" method="POST" style="margin-top: 0.5rem;" onsubmit="return confirm('Are you sure you want to remove this POC?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem; font-weight: 600;">
                            <i class="fas fa-trash-alt"></i> REMOVE
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        @if(count($pocs) == 0)
            <div style="text-align: center; padding: 4rem; background: #fff; border-radius: 12px; border: 1px dashed var(--border-color);">
                <p style="color: var(--text-muted);">No Point of Contacts found. Add one to show in the client portal.</p>
            </div>
        @endif
    </div>
</div>

<!-- Add POC Modal -->
<div id="addPocModal" class="modal">
    <div class="modal-content profile-modal" style="max-width: 500px;">
        <span class="close-modal" onclick="document.getElementById('addPocModal').style.display='none'">&times;</span>
        <h2 class="modal-title">Add New POC</h2>
        <form action="{{ route('portal.masters.pocs.store') }}" method="POST" class="profile-form">
            @csrf
            <div class="form-group">
                <label>Full Name*</label>
                <input type="text" name="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Email Address*</label>
                <input type="email" name="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-input" placeholder="+1-xxx-xxx-xxxx">
            </div>
            <div class="form-group">
                <label>Tag (Designation)</label>
                <input type="text" name="tag" class="form-input" placeholder="e.g. Project Manager">
            </div>
            <button type="submit" class="update-detail-btn">SAVE POC</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.portal')
@section('title', 'Prioritized Requests - FourSquareDesign Portal')
@section('content')
<div class="page-header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <a href="{{ route('portal.submit-request') }}" style="text-decoration: none;">
        <button class="new-request-btn"><i class="fas fa-plus"></i> NEW REQUEST</button>
    </a>
</div>

<div class="empty-state-card">
    <div class="empty-state-content">
        <h3>You have no request assigned</h3>
        <p>Please check with your assign client or project manager for further allocations</p>
    </div>
</div>
@endsection

@section('styles')
<style>
    .empty-state-card {
        background: #f8fafc;
        border-radius: 12px;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
    }
    .empty-state-content {
        text-align: center;
    }
    .empty-state-content h3 {
        font-family: 'Inter', sans-serif;
        font-size: 1.5rem;
        font-weight: 500;
        color: #020617;
        margin-bottom: 0.75rem;
    }
    .empty-state-content p {
        color: #64748b;
        font-size: 1.1rem;
    }
</style>
@endsection

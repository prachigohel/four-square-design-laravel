@extends('layouts.portal')

@section('title', 'All Clients - FourSquareDesign Portal')

@section('content')
<div class="clients-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>All Clients</h2>
    <button class="standard-btn" onclick="document.getElementById('addClientModal').style.display='block'">Add Client</button>
</div>

@if(session('success'))
    <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@endif

<div class="clients-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
    @foreach($clients as $client)
    <div class="client-card" style="background: #fff; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: flex-start; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <div class="client-info">
            <h3 class="client-company" style="font-family: var(--font-body); font-weight: 800; font-size: 1.1rem; color: #020617; margin-bottom: 0.25rem;">{{ $client->company_name ?? 'Individual' }}</h3>
            <p class="client-name" style="font-size: 0.85rem; color: #64748b; margin-bottom: 1rem;">{{ $client->name }}</p>
            <div class="requests-line" style="font-size: 0.85rem; font-weight: 700; color: #fab133;">Total Open Requests: <span class="requests-count">{{ $client->requests_count }}</span></div>
        </div>
        <button class="standard-btn" style="background: #f1f5f9; color: #475569; border: none; font-size: 0.75rem; padding: 0.4rem 0.8rem;">Standard</button>
    </div>
    @endforeach
</div>

<!-- Add Client Modal -->
<div id="addClientModal" class="modal">
    <div class="modal-content profile-modal">
        <span class="close-modal" onclick="document.getElementById('addClientModal').style.display='none'">&times;</span>
        <h2 class="modal-title" style="margin-bottom: 1.5rem; color: var(--text-dark); font-family: 'Playfair Display', serif;">Add New Client</h2>
        
        <form method="POST" action="{{ route('portal.clients.store') }}" class="profile-form">
            @csrf
            <div class="form-group" style="margin-bottom: 1rem;">
                <label>Client Name <span class="required-star">*</span></label>
                <input type="text" name="name" class="form-input" required>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label>Contact Name</label>
                <input type="text" name="contact" class="form-input">
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label>Email Address <span class="required-star">*</span></label>
                <input type="email" name="email" class="form-input" required>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label>Assign Manager</label>
                <select name="manager_id" class="form-input">
                    <option value="">No Manager</option>
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="standard-btn" style="width: 100%; justify-content: center; margin-top: 1rem;">CREATE CLIENT</button>
        </form>
    </div>
</div>

<script>
    // Close modal if clicked outside
    window.addEventListener('click', function(e) {
        let modal = document.getElementById('addClientModal');
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    });
</script>
@endsection

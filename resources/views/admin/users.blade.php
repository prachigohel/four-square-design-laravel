@extends('layouts.portal')
@section('title', 'User Management - Four Square Desigsn Portal')

@section('styles')
<style>
    .users-wrap { max-width: 1200px; }

    /* ── Page header ── */
    .page-head {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
    }
    .page-head h1 { font-size: 1.5rem; font-weight: 800; color: var(--secondary-color); margin: 0; }
    .page-head p  { font-size: 0.82rem; color: var(--text-muted); margin: 0.2rem 0 0; }

    /* ── Role tabs ── */
    .role-tabs { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.75rem; }
    .role-tab {
        padding: 0.4rem 1rem; border-radius: 999px; font-size: 0.78rem; font-weight: 700;
        cursor: pointer; border: 1.5px solid #e2e8f0; background: #f8fafc;
        color: #64748b; transition: all 0.15s;
    }
    .role-tab.active, .role-tab:hover { background: var(--secondary-color); color: #fff; border-color: var(--secondary-color); }

    /* ── User table ── */
    .user-table-wrap {
        background: #fff; border-radius: 14px; border: 1px solid var(--border-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 2rem;
    }
    .user-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .user-table th {
        background: #f8fafc; padding: 0.85rem 1.25rem; text-align: left;
        font-size: 0.72rem; font-weight: 800; text-transform: uppercase;
        letter-spacing: 0.06em; color: #64748b; border-bottom: 1px solid #e2e8f0;
    }
    .user-table td {
        padding: 0.9rem 1.25rem; border-bottom: 1px solid #f1f5f9;
        vertical-align: middle; color: #334155;
    }
    .user-table tr:last-child td { border-bottom: none; }
    .user-table tr:hover td { background: #fafbff; }

    /* ── Avatar ── */
    .user-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--secondary-color); color: #fab133;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 0.78rem; font-weight: 800; flex-shrink: 0;
    }
    .user-name-cell { display: flex; align-items: center; gap: 0.75rem; }
    .user-name { font-weight: 700; color: var(--secondary-color); font-size: 0.88rem; }
    .user-email { font-size: 0.77rem; color: var(--text-muted); }

    /* ── Role badge ── */
    .role-badge {
        display: inline-block; padding: 0.2rem 0.65rem; border-radius: 999px;
        font-size: 0.68rem; font-weight: 700; letter-spacing: 0.04em; white-space: nowrap;
    }
    .role-admin    { background: #fef2f2; color: #b91c1c; }
    .role-manager  { background: #ede9fe; color: #6d28d9; }
    .role-designer { background: #eff6ff; color: #1d4ed8; }
    .role-client   { background: #f0fdf4; color: #166534; }
    .role-default  { background: #f1f5f9; color: #475569; }

    .company-role-badge {
        display: inline-block; padding: 0.15rem 0.5rem; border-radius: 999px;
        font-size: 0.65rem; font-weight: 700; letter-spacing: 0.04em; white-space: nowrap; margin-left: 0.3rem;
    }
    .crole-manager  { background: #fef9ec; color: #92400e; border: 1px solid #fde68a; }
    .crole-employee { background: #f0f9ff; color: #075985; border: 1px solid #bae6fd; }

    /* ── Action buttons ── */
    .btn-edit, .btn-delete {
        padding: 0.35rem 0.8rem; border-radius: 6px; font-size: 0.75rem;
        font-weight: 700; border: none; cursor: pointer; transition: opacity 0.15s;
    }
    .btn-edit   { background: #eff6ff; color: #1d4ed8; }
    .btn-delete { background: #fef2f2; color: #b91c1c; }
    .btn-edit:hover, .btn-delete:hover { opacity: 0.75; }

    /* ── Empty state ── */
    .empty-row td { text-align: center; padding: 2.5rem; color: #94a3b8; font-style: italic; font-size: 0.85rem; }

    /* ── Modal ── */
    .modal-overlay {
        display: none; position: fixed; inset: 0; z-index: 1000;
        background: rgba(0,0,0,0.45); backdrop-filter: blur(4px);
        align-items: center; justify-content: center; padding: 1rem;
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
        background: #fff; border-radius: 16px; width: 100%; max-width: 540px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.2); max-height: 90vh; overflow-y: auto;
    }
    .modal-header {
        padding: 1.5rem 1.75rem 1rem; border-bottom: 1px solid #f1f5f9;
        display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; background: #fff; z-index: 1;
    }
    .modal-header h2 { font-size: 1.15rem; font-weight: 800; color: var(--secondary-color); margin: 0; }
    .modal-close { background: none; border: none; font-size: 1.3rem; color: #94a3b8; cursor: pointer; line-height: 1; }
    .modal-close:hover { color: var(--secondary-color); }
    .modal-body { padding: 1.5rem 1.75rem; }
    .modal-footer { padding: 1rem 1.75rem 1.5rem; display: flex; gap: 0.75rem; justify-content: flex-end; border-top: 1px solid #f1f5f9; }

    .mform-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
    .mform-group { margin-bottom: 1rem; }
    .mform-group label {
        display: block; font-size: 0.75rem; font-weight: 700; color: #374151;
        text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.4rem;
    }
    .mform-group .req { color: var(--primary-color); }
    .mform-input {
        width: 100%; padding: 0.65rem 0.85rem; border: 1.5px solid #e2e8f0;
        border-radius: 8px; background: #f8fafc; font-size: 0.88rem;
        color: var(--secondary-color); transition: border-color 0.15s, box-shadow 0.15s;
        box-sizing: border-box;
    }
    .mform-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(250,177,51,0.15); background: #fff; }

    /* ── Add button ── */
    .btn-add-user {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: var(--secondary-color); color: #fab133;
        padding: 0.6rem 1.25rem; border-radius: 8px; border: none;
        font-size: 0.82rem; font-weight: 800; cursor: pointer;
        letter-spacing: 0.04em; text-transform: uppercase; transition: opacity 0.15s;
    }
    .btn-add-user:hover { opacity: 0.85; }

    /* ── Flash alerts ── */
    .flash-success, .flash-error {
        padding: 0.85rem 1.25rem; border-radius: 10px; font-size: 0.88rem;
        font-weight: 600; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;
    }
    .flash-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
    .flash-error   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    @media (max-width: 640px) {
        .mform-row { grid-template-columns: 1fr; }
        .user-table { font-size: 0.78rem; }
        .user-table th, .user-table td { padding: 0.7rem 0.75rem; }
    }
</style>
@endsection

@section('content')
<div class="users-wrap">

    {{-- Page header --}}
    <div class="page-head">
        <div>
            <h1>User Management</h1>
            <p>Add, edit, and manage all portal users and their roles.</p>
        </div>
        <button class="btn-add-user" onclick="openModal('addUserModal')">
            <i class="fas fa-plus"></i> Add User
        </button>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    {{-- Role tabs --}}
    @php
        $roleOrder = ['Admin', 'Manager', 'Designer', 'Client'];
        $allUsers  = $users->collapse();
        $tabCounts = $users->map->count();
    @endphp
    <div class="role-tabs">
        <button class="role-tab active" onclick="filterRole('all', this)">
            All <span style="font-weight:400;">({{ $allUsers->count() }})</span>
        </button>
        @foreach($roleOrder as $rName)
            @if(isset($users[$rName]) && $users[$rName]->count())
            <button class="role-tab" onclick="filterRole('{{ $rName }}', this)">
                {{ $rName }} <span style="font-weight:400;">({{ $users[$rName]->count() }})</span>
            </button>
            @endif
        @endforeach
    </div>

    {{-- Users table --}}
    <div class="user-table-wrap">
        <table class="user-table" id="userTable">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Joined</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allUsers as $u)
                @php
                    $roleName  = $u->role->name ?? 'No Role';
                    $roleClass = match($roleName) {
                        'Admin'    => 'role-admin',
                        'Manager'  => 'role-manager',
                        'Designer' => 'role-designer',
                        'Client'   => 'role-client',
                        default    => 'role-default',
                    };
                    $initials = collect(explode(' ', $u->name))->map(fn($w) => strtoupper($w[0] ?? ''))->take(2)->implode('');
                @endphp
                <tr data-role="{{ $roleName }}">
                    <td>
                        <div class="user-name-cell">
                            <span class="user-avatar">{{ $initials }}</span>
                            <div>
                                <div class="user-name">{{ $u->name }}</div>
                                <div class="user-email">{{ $u->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="role-badge {{ $roleClass }}">{{ $roleName }}</span>
                        @if($roleName === 'Client' && $u->company_role)
                            <span class="company-role-badge {{ $u->company_role === 'manager' ? 'crole-manager' : 'crole-employee' }}">
                                {{ ucfirst($u->company_role) }}
                            </span>
                        @endif
                    </td>
                    <td>{{ $u->phone ?? '—' }}</td>
                    <td>{{ $u->company_name ?? '—' }}</td>
                    <td style="color:#94a3b8; font-size:0.78rem;">{{ $u->created_at->format('d M Y') }}</td>
                    <td style="text-align:right; white-space:nowrap;">
                        <button class="btn-edit" onclick="openEdit({{ $u->id }}, '{{ addslashes($u->name) }}', '{{ $u->email }}', {{ $u->role_id }}, '{{ $u->phone ?? '' }}', '{{ addslashes($u->company_name ?? '') }}', {{ $u->manager_id ?? 'null' }}, '{{ $u->company_role ?? '' }}')">
                            <i class="fas fa-pen"></i> Edit
                        </button>
                        @if($u->id !== auth()->id())
                        <form action="{{ route('portal.users.destroy', $u->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete {{ addslashes($u->name) }}? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="6">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- ══════════ ADD USER MODAL ══════════ --}}
<div class="modal-overlay" id="addUserModal">
    <div class="modal-box">
        <div class="modal-header">
            <h2><i class="fas fa-user-plus" style="color:var(--primary-color);margin-right:0.5rem;"></i>Add New User</h2>
            <button class="modal-close" onclick="closeModal('addUserModal')">&times;</button>
        </div>
        <form action="{{ route('portal.users.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mform-row">
                    <div class="mform-group">
                        <label>Full Name <span class="req">*</span></label>
                        <input type="text" name="name" class="mform-input" placeholder="John Doe" required value="{{ old('name') }}">
                        @error('name')<span style="color:#ef4444;font-size:0.74rem;">{{ $message }}</span>@enderror
                    </div>
                    <div class="mform-group">
                        <label>Email Address <span class="req">*</span></label>
                        <input type="email" name="email" class="mform-input" placeholder="john@example.com" required value="{{ old('email') }}">
                        @error('email')<span style="color:#ef4444;font-size:0.74rem;">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mform-row">
                    <div class="mform-group">
                        <label>Password <span class="req">*</span></label>
                        <input type="password" name="password" class="mform-input" placeholder="Min. 8 characters" required>
                        @error('password')<span style="color:#ef4444;font-size:0.74rem;">{{ $message }}</span>@enderror
                    </div>
                    <div class="mform-group">
                        <label>Confirm Password <span class="req">*</span></label>
                        <input type="password" name="password_confirmation" class="mform-input" placeholder="Repeat password" required>
                    </div>
                </div>
                <div class="mform-row">
                    <div class="mform-group">
                        <label>Role <span class="req">*</span></label>
                        <select name="role_id" class="mform-input" required id="addRoleSelect" onchange="toggleManagerField('add', this.value)" >
                            <option value="">Select role…</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')<span style="color:#ef4444;font-size:0.74rem;">{{ $message }}</span>@enderror
                    </div>
                    <div class="mform-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="mform-input" placeholder="+1 234 567 8900" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="mform-group">
                    <label>Company / Organisation</label>
                    <input type="text" name="company_name" class="mform-input" placeholder="Company name (optional)" value="{{ old('company_name') }}">
                </div>
                <div class="mform-row" id="addClientFields" style="display:none;">
                    <div class="mform-group">
                        <label>Company Role <span style="font-weight:400;text-transform:none;font-size:0.7rem;">(for Client role)</span></label>
                        <select name="company_role" class="mform-input">
                            <option value="">Not set</option>
                            <option value="manager" {{ old('company_role') === 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="employee" {{ old('company_role') === 'employee' ? 'selected' : '' }}>Employee</option>
                        </select>
                    </div>
                    <div class="mform-group">
                        <label>Assign Manager <span style="font-weight:400;text-transform:none;font-size:0.7rem;">(optional)</span></label>
                        <select name="manager_id" class="mform-input">
                            <option value="">No Manager</option>
                            @foreach($managers as $mgr)
                                <option value="{{ $mgr->id }}">{{ $mgr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('addUserModal')">Cancel</button>
                <button type="submit" class="btn btn-save">Create User</button>
            </div>
        </form>
    </div>
</div>

{{-- ══════════ EDIT USER MODAL ══════════ --}}
<div class="modal-overlay" id="editUserModal">
    <div class="modal-box">
        <div class="modal-header">
            <h2><i class="fas fa-user-edit" style="color:var(--primary-color);margin-right:0.5rem;"></i>Edit User</h2>
            <button class="modal-close" onclick="closeModal('editUserModal')">&times;</button>
        </div>
        <form action="" method="POST" id="editUserForm">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="mform-row">
                    <div class="mform-group">
                        <label>Full Name <span class="req">*</span></label>
                        <input type="text" name="name" id="editName" class="mform-input" required>
                    </div>
                    <div class="mform-group">
                        <label>Email Address <span class="req">*</span></label>
                        <input type="email" name="email" id="editEmail" class="mform-input" required>
                    </div>
                </div>
                <div class="mform-row">
                    <div class="mform-group">
                        <label>New Password <span style="font-weight:400;text-transform:none;font-size:0.7rem;">(leave blank to keep)</span></label>
                        <input type="password" name="password" class="mform-input" placeholder="New password">
                    </div>
                    <div class="mform-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="mform-input" placeholder="Repeat new password">
                    </div>
                </div>
                <div class="mform-row">
                    <div class="mform-group">
                        <label>Role <span class="req">*</span></label>
                        <select name="role_id" id="editRole" class="mform-input" required onchange="toggleManagerField('edit', this.value)">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mform-group">
                        <label>Phone</label>
                        <input type="text" name="phone" id="editPhone" class="mform-input" placeholder="+1 234 567 8900">
                    </div>
                </div>
                <div class="mform-group">
                    <label>Company / Organisation</label>
                    <input type="text" name="company_name" id="editCompany" class="mform-input" placeholder="Company name (optional)">
                </div>
                <div class="mform-row" id="editClientFields" style="display:none;">
                    <div class="mform-group">
                        <label>Company Role <span style="font-weight:400;text-transform:none;font-size:0.7rem;">(for Client role)</span></label>
                        <select name="company_role" id="editCompanyRole" class="mform-input">
                            <option value="">Not set</option>
                            <option value="manager">Manager</option>
                            <option value="employee">Employee</option>
                        </select>
                    </div>
                    <div class="mform-group">
                        <label>Assign Manager <span style="font-weight:400;text-transform:none;font-size:0.7rem;">(optional)</span></label>
                        <select name="manager_id" id="editManager" class="mform-input">
                            <option value="">No Manager</option>
                            @foreach($managers as $mgr)
                                <option value="{{ $mgr->id }}">{{ $mgr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('editUserModal')">Cancel</button>
                <button type="submit" class="btn btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    const clientRoleId = {{ $roles->firstWhere('name', 'Client')?->id ?? 'null' }};

    function openModal(id) {
        document.getElementById(id).classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.modal-overlay').forEach(el => {
        el.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });

    function filterRole(role, btn) {
        document.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('#userTable tbody tr[data-role]').forEach(row => {
            row.style.display = (role === 'all' || row.dataset.role === role) ? '' : 'none';
        });
    }

    function toggleManagerField(prefix, roleId) {
        const isClient = parseInt(roleId) === clientRoleId;
        const fields = document.getElementById(prefix + 'ClientFields');
        if (fields) fields.style.display = isClient ? 'grid' : 'none';
    }

    function openEdit(id, name, email, roleId, phone, company, managerId, companyRole) {
        document.getElementById('editUserForm').action = '/portal/users/' + id;
        document.getElementById('editName').value    = name;
        document.getElementById('editEmail').value   = email;
        document.getElementById('editRole').value    = roleId;
        document.getElementById('editPhone').value   = phone;
        document.getElementById('editCompany').value = company;
        const mgSel = document.getElementById('editManager');
        if (mgSel) mgSel.value = managerId ?? '';
        const crSel = document.getElementById('editCompanyRole');
        if (crSel) crSel.value = companyRole ?? '';
        toggleManagerField('edit', roleId);
        openModal('editUserModal');
    }

    @if($errors->any() && old('_method') === null)
        openModal('addUserModal');
    @endif
</script>
@endsection
@endsection

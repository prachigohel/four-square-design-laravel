@extends('layouts.portal')

@section('title', 'View Request #' . $request->request_number . ' - Four Square Design Portal')

@section('content')
<div class="view-request-container">
    <!-- Header Section -->
    <div class="view-header">
        <div class="header-main">
            <div class="project-info">
                <h1 class="project-title">{{ $request->title }}</h1>
                <div class="request-meta">
                    <span class="request-id">Request #{{ $request->request_number }}</span>
                    <span class="meta-divider">|</span>
                    <span class="company-name">{{ $request->client->name ?? 'Unknown Client' }}</span>
                </div>
            </div>
            <div class="header-actions">
                <span class="status-badge" style="background: var(--primary-color); color: white; padding: 0.5rem 1rem; border-radius: 999px; font-weight: 700;">● {{ $request->status }}</span>
                @if(!in_array(auth()->user()->role->name ?? '', ['Designer', 'Client', 'Manager']))
                <form action="{{ route('portal.requests.prioritize', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @if($request->is_prioritized)
                        <button type="submit" style="padding: 0.5rem 1rem; font-size: 0.8rem; background: #1e40af; color: #fff; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; letter-spacing: 0.3px;">
                            <i class="fas fa-star"></i> Prioritized
                        </button>
                    @else
                        <button type="submit" style="padding: 0.5rem 1rem; font-size: 0.8rem; background: #3b82f6; color: #fff; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; letter-spacing: 0.3px;">
                            <i class="far fa-star"></i> Prioritize this Request
                        </button>
                    @endif
                </form>
                @endif
            </div>
        </div>
        <div class="header-dates">
            <div class="date-item">
                <span class="date-label">Created on:</span>
                <span class="date-value" data-utc="{{ $request->created_at->toISOString() }}">{{ $request->created_at->format('d M, Y h:i A') }}</span>
            </div>
            <div class="date-item">
                <span class="date-label">Due Date:</span>
                <span class="date-value">{{ $request->expected_date ? $request->expected_date->format('d M, Y') : 'Not Set' }}</span>
            </div>
            <div class="date-item">
                <span class="date-label">Last Updated:</span>
                <span class="date-value" data-utc="{{ $request->updated_at->toISOString() }}">{{ $request->updated_at->format('d M, Y h:i A') }}</span>
            </div>
            <div class="rev-v">#1</div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert-success-banner">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert-error-banner">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    @php
        $revisionCount = $request->comments->where('type', 'revision')->count();
        $designErrorCount = $request->comments->where('type', 'status_change')->filter(fn($c) => str_contains($c->message ?? '', 'Design Error'))->count();
        $statusMeta = [
            'Queued'               => ['label' => 'Queued',               'bg' => '#f3f4f6', 'color' => '#6b7280'],
            'Assigned'             => ['label' => 'Assigned',             'bg' => '#ede9fe', 'color' => '#7c3aed'],
            'In Progress'          => ['label' => 'In Progress',          'bg' => '#eff6ff', 'color' => '#3b82f6'],
            'Needs Information'    => ['label' => 'Needs Information',    'bg' => '#fffbeb', 'color' => '#d97706'],
            'Information Submitted'=> ['label' => 'Information Submitted','bg' => '#f0fdf4', 'color' => '#15803d'],
            'To Be Continued'      => ['label' => 'To Be Continued',      'bg' => '#fefce8', 'color' => '#a16207'],
            'Needs Approval'       => ['label' => 'Needs Approval',       'bg' => '#ecfdf5', 'color' => '#059669'],
            'Revision Requested'   => ['label' => 'Revision Requested',   'bg' => '#fff7ed', 'color' => '#c2410c'],
            'Design Error'         => ['label' => 'Design Error',         'bg' => '#fef2f2', 'color' => '#b91c1c'],
            'Approved'             => ['label' => 'Approved',             'bg' => '#f0fdf4', 'color' => '#166534'],
            'Project Completed'    => ['label' => 'Project Completed',    'bg' => '#020617', 'color' => '#fab133'],
            'Closed'               => ['label' => 'Closed',               'bg' => '#f1f5f9', 'color' => '#475569'],
            'Draft'                => ['label' => 'Draft',                'bg' => '#f9fafb', 'color' => '#9ca3af'],
        ];
        $sm = $statusMeta[$request->status] ?? ['label' => $request->status, 'bg' => '#f3f4f6', 'color' => '#6b7280'];
        $userRole = Auth::user()->role->name ?? '';
        $isClosedOrApproved = in_array($request->status, ['Approved', 'Closed']);
        $canChangeStatus = in_array($userRole, ['Designer', 'Manager', 'Admin', 'Client'])
            && !($isClosedOrApproved && in_array($userRole, ['Designer', 'Manager', 'Client']));
    @endphp

    @if($canChangeStatus)
    <div class="req-status-section">
        <h3 class="req-status-heading">Request Status</h3>
        <div class="req-status-stats">
            <div class="req-stat-col">
                <span class="req-stat-label">Current Status</span>
                <span class="req-status-pill" style="background:{{ $sm['bg'] }}; color:{{ $sm['color'] }};">
                    <span class="req-status-dot" style="background:{{ $sm['color'] }};"></span>
                    {{ $sm['label'] }}
                </span>
            </div>
            <div class="req-stat-col">
                <span class="req-stat-label">Revisions</span>
                <span class="req-stat-val">{{ $revisionCount }}</span>
            </div>
            <div class="req-stat-col">
                <span class="req-stat-label">Design Errors</span>
                <span class="req-stat-val">{{ $designErrorCount }}</span>
            </div>
        </div>

        <div class="req-change-status">
            <span class="req-stat-label" style="display:block; margin-bottom:0.75rem;">Change Status</span>

            @if($userRole === 'Client')
                {{-- Context-aware client action buttons --}}
                @if($request->status === 'Needs Approval')
                    <div class="client-action-buttons">
                        <form action="{{ route('portal.requests.status', $request->id) }}" method="POST" style="display:inline;">
                            @csrf <input type="hidden" name="status" value="Approved">
                            <button type="submit" class="btn-action btn-approve"><i class="fas fa-check"></i> Approve</button>
                        </form>
                        <form action="{{ route('portal.requests.status', $request->id) }}" method="POST" style="display:inline;">
                            @csrf <input type="hidden" name="status" value="Revision Requested">
                            <button type="submit" class="btn-action btn-revision"><i class="fas fa-redo"></i> Request Revision</button>
                        </form>
                        <form action="{{ route('portal.requests.status', $request->id) }}" method="POST" style="display:inline;">
                            @csrf <input type="hidden" name="status" value="Design Error">
                            <button type="submit" class="btn-action btn-error"><i class="fas fa-exclamation-triangle"></i> Design Error</button>
                        </form>
                    </div>
                @elseif($request->status === 'Queued')
                    <form action="{{ route('portal.requests.status', $request->id) }}" method="POST" id="statusUpdateForm">
                        @csrf
                        <input type="hidden" name="status" id="statusHiddenInput" value="">
                        <div class="cstm-select-wrap" id="cstmSelect" data-current="{{ $request->status }}">
                            <div class="cstm-select-trigger" id="cstmTrigger">
                                <span id="cstmLabel">{{ $request->status }}</span>
                                <i class="fas fa-chevron-down cstm-chevron"></i>
                            </div>
                            <ul class="cstm-options" id="cstmOptions">
                                <li class="cstm-opt cstm-opt-header" data-value="">Select Status</li>
                                <li class="cstm-opt" data-value="Closed">Closed</li>
                            </ul>
                        </div>
                    </form>
                @elseif($request->status === 'Needs Information')
                    <div class="client-action-buttons">
                        <form action="{{ route('portal.requests.status', $request->id) }}" method="POST" style="display:inline;">
                            @csrf <input type="hidden" name="status" value="Information Submitted">
                            <button type="submit" class="btn-action btn-approve"><i class="fas fa-paper-plane"></i> Submit Information</button>
                        </form>
                    </div>
                @elseif($request->status === 'Approved')
                    <div class="client-action-buttons">
                        <form action="{{ route('portal.requests.status', $request->id) }}" method="POST" style="display:inline;">
                            @csrf <input type="hidden" name="status" value="Closed">
                            <button type="submit" class="btn-action btn-close" onclick="return confirm('Are you sure you want to close this request?')"><i class="fas fa-times-circle"></i> Close Request</button>
                        </form>
                    </div>
                @else
                    <p style="font-size:0.82rem; color:var(--text-muted); font-style:italic;">No actions available at this stage.</p>
                @endif

            @elseif($request->status === 'Needs Approval' && in_array($userRole, ['Designer', 'Manager']))
                {{-- Locked: waiting for client action --}}
                <div style="display:flex;align-items:center;gap:0.6rem;background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:0.65rem 1rem;font-size:0.85rem;color:#92400e;">
                    <i class="fas fa-lock"></i>
                    <span>Locked — awaiting client approval, revision request, or design error report.</span>
                </div>

            @else
                {{-- Dropdown for Manager, Designer, Admin --}}
                <form action="{{ route('portal.requests.status', $request->id) }}" method="POST" id="statusUpdateForm">
                    @csrf
                    <input type="hidden" name="status" id="statusHiddenInput" value="">
                    <div class="cstm-select-wrap" id="cstmSelect" data-current="{{ $request->status }}">
                        <div class="cstm-select-trigger" id="cstmTrigger">
                            <span id="cstmLabel">{{ $request->status }}</span>
                            <i class="fas fa-chevron-down cstm-chevron"></i>
                        </div>
                        <ul class="cstm-options" id="cstmOptions">
                            <li class="cstm-opt cstm-opt-header" data-value="">Select Status</li>
                            @if($userRole === 'Admin')
                                {{-- Admin sees all --}}
                                <li class="cstm-opt" data-value="Queued">Queued</li>
                                <li class="cstm-opt" data-value="Assigned">Assigned</li>
                                <li class="cstm-opt" data-value="In Progress">In Progress</li>
                                <li class="cstm-opt" data-value="Needs Information">Needs Information</li>
                                <li class="cstm-opt" data-value="Information Submitted">Information Submitted</li>
                                <li class="cstm-opt" data-value="To Be Continued">To Be Continued</li>
                                <li class="cstm-opt" data-value="Needs Approval">Needs Approval</li>
                                <li class="cstm-opt" data-value="Revision Requested">Revision Requested</li>
                                <li class="cstm-opt" data-value="Design Error">Design Error</li>
                                <li class="cstm-opt" data-value="Approved">Approved</li>
                                <li class="cstm-opt" data-value="Project Completed">Project Completed</li>
                            @elseif($request->status === 'Assigned')
                                {{-- Designer/Manager: Assigned → only these two transitions --}}
                                <li class="cstm-opt" data-value="In Progress">In Progress</li>
                                <li class="cstm-opt" data-value="Needs Information">Needs Information</li>
                            @elseif($request->status === 'In Progress')
                                {{-- Designer/Manager: In Progress → only these three transitions --}}
                                <li class="cstm-opt" data-value="Needs Information">Needs Information</li>
                                <li class="cstm-opt" data-value="Needs Approval">Needs Approval</li>
                                <li class="cstm-opt" data-value="To Be Continued">To Be Continued</li>
                            @elseif($request->status === 'Needs Information')
                                {{-- Designer/Manager: Needs Information → only In Progress --}}
                                <li class="cstm-opt" data-value="In Progress">In Progress</li>
                            @elseif($request->status === 'Information Submitted')
                                {{-- Designer/Manager: Information Submitted → only In Progress --}}
                                <li class="cstm-opt" data-value="In Progress">In Progress</li>
                            @elseif($request->status === 'Revision Requested')
                                {{-- Designer/Manager: Revision Requested → In Progress, Needs Information --}}
                                <li class="cstm-opt" data-value="In Progress">In Progress</li>
                                <li class="cstm-opt" data-value="Needs Information">Needs Information</li>
                            @elseif($request->status === 'Design Error')
                                {{-- Designer/Manager: Design Error → In Progress, Needs Information --}}
                                <li class="cstm-opt" data-value="In Progress">In Progress</li>
                                <li class="cstm-opt" data-value="Needs Information">Needs Information</li>
                            @elseif($userRole === 'Designer')
                                <li class="cstm-opt" data-value="In Progress">In Progress</li>
                                <li class="cstm-opt" data-value="Needs Information">Needs Information</li>
                                <li class="cstm-opt" data-value="Needs Approval">Needs Approval</li>
                                <li class="cstm-opt" data-value="To Be Continued">To Be Continued</li>
                            @elseif($userRole === 'Manager')
                                <li class="cstm-opt" data-value="In Progress">In Progress</li>
                                <li class="cstm-opt" data-value="Needs Information">Needs Information</li>
                                <li class="cstm-opt" data-value="To Be Continued">To Be Continued</li>
                                <li class="cstm-opt" data-value="Needs Approval">Needs Approval</li>
                            @endif
                        </ul>
                    </div>
                </form>
            @endif
        </div>
    </div>
    @endif

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
                        <span class="detail-value">{{ $request->request_type ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Cabinet Brand</span>
                        <span class="detail-value">{{ $request->cabinet_brand ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Door Style</span>
                        <span class="detail-value">{{ $request->door_style ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Finish</span>
                        <span class="detail-value">{{ $request->finish ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Ceiling Height</span>
                        <span class="detail-value">{{ $request->ceiling_height ?? 'N/A' }} inches</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Wall Cabinet Height</span>
                        <span class="detail-value">{{ $request->wall_cabinet_height ?? 'N/A' }} inches</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Designer</span>
                        @if(in_array($userRole, ['Admin', 'Manager']))
                            <form action="{{ route('portal.requests.assign', $request->id) }}" method="POST" style="margin-top:0.25rem;">
                                @csrf
                                <select name="designer_id" onchange="this.form.submit()"
                                    style="border:1px solid #e2e8f0;border-radius:8px;padding:0.4rem 0.6rem;font-size:0.85rem;color:#020617;background:#f8fafc;outline:none;width:100%;cursor:pointer;">
                                    <option value="">— Unassigned —</option>
                                    @foreach($designers as $d)
                                        <option value="{{ $d->id }}" {{ $request->designer_id == $d->id ? 'selected' : '' }}>
                                            {{ $d->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <span class="detail-value">{{ $request->designer->name ?? 'Unassigned' }}</span>
                        @endif
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sink</span>
                        <span class="detail-value">
                            @php $sink = $request->additional_info['sink'] ?? null; $sinkText = $request->additional_info['sink_others_text'] ?? null; @endphp
                            {{ $sink === 'Others' && $sinkText ? 'Others: ' . $sinkText : ($sink ?: 'N/A') }}
                        </span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Second Door Style</span>
                        <span class="detail-value">
                            @php $secondDoorText = $request->additional_info['second_door_text'] ?? null; @endphp
                            {{ ($request->additional_info['second_door'] ?? false) ? ($secondDoorText ?: 'Yes') : 'No' }}
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Soffits</span>
                        <span class="detail-value">
                            @if(!empty($request->additional_info['soffits']))
                                Yes
                                @if(!empty($request->additional_info['soffits_width']) || !empty($request->additional_info['soffits_height']))
                                    <span style="font-size:0.8rem; color:var(--text-muted); font-weight:400;">
                                        (W: {{ $request->additional_info['soffits_width'] ?? '—' }}", H: {{ $request->additional_info['soffits_height'] ?? '—' }}")
                                    </span>
                                @endif
                            @else
                                No
                            @endif
                        </span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Multiplier</span>
                        <span class="detail-value">{{ $request->additional_info['multiplier'] ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Decoration</span>
                        <span class="detail-value">{{ $request->additional_info['decoration'] ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="details-card assets-card">
            <div class="card-header">
                <h3><i class="fas fa-paperclip"></i> Measurements & Assets</h3>
            </div>
            <div class="assets-content">
                @if(!empty($request->attachments))
                    @foreach($request->attachments as $file)
                        <div class="asset-item">
                            <div class="asset-preview">
                                @php
                                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                                    $ext = strtolower($ext);
                                    $icon = match($ext) {
                                        'pdf' => 'fa-file-pdf',
                                        'xls', 'xlsx', 'csv', 'tsv' => 'fa-file-excel',
                                        'doc', 'docx', 'txt' => 'fa-file-word',
                                        'jpg', 'jpeg', 'png', 'webp', 'heic' => 'fa-file-image',
                                        'ppt', 'pptx' => 'fa-file-powerpoint',
                                        default => 'fa-file',
                                    };
                                @endphp
                                <i class="fas {{ $icon }}"></i>
                            </div>
                            <div class="asset-info">
                                <span class="asset-name">{{ $file['name'] }}</span>
                                <a href="{{ route('portal.download', ['path' => $file['path'], 'name' => $file['name']]) }}" class="asset-download"><i class="fas fa-download"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center; padding: 1rem;">No files uploaded yet.</p>
                @endif
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

            {{-- Door Style & Finish summary row --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--border-color);">
                <div>
                    <span style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);display:block;margin-bottom:0.3rem;">Door Style</span>
                    <span style="font-size:0.95rem;font-weight:600;color:var(--secondary-color);">{{ $request->door_style ?? 'N/A' }}</span>
                </div>
                <div>
                    <span style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);display:block;margin-bottom:0.3rem;">Finish</span>
                    <span style="font-size:0.95rem;font-weight:600;color:var(--secondary-color);">{{ $request->finish ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="info-grid">
                @php
                    function renderInfoList($items, $labelMap = []) {
                        $hasAny = false;
                        $html = '';
                        foreach ($items as $key => $value) {
                            // Skip companion fields — rendered inline with their parent
                            if (str_ends_with($key, '_text') || str_ends_with($key, '_size') || str_ends_with($key, '_type')) continue;
                            if (!$value) continue;
                            $hasAny = true;
                            $label = $labelMap[$key] ?? ucwords(str_replace('_', ' ', $key));
                            if ($key === 'others' && !empty($items[$key . '_text'])) {
                                $label = 'Others: ' . $items[$key . '_text'];
                            }
                            // Collect companion type/size values and show inline
                            $extras = [];
                            if (!empty($items[$key . '_type'])) $extras[] = $items[$key . '_type'];
                            if (!empty($items[$key . '_size'])) $extras[] = $items[$key . '_size'];
                            $html .= '<li><i class="fas fa-check"></i> ' . e($label);
                            if ($extras) {
                                $html .= ' <span style="color:#64748b;font-weight:500;font-size:0.85em;">(' . e(implode(', ', $extras)) . ')</span>';
                            }
                            $html .= '</li>';
                        }
                        if (!$hasAny) $html = '<li style="font-style:italic;">None selected</li>';
                        return $html;
                    }
                @endphp

                <div class="info-group">
                    <h4>Molding &amp; Doors</h4>
                    <ul class="info-list">
                        @if(!empty($request->additional_info['molding']))
                            {!! renderInfoList($request->additional_info['molding']) !!}
                        @else
                            <li style="font-style:italic;">None selected</li>
                        @endif
                    </ul>
                </div>
                <div class="info-group">
                    <h4>Standard Appliances</h4>
                    <ul class="info-list">
                        @if(!empty($request->additional_info['appliances']))
                            {!! renderInfoList($request->additional_info['appliances']) !!}
                        @else
                            <li style="font-style:italic;">None selected</li>
                        @endif
                    </ul>
                </div>
                <div class="info-group">
                    <h4>Storage &amp; Organizer</h4>
                    <ul class="info-list">
                        @if(!empty($request->additional_info['storage']))
                            {!! renderInfoList($request->additional_info['storage']) !!}
                        @else
                            <li style="font-style:italic;">None selected</li>
                        @endif
                    </ul>
                </div>
                <div class="info-group">
                    <h4>Loose Appliances</h4>
                    <ul class="info-list">
                        @if(!empty($request->additional_info['loose']))
                            {!! renderInfoList($request->additional_info['loose']) !!}
                        @else
                            <li style="font-style:italic;">None selected</li>
                        @endif
                    </ul>
                </div>
                <div class="info-group full-width" style="margin-top:1rem;">
                    <h4>Additional Notes</h4>
                    <div class="notes-content">
                        <p>{{ $request->additional_notes ?? 'No additional notes provided.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $userComments  = $request->comments->whereIn('type', ['comment', 'revision']);
        $statusHistory = $request->comments->where('type', 'status_change');
    @endphp

    <!-- Comments + Status History — two columns -->
    <div class="comments-grid">

    <!-- Comments Section -->
    <div class="communications-section">
        <div class="card-header">
            <h3><i class="fas fa-comments"></i> Comments</h3>
        </div>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-icon user-icon">
                    @php
                        $names = explode(' ', $request->client->name ?? 'U');
                        $initials = '';
                        foreach ($names as $n) { $initials .= strtoupper(substr($n, 0, 1)); }
                        echo substr($initials, 0, 2);
                    @endphp
                </div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <span class="sender-name">{{ $request->client->name ?? 'Client' }}</span>
                        <span class="timestamp" data-utc="{{ $request->created_at->toISOString() }}">{{ $request->created_at->format('d M, Y h:i A') }}</span>
                    </div>
                    <div class="timeline-body">
                        <p><strong>Initial Request Submitted:</strong> {{ $request->title }}</p>
                    </div>
                </div>
            </div>

            @forelse($userComments as $comment)
            <div class="timeline-item {{ $comment->type === 'revision' ? 'revision-item' : '' }}">
                <div class="timeline-icon user-icon" style="{{ $comment->type === 'revision' ? 'background:#fef3c7;color:#92400e;border-color:#fde68a;' : 'background:#3b82f6;color:#fff;border-color:#3b82f6;' }}">
                    @if($comment->type === 'revision')
                        <i class="fas fa-sync-alt"></i>
                    @else
                        @php
                            $names = explode(' ', $comment->user->name ?? 'U');
                            $initials = '';
                            foreach ($names as $n) { $initials .= strtoupper(substr($n, 0, 1)); }
                            echo substr($initials, 0, 2);
                        @endphp
                    @endif
                </div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <span class="sender-name">{{ $comment->type === 'revision' ? 'Revision Requested' : ($comment->user->name ?? 'User') }}</span>
                        <span class="timestamp" data-utc="{{ $comment->created_at->toISOString() }}">{{ $comment->created_at->format('d M, Y h:i A') }}</span>
                    </div>
                    <div class="timeline-body">
                        <p>{!! nl2br(e($comment->message)) !!}</p>
                        @if(!empty($comment->attachments))
                        <div class="timeline-attachments">
                            @foreach($comment->attachments as $file)
                                <a href="{{ route('portal.download', ['path' => $file['path'], 'name' => $file['name']]) }}" class="attachment-chip">
                                    <i class="fas fa-paperclip"></i> {{ $file['name'] }}
                                </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
                <p style="font-size:0.9rem;color:var(--text-muted);padding:0.5rem 0;">No comments yet.</p>
            @endforelse
        </div>
    </div>

    <!-- Status History Section -->
    <div class="communications-section">
        <div class="card-header">
            <h3><i class="fas fa-history"></i> Status History</h3>
        </div>
        <div class="timeline">
            <!-- Created entry -->
            <div class="timeline-item">
                <div class="timeline-icon" style="background:#f1f5f9;color:#64748b;border-color:#e2e8f0;">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <span class="sender-name">{{ $request->client->name ?? 'Client' }}</span>
                        <span class="timestamp" data-utc="{{ $request->created_at->toISOString() }}">{{ $request->created_at->format('d M, Y h:i A') }}</span>
                    </div>
                    <div class="timeline-body">
                        <p>Request created with status <strong>Queued</strong>.</p>
                    </div>
                </div>
            </div>

            @forelse($statusHistory as $entry)
            <div class="timeline-item">
                <div class="timeline-icon" style="background:#ede9fe;color:#7c3aed;border-color:#ddd6fe;">
                    <i class="fas fa-arrow-right-arrow-left" style="font-size:0.7rem;"></i>
                </div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <span class="sender-name">{{ $entry->user->name ?? 'System' }}</span>
                        <span class="timestamp" data-utc="{{ $entry->created_at->toISOString() }}">{{ $entry->created_at->format('d M, Y h:i A') }}</span>
                    </div>
                    <div class="timeline-body">
                        <p>{!! nl2br(e($entry->message)) !!}</p>
                    </div>
                </div>
            </div>
            @empty
                <p style="font-size:0.9rem;color:var(--text-muted);padding:0.5rem 0;">No status changes yet.</p>
            @endforelse
        </div>
    </div>

    </div>{{-- end two-column grid --}}

    <!-- Add Comment Section -->
    <form action="{{ route('portal.comments.store', $request->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="add-comment-section">
            <div class="card-header">
                <h3><i class="fas fa-plus"></i> Add Comment</h3>
            </div>
            <div class="comment-input-wrapper">
                <textarea name="message" placeholder="Write your comment here..." rows="4" class="form-input"></textarea>
                <div class="comment-actions">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <label class="attachment-btn" style="margin: 0;">
                            <i class="fas fa-paperclip"></i> ATTACH FILE
                            <input type="file" name="attachments[]" multiple style="display: none;">
                        </label>
                        <span id="file-count" style="font-size: 0.8rem; color: var(--text-muted);"></span>
                    </div>
                    <div class="comment-meta-switches">
                        <button type="submit" class="btn btn-save" style="border-radius: 6px; padding: 0.6rem 1.5rem;">POST COMMENT</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @php $currentRole = Auth::user()->role->name ?? ''; @endphp

    <div class="view-footer" style="margin-top: 1.5rem;">
        <a href="{{ url()->previous() }}" class="btn btn-outline">BACK</a>
        @if($currentRole === 'Client' && $request->status === 'Needs Approval')
        <div class="action-group">
            <span style="font-size: 0.85rem; color: var(--text-muted); align-self: center; font-style: italic;">
                Use the action buttons above to approve, request a revision, or report a design error. Add a comment below with your feedback.
            </span>
        </div>
        @elseif($currentRole === 'Client' && $request->status === 'Needs Information')
        <div class="action-group">
            <span style="font-size: 0.85rem; color: var(--text-muted); align-self: center; font-style: italic;">
                Please add a comment with the requested information, then click "Submit Information" above.
            </span>
        </div>
        @endif
    </div>
</div>

@section('scripts')
<script>
    document.querySelector('input[name="attachments[]"]').addEventListener('change', function(e) {
        const count = e.target.files.length;
        document.getElementById('file-count').textContent = count > 0 ? `${count} file(s) selected` : '';
    });

    (function () {
        const wrap    = document.getElementById('cstmSelect');
        const trigger = document.getElementById('cstmTrigger');
        const options = document.getElementById('cstmOptions');
        const label   = document.getElementById('cstmLabel');
        const hidden  = document.getElementById('statusHiddenInput');
        const form    = document.getElementById('statusUpdateForm');

        if (!wrap) return;

        // Pre-select current status
        const current = wrap.dataset.current || '';
        hidden.value = current;
        options.querySelectorAll('.cstm-opt:not(.cstm-opt-header)').forEach(function (opt) {
            if (opt.dataset.value === current) opt.classList.add('cstm-opt-active');
        });

        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            wrap.classList.toggle('open');
        });

        options.querySelectorAll('.cstm-opt:not(.cstm-opt-header)').forEach(function (opt) {
            opt.addEventListener('click', function () {
                const val = opt.dataset.value;
                if (val === 'Closed' && !confirm('Are you sure you want to close this request?')) return;
                label.textContent = opt.textContent.trim();
                hidden.value = val;
                wrap.classList.remove('open');
                form.submit();
            });
        });

        document.addEventListener('click', function () {
            wrap.classList.remove('open');
        });
    })();
</script>
@endsection

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
        grid-template-columns: repeat(4, 1fr);
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
        word-break: break-word;
        overflow-wrap: break-word;
        white-space: pre-wrap;
    }

    .communications-section {
        margin-top: 2rem;
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .comments-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        align-items: start;
        margin-top: 2rem;
    }

    .comments-grid .communications-section {
        margin-top: 0;
    }

    @media (max-width: 768px) {
        .comments-grid {
            grid-template-columns: 1fr;
        }
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

    @media (max-width: 1100px) {
        .info-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 992px) {
        .details-grid-wrapper { grid-template-columns: 1fr; }
        .info-grid { grid-template-columns: repeat(2, 1fr); }
        .req-status-stats { gap: 2rem; }
    }

    @media (max-width: 768px) {
        .view-request-container { padding-bottom: 3rem; }

        .view-header { padding: 1.25rem; }

        .header-main {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .header-actions {
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .project-title { font-size: 1.4rem; }

        .header-dates {
            gap: 1rem;
            flex-direction: column;
        }

        .rev-v { margin-left: 0; }

        .detail-row {
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .req-status-stats {
            flex-direction: column;
            gap: 1.25rem;
        }

        .req-change-status { max-width: 100%; }

        .comment-actions {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .comment-meta-switches { width: 100%; }
        .comment-meta-switches .btn-save { width: 100%; }

        .view-footer {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .view-footer .btn { text-align: center; }

        .timeline { padding-left: 1.5rem; }

        .timeline-header { flex-direction: column; gap: 0.25rem; }

        .timeline-attachments { flex-wrap: wrap; }

        .info-grid { grid-template-columns: 1fr; }

        .info-group.full-width { grid-column: span 1; }

        .add-comment-section { padding: 1.25rem; }

        .communications-section { padding: 1.25rem; }
    }

    /* ── Alert banners ── */
    .alert-success-banner, .alert-error-banner {
        padding: 0.85rem 1.25rem;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1.5rem;
    }
    .alert-success-banner { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
    .alert-error-banner   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    /* ── Request Status Section ── */
    .req-status-section {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,.05);
    }
    .req-status-heading {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--primary-color);
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--primary-color);
        display: inline-block;
    }
    .req-status-stats {
        display: flex;
        gap: 4rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem;
    }
    .req-stat-col { display: flex; flex-direction: column; gap: 0.5rem; }
    .req-stat-label {
        font-size: 0.78rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
    }
    .req-stat-val {
        font-size: 1rem;
        font-weight: 700;
        color: var(--secondary-color);
    }
    .req-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 700;
    }
    .req-status-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* ── Client Action Buttons ── */
    .client-action-buttons { display: flex; flex-wrap: wrap; gap: 0.75rem; }
    .btn-action {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.55rem 1.1rem; border-radius: 8px; font-size: 0.82rem;
        font-weight: 700; border: none; cursor: pointer; letter-spacing: 0.3px;
        transition: opacity 0.15s;
    }
    .btn-action:hover { opacity: 0.85; }
    .btn-approve  { background: #059669; color: #fff; }
    .btn-revision { background: #d97706; color: #fff; }
    .btn-error    { background: #dc2626; color: #fff; }
    .btn-close    { background: #64748b; color: #fff; }

    /* ── Custom Select ── */
    .req-change-status { max-width: 320px; }
    .cstm-select-wrap {
        position: relative;
        user-select: none;
    }
    .cstm-select-trigger {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.6rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--secondary-color);
        transition: border-color 0.15s;
    }
    .cstm-select-trigger:hover { border-color: var(--primary-color); }
    .cstm-chevron { font-size: 0.75rem; color: #6b7280; transition: transform 0.2s; }
    .cstm-select-wrap.open .cstm-chevron { transform: rotate(180deg); }
    .cstm-options {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: 0; right: 0;
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,.12);
        z-index: 100;
        list-style: none;
        padding: 0; margin: 0;
    }
    .cstm-select-wrap.open .cstm-options { display: block; }
    .cstm-opt {
        padding: 0.65rem 1rem;
        font-size: 0.9rem;
        cursor: pointer;
        color: var(--secondary-color);
        font-weight: 500;
    }
    .cstm-opt:hover { background: #f1f5f9; }
    .cstm-opt-active { background: #eff6ff; color: var(--primary-color); font-weight: 700; }
    .cstm-opt-header {
        background: #1e40af;
        color: #fff !important;
        font-weight: 700;
        cursor: default;
    }
    .cstm-opt-header:hover { background: #1e40af; }
</style>
@endsection

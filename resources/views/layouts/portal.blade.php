<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FourSquareDesign Portal')</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/portal.css') }}">
    @yield('styles')
</head>
<body>
    <div class="app-layout">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        @if(!request()->routeIs(['portal.login', 'portal.signup', 'portal.forgot-password']))
        <aside id="sidebar" class="portal-sidebar">
            <div class="sidebar-brand">
                <span class="brand-full">Four Square Design</span>
                <span class="brand-short">FSD</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('portal.dashboard') }}" class="sidebar-link {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}" title="Dashboard">
                    <i class="fas fa-th-large"></i> <span class="link-label">Dashboard</span>
                </a>


                
                <div style="padding: 1.5rem 1.5rem 0.5rem; font-size: 0.65rem; color: #475569; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;" class="link-label">Requests</div>


                <a href="{{ route('portal.open-requests') }}" class="sidebar-link {{ request()->routeIs('portal.open-requests') ? 'active' : '' }}" title="Open Requests">
                    <i class="fas fa-folder-open"></i> <span class="link-label">Open Requests</span>
                </a>
                <a href="{{ route('portal.wip') }}" class="sidebar-link {{ request()->routeIs('portal.wip') ? 'active' : '' }}" title="In Progress">
                    <i class="fas fa-clock"></i> <span class="link-label">In Progress</span>
                </a>

                @if(in_array(Auth::user()->role->name ?? '', ['Designer', 'Manager', 'Admin', 'Client']))
                <a href="{{ route('portal.needs-information') }}" class="sidebar-link {{ request()->routeIs('portal.needs-information') ? 'active' : '' }}" title="Needs Information">
                    <i class="fas fa-info-circle"></i> <span class="link-label">Needs Info</span>
                </a>
                @endif

                <a href="{{ route('portal.needs-approval') }}" class="sidebar-link {{ request()->routeIs('portal.needs-approval') ? 'active' : '' }}" title="Needs Approval">
                    <i class="fas fa-check-circle"></i> <span class="link-label">Needs Approval</span>
                </a>
                <a href="{{ route('portal.closed') }}" class="sidebar-link {{ request()->routeIs('portal.closed') ? 'active' : '' }}" title="Project Completed">
                    <i class="fas fa-archive"></i> <span class="link-label">Project Completed</span>
                </a>
                <a href="{{ route('portal.your-drafts') }}" class="sidebar-link {{ request()->routeIs('portal.your-drafts') ? 'active' : '' }}" title="Your Drafts">
                    <i class="fas fa-file-alt"></i> <span class="link-label">Your Drafts</span>
                </a>
                <a href="{{ route('portal.prioritized') }}" class="sidebar-link {{ request()->routeIs('portal.prioritized') ? 'active' : '' }}" title="Prioritized">
                    <i class="fas fa-star" style="color: #008fa0;"></i> <span class="link-label" style="color: #008fa0;">Prioritized</span>
                </a>

                <div style="padding: 1.5rem 1.5rem 0.5rem; font-size: 0.65rem; color: #475569; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;" class="link-label">Management</div>

                <a href="{{ route('portal.design-requests') }}" class="sidebar-link {{ request()->routeIs('portal.design-requests') ? 'active' : '' }}" title="Design Requests">
                    <i class="fas fa-drafting-compass"></i> <span class="link-label">Design Requests</span>
                </a>

                @if(Auth::check() && (Auth::user()->role->name ?? '') === 'Admin')
                <a href="{{ route('portal.leads') }}" class="sidebar-link {{ request()->routeIs('portal.leads') ? 'active' : '' }}" title="Leads">
                    <i class="fas fa-user-tag"></i> <span class="link-label">Leads</span>
                </a>
                <a href="{{ route('portal.users') }}" class="sidebar-link {{ request()->routeIs('portal.users') ? 'active' : '' }}" title="User Management">
                    <i class="fas fa-users-cog"></i> <span class="link-label">Users</span>
                </a>
                @endif
            </nav>
            <div class="sidebar-footer">
                <button id="sidebarToggle" class="sidebar-toggle-btn">
                    <i class="fas fa-angle-double-left"></i>
                </button>
            </div>
        </aside>
        @endif

        <div class="app-content-wrapper">
            @if(!request()->routeIs(['portal.login', 'portal.signup', 'portal.forgot-password']))
            <header class="portal-header">
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Open menu">
                    <i class="fas fa-bars"></i>
                </button>
                <div style="flex: 1;"></div>
                <nav class="nav-links">
                    @php
                        $role = Auth::user()->role->name ?? '';
                    @endphp

                    <a href="{{ route('portal.dashboard') }}" class="nav-item {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}">MY REQUESTS</a>

                    @if($role === 'Client')
                        <a href="{{ route('portal.submit-request') }}" class="nav-item {{ request()->routeIs('portal.submit-request') ? 'active' : '' }}">SUBMIT NEW REQUEST</a>
                    @endif

                    @if(in_array($role, ['Admin', 'Manager', 'Designer']))
                        <a href="{{ route('portal.clients') }}" class="nav-item {{ request()->routeIs('portal.clients') ? 'active' : '' }}">ALL CLIENTS</a>
                    @endif




                    
                    <div id="tz-toggle" class="tz-toggle" title="Switch timezone">
                        <span class="tz-opt" data-tz-val="IST">IST</span>
                        <span class="tz-sep">|</span>
                        <span class="tz-opt" data-tz-val="EST">EST</span>
                    </div>

                    <div class="user-dropdown">
                        @auth
                        <div class="user-avatar" id="userDropdownTrigger">
                            @php
                                $names = explode(' ', Auth::user()->name);
                                $initials = '';
                                foreach ($names as $name) {
                                    $initials .= strtoupper(substr($name, 0, 1));
                                }
                                echo substr($initials, 0, 2);
                            @endphp
                        </div>
                        @else
                        <div class="user-avatar" id="userDropdownTrigger">?</div>
                        @endauth
                        <div class="dropdown-menu" id="userDropdownMenu">
                            <a href="#" class="dropdown-item" id="myProfileTrigger">My Profile</a>
                            {{-- SPOC hidden --}}
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                            <form id="logout-form" action="{{ route('portal.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </nav>
            </header>
            @endif

            <main class="{{ request()->routeIs(['portal.login', 'portal.signup', 'portal.forgot-password']) ? 'login-view' : 'portal-main' }}">
                @if(!request()->routeIs(['portal.login', 'portal.signup', 'portal.forgot-password', 'portal.design-requests']))
                    @include('partials.filters')
                @endif

                @if(session('success'))
                    <div id="toast-success" style="position: fixed; top: 1.25rem; right: 1.5rem; z-index: 9999; background: #dcfce7; color: #166534; padding: 0.85rem 1.25rem; border-radius: 8px; border: 1px solid #bbf7d0; box-shadow: 0 4px 16px rgba(0,0,0,0.12); display: flex; align-items: center; gap: 0.6rem; font-size: 0.95rem; max-width: 360px; transition: opacity 0.4s ease;">
                        <i class="fas fa-check-circle" style="font-size: 1.1rem;"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <script>
                        setTimeout(function() {
                            var t = document.getElementById('toast-success');
                            if (t) { t.style.opacity = '0'; setTimeout(function(){ t.remove(); }, 400); }
                        }, 3500);
                    </script>
                @endif

                <div class="page-content">
                    @yield('content')
                </div>
            </main>

            @if(!request()->routeIs(['portal.login', 'portal.signup', 'portal.forgot-password']))
            <footer class="portal-footer">
                <p>&copy; 2026 Four Square Designs. All rights reserved.</p>
            </footer>
            @endif
        </div>
    </div>

    <script>
        // Desktop Sidebar Collapse Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const toggleIcon = sidebarToggle ? sidebarToggle.querySelector('i') : null;

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                if (toggleIcon) {
                    if (sidebar.classList.contains('collapsed')) {
                        toggleIcon.classList.remove('fa-angle-double-left');
                        toggleIcon.classList.add('fa-angle-double-right');
                    } else {
                        toggleIcon.classList.remove('fa-angle-double-right');
                        toggleIcon.classList.add('fa-angle-double-left');
                    }
                }
            });
        }

        // Mobile Sidebar Drawer
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openMobileSidebar() {
            if (sidebar) sidebar.classList.add('mobile-open');
            if (sidebarOverlay) sidebarOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            if (sidebar) sidebar.classList.remove('mobile-open');
            if (sidebarOverlay) sidebarOverlay.classList.remove('show');
            document.body.style.overflow = '';
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', openMobileSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeMobileSidebar);
        }

        // Close sidebar when a nav link is clicked on mobile
        if (sidebar) {
            sidebar.querySelectorAll('.sidebar-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 900) closeMobileSidebar();
                });
            });
        }

        // Filter Toggle
        const toggleFilters = (e) => {
            if (e) e.preventDefault();
            const panel = document.getElementById('filterPanel');
            if (panel) panel.classList.toggle('open');
        };

        document.addEventListener('click', (e) => {
            if (e.target.closest('#closeFilter') || e.target.closest('.filter-btn')) {
                toggleFilters(e);
            }
            
            // User Dropdown
            const dropdownTrigger = document.getElementById('userDropdownTrigger');
            const dropdownMenu = document.getElementById('userDropdownMenu');
            
            if (dropdownTrigger && dropdownMenu) {
                if (e.target.closest('#userDropdownTrigger')) {
                    dropdownMenu.classList.toggle('show');
                } else if (!e.target.closest('#userDropdownMenu')) {
                    dropdownMenu.classList.remove('show');
                }
            }
        });
    </script>
    @yield('scripts')

    <style>
        .tz-toggle {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 0.2rem 0.55rem;
            font-size: 0.7rem;
            font-weight: 700;
            gap: 0.2rem;
            cursor: default;
            user-select: none;
            letter-spacing: 0.4px;
        }
        .tz-opt {
            padding: 0.15rem 0.45rem;
            border-radius: 12px;
            color: #94a3b8;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }
        .tz-opt:hover { color: #475569; }
        .tz-opt.tz-active { background: var(--primary-color, #008fa0); color: #fff; }
        .tz-sep { color: #cbd5e1; font-weight: 300; font-size: 0.75rem; }
    </style>

    <script>
    (function () {
        var TZ_MAP = { IST: 'Asia/Kolkata', EST: 'America/New_York' };

        function fmtInTz(iso, tz, fmt) {
            var d = new Date(iso);
            var parts = new Intl.DateTimeFormat('en-GB', {
                timeZone: tz,
                day: '2-digit', month: 'short', year: 'numeric',
                hour: '2-digit', minute: '2-digit', hour12: true
            }).formatToParts(d);
            var get = function (type) { var p = parts.find(function (x) { return x.type === type; }); return p ? p.value : ''; };
            var day = get('day'), mon = get('month'), yr = get('year');
            var hr = get('hour'), min = get('minute'), ampm = (get('dayPeriod') || '').toUpperCase();
            if (fmt === 'date') return day + ' ' + mon + ', ' + yr;
            if (fmt === 'time') return hr + ':' + min + ' ' + ampm;
            return day + ' ' + mon + ', ' + yr + ' ' + hr + ':' + min + ' ' + ampm;
        }

        function applyTz(tzKey) {
            var tz = TZ_MAP[tzKey] || TZ_MAP.IST;
            document.querySelectorAll('[data-utc]').forEach(function (el) {
                var iso = el.getAttribute('data-utc');
                if (!iso) return;
                var fmt = el.getAttribute('data-utc-fmt') || '';
                el.textContent = fmtInTz(iso, tz, fmt);
            });
            document.querySelectorAll('.tz-opt').forEach(function (opt) {
                opt.classList.toggle('tz-active', opt.getAttribute('data-tz-val') === tzKey);
            });
        }

        var saved = localStorage.getItem('tz_pref') || 'IST';

        document.addEventListener('DOMContentLoaded', function () {
            applyTz(saved);
            document.querySelectorAll('.tz-opt').forEach(function (opt) {
                opt.addEventListener('click', function () {
                    var val = this.getAttribute('data-tz-val');
                    localStorage.setItem('tz_pref', val);
                    applyTz(val);
                });
            });
        });
    })();
    </script>

    <!-- Modals -->
    <div id="spocModal" class="modal">
        <div class="modal-content contact-modal">
            <span class="close-modal">&times;</span>
            <div class="modal-header-img">
                <div class="sidebar-brand" style="padding: 0; background: transparent; width: auto; color: #020617; transform: scale(1.2);">
                    <span class="brand-full">FOUR SQUARE<span> DESIGN</span></span>
                </div>
            </div>
            <h2 class="modal-title">Point of Contact</h2>
            
            <div class="contact-list">
                @php
                    $activePocs = \App\Models\Poc::all();
                @endphp

                @foreach($activePocs as $poc)
                <div class="contact-item">
                    <div class="contact-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="contact-info">
                        <div class="contact-name">{{ $poc->name }}</div>
                        <a href="mailto:{{ $poc->email }}" class="contact-email">{{ $poc->email }}</a>
                        @if($poc->phone)<div class="contact-phone">{{ $poc->phone }}</div>@endif
                    </div>
                    <div class="contact-tag">{{ $poc->tag ?? 'Project Manager' }}</div>
                </div>
                @endforeach

                @if(count($activePocs) == 0)
                <p style="text-align: center; color: var(--text-muted); padding: 1rem;">No contacts available.</p>
                @endif
            </div>
        </div>
    </div>

    @auth
    <div id="profileModal" class="modal">
        <div class="modal-content profile-modal">
            <span class="close-modal">&times;</span>
            <div class="modal-header-img">
                <div class="sidebar-brand" style="padding: 0; background: transparent; width: auto; color: #020617; transform: scale(1.2);">
                    <span class="brand-full">FOUR SQUARE<span> DESIGN</span></span>
                </div>
            </div>
            
            <form class="profile-form" method="POST" action="{{ route('portal.profile.update') }}">
                @csrf
                <div class="form-group">
                    <label>Email address <span class="required-star">*</span></label>
                    <input type="email" value="{{ Auth::user()->email }}" class="form-input" readonly>
                </div>
                <div class="form-group">
                    <label>Name <span class="required-star">*</span></label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Mobile Number <span class="required-star">*</span></label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-input">
                </div>
                <div class="form-group">
                    <label>Company Name <span class="required-star">*</span></label>
                    <input type="text" name="company_name" value="{{ Auth::user()->company_name }}" class="form-input">
                </div>

                
                <button type="submit" class="update-detail-btn">UPDATE DETAIL</button>
                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="{{ route('portal.forgot-password') }}" class="reset-link">Reset password?</a>
                </div>
            </form>
        </div>
    </div>
    @endauth

    <script>
        // Modal logic
        const setupModal = (triggerId, modalId) => {
            const trigger = document.getElementById(triggerId);
            const modal = document.getElementById(modalId);
            const closeBtn = modal.querySelector('.close-modal');

            if (trigger && modal) {
                trigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden'; // Prevent scroll
                });

                closeBtn.addEventListener('click', () => {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                });

                window.addEventListener('click', (e) => {
                    if (e.target == modal) {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                });
            }
        };

        setupModal('spocTrigger', 'spocModal');
        setupModal('myProfileTrigger', 'profileModal');

        // Filter Toggle Logic
        const filterPanel = document.getElementById('filterPanel');
        const filterBtns = document.querySelectorAll('.filter-btn');
        const closeFilter = document.getElementById('closeFilter');

        if (filterPanel && filterBtns.length > 0) {
            filterBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (filterPanel.style.display === 'none' || filterPanel.style.display === '') {
                        filterPanel.style.display = 'block';
                    } else {
                        filterPanel.style.display = 'none';
                    }
                });
            });
        }

        if (closeFilter) {
            closeFilter.addEventListener('click', () => {
                filterPanel.style.display = 'none';
            });
        }

        // Password Visibility Toggle
        document.querySelectorAll('.fa-eye-slash').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                }
            });
        });
    </script>
</body>
</html>

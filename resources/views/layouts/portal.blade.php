<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kitchen365 Portal')</title>
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
        @if(!request()->routeIs('portal.login'))
        <aside id="sidebar" class="portal-sidebar">
            <div class="sidebar-brand">
                <span class="brand-full">Four Square Designs</span>
                <span class="brand-short">PSD</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('portal.dashboard') }}" class="sidebar-link {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}" title="Dashboard">
                    <i class="fas fa-th-large"></i> <span class="link-label">Dashboard</span>
                </a>
                <a href="{{ route('portal.open-requests') }}" class="sidebar-link {{ request()->routeIs('portal.open-requests') ? 'active' : '' }}" title="Open Requests">
                    <i class="fas fa-folder-open"></i> <span class="link-label">Open Requests</span>
                </a>
                <a href="{{ route('portal.wip') }}" class="sidebar-link {{ request()->routeIs('portal.wip') ? 'active' : '' }}" title="WIP">
                    <i class="fas fa-clock"></i> <span class="link-label">WIP</span>
                </a>
                <a href="{{ route('portal.needs-information') }}" class="sidebar-link {{ request()->routeIs('portal.needs-information') ? 'active' : '' }}" title="Needs Information">
                    <i class="fas fa-info-circle"></i> <span class="link-label">Needs Info</span>
                </a>
                <a href="{{ route('portal.needs-approval') }}" class="sidebar-link {{ request()->routeIs('portal.needs-approval') ? 'active' : '' }}" title="Needs Approval">
                    <i class="fas fa-check-circle"></i> <span class="link-label">Needs Approval</span>
                </a>
                <a href="{{ route('portal.closed') }}" class="sidebar-link {{ request()->routeIs('portal.closed') ? 'active' : '' }}" title="Closed">
                    <i class="fas fa-archive"></i> <span class="link-label">Closed</span> <span class="badge"></span>
                </a>
                <a href="{{ route('portal.your-drafts') }}" class="sidebar-link {{ request()->routeIs('portal.your-drafts') ? 'active' : '' }}" title="Your Drafts">
                    <i class="fas fa-file-alt"></i> <span class="link-label">Your Drafts</span>
                </a>
                <a href="{{ route('portal.prioritized') }}" class="sidebar-link {{ request()->routeIs('portal.prioritized') ? 'active' : '' }}" title="Prioritized">
                    <i class="fas fa-star" style="color: #008fa0;"></i> <span class="link-label" style="color: #008fa0;">Prioritized</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <button id="sidebarToggle" class="sidebar-toggle-btn">
                    <i class="fas fa-angle-double-left"></i>
                </button>
            </div>
        </aside>
        @endif

        <div class="app-content-wrapper">
            @if(!request()->routeIs('portal.login'))
            <header class="portal-header">
                <div style="flex: 1;"></div>
                <nav class="nav-links">
                    <a href="{{ route('portal.dashboard') }}" class="nav-item {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}">MY REQUESTS</a>
                    <a href="{{ route('portal.clients') }}" class="nav-item {{ request()->routeIs('portal.clients') ? 'active' : '' }}">ALL CLIENTS</a>
                    <a href="{{ route('portal.submit-request') }}" class="nav-item {{ request()->routeIs('portal.submit-request') ? 'active' : '' }}">SUBMIT NEW REQUEST</a>
                    <a href="#" class="nav-item">REPORTS</a>
                    
                    <div class="user-dropdown">
                        <div class="user-avatar" id="userDropdownTrigger">YA</div>
                        <div class="dropdown-menu" id="userDropdownMenu">
                            <a href="#" class="dropdown-item" id="myProfileTrigger">My Profile</a>
                            <a href="#" class="dropdown-item" id="spocTrigger" style="color: #fab133;">SPOC</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('portal.login') }}" class="dropdown-item">Sign Out</a>
                        </div>
                    </div>
                </nav>
            </header>
            @endif

            <main class="{{ request()->routeIs('portal.login') ? 'login-view' : 'portal-main' }}">
                @if(!request()->routeIs('portal.login'))
                    @include('partials.filters')
                @endif
                <div class="page-content">
                    @yield('content')
                </div>
            </main>

            @if(!request()->routeIs('portal.login'))
            <footer class="portal-footer">
                <p>&copy; 2026 Four Square Designs. All rights reserved.</p>
            </footer>
            @endif
        </div>
    </div>

    <script>
        // Sidebar Toggle
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

    <!-- Modals -->
    <div id="spocModal" class="modal">
        <div class="modal-content contact-modal">
            <span class="close-modal">&times;</span>
            <div class="modal-header-img">
                <div class="sidebar-brand" style="padding: 0; background: transparent; width: auto; color: #020617; transform: scale(1.2);">
                    <span class="brand-full">KITCHEN<span>365</span></span>
                </div>
            </div>
            <h2 class="modal-title">Point of Contact</h2>
            
            <div class="contact-list">
                <div class="contact-item">
                    <div class="contact-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="contact-info">
                        <div class="contact-name">Jignesh Patel</div>
                        <a href="mailto:jignesh@kitchen365.com" class="contact-email">jignesh@kitchen365.com</a>
                    </div>
                    <div class="contact-tag">Project Manager</div>
                </div>

                <div class="contact-item">
                    <div class="contact-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="contact-info">
                        <div class="contact-name">Keyur Gohel</div>
                        <a href="mailto:keyur.gohel@kitchen365.com" class="contact-email">keyur.gohel@kitchen365.com</a>
                        <div class="contact-phone">+1-6789992124 Ext.118</div>
                    </div>
                    <div class="contact-tag">Project Manager</div>
                </div>
            </div>
        </div>
    </div>

    <div id="profileModal" class="modal">
        <div class="modal-content profile-modal">
            <span class="close-modal">&times;</span>
            <div class="modal-header-img">
                <div class="sidebar-brand" style="padding: 0; background: transparent; width: auto; color: #020617; transform: scale(1.2);">
                    <span class="brand-full">KITCHEN<span>365</span></span>
                </div>
            </div>
            
            <form class="profile-form">
                <div class="form-group">
                    <label>Email address <span class="required-star">*</span></label>
                    <input type="email" value="ybouafia@kitchentuneup.com" class="form-input" readonly>
                </div>
                <div class="form-group">
                    <label>Name <span class="required-star">*</span></label>
                    <input type="text" value="Yakout B" class="form-input">
                </div>
                <div class="form-group">
                    <label>Mobile Number <span class="required-star">*</span></label>
                    <input type="text" value="10000000000" class="form-input">
                </div>
                <div class="form-group">
                    <label>Company Name <span class="required-star">*</span></label>
                    <input type="text" value="TAC Kitchen Transformation LLC dba Kitchen" class="form-input">
                </div>
                
                <button type="button" class="update-detail-btn">UPDATE DETAIL</button>
                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="#" class="reset-link">Reset password?</a>
                </div>
            </form>
        </div>
    </div>

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
    </script>
</body>
</html>

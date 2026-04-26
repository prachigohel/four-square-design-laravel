<div class="horizontal-subnav">
    <a href="{{ route('portal.dashboard') }}" class="subnav-link {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}">All</a>
    <a href="{{ route('portal.open-requests') }}" class="subnav-link {{ request()->routeIs('portal.open-requests') ? 'active' : '' }}">Open Requests</a>
    <a href="{{ route('portal.wip') }}" class="subnav-link {{ request()->routeIs('portal.wip') ? 'active' : '' }}">WIP</a>
    <a href="{{ route('portal.needs-information') }}" class="subnav-link {{ request()->routeIs('portal.needs-information') ? 'active' : '' }}">Needs Information</a>
    <a href="{{ route('portal.needs-approval') }}" class="subnav-link {{ request()->routeIs('portal.needs-approval') ? 'active' : '' }}">Needs Approval</a>
    <a href="{{ route('portal.closed') }}" class="subnav-link {{ request()->routeIs('portal.closed') ? 'active' : '' }}">Closed</a>
    <a href="{{ route('portal.your-drafts') }}" class="subnav-link {{ request()->routeIs('portal.your-drafts') ? 'active' : '' }}" style="color: #ff7e36;">Your Drafts</a>
    <a href="{{ route('portal.prioritized') }}" class="subnav-link {{ request()->routeIs('portal.prioritized') ? 'active' : '' }}" style="color: #008fa0;">Prioritized</a>
</div>

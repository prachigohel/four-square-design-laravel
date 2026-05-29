<header class="fixed w-full z-50 transition-all duration-500" id="main-header">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-xl border-b border-white/5"></div>
    <nav class="container mx-auto px-6 lg:px-12 py-6 flex justify-between items-center relative z-10">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-4 group">
            <div class="relative w-12 h-12 bg-slate-900 border border-white/10 rounded flex items-center justify-center overflow-hidden transition-all group-hover:border-amber-500/50 shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="text-white font-black text-xl z-10">FS</span>
            </div>
            <div class="flex flex-col">
                <span class="text-white font-serif italic font-bold text-2xl tracking-tight leading-none group-hover:text-amber-500 transition-colors">Four Square</span>
                <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.4em] leading-none mt-1">DESIGNS</span>
            </div>
        </a>

        <!-- Desktop Nav -->
        <div class="hidden lg:flex items-center gap-10">
            @php $currentRoute = Request::url(); @endphp
            <a href="{{ url('/') }}" class="nav-link {{ $currentRoute == url('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/portfolio') }}" class="nav-link {{ $currentRoute == url('/portfolio') ? 'active' : '' }}">Portfolio</a>
            <a href="{{ url('/services') }}" class="nav-link {{ $currentRoute == url('/services') ? 'active' : '' }}">Services</a>
            <a href="{{ url('/request') }}" class="nav-link {{ $currentRoute == url('/request') ? 'active' : '' }}">Start A Project</a>
            
            <a href="{{ url('/contact') }}" class="btn-outline !px-8 !py-3">
                Contact
            </a>
        </div>

        <!-- Mobile Toggle -->
        <button class="lg:hidden text-white w-10 h-10 flex items-center justify-center bg-white/5 rounded-full border border-white/10" id="mobile-menu-toggle">
            <i data-lucide="menu" size="20"></i>
        </button>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-slate-950/95 backdrop-blur-2xl z-[60] flex flex-col items-center justify-center gap-10 opacity-0 pointer-events-none transition-all duration-500">
        <button id="mobile-menu-close" class="absolute top-8 right-8 text-white w-12 h-12 flex items-center justify-center bg-white/5 rounded-full border border-white/10">
            <i data-lucide="x" size="24"></i>
        </button>
        
        <a href="{{ url('/') }}" class="text-4xl font-serif italic text-white hover:text-amber-500 transition-all">Home</a>
        <a href="{{ url('/portfolio') }}" class="text-4xl font-serif italic text-white hover:text-amber-500 transition-all">Portfolio</a>
        <a href="{{ url('/services') }}" class="text-4xl font-serif italic text-white hover:text-amber-500 transition-all">Services</a>
        <a href="{{ url('/request') }}" class="text-4xl font-serif italic text-white hover:text-amber-500 transition-all">Start A Project</a>
        <a href="{{ url('/contact') }}" class="btn-gold !px-16">Contact</a>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('main-header');
        const mobileMenu = document.getElementById('mobile-menu');
        const toggle = document.getElementById('mobile-menu-toggle');
        const close = document.getElementById('mobile-menu-close');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('py-0');
            } else {
                header.classList.remove('py-0');
            }
        });

        toggle.addEventListener('click', () => {
            mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
            mobileMenu.classList.add('opacity-100', 'pointer-events-auto');
        });

        close.addEventListener('click', () => {
            mobileMenu.classList.add('opacity-0', 'pointer-events-none');
            mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
        });
    });
</script>

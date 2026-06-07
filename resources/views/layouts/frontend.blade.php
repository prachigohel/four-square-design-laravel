<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Four Square Design | Bespoke Kitchen & Interior Artistry')</title>
    <meta name="description" content="@yield('meta_description', 'Four Square Design is an Ahmedabad-based interior design studio specializing in bespoke kitchen cabinetry, 2020 Design layouts, 3D renderings, and bath artistry for luxury homes.')">
    <meta name="keywords" content="@yield('meta_keywords', 'kitchen cabinet design, interior design Ahmedabad, 2020 design software, 3D kitchen rendering, cabinet layout, bath design, luxury kitchen design, kitchen remodel India')">
    <meta name="author" content="Four Square Design">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <meta name="theme-color" content="#020617">

    <!-- Canonical -->
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Open Graph -->
    <meta property="og:site_name" content="Four Square Design">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:title" content="@yield('og_title', 'Four Square Design | Bespoke Kitchen & Interior Artistry')">
    <meta property="og:description" content="@yield('og_description', 'Four Square Design is an Ahmedabad-based studio specializing in bespoke kitchen cabinetry, 2020 Design layouts, 3D renderings, and luxury bath artistry.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Four Square Design | Bespoke Kitchen & Interior Artistry')">
    <meta name="twitter:description" content="@yield('og_description', 'Four Square Design is an Ahmedabad-based studio specializing in bespoke kitchen cabinetry, 2020 Design layouts, 3D renderings, and luxury bath artistry.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <!-- 3D & Animation Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- App Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- JSON-LD Schema (per-page) -->
    @stack('schema')
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-50 overflow-x-hidden w-full">

    <!-- ===== THREE.JS PARTICLE CANVAS ===== -->
    <canvas id="particle-canvas"></canvas>


    <div id="app" class="relative">
        <!-- Background Grid Global -->
        <div class="fixed inset-0 bg-grid opacity-20 pointer-events-none z-0"></div>

        <div class="relative z-10">
            <!-- Navigation -->
            @include('partials.header')

            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            @include('partials.footer')
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>

    <!-- 3D Animation System -->
    <script src="{{ asset('js/animations.js') }}"></script>

    @stack('scripts')

    <!-- ===== CONTACT POPUP ===== -->
    <div id="contact-popup-overlay"
         class="fixed inset-0 z-[999] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-500"
         style="background:rgba(0,0,0,0.75);backdrop-filter:blur(6px);">

        <div id="contact-popup"
             class="relative w-full max-w-lg bg-[#111111] border border-white/10 rounded-2xl shadow-2xl translate-y-6 transition-transform duration-500 overflow-hidden">

            {{-- Amber top bar --}}
            <div class="h-1 w-full bg-amber-500"></div>

            <div class="p-8 md:p-10">

                {{-- Header --}}
                <div class="flex items-start justify-between mb-8">
                    <div>
                        <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.45em] mb-2">Get In Touch</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-white leading-snug">
                            Let's Discuss Your<br>
                            <span class="font-serif italic font-normal text-amber-500">Next Project</span>
                        </h3>
                    </div>
                    <button onclick="closeContactPopup()"
                            class="w-9 h-9 rounded-full border border-white/15 flex items-center justify-center text-white/50 hover:text-white hover:border-white/40 transition-all duration-200 flex-shrink-0 ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Success message --}}
                <div id="popup-success" style="display:none;" class="mb-6 p-4 bg-amber-500/10 border border-amber-500/20 rounded-xl items-center gap-3 text-amber-500 text-sm font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Message sent! We'll get back to you within 24 hours.</span>
                </div>

                {{-- Form --}}
                <form id="popup-contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[12px] text-white/50 font-medium mb-3 uppercase tracking-wider">Name</label>
                            <input type="text" name="name" required placeholder="Your Name"
                                   class="popup-input w-full border-b border-white/15 pb-3 text-[13px] text-white placeholder-white/20 focus:outline-none focus:border-amber-500 transition-colors duration-200"
                                   style="background:transparent;">
                        </div>
                        <div>
                            <label class="block text-[12px] text-white/50 font-medium mb-3 uppercase tracking-wider">Email</label>
                            <input type="email" name="email" required placeholder="your@email.com"
                                   class="popup-input w-full border-b border-white/15 pb-3 text-[13px] text-white placeholder-white/20 focus:outline-none focus:border-amber-500 transition-colors duration-200"
                                   style="background:transparent;">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[12px] text-white/50 font-medium mb-3 uppercase tracking-wider">Message</label>
                        <textarea name="message" rows="4" required placeholder="How can we help with your design?"
                                  class="popup-input w-full border-b border-white/15 pb-3 text-[13px] text-white placeholder-white/20 focus:outline-none focus:border-amber-500 transition-colors duration-200 resize-none"
                                  style="background:transparent;"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-amber-500 hover:bg-amber-400 text-black font-bold text-[13px] tracking-widest uppercase py-4 rounded-xl transition-all duration-300 hover:shadow-[0_8px_30px_rgba(245,158,11,0.3)] flex items-center justify-center gap-2">
                        Send Message
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </form>

                <p class="text-center text-white/20 text-[11px] mt-5">
                    Or email us at <a href="mailto:foursquaredesigns.fsd@gmail.com" class="text-amber-500/70 hover:text-amber-500 transition-colors">foursquaredesigns.fsd@gmail.com</a>
                </p>
            </div>
        </div>
    </div>

    <style>
        .popup-input:-webkit-autofill,
        .popup-input:-webkit-autofill:hover,
        .popup-input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px #111111 inset !important;
            -webkit-text-fill-color: #ffffff !important;
        }
    </style>

    <script>
        function openContactPopup() {
            const overlay = document.getElementById('contact-popup-overlay');
            const popup   = document.getElementById('contact-popup');
            overlay.classList.remove('opacity-0','pointer-events-none');
            overlay.classList.add('opacity-100');
            popup.classList.remove('translate-y-6');
            document.body.style.overflow = 'hidden';
        }

        function closeContactPopup() {
            const overlay = document.getElementById('contact-popup-overlay');
            const popup   = document.getElementById('contact-popup');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0','pointer-events-none');
            popup.classList.add('translate-y-6');
            document.body.style.overflow = '';
            sessionStorage.setItem('contactPopupShown', '1');
        }

        // Close on backdrop click
        document.getElementById('contact-popup-overlay').addEventListener('click', function(e) {
            if (e.target === this) closeContactPopup();
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeContactPopup();
        });

        // AJAX form submit
        document.getElementById('popup-contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const btn  = form.querySelector('button[type="submit"]');
            const originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin w-4 h-4 inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>Sending…';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(function(r) {
                if (!r.ok) throw new Error('Server error');
                return r.json();
            })
            .then(function(data) {
                if (data.success) {
                    const successEl = document.getElementById('popup-success');
                    successEl.style.display = 'flex';
                    form.reset();
                    btn.disabled = false;
                    btn.innerHTML = originalHTML;
                    setTimeout(closeContactPopup, 2500);
                }
            })
            .catch(function() {
                btn.disabled = false;
                btn.innerHTML = originalHTML;
                alert('Something went wrong. Please try again or email us directly.');
            });
        });

        // Auto-open after 3 s, once per session
        if (!sessionStorage.getItem('contactPopupShown')) {
            setTimeout(openContactPopup, 3000);
        }
    </script>
</body>
</html>

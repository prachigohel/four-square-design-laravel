@extends('layouts.frontend')

@section('title', 'Four Square Design | Bespoke Kitchen & Interior Artistry')

@section('content')

{{-- ===================== HERO ===================== --}}
<section class="relative h-screen min-h-[700px] md:min-h-[900px] flex items-center overflow-hidden">

    {{-- Background image with heavy left-side darkening --}}
    <div class="absolute inset-0 z-0">
        <img
            src="{{ asset('images/kitchen-hero.png') }}"
            alt="Luxury Kitchen"
            class="w-full h-full object-cover scale-110 animate-slow-zoom"
        />
        {{-- Primary: strong left-to-right dark wash --}}
        <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(2,6,23,0.97) 0%, rgba(2,6,23,0.88) 40%, rgba(2,6,23,0.55) 65%, rgba(2,6,23,0.15) 100%);"></div>
        {{-- Secondary: top & bottom vignette --}}
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(2,6,23,0.55) 0%, transparent 30%, transparent 60%, rgba(2,6,23,0.85) 100%);"></div>
        {{-- Tertiary: dark panel covering the text column --}}
        <div class="absolute inset-0" style="background: radial-gradient(ellipse 65% 90% at 20% 50%, rgba(2,6,23,0.45) 0%, transparent 100%);"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-16 relative z-10">
        <div class="max-w-3xl space-y-8">

            {{-- Eyebrow --}}
            <div class="flex items-center gap-4">
                <div class="w-16 h-[1px] bg-amber-500/70"></div>
                <span class="hero-eyebrow text-amber-400 text-[10px] font-black uppercase tracking-[0.5em]">Specialized Kitchen &amp; Interior Design</span>
            </div>

            {{-- Headline --}}
            <h1 class="hero-heading text-5xl sm:text-6xl md:text-7xl lg:text-[5.5rem] font-serif text-white leading-[1.05] tracking-tight">
                <em>Bespoke Kitchen &amp;</em><br>
                <span class="text-amber-400 not-italic font-bold">Bath Artistry</span>
            </h1>

            {{-- Sub-headline --}}
            <p class="hero-sub text-base md:text-lg text-white/90 font-light leading-relaxed max-w-xl">
                Curating high-end interior experiences with 2020 Design precision.<br>
                From meticulous planning to 4K visualizations, we craft the heart of your home.
            </p>

            {{-- CTAs --}}
            <div class="flex flex-col sm:flex-row gap-5 items-start pt-4">
                <a href="{{ url('/portfolio') }}" class="btn-gold group">
                    Explore Portfolio
                    <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform" size="14"></i>
                </a>
                <a href="{{ url('/request') }}" class="btn-outline">
                    Inquire Project
                </a>
            </div>

            {{-- Inline stats strip --}}
            <div class="flex items-center gap-7 pt-8 border-t border-white/10 mt-2">
                <div>
                    <span class="block text-white text-2xl font-serif italic leading-none hero-sub">8+</span>
                    <span class="block text-slate-500 text-[9px] font-black uppercase tracking-[0.35em] mt-1.5">Years Exp.</span>
                </div>
                <div class="w-[1px] h-8 bg-white/15 shrink-0"></div>
                <div>
                    <span class="block text-white text-2xl font-serif italic leading-none hero-sub">2K+</span>
                    <span class="block text-slate-500 text-[9px] font-black uppercase tracking-[0.35em] mt-1.5">Projects</span>
                </div>
                <div class="w-[1px] h-8 bg-white/15 shrink-0"></div>
                <div>
                    <span class="block text-white text-2xl font-serif italic leading-none hero-sub">12+</span>
                    <span class="block text-slate-500 text-[9px] font-black uppercase tracking-[0.35em] mt-1.5">Brands</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex-col items-center gap-3 text-white/40 hidden md:flex">
        <span class="text-[9px] uppercase tracking-[0.5em] font-black">Discover More</span>
        <div class="w-[1px] h-16 bg-gradient-to-b from-amber-500/60 to-transparent"></div>
    </div>
</section>

{{-- ===================== BRAND LOGOS MARQUEE ===================== --}}
<section class="bg-[#0d0d0d] pt-12 pb-14 border-y border-white/5 overflow-hidden">
    <p class="text-center text-[10px] font-black uppercase tracking-[0.45em] text-slate-500 mb-10 px-6">
        Elevating Professionals Through Exclusive Cabinetry Brand Catalogs
    </p>

    @php
    $logos = [
        ['home/logos/Kraftmaid-Logo-Vector.svg-.png', 'KraftMaid'],
        ['home/logos/MD_Logo_CMYK_LG.png',            'Medallion'],
        ['Merillat_Logo.svg',                          'Merillat Cabinetry'],
        ['home/logos/cnc_logo.png',                    'CNC Cabinetry'],
        ['home/logos/Bellmont-Logo.png',               'Bellmont'],
        ['home/logos/2016_smartLogo-500x198_slider.png', 'Smart Cabinetry'],
        ['home/logos/yorktowne-cabinetry-logo.png',    'Yorktowne Cabinetry'],
        ['home/logos/nmwLargeLogo.png',                'Fabuwood'],
        ['plain_fency.svg',                            'Plain & Fancy'],
        ['home/logos/woodmode_logo.png',               'Wood-Mode'],
        ['home/logos/omega_logo.png',                  'Omega Cabinetry'],
        ['home/logos/decore_logo.png',                 'Decore-ative Specialties'],
    ];
    @endphp

    <div class="marquee-wrapper">
        <div class="marquee-inner">
            @foreach(array_merge($logos, $logos) as $logo)
            <div class="flex-shrink-0 flex items-center justify-center px-10 md:px-14">
                <img
                    src="{{ asset('images/' . $logo[0]) }}"
                    alt="{{ $logo[1] }}"
                    class="marquee-logo-img h-9 max-w-[130px] object-contain hidden"
                    onload="this.classList.remove('hidden'); this.nextElementSibling.classList.add('hidden');"
                    onerror="this.closest('div').remove();"
                >
                <span class="marquee-logo-text whitespace-nowrap">{{ $logo[1] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== ARTISTRY IN INTERIOR PLANNING ===================== --}}
<section class="py-20 md:py-32 bg-[#0a0a0a] border-t border-white/5">
    <div class="container mx-auto px-6 lg:px-16">

        {{-- Section heading --}}
        <div class="mb-14 md:mb-16">
            <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.5em] block mb-4">Who We Are</span>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-serif text-white leading-tight">
                <em>Artistry in </em><span class="text-amber-500 not-italic font-bold">Interior</span> <em>Planning</em>
            </h2>
        </div>

        {{-- Bento Grid: left tall card + right nested grid --}}
        <div class="flex flex-col lg:flex-row gap-4 md:gap-5">

            {{-- LEFT — Main text card --}}
            <div class="bento-card p-8 md:p-12 flex flex-col justify-center gap-6 lg:w-[58%] shrink-0">
                <div class="w-10 h-[2px] bg-amber-500"></div>
                <p class="text-slate-300 text-lg leading-relaxed font-light">
                    We specialize in Kitchen &amp; Bath design, delivering precise, build-ready layouts using industry-standard 2020 Design.
                    With over 8 years of experience, we focus on creating functional, detail-driven spaces that seamlessly translate from concept to execution.
                </p>
                <p class="text-slate-400 leading-relaxed font-light">
                    Working alongside professionals who use leading cabinetry brands, we provide accurate cabinet layouts,
                    NKBA-compliant planning, and high-quality 4K visualizations—ensuring every design is both technically sound and visually compelling.
                </p>
            </div>

            {{-- RIGHT — Nested 2-col grid --}}
            <div class="grid grid-cols-2 gap-4 md:gap-5 flex-1">

                {{-- 8+ Years --}}
                <div class="bento-card p-6 md:p-8 flex flex-col items-center justify-center text-center gap-2">
                    <span class="text-5xl md:text-6xl font-serif italic text-amber-500 leading-none">8+</span>
                    <span class="text-[9px] font-black uppercase tracking-[0.28em] text-slate-500 leading-snug mt-1">Years of<br>Excellence</span>
                </div>

                {{-- 2K+ Projects --}}
                <div class="bento-card p-6 md:p-8 flex flex-col items-center justify-center text-center gap-2">
                    <span class="text-5xl md:text-6xl font-serif italic text-amber-500 leading-none">2K+</span>
                    <span class="text-[9px] font-black uppercase tracking-[0.28em] text-slate-500 leading-snug mt-1">Projects<br>Delivered</span>
                </div>

                {{-- NKBA — full width row --}}
                <div class="col-span-2 bento-card p-5 md:p-6 flex items-center gap-5">
                    <div class="w-11 h-11 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center shrink-0">
                        <i data-lucide="shield-check" class="text-amber-500" size="20"></i>
                    </div>
                    <div>
                        <h4 class="text-white text-xs font-black uppercase tracking-widest mb-1">NKBA Compliant</h4>
                        <p class="text-slate-500 text-xs font-light leading-relaxed">National Kitchen &amp; Bath Association standards in every project.</p>
                    </div>
                </div>

                {{-- ADA Standards --}}
                <div class="bento-card p-5 md:p-6 flex flex-col gap-4">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center shrink-0">
                        <i data-lucide="accessibility" class="text-amber-500" size="18"></i>
                    </div>
                    <div>
                        <h4 class="text-white text-xs font-black uppercase tracking-widest mb-1">ADA Standards</h4>
                        <p class="text-slate-500 text-xs font-light leading-relaxed">Inclusive, accessible spatial planning.</p>
                    </div>
                </div>

                {{-- 4K Visualizations --}}
                <div class="bento-card p-5 md:p-6 flex flex-col gap-4">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center shrink-0">
                        <i data-lucide="image" class="text-amber-500" size="18"></i>
                    </div>
                    <div>
                        <h4 class="text-white text-xs font-black uppercase tracking-widest mb-1">4K Visualizations</h4>
                        <p class="text-slate-500 text-xs font-light leading-relaxed">Photorealistic renders &amp; 360° panoramas.</p>
                    </div>
                </div>

            </div>{{-- end right nested grid --}}

        </div>{{-- end bento wrapper --}}
    </div>
</section>

{{-- ===================== OUR EXPERTISE ===================== --}}
<section class="py-20 md:py-32 bg-[#0d0d0d] border-t border-white/5">
    <div class="container mx-auto px-6 lg:px-16">

        <div class="text-center mb-16 md:mb-20">
            <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.5em] block mb-4">What We Do</span>
            <h2 class="text-4xl md:text-5xl font-black uppercase tracking-[0.12em] text-white">
                Our <span class="text-amber-500">Expertise</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Softwares --}}
            <div class="tilt-card expertise-card">
                <div class="expertise-card-icon">
                    <i data-lucide="monitor" class="text-amber-500" size="22"></i>
                </div>
                <h4 class="text-white text-[11px] font-black uppercase tracking-[0.35em] mb-7 mt-2">Softwares</h4>
                <ul class="space-y-3.5 flex-1">
                    <li class="expertise-list-item">2020 Design <span class="text-amber-500/50 text-[9px] ml-1 font-black uppercase">Expert</span></li>
                    <li class="expertise-list-item">AutoCAD</li>
                    <li class="expertise-list-item">SketchUp</li>
                    <li class="expertise-list-item">Cohoom</li>
                    <li class="expertise-list-item">Microsoft Office</li>
                </ul>
                <div class="expertise-card-glow"></div>
            </div>

            {{-- Spatial Planning --}}
            <div class="tilt-card expertise-card">
                <div class="expertise-card-icon">
                    <i data-lucide="layout-dashboard" class="text-amber-500" size="22"></i>
                </div>
                <h4 class="text-white text-[11px] font-black uppercase tracking-[0.35em] mb-7 mt-2">Spatial Planning</h4>
                <ul class="space-y-3.5 flex-1">
                    <li class="expertise-list-item">US-Standard K&amp;B Planning</li>
                    <li class="expertise-list-item">NKBA &amp; ADA Standards</li>
                    <li class="expertise-list-item">Residential &amp; Multi-Family</li>
                    <li class="expertise-list-item">Estimation</li>
                </ul>
                <div class="expertise-card-glow"></div>
            </div>

            {{-- Visualization --}}
            <div class="tilt-card expertise-card">
                <div class="expertise-card-icon">
                    <i data-lucide="camera" class="text-amber-500" size="22"></i>
                </div>
                <h4 class="text-white text-[11px] font-black uppercase tracking-[0.35em] mb-7 mt-2">Visualization</h4>
                <ul class="space-y-3.5 flex-1">
                    <li class="expertise-list-item">High-Quality 3D Rendering</li>
                    <li class="expertise-list-item">Panorama 360° Views</li>
                    <li class="expertise-list-item">Elevations &amp; Perspective</li>
                </ul>
                <div class="expertise-card-glow"></div>
            </div>

            {{-- Communication --}}
            <div class="tilt-card expertise-card">
                <div class="expertise-card-icon">
                    <i data-lucide="message-square" class="text-amber-500" size="22"></i>
                </div>
                <h4 class="text-white text-[11px] font-black uppercase tracking-[0.35em] mb-7 mt-2">Communication</h4>
                <ul class="space-y-3.5 flex-1">
                    <li class="expertise-list-item">Project Coordination</li>
                    <li class="expertise-list-item">Quick Turnaround</li>
                    <li class="expertise-list-item">Developer Support</li>
                    <li class="expertise-list-item">Meticulous Documentation</li>
                </ul>
                <div class="expertise-card-glow"></div>
            </div>

        </div>
    </div>
</section>

{{-- ===================== FROM CONCEPT TO REALITY ===================== --}}
<section class="py-20 md:py-32 bg-[#0a0a0a] border-t border-white/5">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 md:gap-20 items-center">

            {{-- Left: Text --}}
            <div class="space-y-10">
                <div>
                    <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.5em] block mb-4">The Design Process</span>
                    <h2 class="text-4xl md:text-5xl font-serif italic text-white leading-tight">
                        From Concept to <span class="text-amber-500 not-italic font-bold">Reality</span>
                    </h2>
                </div>

                <p class="text-slate-400 leading-relaxed font-light">
                    Our team-based workflow bridges the gap between technical architectural plans and stunning photorealistic visualizations.
                    We don't just design kitchens; we engineer experiences using industry-leading 2020 Design software.
                </p>

                <div class="space-y-4">

                    <div class="process-feature-item">
                        <div class="process-feature-icon">
                            <i data-lucide="shield-check" class="text-amber-500" size="20"></i>
                        </div>
                        <div>
                            <h4 class="text-white text-[11px] font-black uppercase tracking-[0.3em] mb-1.5">US Technical Standards</h4>
                            <p class="text-slate-400 text-sm font-light">NKBA &amp; ADA compliant spatial planning.</p>
                        </div>
                    </div>

                    <div class="process-feature-item">
                        <div class="process-feature-icon">
                            <i data-lucide="zap" class="text-amber-500" size="20"></i>
                        </div>
                        <div>
                            <h4 class="text-white text-[11px] font-black uppercase tracking-[0.3em] mb-1.5">Accelerated Turnaround</h4>
                            <p class="text-slate-400 text-sm font-light">Team-based delivery for large developments.</p>
                        </div>
                    </div>

                    <div class="process-feature-item">
                        <div class="process-feature-icon">
                            <i data-lucide="users" class="text-amber-500" size="20"></i>
                        </div>
                        <div>
                            <h4 class="text-white text-[11px] font-black uppercase tracking-[0.3em] mb-1.5">Developer Support</h4>
                            <p class="text-slate-400 text-sm font-light">Reliable coordination for multi-family units.</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Right: Before / After Comparison Slider --}}
            <div id="compare-slider" class="relative rounded-3xl overflow-hidden border border-white/8 shadow-2xl select-none" style="cursor:col-resize;">

                {{-- Before (2D Draft) --}}
                <img src="{{ asset('images/before.png') }}" alt="2D Draft"
                     class="w-full h-52 md:h-[380px] object-cover block">

                {{-- After (4K Render) --}}
                <img id="compare-after-img" src="{{ asset('images/after.png') }}" alt="4K Render"
                     class="absolute inset-0 w-full h-52 md:h-[380px] object-cover pointer-events-none"
                     style="clip-path: inset(0 0 0 50%);">

                {{-- Draggable handle --}}
                <div id="compare-handle" class="absolute top-0 bottom-0 z-20 flex items-center justify-center"
                     style="left:50%; transform:translateX(-50%); width:2px; background: rgba(245,158,11,0.6); cursor:col-resize;">
                    <div class="w-10 h-10 rounded-full bg-white shadow-2xl flex items-center justify-center flex-shrink-0 border-2 border-amber-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l-3 3 3 3M16 9l3 3-3 3"/>
                        </svg>
                    </div>
                </div>

                {{-- Labels --}}
                <span class="absolute bottom-4 left-4 bg-black/80 backdrop-blur-sm text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full flex items-center gap-2 z-10 pointer-events-none">
                    <i data-lucide="file-text" size="12"></i> 2D Draft
                </span>
                <span class="absolute bottom-4 right-4 bg-amber-500 text-slate-950 text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full flex items-center gap-2 z-10 pointer-events-none">
                    <i data-lucide="image" size="12"></i> 4K Render
                </span>
            </div>

        </div>
    </div>
</section>

{{-- ===================== CLIENT PERSPECTIVES ===================== --}}
<section class="py-20 md:py-36 bg-[#0d0d0d] relative overflow-hidden border-t border-white/5">

    {{-- Ambient glows --}}
    <div class="absolute top-0 right-0 w-[700px] h-[700px] bg-amber-500/5 blur-[150px] -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-amber-500/4 blur-[120px] translate-y-1/2 -translate-x-1/3 pointer-events-none"></div>

    <div class="container mx-auto px-6 lg:px-16 relative z-10">
        <div class="flex flex-col lg:flex-row gap-16 lg:gap-20 items-start">

            {{-- Left: Sticky header --}}
            <div class="w-full lg:w-2/5 space-y-8 lg:sticky lg:top-32">
                <div>
                    <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.5em] block mb-4">Our Reputation</span>
                    <h2 class="text-4xl md:text-6xl font-serif italic text-white leading-tight">
                        Client<br><span class="text-amber-500 not-italic font-bold">Perspectives</span>
                    </h2>
                </div>

                <p class="text-slate-400 font-light leading-relaxed">
                    Trusted by homeowners, remodelers, and developers across the US and India for over 8 years. We take pride in technical precision and aesthetic excellence.
                </p>

                <div class="flex items-center gap-10 pt-2">
                    <div>
                        <span class="block text-white text-4xl font-serif italic">8+</span>
                        <span class="block text-slate-500 text-[9px] font-black uppercase tracking-widest mt-1">Years Exp.</span>
                    </div>
                    <div class="w-[1px] h-12 bg-white/10"></div>
                    <div>
                        <span class="block text-white text-4xl font-serif italic">2000+</span>
                        <span class="block text-slate-500 text-[9px] font-black uppercase tracking-widest mt-1">Projects</span>
                    </div>
                </div>

                <div class="hidden lg:flex gap-4 pt-4">
                    <button onclick="prevTestimonial()" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-amber-500 hover:border-amber-500 hover:text-slate-950 transition-all duration-300">
                        <i data-lucide="arrow-left" size="18"></i>
                    </button>
                    <button onclick="nextTestimonial()" class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-amber-500 hover:border-amber-500 hover:text-slate-950 transition-all duration-300">
                        <i data-lucide="arrow-right" size="18"></i>
                    </button>
                </div>
            </div>

            {{-- Right: Testimonials --}}
            <div class="w-full lg:w-3/5 relative">
                @php
                $testimonials = [
                    [
                        'quote'    => 'Seamless coordination for our multi-family project. The 2020 Design renderings helped us sell 80% of units before completion.',
                        'name'     => 'Michael Rossi',
                        'role'     => 'Developer, LX Group',
                        'initials' => 'MR'
                    ],
                    [
                        'quote'    => 'The level of detail in every elevation and layout exceeded our expectations. True professionals who understand our brand standards.',
                        'name'     => 'Sarah Mitchell',
                        'role'     => 'Kitchen Designer, Studio M',
                        'initials' => 'SM'
                    ],
                    [
                        'quote'    => 'Quick turnaround and NKBA-compliant plans every single time. Four Square has become our go-to design partner.',
                        'name'     => 'David Chen',
                        'role'     => 'Remodeler, Chen Builds',
                        'initials' => 'DC'
                    ],
                    [
                        'quote'    => 'Their expertise in 2020 Design is unmatched. They transformed our rough sketches into a technical masterpiece.',
                        'name'     => 'Elena Rodriguez',
                        'role'     => 'Lead Architect, Urban Nest',
                        'initials' => 'ER'
                    ],
                    [
                        'quote'    => 'The 360° panoramas were a game-changer. It allowed our clients to walk through their future kitchen before ordering.',
                        'name'     => 'James Wilson',
                        'role'     => 'Interior Stylist, Wilson & Co.',
                        'initials' => 'JW'
                    ],
                    [
                        'quote'    => 'Exceptional attention to detail and consistent NKBA compliance. Significantly reduced our project lead times.',
                        'name'     => 'Amanda Lee',
                        'role'     => 'Project Manager, Elite Renovations',
                        'initials' => 'AL'
                    ],
                ];
                @endphp

                <div id="testimonial-slider" class="relative h-[480px] md:h-[400px]">
                    @foreach($testimonials as $i => $t)
                    <div class="testimonial-item absolute inset-0 transition-all duration-700 ease-in-out opacity-0 translate-y-4 pointer-events-none {{ $i === 0 ? 'opacity-100 translate-y-0 pointer-events-auto' : '' }}" data-index="{{ $i }}">
                        <div class="testimonial-glass-card h-full flex flex-col justify-between">
                            <div>
                                <div class="text-amber-500/15 text-8xl font-serif leading-none -mt-6 mb-2 select-none">"</div>
                                <div class="flex gap-1 mb-5 text-amber-500">
                                    <i data-lucide="star" size="13" fill="currentColor"></i>
                                    <i data-lucide="star" size="13" fill="currentColor"></i>
                                    <i data-lucide="star" size="13" fill="currentColor"></i>
                                    <i data-lucide="star" size="13" fill="currentColor"></i>
                                    <i data-lucide="star" size="13" fill="currentColor"></i>
                                </div>
                                <p class="text-white text-xl md:text-2xl font-serif italic leading-relaxed">
                                    "{{ $t['quote'] }}"
                                </p>
                            </div>
                            <div class="flex items-center gap-5 pt-7 border-t border-white/5">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500/20 to-amber-500/5 flex items-center justify-center text-amber-500 font-bold text-sm border border-amber-500/20 shrink-0">
                                    {{ $t['initials'] }}
                                </div>
                                <div>
                                    <span class="block text-white text-[11px] font-black uppercase tracking-[0.3em]">{{ $t['name'] }}</span>
                                    <span class="block text-slate-500 text-[10px] uppercase tracking-wider mt-1">{{ $t['role'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Mobile controls --}}
                <div class="flex lg:hidden justify-center gap-4 mt-6">
                    <button onclick="prevTestimonial()" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-amber-500 hover:border-amber-500 hover:text-slate-950 transition-all">
                        <i data-lucide="arrow-left" size="16"></i>
                    </button>
                    <button onclick="nextTestimonial()" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-amber-500 hover:border-amber-500 hover:text-slate-950 transition-all">
                        <i data-lucide="arrow-right" size="16"></i>
                    </button>
                </div>

                {{-- Progress --}}
                <div class="mt-8 flex items-center gap-4">
                    <div class="flex-1 h-[1px] bg-white/8 overflow-hidden rounded-full">
                        <div id="testimonial-progress" class="h-full bg-gradient-to-r from-amber-500 to-amber-400 transition-all duration-700 rounded-full" style="width: 16.66%"></div>
                    </div>
                    <span id="testimonial-counter" class="text-slate-500 text-[10px] font-black uppercase tracking-widest tabular-nums">01 / 06</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===================== CTA BANNER ===================== --}}
<section class="py-20 md:py-32 bg-[#0a0a0a] relative overflow-hidden border-t border-white/5">

    {{-- Background glow --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="w-[700px] h-[350px] bg-amber-500/7 blur-[130px] rounded-full"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-16 relative z-10">
        <div class="cta-glass-card max-w-5xl mx-auto text-center py-16 md:py-24 px-8 md:px-16">

            {{-- Decorative line --}}
            <div class="flex items-center justify-center gap-4 mb-10">
                <div class="w-20 h-[1px] bg-amber-500/35"></div>
                <div class="w-2 h-2 rounded-full bg-amber-500/70"></div>
                <div class="w-20 h-[1px] bg-amber-500/35"></div>
            </div>

            <h2 class="text-4xl md:text-5xl lg:text-6xl font-serif italic text-white mb-5 leading-tight">
                Ready to Elevate Your<br><span class="text-amber-500">Next Project?</span>
            </h2>
            <p class="text-slate-400 font-light mb-10 text-lg max-w-xl mx-auto leading-relaxed">
                Let's collaborate to create spaces that define luxury and precision.
            </p>
            <a href="{{ url('/request') }}" class="btn-gold inline-flex">
                Start Your Design
                <i data-lucide="arrow-right" size="14"></i>
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    lucide.createIcons();

    // ── Before/After comparison slider ──────────────────────────────
    (function () {
        var slider   = document.getElementById('compare-slider');
        var afterImg = document.getElementById('compare-after-img');
        var handle   = document.getElementById('compare-handle');
        if (!slider || !afterImg || !handle) return;

        var dragging = false;

        function setPos(pct) {
            pct = Math.max(5, Math.min(95, pct));
            afterImg.style.clipPath = 'inset(0 0 0 ' + pct + '%)';
            handle.style.left = pct + '%';
        }

        function getPct(e) {
            var rect = slider.getBoundingClientRect();
            var x = e.touches ? e.touches[0].clientX : e.clientX;
            return ((x - rect.left) / rect.width) * 100;
        }

        handle.addEventListener('mousedown',  function () { dragging = true; });
        handle.addEventListener('touchstart', function () { dragging = true; }, { passive: true });
        document.addEventListener('mouseup',  function () { dragging = false; });
        document.addEventListener('touchend', function () { dragging = false; });
        slider.addEventListener('mousemove', function (e) { if (dragging) setPos(getPct(e)); });
        slider.addEventListener('touchmove', function (e) {
            if (dragging) { e.preventDefault(); setPos(getPct(e)); }
        }, { passive: false });
        slider.addEventListener('click', function (e) { setPos(getPct(e)); });
    })();

    // ── 3D Tilt on expertise cards ──────────────────────────────────
    document.querySelectorAll('.tilt-card').forEach(function (card) {
        card.addEventListener('mousemove', function (e) {
            var rect = card.getBoundingClientRect();
            var x = (e.clientX - rect.left) / rect.width  - 0.5;
            var y = (e.clientY - rect.top)  / rect.height - 0.5;
            card.style.transition = 'transform 0.08s ease, box-shadow 0.4s ease, border-color 0.4s ease';
            card.style.transform  = 'perspective(900px) rotateX(' + (-y * 10).toFixed(2) + 'deg) rotateY(' + (x * 10).toFixed(2) + 'deg) translateZ(12px)';
        });
        card.addEventListener('mouseleave', function () {
            card.style.transition = 'transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease, border-color 0.4s ease';
            card.style.transform  = 'perspective(900px) rotateX(0deg) rotateY(0deg) translateZ(0)';
        });
    });

    // ── Testimonials carousel ───────────────────────────────────────
    var currentTestimonial = 0;
    var items        = document.querySelectorAll('.testimonial-item');
    var progressBar  = document.getElementById('testimonial-progress');
    var counterEl    = document.getElementById('testimonial-counter');

    function showTestimonial(index) {
        items.forEach(function (el) {
            el.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
            el.classList.remove('opacity-100', 'pointer-events-auto');
            el.style.transform = 'translateY(1rem)';
        });

        var active = items[index];
        active.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
        active.classList.add('opacity-100', 'pointer-events-auto');
        active.style.transform = 'translateY(0)';

        if (progressBar) progressBar.style.width = (((index + 1) / items.length) * 100) + '%';
        if (counterEl)   counterEl.textContent   = '0' + (index + 1) + ' / 0' + items.length;

        currentTestimonial = index;
        lucide.createIcons();
    }

    function nextTestimonial() { showTestimonial((currentTestimonial + 1) % items.length); }
    function prevTestimonial() { showTestimonial((currentTestimonial - 1 + items.length) % items.length); }

    setInterval(nextTestimonial, 7000);
</script>
@endpush

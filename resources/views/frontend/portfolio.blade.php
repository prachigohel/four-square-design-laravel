@extends('layouts.frontend')

@section('title', 'Portfolio | Four Square Design')

@section('content')

<!-- Hero Section -->
<section class="pt-28 md:pt-40 pb-16 md:pb-24 bg-black text-white text-center relative overflow-hidden">
    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <h1 class="leading-none tracking-tight">
            <span class="font-serif italic font-normal text-white" style="font-size: clamp(3.5rem, 9vw, 9rem)">OUR </span><span class="font-black uppercase text-amber-500 not-italic" style="font-size: clamp(3.5rem, 9vw, 9rem); font-family: 'Outfit', sans-serif;">PORTFOLIO</span>
        </h1>
        <p class="text-slate-400 text-base lg:text-lg mt-8 mx-auto leading-relaxed whitespace-nowrap">
            Explore our curated selection of Premium Residential and Multi-Family projects, designed to exact NKBA and ADA standards.
        </p>
    </div>
</section>

<!-- Technical Layout Section -->
<section class="pb-20 bg-black">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="bg-zinc-900 rounded-3xl p-6 md:p-10 lg:p-14 flex flex-col lg:flex-row items-center gap-8 lg:gap-16">
            <!-- Left: Text Content -->
            <div class="flex-1 space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-[1px] bg-amber-500"></div>
                    <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.4em]">Technical Layout</span>
                </div>
                <h2 class="font-serif italic text-white leading-snug" style="font-size: clamp(1.8rem, 3.5vw, 2.8rem)">
                    Multi-Family Design Sample
                </h2>
                <p class="text-slate-400 leading-relaxed text-sm lg:text-base">
                    Step into our design showcase, featuring meticulously crafted elevations and cabinetry layouts designed to achieve a perfect balance of functionality and visual harmony. Each detail reflects our dedication to precision, premium finishes, and delivering elevated design experiences for multi-family spaces.
                </p>
                <button onclick="openSpecsDrawer()" class="btn-gold inline-flex mt-4 !px-8 !py-4 !text-[10px]">
                    View Full Design Specs
                </button>
            </div>
            <!-- Right: Floor Plan Image -->
            <div class="flex-1 w-full">
                <div class="bg-white rounded-2xl overflow-hidden shadow-2xl p-4 lg:p-6">
                    <img
                        src="{{ asset('images/design-sample/overview.png') }}"
                        class="w-full h-auto object-contain"
                        alt="Multi-Family Design Sample Floor Plan"
                    >
                    <div class="flex justify-between text-xs text-slate-500 pt-3 font-medium">
                        <span>Four Square Designs</span>
                        <span>Multi-Family Design Sample</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Project Gallery -->
<section class="py-20 bg-black">
    <div class="container mx-auto px-6 lg:px-12">
        <h2 class="font-serif italic text-white text-center text-4xl lg:text-5xl mb-14">Project Gallery</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <!-- Card 1: Gourmet Living Kitchen -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer">
                <img src="{{ asset('images/portfolio/image_1.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Gourmet Living Kitchen">
                <div class="absolute top-4 right-4 w-10 h-10 bg-black/80 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 via-black/40 to-transparent translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 class="font-serif italic text-white text-xl mb-3">Gourmet Living Kitchen</h3>
                    <div class="space-y-1">
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Door Style</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Inset Slim Shaker</p></div>
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Finish</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Warm-Off White &amp; Deep Navy</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Serene Bath Retreat -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer">
                <img src="{{ asset('images/portfolio/image_2.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Serene Bath Retreat">
                <div class="absolute top-4 right-4 w-10 h-10 bg-black/80 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 via-black/40 to-transparent translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 class="font-serif italic text-white text-xl mb-3">Serene Bath Retreat</h3>
                    <div class="space-y-1">
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Door Style</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Full Overlay Shaker</p></div>
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Finish</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Pure White Matte</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Dual Vanity Suite -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer">
                <img src="{{ asset('images/portfolio/image_3.3.jpeg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Dual Vanity Suite">
                <div class="absolute top-4 right-4 w-10 h-10 bg-black/80 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 via-black/40 to-transparent translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 class="font-serif italic text-white text-xl mb-3">Dual Vanity Suite</h3>
                    <div class="space-y-1">
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Door Style</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Arch Profile Shaker</p></div>
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Finish</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Antique White &amp; Brass</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Library Nook -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer">
                <img src="{{ asset('images/portfolio/image_4.jpeg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Built-In Library Nook">
                <div class="absolute top-4 right-4 w-10 h-10 bg-black/80 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 via-black/40 to-transparent translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 class="font-serif italic text-white text-xl mb-3">Built-In Library Nook</h3>
                    <div class="space-y-1">
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Door Style</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Open Shelving</p></div>
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Finish</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Deep Navy &amp; Warm Oak</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 5: Coffered Ceiling Kitchen -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer">
                <img src="{{ asset('images/portfolio/image_5.jpeg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Coffered Ceiling Kitchen">
                <div class="absolute top-4 right-4 w-10 h-10 bg-black/80 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 via-black/40 to-transparent translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 class="font-serif italic text-white text-xl mb-3">Coffered Ceiling Kitchen</h3>
                    <div class="space-y-1">
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Door Style</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Raised Panel Traditional</p></div>
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Finish</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Cream &amp; Natural Maple</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 6: Midnight Blue Kitchen -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer">
                <img src="{{ asset('images/portfolio/image_6.jpeg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Midnight Blue Kitchen">
                <div class="absolute top-4 right-4 w-10 h-10 bg-black/80 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 via-black/40 to-transparent translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Multi-Family</p>
                    <h3 class="font-serif italic text-white text-xl mb-3">Midnight Blue Kitchen</h3>
                    <div class="space-y-1">
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Door Style</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Flat Panel Modern</p></div>
                        <div><p class="text-slate-500 text-[8px] font-black uppercase tracking-widest">Finish</p><p class="text-white text-[10px] font-black uppercase tracking-wider">Midnight Blue &amp; Concrete</p></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== DESIGN SPECS DRAWER ===== -->
<div id="specs-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300" onclick="closeSpecsDrawer()"></div>

<div id="specs-drawer" class="fixed inset-0 z-[70] flex items-center justify-center pointer-events-none">
    <div id="specs-panel" class="relative w-[95vw] max-w-6xl h-[90vh] bg-[#111] rounded-2xl border border-white/10 shadow-2xl overflow-hidden flex flex-col lg:flex-row pointer-events-auto translate-y-8 opacity-0 transition-all duration-400">

        <!-- Close Button -->
        <button onclick="closeSpecsDrawer()" class="absolute top-5 right-5 z-10 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- LEFT PANEL -->
        <div class="w-full lg:w-[300px] flex-shrink-0 bg-[#0d0d0d] p-6 md:p-8 overflow-y-auto border-b lg:border-b-0 lg:border-r border-white/8 lg:h-full">
            <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.45em] mb-4">Technical Layout</p>
            <h2 class="font-serif italic text-white text-2xl leading-snug mb-5">
                Multi-Family<br>Design Sample
            </h2>
            <p class="text-slate-400 text-sm leading-relaxed mb-8">
                A refined design showcase of our multi-family layout expertise, where every elevation and cabinetry detail is crafted for precision, functionality, and seamless visual flow—delivering a clean, well-structured, and premium aesthetic.
            </p>

            <!-- Design Specifications Box -->
            <div class="bg-[#1a1a1a] rounded-xl p-5 border border-white/8">
                <p class="text-[9px] font-black uppercase tracking-[0.35em] text-white/60 mb-4">Design Specifications</p>
                <div class="border-t border-white/8 pt-4 grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <p class="text-[8px] font-black uppercase tracking-widest text-slate-500 mb-1">Door Style</p>
                        <p class="text-white text-sm font-black uppercase tracking-wider">Shaker</p>
                    </div>
                    <div>
                        <p class="text-[8px] font-black uppercase tracking-widest text-slate-500 mb-1">Finish</p>
                        <p class="text-white text-sm font-black uppercase tracking-wider">White</p>
                    </div>
                </div>

                <!-- Cabinetry Preview -->
                <div class="relative rounded-lg overflow-hidden bg-white/5 border border-white/8">
                    <p class="text-[8px] font-black uppercase tracking-widest text-slate-500 p-3 pb-2">Cabinetry Details</p>
                    <img
                        src="{{ asset('images/design-sample/cabinetry.png') }}"
                        class="w-full h-28 object-cover opacity-60"
                        alt="Cabinetry Details"
                    >
                    <div class="absolute inset-0 flex items-end justify-center pb-4">
                        <button class="bg-zinc-900/90 text-white text-[9px] font-black uppercase tracking-[0.3em] px-4 py-2 rounded-full border border-white/10 flex items-center gap-2 hover:bg-zinc-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                            View Cabinetry
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-10">

            <!-- Floor Plan Overview -->
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-[1px] bg-white/30"></div>
                    <h3 class="font-serif italic text-white text-xl">Floor Plan Overview</h3>
                </div>
                <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                    <img
                        src="{{ asset('images/design-sample/overview.png') }}"
                        class="w-full h-auto object-contain"
                        alt="Floor Plan Overview"
                    >
                </div>
            </div>

            <!-- Structural Elevations -->
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-[1px] bg-white/30"></div>
                    <h3 class="font-serif italic text-white text-xl">Structural Elevations</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <!-- Elevation 1 -->
                    <div class="group relative bg-zinc-900 rounded-xl overflow-hidden cursor-pointer" onclick="openElevationLightbox('{{ asset('images/design-sample/elevation-fridge.png') }}', 'Refrigerator Elevation')">
                        <img
                            src="{{ asset('images/design-sample/elevation-fridge.png') }}"
                            class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="Refrigerator Elevation"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                            <span class="opacity-0 group-hover:opacity-100 bg-amber-500 text-black text-[9px] font-black uppercase tracking-[0.3em] px-3 py-1.5 rounded-full transition-opacity duration-300">Expand</span>
                        </div>
                        <div class="p-3 flex items-center justify-between">
                            <p class="text-white text-[10px] font-black uppercase tracking-wider">Refrigerator<br>Elevation</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Elevation 2 -->
                    <div class="group relative bg-zinc-900 rounded-xl overflow-hidden cursor-pointer" onclick="openElevationLightbox('{{ asset('images/design-sample/elevation-range.png') }}', 'Range Elevation')">
                        <img
                            src="{{ asset('images/design-sample/elevation-range.png') }}"
                            class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="Range Elevation"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                            <span class="opacity-0 group-hover:opacity-100 bg-amber-500 text-black text-[9px] font-black uppercase tracking-[0.3em] px-3 py-1.5 rounded-full transition-opacity duration-300">Expand</span>
                        </div>
                        <div class="p-3 flex items-center justify-between">
                            <p class="text-white text-[10px] font-black uppercase tracking-wider">Range<br>Elevation</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Elevation 3 -->
                    <div class="group relative bg-zinc-900 rounded-xl overflow-hidden cursor-pointer" onclick="openElevationLightbox('{{ asset('images/design-sample/elevation-island.png') }}', 'Island Elevation')">
                        <img
                            src="{{ asset('images/design-sample/elevation-island.png') }}"
                            class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="Island Elevation"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                            <span class="opacity-0 group-hover:opacity-100 bg-amber-500 text-black text-[9px] font-black uppercase tracking-[0.3em] px-3 py-1.5 rounded-full transition-opacity duration-300">Expand</span>
                        </div>
                        <div class="p-3 flex items-center justify-between">
                            <p class="text-white text-[10px] font-black uppercase tracking-wider">Island<br>Elevation</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Elevation 4 -->
                    <div class="group relative bg-zinc-900 rounded-xl overflow-hidden cursor-pointer" onclick="openElevationLightbox('{{ asset('images/design-sample/bath_1_elevation.png') }}', 'Bath 1 Elevation')">
                        <img
                            src="{{ asset('images/design-sample/bath_1_elevation.png') }}"
                            class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="Bath 1 Elevation"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                            <span class="opacity-0 group-hover:opacity-100 bg-amber-500 text-black text-[9px] font-black uppercase tracking-[0.3em] px-3 py-1.5 rounded-full transition-opacity duration-300">Expand</span>
                        </div>
                        <div class="p-3 flex items-center justify-between">
                            <p class="text-white text-[10px] font-black uppercase tracking-wider">Bath 1<br>Elevation</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Elevation 5 -->
                    <div class="group relative bg-zinc-900 rounded-xl overflow-hidden cursor-pointer" onclick="openElevationLightbox('{{ asset('images/design-sample/bath_2_elevation.png') }}', 'Bath 2 Elevation')">
                        <img
                            src="{{ asset('images/design-sample/bath_2_elevation.png') }}"
                            class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500"
                            alt="Bath 2 Elevation"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                            <span class="opacity-0 group-hover:opacity-100 bg-amber-500 text-black text-[9px] font-black uppercase tracking-[0.3em] px-3 py-1.5 rounded-full transition-opacity duration-300">Expand</span>
                        </div>
                        <div class="p-3 flex items-center justify-between">
                            <p class="text-white text-[10px] font-black uppercase tracking-wider">Bath 2<br>Elevation</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Bottom dot indicator -->
            <div class="flex justify-center pt-2 pb-2">
                <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
            </div>
        </div>

    </div>
</div>

<!-- Elevation Lightbox -->
<div id="elevation-lightbox" class="fixed inset-0 bg-black/95 z-[80] hidden items-center justify-center p-6" onclick="closeElevationLightbox()">
    <button class="absolute top-6 right-6 w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="elevation-lightbox-img" src="" class="max-w-4xl max-h-[85vh] w-full object-contain rounded-2xl shadow-2xl" alt="">
</div>

<!-- Gallery Lightbox -->
<div id="lightbox" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-6" onclick="closeLightbox()">
    <button class="absolute top-6 right-6 w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20 transition-colors" onclick="closeLightbox()">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="lightbox-img" src="" class="max-w-4xl max-h-[85vh] w-full object-contain rounded-2xl shadow-2xl" alt="">
</div>


<!-- Call to Action -->
<section class="py-20 md:py-40 bg-black relative overflow-hidden">
    <div class="absolute inset-0 bg-grid opacity-10 pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-amber-500/10 blur-[150px] rounded-full pointer-events-none"></div>
    <div class="container relative z-10 mx-auto px-6 lg:px-12 text-center space-y-12">
        <h2 class="text-5xl md:text-7xl font-serif italic text-white tracking-tight">
            Your Vision, Our <br><span class="text-amber-500 not-italic font-black" style="font-family:'Outfit',sans-serif">Technical Mastery</span>
        </h2>
        <div class="pt-4">
            <a href="{{ url('/request') }}" class="btn-gold !px-16 !py-6 text-sm inline-flex">
                Start A Conversation
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ---- Design Specs Drawer ----
    function openSpecsDrawer() {
        const overlay = document.getElementById('specs-overlay');
        const panel   = document.getElementById('specs-panel');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => {
            overlay.classList.add('opacity-100');
            overlay.classList.remove('opacity-0');
            panel.classList.remove('translate-y-8', 'opacity-0');
            panel.classList.add('translate-y-0', 'opacity-100');
        });
    }

    function closeSpecsDrawer() {
        const overlay = document.getElementById('specs-overlay');
        const panel   = document.getElementById('specs-panel');
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0');
        panel.classList.add('translate-y-8', 'opacity-0');
        panel.classList.remove('translate-y-0', 'opacity-100');
        setTimeout(() => {
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }, 350);
    }

    // ---- Elevation Lightbox ----
    function openElevationLightbox(src, alt) {
        const lb = document.getElementById('elevation-lightbox');
        document.getElementById('elevation-lightbox-img').src = src;
        document.getElementById('elevation-lightbox-img').alt = alt;
        lb.classList.remove('hidden');
        lb.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeElevationLightbox() {
        const lb = document.getElementById('elevation-lightbox');
        lb.classList.add('hidden');
        lb.classList.remove('flex');
    }

    // ---- Gallery Lightbox ----
    document.querySelectorAll('.portfolio-card').forEach(card => {
        const expandBtn = card.querySelector('.absolute.top-4');
        expandBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const img = card.querySelector('img');
            openLightbox(img.src, img.alt);
        });
        card.addEventListener('click', () => {
            const img = card.querySelector('img');
            openLightbox(img.src, img.alt);
        });
    });

    function openLightbox(src, alt) {
        const lb = document.getElementById('lightbox');
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-img').alt = alt;
        lb.classList.remove('hidden');
        lb.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lb = document.getElementById('lightbox');
        lb.classList.add('hidden');
        lb.classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeLightbox();
            closeSpecsDrawer();
            closeElevationLightbox();
        }
    });
</script>
@endpush

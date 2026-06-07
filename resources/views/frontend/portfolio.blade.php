@extends('layouts.frontend')

@section('title', 'Portfolio | Kitchen & Bath Design Projects | Four Square Design')
@section('meta_description', 'Browse Four Square Design\'s portfolio of completed kitchen and bath projects — including gourmet kitchens, luxury bath retreats, elevation drawings, floor plans, and multi-family unit designs.')
@section('meta_keywords', 'kitchen design portfolio, 3D kitchen rendering portfolio, bath design portfolio, Ahmedabad interior design projects, luxury kitchen gallery, cabinet design gallery India')
@section('og_title', 'Portfolio | Kitchen & Bath Design Projects | Four Square Design')
@section('og_description', 'Browse our completed kitchen and bath design projects — gourmet kitchens, bath retreats, elevation drawings, floor plans, and multi-family designs.')
@section('canonical', url('/portfolio'))

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Four Square Design – Portfolio",
  "url": "{{ url('/portfolio') }}",
  "description": "Portfolio of completed kitchen and bath design projects by Four Square Design, Ahmedabad.",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Four Square Design",
    "url": "{{ url('/') }}"
  }
}
</script>
@endpush

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
                    <div class="relative group cursor-pointer overflow-hidden rounded-lg"
                         onclick="openElevationLightbox('{{ asset('images/design-sample/overview.png') }}', 'Multi-Family Design Sample Floor Plan')">
                        <img
                            src="{{ asset('images/design-sample/overview.png') }}"
                            class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-105"
                            alt="Multi-Family Design Sample Floor Plan"
                        >
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/70 rounded-full p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0zm0 0l3 3" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 8v6M8 11h6" />
                                </svg>
                            </div>
                        </div>
                    </div>
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
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer" onclick="openElevationLightbox('{{ asset('images/portfolio/image_1.png') }}', 'Gourmet Living Kitchen')">
                <img src="{{ asset('images/portfolio/image_1.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Gourmet Living Kitchen">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-start justify-end p-4">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/70 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 transition-all duration-500" style="background:linear-gradient(to top, rgba(0,0,0,0.98) 0%, rgba(0,0,0,0.92) 55%, rgba(0,0,0,0.4) 80%, transparent 100%);">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 style="font-family:'Playfair Display',serif; font-style:italic; color:#fff; font-size:1.25rem; font-weight:700; margin:0 0 10px 0; text-shadow:0 2px 10px rgba(0,0,0,0.9);">Gourmet Living Kitchen</h3>
                    <div class="space-y-1">
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Door Style</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Inset Slim Shaker</p></div>
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Finish</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Warm-Off White &amp; Deep Navy</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Serene Bath Retreat -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer" onclick="openElevationLightbox('{{ asset('images/portfolio/image_2.png') }}', 'Serene Bath Retreat')">
                <img src="{{ asset('images/portfolio/image_2.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Serene Bath Retreat">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-start justify-end p-4">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/70 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 transition-all duration-500" style="background:linear-gradient(to top, rgba(0,0,0,0.98) 0%, rgba(0,0,0,0.92) 55%, rgba(0,0,0,0.4) 80%, transparent 100%);">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 style="font-family:'Playfair Display',serif; font-style:italic; color:#fff; font-size:1.25rem; font-weight:700; margin:0 0 10px 0; text-shadow:0 2px 10px rgba(0,0,0,0.9);">Serene Bath Retreat</h3>
                    <div class="space-y-1">
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Door Style</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Full Overlay Shaker</p></div>
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Finish</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Pure White Matte</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Dual Vanity Suite -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer" onclick="openElevationLightbox('{{ asset('images/portfolio/image_3.3.jpeg') }}', 'Dual Vanity Suite')">
                <img src="{{ asset('images/portfolio/image_3.3.jpeg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Dual Vanity Suite">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-start justify-end p-4">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/70 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 transition-all duration-500" style="background:linear-gradient(to top, rgba(0,0,0,0.98) 0%, rgba(0,0,0,0.92) 55%, rgba(0,0,0,0.4) 80%, transparent 100%);">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 style="font-family:'Playfair Display',serif; font-style:italic; color:#fff; font-size:1.25rem; font-weight:700; margin:0 0 10px 0; text-shadow:0 2px 10px rgba(0,0,0,0.9);">Dual Vanity Suite</h3>
                    <div class="space-y-1">
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Door Style</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Arch Profile Shaker</p></div>
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Finish</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Antique White &amp; Brass</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Library Nook -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer" onclick="openElevationLightbox('{{ asset('images/portfolio/image_4.jpeg') }}', 'Built-In Library Nook')">
                <img src="{{ asset('images/portfolio/image_4.jpeg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Built-In Library Nook">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-start justify-end p-4">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/70 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 transition-all duration-500" style="background:linear-gradient(to top, rgba(0,0,0,0.98) 0%, rgba(0,0,0,0.92) 55%, rgba(0,0,0,0.4) 80%, transparent 100%);">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 style="font-family:'Playfair Display',serif; font-style:italic; color:#fff; font-size:1.25rem; font-weight:700; margin:0 0 10px 0; text-shadow:0 2px 10px rgba(0,0,0,0.9);">Built-In Library Nook</h3>
                    <div class="space-y-1">
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Door Style</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Open Shelving</p></div>
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Finish</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Deep Navy &amp; Warm Oak</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 5: Coffered Ceiling Kitchen -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer" onclick="openElevationLightbox('{{ asset('images/portfolio/image_5.jpeg') }}', 'Coffered Ceiling Kitchen')">
                <img src="{{ asset('images/portfolio/image_5.jpeg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Coffered Ceiling Kitchen">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-start justify-end p-4">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/70 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 transition-all duration-500" style="background:linear-gradient(to top, rgba(0,0,0,0.98) 0%, rgba(0,0,0,0.92) 55%, rgba(0,0,0,0.4) 80%, transparent 100%);">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Residential</p>
                    <h3 style="font-family:'Playfair Display',serif; font-style:italic; color:#fff; font-size:1.25rem; font-weight:700; margin:0 0 10px 0; text-shadow:0 2px 10px rgba(0,0,0,0.9);">Coffered Ceiling Kitchen</h3>
                    <div class="space-y-1">
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Door Style</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Raised Panel Traditional</p></div>
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Finish</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Cream &amp; Natural Maple</p></div>
                    </div>
                </div>
            </div>

            <!-- Card 6: Midnight Blue Kitchen -->
            <div class="portfolio-card group relative overflow-hidden rounded-3xl bg-zinc-900 aspect-square cursor-pointer" onclick="openElevationLightbox('{{ asset('images/portfolio/image_6.jpeg') }}', 'Midnight Blue Kitchen')">
                <img src="{{ asset('images/portfolio/image_6.jpeg') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Midnight Blue Kitchen">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-start justify-end p-4">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/70 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-6 transition-all duration-500" style="background:linear-gradient(to top, rgba(0,0,0,0.98) 0%, rgba(0,0,0,0.92) 55%, rgba(0,0,0,0.4) 80%, transparent 100%);">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-[0.4em] mb-1">Multi-Family</p>
                    <h3 style="font-family:'Playfair Display',serif; font-style:italic; color:#fff; font-size:1.25rem; font-weight:700; margin:0 0 10px 0; text-shadow:0 2px 10px rgba(0,0,0,0.9);">Midnight Blue Kitchen</h3>
                    <div class="space-y-1">
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Door Style</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Flat Panel Modern</p></div>
                        <div><p style="color:#f59e0b; font-size:9px; font-weight:900; text-transform:uppercase; letter-spacing:0.15em; margin:0 0 1px 0;">Finish</p><p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Midnight Blue &amp; Concrete</p></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== DESIGN SPECS DRAWER ===== -->
<div id="specs-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300" onclick="closeSpecsDrawer()"></div>

<div id="specs-drawer" class="fixed inset-0 z-[70] flex items-center justify-center pointer-events-none">
    <div id="specs-panel" class="relative w-[95vw] max-w-6xl h-[90vh] bg-[#111] rounded-2xl border border-white/10 shadow-2xl overflow-hidden flex flex-col lg:flex-row pointer-events-none translate-y-8 opacity-0 transition-all duration-400">

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
                            <p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Refrigerator<br>Elevation</p>
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
                            <p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Range<br>Elevation</p>
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
                            <p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Island<br>Elevation</p>
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
                            <p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Bath 1<br>Elevation</p>
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
                            <p style="color:#ffffff; font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:0.08em; margin:0 0 6px 0;">Bath 2<br>Elevation</p>
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
<div id="elevation-lightbox" onclick="closeElevationLightbox()"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.96); z-index:9999; align-items:center; justify-content:center; padding:1.5rem;">
    <button onclick="event.stopPropagation(); closeElevationLightbox()"
            style="position:absolute; top:1.25rem; right:1.25rem; width:2.75rem; height:2.75rem; background:rgba(255,255,255,0.12); border:none; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background .2s;"
            onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.2rem;height:1.2rem;" stroke="white" fill="none" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="elevation-lightbox-img" src="" alt=""
         style="max-width:90vw; max-height:90vh; width:auto; height:auto; object-fit:contain; border-radius:1rem; box-shadow:0 25px 60px rgba(0,0,0,0.8); display:block; margin:auto;">
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
            panel.classList.remove('translate-y-8', 'opacity-0', 'pointer-events-none');
            panel.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
        });
    }

    function closeSpecsDrawer() {
        const overlay = document.getElementById('specs-overlay');
        const panel   = document.getElementById('specs-panel');
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0');
        panel.classList.add('translate-y-8', 'opacity-0', 'pointer-events-none');
        panel.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
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
        lb.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeElevationLightbox() {
        document.getElementById('elevation-lightbox').style.display = 'none';
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSpecsDrawer();
            closeElevationLightbox();
        }
    });
</script>
@endpush

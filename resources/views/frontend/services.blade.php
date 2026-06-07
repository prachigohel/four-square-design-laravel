@extends('layouts.frontend')

@section('title', 'Kitchen & Interior Design Services | Four Square Design Ahmedabad')
@section('meta_description', 'Explore Four Square Design\'s full range of services: kitchen cabinet design, 2020 Design floor plans, photorealistic 3D renderings, elevation drawings, multi-family layouts, and luxury bath design — based in Ahmedabad, India.')
@section('meta_keywords', 'kitchen design services Ahmedabad, 2020 Design floor plan, 3D rendering service, cabinet elevation drawing, multi-family unit design, bath design India, interior design packages')
@section('og_title', 'Kitchen & Interior Design Services | Four Square Design')
@section('og_description', 'Cabinet layouts, 3D renderings, elevation drawings, multi-family plans & luxury bath design. Full-service interior design studio based in Ahmedabad.')
@section('canonical', url('/services'))

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Four Square Design – Services",
  "url": "{{ url('/services') }}",
  "itemListElement": [
    {
      "@type": "ListItem", "position": 1,
      "item": { "@type": "Service", "name": "Kitchen Cabinet Design", "provider": { "@type": "LocalBusiness", "name": "Four Square Design" }, "description": "Complete 2020 Design kitchen cabinet layouts tailored to your space and style." }
    },
    {
      "@type": "ListItem", "position": 2,
      "item": { "@type": "Service", "name": "3D Photorealistic Rendering", "provider": { "@type": "LocalBusiness", "name": "Four Square Design" }, "description": "4K-quality photorealistic 3D renderings that bring your kitchen and bath designs to life before construction." }
    },
    {
      "@type": "ListItem", "position": 3,
      "item": { "@type": "Service", "name": "Elevation Drawings", "provider": { "@type": "LocalBusiness", "name": "Four Square Design" }, "description": "Detailed wall elevation drawings for kitchen and bath spaces, ready for contractor use." }
    },
    {
      "@type": "ListItem", "position": 4,
      "item": { "@type": "Service", "name": "Multi-Family Unit Design", "provider": { "@type": "LocalBusiness", "name": "Four Square Design" }, "description": "Scalable design solutions for apartment complexes and multi-family residential developments." }
    },
    {
      "@type": "ListItem", "position": 5,
      "item": { "@type": "Service", "name": "Bath Design", "provider": { "@type": "LocalBusiness", "name": "Four Square Design" }, "description": "Luxury bath design with precise cabinet and vanity layouts, tailored to your space." }
    }
  ]
}
</script>
@endpush

@section('content')
<!-- Hero Section -->
<section class="pt-28 md:pt-36 pb-16 md:pb-24 bg-slate-950 text-white relative overflow-hidden min-h-[620px] flex items-center">

    {{-- Ambient glows --}}
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-amber-500/6 blur-[150px] -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-amber-500/4 blur-[120px] translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10 w-full">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            {{-- LEFT: Text content --}}
            <div class="flex-1 space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-[1px] bg-amber-500"></div>
                    <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.5em]">Exceptional Standards</span>
                </div>

                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-serif italic text-white leading-[1.0] tracking-tight">
                    Bespoke <span class="text-amber-500 not-italic font-bold">Interiors</span><br>
                    <span class="text-[0.75em] font-normal not-italic tracking-normal">Technical Artistry</span>
                </h1>

                <p class="text-slate-400 text-lg font-light leading-relaxed max-w-lg">
                    We curate high-end spatial experiences through meticulous 2020 Design precision and NKBA-compliant architectural planning.
                </p>

                {{-- Quick stats row --}}
                <div class="flex items-center gap-8 pt-4 border-t border-white/10">
                    <div>
                        <span class="block text-white text-2xl font-serif italic">09</span>
                        <span class="block text-slate-500 text-[9px] font-black uppercase tracking-widest mt-1">Services</span>
                    </div>
                    <div class="w-[1px] h-8 bg-white/10 shrink-0"></div>
                    <div>
                        <span class="block text-white text-2xl font-serif italic">8+</span>
                        <span class="block text-slate-500 text-[9px] font-black uppercase tracking-widest mt-1">Years Exp.</span>
                    </div>
                    <div class="w-[1px] h-8 bg-white/10 shrink-0"></div>
                    <div>
                        <span class="block text-white text-2xl font-serif italic">2K+</span>
                        <span class="block text-slate-500 text-[9px] font-black uppercase tracking-widest mt-1">Projects</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Visual panel --}}
            <div class="w-full lg:w-[45%] shrink-0">
                <div class="relative rounded-3xl overflow-hidden border border-white/8 shadow-2xl">

                    {{-- Kitchen render image --}}
                    <img src="{{ asset('images/after.png') }}" alt="4K Kitchen Render"
                         class="w-full h-72 md:h-96 object-cover">

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>

                    {{-- Bottom glass info strip --}}
                    <div class="absolute bottom-0 left-0 right-0 p-5 bg-slate-950/50 backdrop-blur-md border-t border-white/8">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-xs font-black uppercase tracking-widest">4K Render Quality</p>
                                <p class="text-slate-400 text-[10px] mt-0.5">Photorealistic · NKBA Compliant · Build-Ready</p>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center shrink-0">
                                <i data-lucide="image" class="text-slate-950" size="15"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Service Cards -->
<section class="py-20 md:py-40 bg-slate-950 relative overflow-hidden">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-10">
            @php
            $services = [
                ['01', 'monitor', 'Bespoke 3D Visualization', 'Industry-leading 2020 Design renderings. We transform your vision into immersive, high-fidelity 3D environments.'],
                ['02', 'shield-check', 'NKBA & ADA Standards', 'Meticulous adherence to global guidelines. We prioritize safety, clearance zones, and ergonomic usability.'],
                ['03', 'settings', 'Appliance Coordination', 'Seamless integration of high-end appliances. We ensure precise cutouts and dedicated mechanical planning.'],
                ['04', 'ruler', 'Custom Cabinetry', 'Elegant detailing for bespoke millwork. Covering frameless, inset, and furniture-style layouts with sophistication.'],
                ['05', 'layout', 'Multi-Family Planning', 'Scalable, design-driven solutions for large-scale developments—combining refined unit layouts with precise estimation.'],
                ['06', 'pen-tool', 'Material Curation', 'Expert selection of premium finishes. We curate palettes that balance modern trends with timeless interior elegance.'],
                ['07', 'bar-chart', 'Technical Estimations', 'Detailed material take-offs and cabinetry estimations. We help you stay within budget while maintaining high-end design integrity.'],
                ['08', 'zap', 'Lighting & Electrical Layouts', 'Strategic lighting placement and electrical callouts. We ensure your space is as functional as it is beautiful.'],
                ['09', 'maximize', '360° Virtual Tours', 'Immersive VR-ready experiences. Walk through your project before construction begins with our interactive panorama exports.']
            ];
            @endphp

            @foreach($services as $service)
            <div class="glass-card p-8 md:p-12 relative group overflow-hidden">
                <span class="absolute top-10 right-12 text-white/5 text-9xl font-black transition-all group-hover:scale-110 group-hover:text-amber-500/10 duration-700">{{ $service[0] }}</span>
                <div class="w-20 h-20 bg-amber-500 rounded-3xl flex items-center justify-center text-slate-950 mb-12 shadow-2xl relative z-10 group-hover:scale-110 transition-transform duration-500">
                    <i data-lucide="{{ $service[1] }}" size="32"></i>
                </div>
                <div class="relative z-10 space-y-6">
                    <h3 class="text-xl md:text-2xl lg:text-3xl font-serif italic text-white">{{ $service[2] }}</h3>
                    <p class="text-slate-400 text-base leading-relaxed font-light">
                        {{ $service[3] }}
                    </p>
                </div>
                <div class="absolute bottom-0 left-0 w-0 h-1 bg-amber-500 transition-all duration-700 group-hover:w-full"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Design Workflow -->
<section class="py-20 md:py-32 bg-[#0a0a0a] border-t border-white/5 relative overflow-hidden">

    {{-- Ambient glow --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="w-[700px] h-[300px] bg-amber-500/6 blur-[120px] rounded-full"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">

        {{-- Section heading --}}
        <div class="text-center mb-16 md:mb-20">
            <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.5em] block mb-4">Proven Methodology</span>
            <h2 class="text-3xl sm:text-5xl md:text-6xl font-serif italic text-white">
                Our Design <span class="text-amber-500 not-italic font-bold">Workflow</span>
            </h2>
        </div>

        {{-- 3-step process flow --}}
        @php
        $steps = [
            ['01', 'pen-tool',   'Technical Schematics',   'Drafting intricate floor plans, elevations, and meticulous mechanical callouts using established US standards.'],
            ['02', 'monitor',    '2020 Design Rendering',  'Producing photorealistic 4K visuals with exact vendor materials to eliminate guesswork and ensure design fidelity.'],
            ['03', 'file-check', 'Final Drawing Package',  'Delivering fully dimensioned, contractor-ready technical documents that bridge the gap from concept to build.'],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-5 relative">

            {{-- Connecting line (desktop only) --}}
            <div class="hidden md:block absolute top-[3.5rem] left-[calc(16.66%+1.5rem)] right-[calc(16.66%+1.5rem)] h-[1px] bg-gradient-to-r from-transparent via-amber-500/30 to-transparent z-0"></div>

            @foreach($steps as $i => $step)
            <div class="workflow-step-card group relative z-10">

                {{-- Step number badge --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500 flex items-center justify-center text-slate-950 font-black text-sm shrink-0 shadow-[0_0_24px_rgba(245,158,11,0.25)] group-hover:shadow-[0_0_40px_rgba(245,158,11,0.4)] transition-shadow duration-500">
                        {{ $step[0] }}
                    </div>
                    {{-- Dot connector (between cards) --}}
                    @if($i < count($steps) - 1)
                    <div class="hidden md:flex flex-1 items-center justify-end">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-500/40"></div>
                    </div>
                    @endif
                </div>

                {{-- Content --}}
                <h4 class="text-white text-lg font-serif italic mb-3 group-hover:text-amber-400 transition-colors duration-300">{{ $step[2] }}</h4>
                <p class="text-slate-400 text-sm font-light leading-relaxed">{{ $step[3] }}</p>

                {{-- Bottom accent --}}
                <div class="absolute bottom-0 left-0 right-0 h-[2px] rounded-b-2xl overflow-hidden">
                    <div class="h-full w-0 bg-gradient-to-r from-amber-500/60 via-amber-400 to-amber-500/60 group-hover:w-full transition-all duration-700"></div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-20 md:py-40 bg-slate-950 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-amber-500/5 blur-[180px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <!-- Header -->
        <div class="text-center space-y-8 mb-14 md:mb-24">
            <div class="inline-flex items-center gap-3 px-6 py-2 border border-amber-500/30 rounded-full bg-amber-500/5">
                <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.4em]">Transparent Pricing</span>
            </div>
            <h2 class="text-3xl sm:text-5xl md:text-7xl font-serif italic text-white leading-none">
                Invest in <span class="text-amber-500 not-italic font-bold">Excellence</span>
            </h2>
            <p class="text-slate-400 text-lg font-light max-w-xl mx-auto leading-relaxed">
                Select the perfect design package tailored to the scale of your project. High-end design, delivered with precision.
            </p>
        </div>

        <!-- Pricing Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 items-start">
            @php
            $plans = [
                [
                    'name'     => 'Kitchen',
                    'label'    => 'Plan for single kitchen design',
                    'price'    => '24.99',
                    'unit'     => 'per design',
                    'features' => [
                        'Kitchen Design',
                        '3 Iterations',
                        'Includes 2020 .KIT File',
                        'Full 3D Render Presentation',
                        'Blueprints & Floorplans',
                        'Cabinet List and Quotations',
                    ],
                    'recommended' => false,
                ],
                [
                    'name'     => 'Full House',
                    'label'    => 'Includes Kitchen + 3 Areas',
                    'price'    => '49.99',
                    'unit'     => 'per design',
                    'features' => [
                        'All in Kitchen Plus "any 3 areas"',
                        'Bathrooms x 3',
                        'Laundry Room',
                        'Mudroom',
                        'Bar',
                        'Entertainment Area',
                        'Kitchenette',
                        'Pantry',
                    ],
                    'recommended' => false,
                ],
                [
                    'name'     => 'Full House+',
                    'label'    => 'Includes Kitchen + 5 Areas',
                    'price'    => '69.99',
                    'unit'     => 'per design',
                    'features' => [
                        'All in Kitchen Plus "any 5 areas"',
                        'Bathrooms x 4',
                        'Laundry Room',
                        'Mudroom',
                        'Bar',
                        'Entertainment Area',
                        'Kitchenette',
                        'Pantry',
                    ],
                    'recommended' => false,
                ],
                [
                    'name'     => 'Retainer',
                    'label'    => 'Enjoy kitchen designs as low as $19 per design',
                    'price'    => '1199',
                    'unit'     => 'per month',
                    'features' => [
                        'All in Full House Plan plus',
                        'Dedicated Design Expert',
                        '65 Designs a Month',
                        'Instant Design Assistance',
                        'Quote Creation',
                        'Personalized Design Packets',
                    ],
                    'recommended' => true,
                ],
            ];
            @endphp

            @foreach($plans as $plan)
            <div class="relative flex flex-col rounded-3xl border overflow-hidden
                {{ $plan['recommended']
                    ? 'border-amber-500/50 bg-amber-500/10 shadow-[0_0_60px_rgba(245,158,11,0.15)]'
                    : 'border-white/10 bg-white/5' }}">

                @if($plan['recommended'])
                <div class="bg-amber-500 text-slate-950 text-[10px] font-black uppercase tracking-[0.4em] text-center py-3">
                    Recommended
                </div>
                @endif

                <div class="p-7 md:p-10 flex flex-col flex-1 space-y-8 md:space-y-10">
                    <!-- Plan Name & Label -->
                    <div class="space-y-3">
                        <h3 class="text-xl font-black uppercase tracking-widest {{ $plan['recommended'] ? 'text-amber-400' : 'text-white' }}">
                            {{ $plan['name'] }}
                        </h3>
                        <p class="text-slate-500 text-[10px] uppercase tracking-widest font-bold leading-relaxed">
                            {{ $plan['label'] }}
                        </p>
                    </div>

                    <!-- Price -->
                    <div class="flex items-end gap-1">
                        <span class="text-4xl lg:text-5xl xl:text-6xl font-black text-white leading-none break-all">
                            {{ $plan['price'] }}<sup class="text-xl text-amber-500">$</sup>
                        </span>
                    </div>
                    <p class="text-slate-500 text-[10px] uppercase tracking-widest font-bold -mt-4">{{ $plan['unit'] }}</p>

                    <!-- CTA -->
                    <a href="{{ url('/request') }}"
                        class="{{ $plan['recommended'] ? 'btn-gold' : 'btn-outline' }} !py-4 !text-[10px] w-full justify-center">
                        Get Started
                        <i data-lucide="arrow-right" size="14"></i>
                    </a>

                    <!-- Divider -->
                    <div class="border-t {{ $plan['recommended'] ? 'border-amber-500/20' : 'border-white/5' }}"></div>

                    <!-- Features -->
                    <div class="space-y-4">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] {{ $plan['recommended'] ? 'text-amber-500' : 'text-slate-500' }}">
                            {{ $plan['recommended'] ? 'Package Features:' : ($loop->first ? 'Everything Included:' : 'Package Features:') }}
                        </p>
                        <ul class="space-y-4">
                            @foreach($plan['features'] as $feature)
                            <li class="flex items-start gap-3 text-slate-300 text-sm font-light">
                                <i data-lucide="check" size="14" class="text-amber-500 mt-0.5 shrink-0"></i>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Bottom CTA -->
<section class="bg-[#0a0a0a] border-t border-white/5 py-24 md:py-32 overflow-hidden relative">

    {{-- Ambient glows --}}
    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[400px] bg-amber-500/4 blur-[160px] pointer-events-none rounded-full"></div>

    <div class="container mx-auto px-6 lg:px-16 relative z-10">

        {{-- Top label --}}
        <div class="flex items-center justify-center gap-4 mb-10">
            <div class="h-px w-12 bg-amber-500/40"></div>
            <span class="text-amber-500 text-[9px] font-black uppercase tracking-[0.5em]">Begin Your Journey</span>
            <div class="h-px w-12 bg-amber-500/40"></div>
        </div>

        {{-- Heading --}}
        <div class="text-center mb-10">
            <h2 class="text-5xl sm:text-6xl md:text-7xl font-serif text-white leading-tight">
                <em>Let's Build</em> <span class="text-amber-500 not-italic font-bold">Your Vision</span>
            </h2>
            <p class="text-slate-400 text-base font-light leading-relaxed max-w-xl mx-auto mt-6">
                From concept sketches to build-ready construction documents — precision-crafted kitchen and bath designs that contractors trust.
            </p>
        </div>

        {{-- Feature pills --}}
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            @foreach(['NKBA-Compliant Drawings', '2020 Design 4K Renderings', 'Contractor-Ready Packages', 'US-Standard Specifications'] as $item)
            <span class="flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/4 text-slate-300 text-xs font-medium">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></span>
                {{ $item }}
            </span>
            @endforeach
        </div>

        {{-- CTA buttons --}}
        <div class="flex flex-wrap items-center justify-center gap-4 mb-16">
            <a href="{{ url('/request') }}" class="btn-gold inline-flex items-center gap-3 !px-10 !py-4">
                <span>Start Your Project</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ url('/contact') }}" class="px-10 py-4 rounded-full border border-white/15 text-white/60 text-sm font-semibold hover:border-amber-500/40 hover:text-amber-500 transition-all duration-300">
                Ask a Question
            </a>
        </div>

        {{-- Stats row --}}
        <div class="flex items-center justify-center gap-10 md:gap-16 pt-10 border-t border-white/8 max-w-lg mx-auto">
            <div class="text-center">
                <p class="text-amber-500 text-3xl font-black">2000+</p>
                <p class="text-slate-500 text-[9px] font-black uppercase tracking-widest mt-1">Projects</p>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="text-center">
                <p class="text-amber-500 text-3xl font-black">8+</p>
                <p class="text-slate-500 text-[9px] font-black uppercase tracking-widest mt-1">Years</p>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="text-center">
                <p class="text-amber-500 text-3xl font-black">100%</p>
                <p class="text-slate-500 text-[9px] font-black uppercase tracking-widest mt-1">Satisfaction</p>
            </div>
        </div>

    </div>
</section>
@endsection

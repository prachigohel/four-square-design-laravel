<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Four Square Designs | Bespoke Kitchen & Interior Artistry')</title>
    <meta name="description" content="@yield('meta_description', 'Curating high-end interior experiences with 2020 Design precision. Specialized in Kitchen & Bath artistry for luxury homes.')">
    <meta name="theme-color" content="#020617">

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
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-50 overflow-x-hidden w-full">

    <!-- ===== THREE.JS PARTICLE CANVAS ===== -->
    <canvas id="particle-canvas"></canvas>

    <!-- ===== CUSTOM CURSOR ===== -->
    <div id="custom-cursor"></div>
    <div id="cursor-dot"></div>

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
</body>
</html>

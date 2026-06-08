<footer class="bg-slate-950 text-white pt-20 md:pt-32 pb-12 md:pb-16 border-t border-white/5 relative overflow-hidden">
    <!-- Background Glow -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cyan-500/5 blur-[150px] -translate-y-1/2 translate-x-1/2"></div>
    
    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-16 mb-16 md:mb-24">
            <!-- Brand -->
            <div class="md:col-span-5 space-y-10">
                <a href="{{ url('/') }}" class="flex items-center gap-4 group">
                    <div class="w-14 h-14 bg-amber-500 rounded-2xl flex items-center justify-center text-slate-950 font-black text-2xl shadow-[0_0_30px_rgba(245,158,11,0.3)]">
                        FS
                    </div>
                    <div class="flex flex-col">
                        <span class="text-white font-serif italic font-bold text-3xl tracking-tight leading-none group-hover:text-amber-500 transition-colors">Four Square</span>
                        <span class="text-amber-500 text-xs font-black uppercase tracking-[0.4em] leading-none mt-1">DESIGNS</span>
                    </div>
                </a>
                <p class="text-slate-400 text-lg leading-relaxed font-light max-w-md serif-italic">
                    "Curating bespoke interior artistry with a focus on high-end kitchen and bath design. Bringing US-standard elegance to the heart of your home."
                </p>
                <div class="flex gap-6">
                    @foreach(['FB', 'IG', 'LI', 'TW'] as $social)
                    <a href="#" class="w-12 h-12 bg-white/5 border border-white/10 rounded-full flex items-center justify-center text-white hover:bg-amber-500 hover:text-slate-950 hover:border-amber-500 transition-all text-xs font-black tracking-widest shadow-xl">
                        {{ $social }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Navigation -->
            <div class="md:col-span-3">
                <h4 class="text-white text-[10px] font-black uppercase tracking-[0.4em] mb-12 flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                    Navigation
                </h4>
                <ul class="space-y-6">
                    <li><a href="{{ url('/portfolio') }}" class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] hover:text-amber-500 transition-colors">Portfolio</a></li>
                    <li><a href="{{ url('/services') }}" class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] hover:text-amber-500 transition-colors">Services</a></li>
                    <li><a href="{{ url('/request') }}" class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] hover:text-amber-500 transition-colors">Start A Project</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] hover:text-amber-500 transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Inquiries -->
            <div class="md:col-span-4">
                <h4 class="text-white text-[10px] font-black uppercase tracking-[0.4em] mb-12 flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                    Inquiries
                </h4>
                <div class="space-y-10">
                    <div class="space-y-3">
                        <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.2em] block">Office</span>
                        <p class="text-slate-300 text-sm leading-relaxed font-light">E-601, Iscon Platinum, Bopal,<br>Ahmedabad, Gujarat 380058</p>
                    </div>
                    <div class="space-y-3">
                        <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.2em] block">Email</span>
                        <a href="mailto:foursquaredesigns.fsd@gmail.com" class="text-slate-300 text-sm hover:text-amber-500 transition-colors font-light">foursquaredesigns.fsd@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-10 md:pt-16 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 md:gap-10">
            <p class="text-slate-600 text-[10px] font-black uppercase tracking-[0.3em]">&copy; {{ date('Y') }} FOUR SQUARE DESIGN. CRAFTED WITH PRECISION.</p>
            <div class="flex flex-wrap justify-center items-center gap-8">
                <span class="text-slate-500 text-[9px] font-black uppercase tracking-[0.3em] px-4 py-2 bg-white/5 rounded-full border border-white/5">NKBA COMPLIANT</span>
                <span class="text-slate-500 text-[9px] font-black uppercase tracking-[0.3em] px-4 py-2 bg-white/5 rounded-full border border-white/5">ADA STANDARDS</span>
                <span class="text-slate-500 text-[9px] font-black uppercase tracking-[0.3em] px-4 py-2 bg-white/5 rounded-full border border-white/5">US EXPERTISE</span>
            </div>
        </div>
    </div>
</footer>

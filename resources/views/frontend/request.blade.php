@extends('layouts.frontend')

@section('title', 'Start Your Design Project | Request a Quote | Four Square Design')
@section('meta_description', 'Ready to redesign your kitchen or bath? Submit your project details to Four Square Design. Serving residential and multi-family clients with 2020 Design layouts, 3D renderings, and elevation drawings.')
@section('meta_keywords', 'start kitchen design project, request interior design quote, kitchen remodel estimate India, cabinet design request Ahmedabad, hire kitchen designer')
@section('og_title', 'Start Your Design Project | Four Square Design')
@section('og_description', 'Submit your kitchen or bath project details and our design team in Ahmedabad will get back to you with a tailored proposal.')
@section('meta_robots', 'noindex, follow')
@section('canonical', url('/request'))

@section('content')
<section class="min-h-screen bg-slate-950 pt-28 md:pt-40 pb-20 md:pb-32 relative overflow-hidden">
    <!-- Background glows -->
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-amber-500/5 blur-[150px] -translate-y-1/3 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-500/5 blur-[120px] translate-y-1/3 -translate-x-1/3 pointer-events-none"></div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="max-w-2xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-14 space-y-5">
                <h1 class="text-5xl font-serif font-bold text-white tracking-tight">Start Your Project</h1>
                <p class="text-slate-400 text-base font-light leading-relaxed max-w-md mx-auto">
                    Provide us with the details of your vision, and our design team will begin crafting your architectural layout.
                </p>
            </div>

            <!-- Step Indicator -->
            <div class="relative mb-10 px-2">
                <!-- Track line -->
                <div class="absolute top-6 left-0 right-0 h-[2px] bg-white/10 mx-8"></div>
                <div id="progress-track" class="absolute top-6 left-0 h-[2px] bg-amber-500 transition-all duration-700 ease-out mx-8" style="width: 0%;"></div>

                <div class="relative flex justify-between">
                    @foreach([1,2,3,4] as $s)
                    <div class="step-indicator flex flex-col items-center gap-3" data-step="{{ $s }}">
                        <div class="step-circle w-10 h-10 md:w-12 md:h-12 rounded-full border-2 flex items-center justify-center text-xs md:text-sm font-black transition-all duration-500 z-10
                            {{ $s === 1 ? 'bg-amber-500 border-amber-500 text-slate-950' : 'bg-slate-950 border-white/20 text-white/40' }}">
                            {{ $s }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('design-requests.store') }}" method="POST" enctype="multipart/form-data" id="project-form">
                @csrf

                @if ($errors->any())
                <div class="mb-8 p-5 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-400 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <!-- ── Step 1: Client & Project Details ── -->
                <div class="step-panel" id="step-1">
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-10 space-y-8">
                        <div class="space-y-1">
                            <h2 class="text-2xl font-serif font-bold text-white">Client &amp; Project Details</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Full Name <span class="text-red-400">*</span></label>
                                <input type="text" name="full_name" placeholder="John Doe"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                                <p class="field-error hidden text-red-400 text-xs mt-1" data-for="full_name">Full name is required.</p>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Email Address <span class="text-red-400">*</span></label>
                                <input type="email" name="email" placeholder="john@example.com"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                                <p class="field-error hidden text-red-400 text-xs mt-1" data-for="email">Email address is required.</p>
                            </div>
                            <div class="md:col-span-2 space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Phone Number <span class="text-red-400">*</span></label>
                                <input type="tel" name="phone" placeholder="(555) 123-4567"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                                <p class="field-error hidden text-red-400 text-xs mt-1" data-for="phone">Phone number is required.</p>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Request Type</label>
                                <select name="project_type"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-amber-500 transition-colors text-sm appearance-none cursor-pointer">
                                    <option value="">Select</option>
                                    <option value="Design Start">Design Start</option>
                                    <option value="Initial Packet">Initial Packet</option>
                                    <option value="Conversion">Conversion</option>
                                    <option value="Full Package">Full Package</option>
                                    <option value="Design start & Initial Packet">Design start &amp; Initial Packet</option>
                                    <option value="Other Services">Other Services</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Scope</label>
                                <select name="scope"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-amber-500 transition-colors text-sm appearance-none cursor-pointer">
                                    <option value="Remodel / Renovation">Remodel / Renovation</option>
                                    <option value="New Construction">New Construction</option>
                                    <option value="Refacing / Refresh">Refacing / Refresh</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="button" class="next-btn inline-flex items-center gap-3 text-white font-bold text-sm uppercase tracking-widest hover:text-amber-500 transition-colors">
                            Next Step <i data-lucide="arrow-right" size="18"></i>
                        </button>
                    </div>
                </div>

                <!-- ── Step 2: Cabinetry & Design Specifications ── -->
                <div class="step-panel hidden" id="step-2">
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-10 space-y-8">
                        <div class="space-y-1">
                            <h2 class="text-2xl font-serif font-bold text-white italic">Cabinetry &amp; Design Specifications</h2>
                            <p class="text-slate-500 text-sm font-light">Please provide initial cabinetry details to help us refine your technical layout.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Cabinetry Brand</label>
                                <input type="text" name="cabinet_brand" placeholder="e.g. KraftMaid, Omega"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Door Style &amp; Finish</label>
                                <input type="text" name="door_style" placeholder="e.g. Shaker White / Inset Navy"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Ceiling Height</label>
                                <input type="text" name="ceiling_height" placeholder="e.g. 8', 9', 10'"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Wall Cabinet Height</label>
                                <input type="text" name="wall_cabinet_height" placeholder="e.g. 30'', 36'', 42'' / Double Stack"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-8">
                        <button type="button" class="prev-btn inline-flex items-center gap-3 text-slate-500 hover:text-white font-bold text-sm uppercase tracking-widest transition-colors">
                            <i data-lucide="arrow-left" size="18"></i> Back
                        </button>
                        <button type="button" class="next-btn inline-flex items-center gap-3 text-white font-bold text-sm uppercase tracking-widest hover:text-amber-500 transition-colors">
                            Next Step <i data-lucide="arrow-right" size="18"></i>
                        </button>
                    </div>
                </div>

                <!-- ── Step 3: Appliance Specifications ── -->
                <div class="step-panel hidden" id="step-3">
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-10 space-y-8">
                        <div class="space-y-1">
                            <h2 class="text-2xl font-serif font-bold text-white italic">Appliance Specifications</h2>
                            <p class="text-slate-500 text-sm font-light">Please specify appliance sizes or models so we can accurately coordinate cabinet cutouts and electrical/plumbing requirements.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-amber-500">Refrigerator (Size/Type)</label>
                                <input type="text" name="refrigerator" placeholder="e.g. 36'' French Door Sub-Zero"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Range / Cooktop</label>
                                <input type="text" name="range_cooktop" placeholder="e.g. 48'' Dual Fuel Wolf Range"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-amber-500">Ventilation / Hood</label>
                                <input type="text" name="ventilation" placeholder="e.g. 48'' Pro Wall Hood"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-300">Dishwasher</label>
                                <input type="text" name="dishwasher" placeholder="e.g. 24'' Panel Ready Miele"
                                    class="w-full bg-slate-900 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-8">
                        <button type="button" class="prev-btn inline-flex items-center gap-3 text-slate-500 hover:text-white font-bold text-sm uppercase tracking-widest transition-colors">
                            <i data-lucide="arrow-left" size="18"></i> Back
                        </button>
                        <button type="button" class="next-btn inline-flex items-center gap-3 text-white font-bold text-sm uppercase tracking-widest hover:text-amber-500 transition-colors">
                            Next Step <i data-lucide="arrow-right" size="18"></i>
                        </button>
                    </div>
                </div>

                <!-- ── Step 4: Upload & Submit ── -->
                <div class="step-panel hidden" id="step-4">
                    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-10 space-y-8">
                        <div class="space-y-1">
                            <h2 class="text-2xl font-serif font-bold text-white italic">Upload Floor Plans &amp; PDF Exports</h2>
                            <p class="text-slate-500 text-sm font-light">Upload your 2020 Design initial layouts, architectural blueprints, or hand-drawn measurements.</p>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-300">Additional Information</label>
                            <textarea name="additional_notes" rows="4" placeholder="Any specific instructions, style preferences, or details we should know about?"
                                class="w-full bg-slate-900 border border-white/10 rounded-2xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-amber-500 transition-colors text-sm resize-none"></textarea>
                        </div>

                        <!-- File Upload -->
                        <div class="relative group">
                            <input type="file" name="attachments[]" multiple id="file-input"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div id="drop-zone" class="border-2 border-dashed border-white/15 rounded-2xl p-8 md:p-12 text-center group-hover:border-amber-500/50 transition-all bg-slate-900/50 space-y-4">
                                <div class="w-14 h-14 rounded-full bg-slate-800 flex items-center justify-center mx-auto">
                                    <i data-lucide="upload-cloud" size="28" class="text-slate-500 group-hover:text-amber-500 transition-colors"></i>
                                </div>
                                <div>
                                    <p class="text-white font-semibold text-sm">Click to upload or drag and drop</p>
                                    <p class="text-slate-500 text-xs mt-1">Any file format allowed (PDF, JPG, PNG, DWG, etc. up to 50MB)</p>
                                </div>
                                <div id="file-list" class="text-amber-500 text-xs space-y-1 hidden"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-8">
                        <button type="button" class="prev-btn inline-flex items-center gap-3 text-slate-500 hover:text-white font-bold text-sm uppercase tracking-widest transition-colors">
                            <i data-lucide="arrow-left" size="18"></i> Back
                        </button>
                        <button type="submit" class="btn-gold !px-12 !py-4 group">
                            Submit Request
                            <i data-lucide="check-circle" size="18" class="group-hover:scale-110 transition-transform"></i>
                        </button>
                    </div>
                </div>

            </form>

            @if(session('success'))
            <div class="mt-10 p-6 bg-amber-500/10 border border-amber-500/20 rounded-2xl flex items-center gap-4 text-amber-500 animate-fade-in">
                <i data-lucide="check-circle" size="20"></i>
                <span class="text-sm font-bold uppercase tracking-widest">{{ session('success') }}</span>
            </div>
            @endif

        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const totalSteps = 4;
    let current = 1;

    const panels   = document.querySelectorAll('.step-panel');
    const circles  = document.querySelectorAll('.step-circle');
    const track    = document.getElementById('progress-track');

    function updateUI() {
        // Panels
        panels.forEach((p, i) => {
            p.classList.toggle('hidden', i + 1 !== current);
        });

        // Circles
        circles.forEach((c, i) => {
            const step = i + 1;
            c.classList.remove(
                'bg-amber-500', 'border-amber-500', 'text-slate-950',
                'bg-slate-950',  'border-white/20',  'text-white/40',
                'border-green-500', 'bg-green-500/10', 'text-green-400'
            );
            if (step < current) {
                // Completed
                c.classList.add('bg-amber-500', 'border-amber-500', 'text-slate-950');
                c.innerHTML = '<i data-lucide="check" style="width:18px;height:18px;"></i>';
            } else if (step === current) {
                // Active
                c.classList.add('bg-amber-500', 'border-amber-500', 'text-slate-950');
                c.textContent = step;
            } else {
                // Future
                c.classList.add('bg-slate-950', 'border-white/20', 'text-white/40');
                c.textContent = step;
            }
        });

        // Progress track (spans between dots, so 0% at step 1, 100% at step 4)
        const pct = ((current - 1) / (totalSteps - 1)) * 100;
        track.style.width = pct + '%';

        if (window.lucide) window.lucide.createIcons();
    }

    function showFieldError(input, show) {
        const errorEl = document.querySelector(`.field-error[data-for="${input.name}"]`);
        if (show) {
            input.classList.add('border-red-500');
            input.classList.remove('border-white/10');
            if (errorEl) errorEl.classList.remove('hidden');
        } else {
            input.classList.remove('border-red-500');
            input.classList.add('border-white/10');
            if (errorEl) errorEl.classList.add('hidden');
        }
    }

    // Next buttons
    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (current < totalSteps) {
                if (current === 1) {
                    const name  = document.querySelector('[name="full_name"]');
                    const email = document.querySelector('[name="email"]');
                    const phone = document.querySelector('[name="phone"]');
                    const nameInvalid  = !name.value.trim();
                    const emailInvalid = !email.value.trim();
                    const phoneInvalid = !phone.value.trim();
                    showFieldError(name,  nameInvalid);
                    showFieldError(email, emailInvalid);
                    showFieldError(phone, phoneInvalid);
                    if (nameInvalid || emailInvalid || phoneInvalid) return;
                }
                current++;
                updateUI();
                window.scrollTo({ top: 300, behavior: 'smooth' });
            }
        });
    });

    // Back buttons
    document.querySelectorAll('.prev-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (current > 1) {
                current--;
                updateUI();
                window.scrollTo({ top: 300, behavior: 'smooth' });
            }
        });
    });

    // Clear errors on input
    ['full_name', 'email', 'phone'].forEach(fieldName => {
        const el = document.querySelector(`[name="${fieldName}"]`);
        if (el) el.addEventListener('input', () => showFieldError(el, false));
    });

    // File input display
    const fileInput = document.getElementById('file-input');
    const fileList  = document.getElementById('file-list');
    if (fileInput) {
        fileInput.addEventListener('change', function () {
            if (this.files.length > 0) {
                fileList.innerHTML = '';
                Array.from(this.files).forEach(f => {
                    const el = document.createElement('p');
                    el.textContent = f.name;
                    fileList.appendChild(el);
                });
                fileList.classList.remove('hidden');
            }
        });
    }

    updateUI();
});
</script>
@endpush
@endsection

@extends('layouts.frontend')

@section('title', 'Contact Us | Four Square Design Ahmedabad')
@section('meta_description', 'Get in touch with Four Square Design in Ahmedabad. Located at E-601, Iscon Platinum, Bopal — reach us for kitchen design, 3D rendering, and cabinet layout enquiries.')
@section('meta_keywords', 'contact Four Square Design, kitchen design Ahmedabad contact, interior design studio Bopal, design enquiry Gujarat')
@section('og_title', 'Contact Us | Four Square Design Ahmedabad')
@section('og_description', 'Reach out to Four Square Design at E-601, Iscon Platinum, Bopal, Ahmedabad. We\'d love to discuss your next kitchen or bath design project.')
@section('canonical', url('/contact'))

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "name": "Contact Four Square Design",
  "url": "{{ url('/contact') }}",
  "description": "Contact page for Four Square Design — kitchen and interior design studio in Ahmedabad.",
  "mainEntity": {
    "@type": "LocalBusiness",
    "name": "Four Square Design",
    "email": "foursquaredesigns.fsd@gmail.com",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "E-601, Iscon Platinum, Bopal, S.P. Ring Road",
      "addressLocality": "Ahmedabad",
      "addressRegion": "Gujarat",
      "postalCode": "380058",
      "addressCountry": "IN"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "23.0422",
      "longitude": "72.4757"
    },
    "url": "{{ url('/') }}"
  }
}
</script>
@endpush

@section('content')
<section class="min-h-screen bg-[#0d0d0d] text-white flex items-center py-24 lg:py-36 pt-28 md:pt-24">
    <div class="container mx-auto px-8 lg:px-16 xl:px-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-20 xl:gap-32 items-center">

            <!-- Left: Info -->
            <div>
                <!-- Heading -->
                <div class="mb-10">
                    <h1 class="text-5xl md:text-6xl xl:text-7xl font-bold leading-tight tracking-tight text-white mb-2">
                        Let's Discuss Your<br>
                        <span class="font-serif italic font-normal text-amber-500">Next Project</span>
                    </h1>
                </div>

                <!-- Subtitle -->
                <p class="text-white/40 text-base leading-relaxed max-w-sm mb-14">
                    Whether you need a complete kitchen redesign, multi-family unit layouts, or
                    technical drawing sets, our team in Ahmedabad is ready to collaborate with you.
                </p>

                <!-- Contact Info -->
                <div class="space-y-10">
                    <!-- Office -->
                    <div class="flex items-start gap-5">
                        <div class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="map-pin" style="width:15px;height:15px;color:#fff;stroke-width:2;"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-[15px] mb-2">Office Location</p>
                            <p class="text-white/55 text-sm leading-relaxed mb-1.5">
                                E-601, Iscon Platinum, Bopal, S.P. Ring Road,<br>
                                Ahmedabad-380058
                            </p>
                            <p class="text-white/30 text-xs">Serving clients globally with US-Standard expertise.</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-5">
                        <div class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="mail" style="width:15px;height:15px;color:#fff;stroke-width:2;"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-[15px] mb-2">Email Address</p>
                            <a href="mailto:foursquaredesigns.fsd@gmail.com" class="text-white/55 text-sm hover:text-amber-500 transition-colors block mb-1.5">
                                foursquaredesigns.fsd@gmail.com
                            </a>
                            <p class="text-white/30 text-xs">We aim to respond within 24 business hours.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Form Card -->
            <div class="relative pt-5">
                <!-- Dot indicator -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-9 h-9 rounded-full bg-[#1a1a1a] border border-white/10 flex items-center justify-center z-10">
                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
                </div>

                <div class="bg-[#141414] border border-white/[0.08] rounded-2xl p-10 md:p-12">
                    <h2 class="text-[22px] font-bold text-white mb-10">Send us a Message</h2>

                    @if(session('success'))
                        <div class="mb-8 p-4 bg-amber-500/10 border border-amber-500/20 rounded-xl flex items-center gap-3 text-amber-500">
                            <i data-lucide="check-circle" style="width:17px;height:17px;flex-shrink:0;"></i>
                            <span class="text-sm font-semibold">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div class="mb-8">
                            <label class="block text-[13px] text-white/60 font-medium mb-4">Name</label>
                            <input
                                type="text"
                                name="name"
                                required
                                placeholder="Your Name"
                                class="contact-input w-full border-b border-white/15 pb-3 text-[14px] text-white placeholder-white/20 focus:outline-none focus:border-amber-500 transition-colors duration-200"
                                style="background:transparent;"
                            >
                        </div>

                        <!-- Email -->
                        <div class="mb-8">
                            <label class="block text-[13px] text-white/60 font-medium mb-4">Email</label>
                            <input
                                type="email"
                                name="email"
                                required
                                placeholder="your@email.com"
                                class="contact-input w-full border-b border-white/15 pb-3 text-[14px] text-white placeholder-white/20 focus:outline-none focus:border-amber-500 transition-colors duration-200"
                                style="background:transparent;"
                            >
                        </div>

                        <!-- Message -->
                        <div class="mb-10">
                            <label class="block text-[13px] text-white/60 font-medium mb-4">Message</label>
                            <textarea
                                name="message"
                                rows="5"
                                required
                                placeholder="How can we help with your design?"
                                class="contact-input w-full border-b border-white/15 pb-3 text-[14px] text-white placeholder-white/20 focus:outline-none focus:border-amber-500 transition-colors duration-200 resize-none"
                                style="background:transparent;"
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-amber-500 hover:bg-amber-400 text-black font-bold text-[14px] tracking-wide py-5 rounded-xl transition-all duration-300 hover:shadow-[0_8px_30px_rgba(245,158,11,0.3)] flex items-center justify-center gap-2"
                        >
                            Send Message
                            <i data-lucide="arrow-right" style="width:16px;height:16px;"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .contact-input:-webkit-autofill,
    .contact-input:-webkit-autofill:hover,
    .contact-input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px #141414 inset !important;
        -webkit-text-fill-color: #ffffff !important;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>
@endsection

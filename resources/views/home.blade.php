@extends('layouts.app')

@section('title', setting('site_title', 'The Conduit') . ' — ' . setting('hero_headline', 'Where Clinical Rigor Meets Human Testimony'))

@section('content')

    <!-- ============================================================== -->
    <!-- 1. HERO SECTION (Dynamic Photo Background + Parallax + GSAP)   -->
    <!-- ============================================================== -->
    @php
        $heroBg = setting('hero_bg_image') ?: 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1920&q=80';
        $headline = setting('hero_headline', 'Where Clinical Rigor Meets Human Testimony');
        $subtitle = setting('hero_subtitle', 'An independent editorial bureau interrogating modern healthcare frontiers, frontline medical humanitarianism, and bioethics through longform investigative journalism and visual documentary.');
        $edition = setting('hero_edition_label', 'Vol. XXIV — Special Global Health Dispatch');
        $ctaText = setting('hero_cta_text', 'Explore Investigations');
        $ctaUrl = setting('hero_cta_url', route('articles.index'));
        $siteLogo = setting('site_logo') ?: asset('images/conduit-logo.png');
    @endphp

    <section class="relative min-h-[82vh] lg:min-h-[88vh] flex items-center justify-center overflow-hidden bg-conduit-deep text-conduit-cream">
        
        <!-- Background Hero Image Container (Parallax target) -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <img id="hero-parallax-bg" 
                 src="{{ $heroBg }}" 
                 alt="The Conduit Cover Story Background" 
                 class="w-full h-full object-cover object-center transform scale-110 will-change-transform filter brightness-[0.70] contrast-[1.15]">
            <!-- Multi-layered editorial vignette: Deep emerald to charcoal fade -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B3D2E] via-[#0B3D2E]/75 to-[#07241B]/85 mix-blend-multiply"></div>
            <!-- Grain Texture -->
            <div class="absolute inset-0 opacity-15 editorial-grain"></div>
        </div>

        <!-- Hero Editorial Content Container -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10 text-center flex flex-col items-center">
            
            <!-- Issue & Seal Badge (GSAP anim 1) -->
            <div class="gsap-hero-el inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-conduit-deep/90 border border-conduit-gold/50 shadow-xl backdrop-blur-md mb-8">
                <div class="w-6 h-6 rounded-full overflow-hidden border border-conduit-gold flex-shrink-0">
                    <img src="{{ $siteLogo }}" alt="Emblem" class="w-full h-full object-cover">
                </div>
                <span class="text-xs font-mono uppercase tracking-widest text-conduit-light-gold font-semibold">
                    {{ $edition }}
                </span>
            </div>

            <!-- Massive Commanding Headline (GSAP anim 2) -->
            <h1 class="gsap-hero-el font-display font-black text-4xl sm:text-6xl lg:text-7xl tracking-tight text-white leading-[1.08] max-w-4xl text-balance drop-shadow-lg mb-6">
                {{ $headline }}
            </h1>

            <!-- Narrative Subtitle (GSAP anim 3) -->
            <p class="gsap-hero-el font-serif text-lg sm:text-xl lg:text-2xl text-conduit-cream/90 max-w-3xl mx-auto leading-relaxed font-normal text-balance mb-10 drop-shadow">
                {{ $subtitle }}
            </p>

            <!-- Call to Actions & Dispatch Link (GSAP anim 4) -->
            <div class="gsap-hero-el flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto">
                <a href="{{ $ctaUrl }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-conduit-gold hover:bg-conduit-light-gold text-conduit-deep font-display font-extrabold text-sm uppercase tracking-wider shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <span>{{ $ctaText }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="#cover-investigation" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl bg-conduit-emerald/40 hover:bg-conduit-emerald border border-conduit-gold/40 text-conduit-cream font-mono text-xs uppercase tracking-widest backdrop-blur-sm transition-all duration-300">
                    <span>Read Lead Story</span>
                    <svg class="w-3.5 h-3.5 text-conduit-light-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>
            </div>

            <!-- Editorial Coordinates Strip (GSAP anim 5) -->
            <div class="gsap-hero-el mt-14 pt-6 border-t border-conduit-gold/20 flex flex-wrap items-center justify-center gap-6 text-[11px] font-mono text-conduit-cream/70 uppercase tracking-widest">
                <span>Verified Peer Review</span>
                <span>•</span>
                <span>Documentary Field Photography</span>
                <span>•</span>
                <span>Non-Commercial Trust</span>
            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- 2. EDITORIAL FRONT-PAGE: LEAD COVER STORY & THE WIRE           -->
    <!-- ============================================================== -->
    <section id="cover-investigation" class="py-16 lg:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex items-end justify-between border-b-2 border-conduit-deep pb-4 mb-10">
            <div>
                <span class="font-mono text-xs uppercase tracking-widest text-conduit-emerald font-bold block mb-1">
                    Editorial Bureau • Frontline Focus
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-conduit-deep tracking-tight">
                    Today's Primary Investigations
                </h2>
            </div>
            <a href="{{ route('articles.index') }}" class="hidden sm:inline-flex items-center gap-1 text-xs font-mono font-bold uppercase tracking-wider text-conduit-emerald hover:text-conduit-deep transition">
                <span>All Publications</span>
                <span class="text-conduit-gold">&rarr;</span>
            </a>
        </div>

        @php
            $leadArticle = $featuredArticles->first();
            $secondaryArticles = $featuredArticles->slice(1, 4);
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- LEFT (Cols 7): LEAD COVER STORY -->
            @if($leadArticle)
                <article class="lg:col-span-7 bg-white rounded-2xl border border-conduit-border shadow-sm overflow-hidden flex flex-col group hover:shadow-xl transition-shadow duration-300">
                    
                    <!-- Cover Photo with Documentary Crop Marks -->
                    <a href="{{ route('articles.show', $leadArticle->slug) }}" class="relative block h-72 sm:h-96 overflow-hidden bg-gray-100">
                        <img src="{{ $leadArticle->featured_image_url }}" 
                             alt="{{ $leadArticle->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        
                        <div class="absolute top-4 left-4 flex items-center gap-2">
                            <span class="bg-conduit-deep text-conduit-gold text-[10px] font-mono font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow">
                                Cover Investigation
                            </span>
                            @if($leadArticle->category)
                                <span class="bg-white/90 backdrop-blur-sm text-conduit-deep text-[10px] font-mono font-semibold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm">
                                    {{ $leadArticle->category }}
                                </span>
                            @endif
                        </div>

                        <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-sm text-white text-[10px] font-mono px-2 py-1 rounded">
                            Field Dispatch
                        </div>
                    </a>

                    <!-- Editorial Body -->
                    <div class="p-6 sm:p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 text-xs font-mono text-gray-500 mb-3">
                            <time datetime="{{ $leadArticle->published_at?->toISOString() }}">
                                {{ $leadArticle->published_at ? $leadArticle->published_at->format('M d, Y') : 'Recent' }}
                            </time>
                            <span>•</span>
                            <span>By {{ $leadArticle->author->name ?? 'Staff Bureau' }}</span>
                            <span>•</span>
                            <span class="text-conduit-emerald font-semibold">6 Min Read</span>
                        </div>

                        <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-conduit-deep leading-tight mb-4 group-hover:text-conduit-emerald transition">
                            <a href="{{ route('articles.show', $leadArticle->slug) }}">
                                {{ $leadArticle->title }}
                            </a>
                        </h3>

                        <p class="font-serif text-gray-700 text-base sm:text-lg leading-relaxed drop-cap mb-6">
                            {{ $leadArticle->excerpt ?? Str::limit(strip_tags($leadArticle->content), 180) }}
                        </p>

                        <div class="pt-4 border-t border-gray-100 mt-auto flex items-center justify-between">
                            <a href="{{ route('articles.show', $leadArticle->slug) }}" class="inline-flex items-center gap-2 font-display font-bold text-sm text-conduit-emerald group-hover:text-conduit-deep transition">
                                <span>Read Complete Investigation</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                            <span class="font-mono text-xs text-gray-400">Vol. 24</span>
                        </div>
                    </div>

                </article>
            @endif

            <!-- RIGHT (Cols 5): THE CONDUIT WIRE (Chronological Briefs) -->
            <div class="lg:col-span-5 space-y-6">
                
                <div class="bg-conduit-paper rounded-2xl p-6 border border-conduit-border shadow-sm">
                    <div class="flex items-center justify-between pb-3 border-b border-conduit-border mb-4">
                        <h3 class="font-mono font-bold text-xs uppercase tracking-widest text-conduit-deep flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-conduit-gold"></span>
                            The Conduit Wire • Live Briefs
                        </h3>
                        <span class="text-[10px] font-mono text-gray-400 uppercase">Chronological</span>
                    </div>

                    <div class="divide-y divide-conduit-border">
                        @forelse($secondaryArticles as $wireArticle)
                            <article class="py-4 first:pt-0 last:pb-0 group">
                                <div class="flex items-center gap-2 text-[11px] font-mono text-gray-400 mb-1.5">
                                    <span class="text-conduit-emerald font-semibold uppercase">{{ $wireArticle->category ?? 'Dispatch' }}</span>
                                    <span>•</span>
                                    <span>{{ $wireArticle->published_at ? $wireArticle->published_at->format('M d') : 'Recent' }}</span>
                                </div>
                                <h4 class="font-display font-bold text-base text-conduit-deep group-hover:text-conduit-emerald transition leading-snug mb-1.5">
                                    <a href="{{ route('articles.show', $wireArticle->slug) }}">
                                        {{ $wireArticle->title }}
                                    </a>
                                </h4>
                                <p class="font-serif text-xs text-gray-600 line-clamp-2 leading-relaxed">
                                    {{ $wireArticle->excerpt ?? Str::limit(strip_tags($wireArticle->content), 90) }}
                                </p>
                            </article>
                        @empty
                            <p class="text-xs text-gray-500 py-4 font-mono">No supplementary wire briefs available.</p>
                        @endforelse
                    </div>

                    <div class="mt-5 pt-4 border-t border-conduit-border text-center">
                        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-1.5 text-xs font-mono font-bold text-conduit-deep hover:text-conduit-emerald uppercase tracking-wider transition">
                            <span>Access Complete Archive ({{ $featuredArticles->count() }} Dispatches)</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Editorial Quote Callout Box -->
                <div class="bg-conduit-deep text-conduit-cream rounded-2xl p-6 border border-conduit-gold/30 shadow-md">
                    <span class="text-conduit-gold text-2xl font-serif leading-none block mb-2">&ldquo;</span>
                    <blockquote class="font-serif italic text-sm text-conduit-cream/90 leading-relaxed mb-4">
                        Medical reporting is not merely recording data; it is bearing witness to human vulnerability with scientific integrity and unconditional empathy.
                    </blockquote>
                    <p class="font-mono text-[10px] text-conduit-light-gold uppercase tracking-wider">
                        — The Conduit Editorial Charter
                    </p>
                </div>

            </div>

        </div>

    </section>

    <!-- ============================================================== -->
    <!-- 3. VISUAL DOCUMENTARY & DARKROOM REEL (Camera Shutter Focus)   -->
    <!-- ============================================================== -->
    <section id="multimedia" class="py-20 bg-[#061C14] text-conduit-cream border-y border-conduit-emerald/40 overflow-hidden relative">
        <div class="absolute inset-0 opacity-10 editorial-grain pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-conduit-emerald/40 pb-6">
                <div>
                    <div class="flex items-center gap-2 text-conduit-gold font-mono text-xs uppercase tracking-widest mb-1.5">
                        <svg class="w-4 h-4 text-conduit-light-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Lens & Shutter Bureau</span>
                    </div>
                    <h2 class="font-display font-extrabold text-3xl sm:text-5xl text-white">
                        Visual Investigations
                    </h2>
                </div>
                <p class="mt-4 md:mt-0 font-serif text-sm text-conduit-cream/70 max-w-md italic">
                    Documentary photography capturing raw clinical realities across remote corridors and emergency surgery wards.
                </p>
            </div>

            <!-- Darkroom Filmstrip Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-[#092B20] rounded-xl overflow-hidden border border-conduit-emerald/50 flex flex-col group hover:border-conduit-gold transition duration-300">
                    <div class="relative h-56 overflow-hidden bg-black">
                        <img src="https://picsum.photos/800/500?random=2" alt="Field Clinic" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100">
                        <div class="absolute bottom-2 left-2 bg-black/75 px-2 py-0.5 rounded text-[10px] font-mono text-conduit-light-gold">
                            35mm • ƒ/2.0 • 1/250s
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-[10px] font-mono uppercase text-conduit-gold tracking-wider mb-2">Photojournalism Dispatch</span>
                        <h3 class="font-display font-bold text-lg text-white mb-2 group-hover:text-conduit-light-gold transition">
                            The Shutter and the Scalpel
                        </h3>
                        <p class="font-serif text-xs text-conduit-cream/80 leading-relaxed mb-4">
                            Documenting frontline surgical volunteer missions where electrical grids fail and patient courage sustains triage.
                        </p>
                        <span class="text-xs font-mono text-conduit-emerald font-semibold mt-auto flex items-center gap-1 group-hover:text-conduit-light-gold transition">
                            View Visual Essay &rarr;
                        </span>
                    </div>
                </div>

                <div class="bg-[#092B20] rounded-xl overflow-hidden border border-conduit-emerald/50 flex flex-col group hover:border-conduit-gold transition duration-300">
                    <div class="relative h-56 overflow-hidden bg-black">
                        <img src="https://picsum.photos/800/500?random=5" alt="Acoustic Therapy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100">
                        <div class="absolute bottom-2 left-2 bg-black/75 px-2 py-0.5 rounded text-[10px] font-mono text-conduit-light-gold">
                            Binaural Audio Reel • 24bit/96kHz
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-[10px] font-mono uppercase text-conduit-gold tracking-wider mb-2">Acoustic Investigation</span>
                        <h3 class="font-display font-bold text-lg text-white mb-2 group-hover:text-conduit-light-gold transition">
                            Soundscapes of Recovery
                        </h3>
                        <p class="font-serif text-xs text-conduit-cream/80 leading-relaxed mb-4">
                            How restorative frequency design in intensive care wards reduces trauma delirium and regulates patient cardiac rhythms.
                        </p>
                        <span class="text-xs font-mono text-conduit-emerald font-semibold mt-auto flex items-center gap-1 group-hover:text-conduit-light-gold transition">
                            Listen to Audio Dispatch &rarr;
                        </span>
                    </div>
                </div>

                <div class="bg-[#092B20] rounded-xl overflow-hidden border border-conduit-emerald/50 flex flex-col group hover:border-conduit-gold transition duration-300">
                    <div class="relative h-56 overflow-hidden bg-black">
                        <img src="https://picsum.photos/800/500?random=3" alt="Supply Line" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100">
                        <div class="absolute bottom-2 left-2 bg-black/75 px-2 py-0.5 rounded text-[10px] font-mono text-conduit-light-gold">
                            Cold-Chain Telemetry • Log 84
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-[10px] font-mono uppercase text-conduit-gold tracking-wider mb-2">Infographic Report</span>
                        <h3 class="font-display font-bold text-lg text-white mb-2 group-hover:text-conduit-light-gold transition">
                            The Vaccine Mountain Trail
                        </h3>
                        <p class="font-serif text-xs text-conduit-cream/80 leading-relaxed mb-4">
                            Interactive data mapping of solar-powered biologic couriers crossing treacherous monsoon passes to reach indigenous communities.
                        </p>
                        <span class="text-xs font-mono text-conduit-emerald font-semibold mt-auto flex items-center gap-1 group-hover:text-conduit-light-gold transition">
                            Explore Data Map &rarr;
                        </span>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- 4. EDITORIAL ETHICS & BUREAU IDENTITY (About Anchor)           -->
    <!-- ============================================================== -->
    <section id="about" class="py-20 lg:py-28 bg-conduit-paper border-b border-conduit-border">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-center">
                
                <div class="md:col-span-7 space-y-6">
                    <div class="inline-block bg-conduit-deep text-conduit-gold font-mono text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded">
                        Bureau Methodology
                    </div>
                    <h2 class="font-display font-extrabold text-3xl sm:text-5xl text-conduit-deep leading-tight">
                        An Antidote to Sensationalism
                    </h2>
                    <p class="font-serif text-lg text-gray-800 leading-relaxed">
                        {{ setting('about_snippet', 'The Conduit was founded to connect clinical veracity with community understanding. In a media landscape crowded with sensationalist soundbites, we provide patient, thorough, and beautifully documented investigations into healthcare, public health policy, and frontline resilience.') }}
                    </p>
                    <p class="font-serif text-base text-gray-600 leading-relaxed">
                        Every investigation published by The Conduit undergoes rigorous verification against primary trial literature. We accept no pharmaceutical sponsorship, corporate native advertising, or editorial interference.
                    </p>
                </div>

                <div class="md:col-span-5 bg-white rounded-2xl p-8 border border-conduit-border shadow-md space-y-5">
                    <h3 class="font-display font-bold text-xl text-conduit-deep pb-3 border-b border-gray-100">
                        Our Five Cornerstones
                    </h3>
                    
                    <div class="space-y-4 text-xs font-mono">
                        <div class="flex items-start gap-3">
                            <span class="text-conduit-gold font-bold text-sm">01</span>
                            <div>
                                <span class="font-bold text-conduit-deep block uppercase">The Flame</span>
                                <span class="text-gray-500">Uncompromising pursuit of verified biomedical truth.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="text-conduit-gold font-bold text-sm">02</span>
                            <div>
                                <span class="font-bold text-conduit-deep block uppercase">The Shutter</span>
                                <span class="text-gray-500">Documentary photography that preserves patient dignity.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="text-conduit-gold font-bold text-sm">03</span>
                            <div>
                                <span class="font-bold text-conduit-deep block uppercase">The Asclepius Rod</span>
                                <span class="text-gray-500">Honoring the clinical oath and equitable therapeutic access.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="text-conduit-gold font-bold text-sm">04</span>
                            <div>
                                <span class="font-bold text-conduit-deep block uppercase">The Heartbeat Line</span>
                                <span class="text-gray-500">Centering reporting around lived human experience.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="text-conduit-gold font-bold text-sm">05</span>
                            <div>
                                <span class="font-bold text-conduit-deep block uppercase">The Quill Pen</span>
                                <span class="text-gray-500">Precision prose resisting algorithmic hyperbole.</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- 5. CONTACT BUREAU DESK                                         -->
    <!-- ============================================================== -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="font-mono text-xs font-bold text-conduit-emerald uppercase tracking-widest block mb-2">Editorial Desk</span>
            <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-conduit-deep mb-4">
                Connect With Our Researchers
            </h2>
            <p class="font-serif text-base text-gray-600 mb-8 max-w-xl mx-auto leading-relaxed">
                Have confidential biomedical documentation, field photographs, or investigative tips? Reach our editorial desk directly.
            </p>
            <div class="inline-flex items-center gap-3 px-6 py-4 rounded-xl bg-conduit-paper border border-conduit-border shadow-sm">
                <svg class="w-5 h-5 text-conduit-emerald" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <a href="mailto:{{ setting('contact_email', 'editorial@theconduit.org') }}" class="font-mono font-medium text-conduit-deep hover:underline text-sm">
                    {{ setting('contact_email', 'editorial@theconduit.org') }}
                </a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <!-- GSAP Editorial Interactions & Parallax -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Register ScrollTrigger if available
            if (typeof gsap !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                // 1. Hero Stagger Entrance on page load
                gsap.from('.gsap-hero-el', {
                    opacity: 0,
                    y: 28,
                    duration: 1.1,
                    stagger: 0.14,
                    ease: 'power3.out'
                });

                // 2. Parallax background depth on scroll
                const heroBg = document.getElementById('hero-parallax-bg');
                if (heroBg) {
                    gsap.to(heroBg, {
                        yPercent: 20,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: heroBg.parentElement,
                            start: 'top top',
                            end: 'bottom top',
                            scrub: true
                        }
                    });
                }
            }
        });
    </script>
@endpush

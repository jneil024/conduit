@extends('layouts.admin')

@section('title', 'System Settings & Visuals')
@section('header', 'System Settings & Visuals')

@section('content')

    <div class="max-w-5xl mx-auto">
        
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-sm text-gray-500">Configure global publication identity, upload hero visuals for the front page, and manage brand assets.</p>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-conduit-deep text-white text-xs font-semibold hover:bg-conduit-emerald transition shadow-sm">
                <span>Preview Front Page</span>
                <svg class="w-3.5 h-3.5 text-conduit-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- SECTION 1: HOME PAGE HERO VISUALS -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-5 border-b border-gray-100 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-conduit-deep text-conduit-gold flex items-center justify-center font-bold">
                        🖼️
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-lg text-conduit-deep">Front Page Hero Photography & Visuals</h3>
                        <p class="text-xs text-gray-500">Customize the full-width background photo, edition stamp, and lead typography on home.blade.php.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Hero Background Photo Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-conduit-deep mb-1">
                            Hero Background Photo
                            <span class="text-xs font-normal text-gray-500">(Recommended: 1920x1080px or higher, landscape, max 4MB)</span>
                        </label>

                        <div class="mt-2 grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                            
                            <!-- Current / Live Preview Container -->
                            <div class="md:col-span-6">
                                <div class="relative w-full h-52 rounded-xl overflow-hidden border-2 border-dashed border-gray-300 bg-conduit-deep flex items-center justify-center group shadow-inner">
                                    @php
                                        $currentHeroBg = setting('hero_bg_image');
                                    @endphp

                                    <img id="hero-preview-img" 
                                         src="{{ $currentHeroBg ?: 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1920&q=80' }}" 
                                         alt="Hero Background Preview" 
                                         class="w-full h-full object-cover">
                                    
                                    <div class="absolute inset-0 bg-gradient-to-t from-conduit-deep via-conduit-deep/40 to-transparent pointer-events-none"></div>
                                    <div class="absolute bottom-3 left-3 right-3 text-white text-[11px] font-mono pointer-events-none bg-black/60 backdrop-blur-sm p-1.5 rounded">
                                        <span class="text-conduit-light-gold font-bold">Live Hero Preview</span> • Tinted with Conduit Deep (#0B3D2E)
                                    </div>
                                </div>
                            </div>

                            <!-- File Selector & Removal -->
                            <div class="md:col-span-6 space-y-3">
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    Upload an authentic documentary photo, laboratory still, or field clinic capture. A cinematic dark vignette overlay is automatically applied to ensure crisp headline readability.
                                </p>

                                <input type="file" 
                                       id="hero_bg_image" 
                                       name="hero_bg_image" 
                                       accept="image/jpeg,image/png,image/webp" 
                                       onchange="previewHeroBg(this)"
                                       class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-conduit-deep file:text-white hover:file:bg-conduit-emerald file:cursor-pointer border border-gray-200 rounded-lg p-1.5">

                                @if($currentHeroBg)
                                    <div class="pt-2">
                                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs text-red-600 hover:text-red-700 font-medium">
                                            <input type="checkbox" name="remove_hero_bg_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            <span>Reset to default editorial documentary photo</span>
                                        </label>
                                    </div>
                                @endif
                                @error('hero_bg_image')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Hero Headlines & Edition Metadata -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                        <div>
                            <label for="hero_edition_label" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1">
                                Masthead Edition Stamp / Volume
                            </label>
                            <input type="text" 
                                   id="hero_edition_label" 
                                   name="hero_edition_label" 
                                   value="{{ old('hero_edition_label', setting('hero_edition_label', 'Vol. XXIV — Special Global Health Dispatch')) }}" 
                                   placeholder="e.g. Vol. XXIV — Special Global Health Dispatch" 
                                   class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                        </div>

                        <div>
                            <label for="hero_cta_text" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1">
                                Hero Primary Button Text
                            </label>
                            <input type="text" 
                                   id="hero_cta_text" 
                                   name="hero_cta_text" 
                                   value="{{ old('hero_cta_text', setting('hero_cta_text', 'Explore Investigations')) }}" 
                                   placeholder="Explore Investigations" 
                                   class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="hero_headline" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1">
                            Hero Main Headline
                        </label>
                        <input type="text" 
                               id="hero_headline" 
                               name="hero_headline" 
                               value="{{ old('hero_headline', setting('hero_headline', 'Where Clinical Rigor Meets Human Testimony')) }}" 
                               placeholder="e.g. Where Clinical Rigor Meets Human Testimony" 
                               class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none font-display font-bold text-conduit-deep">
                    </div>

                    <div>
                        <label for="hero_subtitle" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1">
                            Hero Narrative Subtitle
                        </label>
                        <textarea id="hero_subtitle" 
                                  name="hero_subtitle" 
                                  rows="2" 
                                  class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none leading-relaxed">{{ old('hero_subtitle', setting('hero_subtitle', 'An independent editorial bureau interrogating modern healthcare frontiers, frontline medical humanitarianism, and bioethics through longform investigative journalism and visual documentary.')) }}</textarea>
                    </div>

                </div>
            </div>

            <!-- SECTION 2: BRAND IDENTITY, LOGO & ICONS -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-5 border-b border-gray-100 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-conduit-emerald text-conduit-gold flex items-center justify-center font-bold">
                        🛡️
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-lg text-conduit-deep">Brand Emblem, Logo & Favicon Icons</h3>
                        <p class="text-xs text-gray-500">Upload your custom circular emblem (flame, shutter, Asclepius, heartbeat, quill) and browser tab icon.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Site Logo -->
                    <div class="p-5 rounded-xl bg-conduit-cream/60 border border-conduit-emerald/20">
                        <label class="block text-sm font-semibold text-conduit-deep mb-2">
                            Publication Emblem / Logo
                        </label>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 rounded-full bg-conduit-emerald border-2 border-conduit-gold flex items-center justify-center overflow-hidden flex-shrink-0 shadow">
                                <img id="logo-preview-img" 
                                     src="{{ setting('site_logo') ?: asset('images/conduit-logo.png') }}" 
                                     alt="Logo" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="text-xs text-gray-600">
                                <p class="font-semibold text-conduit-deep">Circular Emblem</p>
                                <p class="text-[11px] text-gray-500">Appears in header navbar, hero seal, and footer masthead.</p>
                            </div>
                        </div>
                        <input type="file" 
                               id="site_logo" 
                               name="site_logo" 
                               accept="image/png,image/jpeg,image/webp,image/svg+xml" 
                               onchange="previewImg(this, 'logo-preview-img')"
                               class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-conduit-deep file:text-white hover:file:bg-conduit-emerald file:cursor-pointer border border-gray-200 rounded p-1 bg-white">
                        @error('site_logo')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Browser Favicon / Tab Icon -->
                    <div class="p-5 rounded-xl bg-conduit-cream/60 border border-conduit-emerald/20">
                        <label class="block text-sm font-semibold text-conduit-deep mb-2">
                            Browser Tab Icon (Favicon)
                        </label>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-lg bg-white border border-gray-300 flex items-center justify-center overflow-hidden flex-shrink-0 shadow-sm p-1">
                                <img id="icon-preview-img" 
                                     src="{{ setting('site_icon') ?: asset('images/conduit-logo.png') }}" 
                                     alt="Favicon" 
                                     class="w-full h-full object-contain">
                            </div>
                            <div class="text-xs text-gray-600">
                                <p class="font-semibold text-conduit-deep">Browser Icon</p>
                                <p class="text-[11px] text-gray-500">Displayed in browser tabs and bookmark bars (32x32 or 64x64).</p>
                            </div>
                        </div>
                        <input type="file" 
                               id="site_icon" 
                               name="site_icon" 
                               accept="image/png,image/x-icon,image/svg+xml" 
                               onchange="previewImg(this, 'icon-preview-img')"
                               class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-conduit-deep file:text-white hover:file:bg-conduit-emerald file:cursor-pointer border border-gray-200 rounded p-1 bg-white">
                        @error('site_icon')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Brand Names -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 pt-6 border-t border-gray-100">
                    <div>
                        <label for="site_title" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1">
                            Publication Title
                        </label>
                        <input type="text" 
                               id="site_title" 
                               name="site_title" 
                               value="{{ old('site_title', setting('site_title', 'The Conduit')) }}" 
                               class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 text-sm font-semibold text-conduit-deep focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                    </div>

                    <div>
                        <label for="site_tagline" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1">
                            Official Tagline
                        </label>
                        <input type="text" 
                               id="site_tagline" 
                               name="site_tagline" 
                               value="{{ old('site_tagline', setting('site_tagline', 'Publication and Multimedia Organization')) }}" 
                               class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                    </div>
                </div>

            </div>

            <!-- SECTION 3: EDITORIAL BUREAU & CONTACT INFO -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-5 border-b border-gray-100 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-conduit-gold text-conduit-deep flex items-center justify-center font-bold">
                        📜
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-lg text-conduit-deep">Editorial Bureau & Inquiries</h3>
                        <p class="text-xs text-gray-500">Contact desk email and mission statement shown on the front-page anchor and footer.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="contact_email" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1">
                            Editorial Desk Inquiries Email
                        </label>
                        <input type="email" 
                               id="contact_email" 
                               name="contact_email" 
                               value="{{ old('contact_email', setting('contact_email', 'editorial@theconduit.org')) }}" 
                               class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                    </div>

                    <div>
                        <label for="about_snippet" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1">
                            About Bureau Mission Statement
                        </label>
                        <textarea id="about_snippet" 
                                  name="about_snippet" 
                                  rows="3" 
                                  class="w-full px-3.5 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none leading-relaxed">{{ old('about_snippet', setting('about_snippet', 'The Conduit was founded to connect clinical veracity with community understanding. In a media landscape crowded with sensationalist soundbites, we provide patient, thorough, and beautifully documented investigations into healthcare, public health policy, and frontline resilience.')) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-gray-100">
                        <div>
                            <label for="social_twitter" class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">
                                Twitter / X Handle or URL
                            </label>
                            <input type="text" 
                                   id="social_twitter" 
                                   name="social_twitter" 
                                   value="{{ old('social_twitter', setting('social_twitter', '@TheConduitOrg')) }}" 
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-xs">
                        </div>
                        <div>
                            <label for="social_instagram" class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">
                                Instagram Account
                            </label>
                            <input type="text" 
                                   id="social_instagram" 
                                   name="social_instagram" 
                                   value="{{ old('social_instagram', setting('social_instagram', '@theconduit.media')) }}" 
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-xs">
                        </div>
                        <div>
                            <label for="social_youtube" class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">
                                YouTube Documentary Channel
                            </label>
                            <input type="text" 
                                   id="social_youtube" 
                                   name="social_youtube" 
                                   value="{{ old('social_youtube', setting('social_youtube', 'The Conduit Documentaries')) }}" 
                                   class="w-full px-3 py-2 rounded-lg border border-gray-300 text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUBMIT BUTTON BAR -->
            <div class="pt-4 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm transition">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-conduit-gold hover:bg-conduit-light-gold text-conduit-deep font-display font-bold text-sm shadow-lg transition transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Save System Settings
                </button>
            </div>

        </form>

    </div>

    <!-- Client-Side Image Preview Scripts -->
    <script>
        function previewHeroBg(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('hero-preview-img').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewImg(input, targetId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(targetId).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection

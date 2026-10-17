<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', setting('site_title', 'The Conduit') . ' — ' . setting('site_tagline', 'Publication and Multimedia Organization'))</title>
    <meta name="description" content="@yield('meta_description', setting('about_snippet', 'An independent editorial bureau interrogating modern healthcare frontiers, frontline medical humanitarianism, and bioethics through longform journalism and visual documentary.'))">

    <!-- Favicon & Site Icon -->
    @php
        $siteIcon = setting('site_icon') ?: asset('images/conduit-logo.png');
    @endphp
    <link rel="icon" type="image/png" href="{{ $siteIcon }}">
    <link rel="apple-touch-icon" href="{{ $siteIcon }}">

    <!-- Google Fonts: Playfair Display + Newsreader (Editorial Serifs) & Plus Jakarta Sans + Inter (Sans) & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400;1,6..72,600&family=Playfair+Display:ital,wght@0,600;0,700;0,800;0,900;1,600;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
      theme: { extend: {
        colors: {
          conduit: {
            deep:'#0B3D2E', emerald:'#1B6B4A', gold:'#F5A623',
            'light-gold':'#FFC857', cream:'#FDFBF7', dark:'#141414',
            paper:'#F6F3EB', border:'#E2DCD2', muted:'#686358'
          }
        },
        fontFamily: {
          sans: ['Plus Jakarta Sans','Inter','ui-sans-serif','system-ui'],
          serif: ['Newsreader','Georgia','serif'],
          display: ['Playfair Display','Georgia','serif'],
          mono: ['JetBrains Mono','monospace']
        }
      }}
    }
    </script>

    <!-- GSAP (GreenSock Animation Platform) + ScrollTrigger CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <style>
        /* Editorial Paper Grain Overlay */
        .editorial-grain {
            background-image: radial-gradient(rgba(11, 61, 46, 0.08) 1px, transparent 0);
            background-size: 24px 24px;
        }
        /* Custom Drop Cap for lead paragraph */
        .drop-cap::first-letter {
            float: left;
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 3.75rem;
            line-height: 0.8;
            font-weight: 800;
            margin-right: 0.75rem;
            color: #0B3D2E;
        }
    </style>
</head>
<body class="bg-conduit-cream text-conduit-dark font-sans antialiased min-h-screen flex flex-col selection:bg-conduit-gold selection:text-conduit-deep">

    <!-- Top Editorial Masthead Ribbon -->
    <div class="bg-[#07241B] text-conduit-cream/80 text-[11px] font-mono border-b border-conduit-emerald/40 py-1.5 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 text-conduit-light-gold font-semibold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-conduit-gold animate-pulse"></span>
                    {{ setting('hero_edition_label', 'Vol. XXIV — Special Global Health Dispatch') }}
                </span>
                <span class="hidden md:inline text-conduit-cream/40">•</span>
                <span class="hidden md:inline">{{ date('l, F j, Y') }}</span>
            </div>
            <div class="flex items-center gap-4 text-[10px] uppercase tracking-widest text-conduit-cream/60">
                <span>Bureau: Washington / Geneva / Manila</span>
                <span>•</span>
                <span class="text-conduit-gold">Open Access Edition</span>
            </div>
        </div>
    </div>

    <!-- Sticky Main Navigation Header -->
    <header class="sticky top-0 z-50 bg-conduit-deep text-conduit-cream shadow-xl border-b border-conduit-emerald/50 backdrop-blur-md transition-all duration-300" id="main-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 sm:h-22">
                
                <!-- Brand Masthead & Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    @php
                        $siteLogo = setting('site_logo') ?: asset('images/conduit-logo.png');
                    @endphp
                    <div class="w-12 h-12 rounded-full bg-conduit-emerald border-2 border-conduit-gold flex items-center justify-center overflow-hidden shadow-md group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                        <img src="{{ $siteLogo }}" 
                             alt="{{ setting('site_title', 'The Conduit') }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="font-display font-extrabold text-2xl tracking-tight text-white group-hover:text-conduit-light-gold transition leading-tight">
                            {{ setting('site_title', 'The Conduit') }}
                        </span>
                        <span class="text-[10px] tracking-widest uppercase text-conduit-gold font-mono font-medium">
                            {{ setting('site_tagline', 'Publication and Multimedia Organization') }}
                        </span>
                    </div>
                </a>

                <!-- Desktop Editorial Navigation -->
                <nav class="hidden lg:flex items-center gap-9 font-medium text-xs tracking-wider uppercase">
                    <a href="{{ route('home') }}" class="hover:text-conduit-light-gold transition pb-1 border-b-2 {{ request()->routeIs('home') ? 'border-conduit-gold text-conduit-gold font-bold' : 'border-transparent text-conduit-cream/90' }}">
                        Cover Story
                    </a>
                    <a href="{{ route('articles.index') }}" class="hover:text-conduit-light-gold transition pb-1 border-b-2 {{ request()->routeIs('articles.*') ? 'border-conduit-gold text-conduit-gold font-bold' : 'border-transparent text-conduit-cream/90' }}">
                        Investigations
                    </a>
                    <a href="{{ route('home') }}#multimedia" class="hover:text-conduit-light-gold transition pb-1 border-b-2 border-transparent text-conduit-cream/90">
                        Visual Documentary
                    </a>
                    <a href="{{ route('home') }}#about" class="hover:text-conduit-light-gold transition pb-1 border-b-2 border-transparent text-conduit-cream/90">
                        About Bureau
                    </a>
                    <a href="{{ route('home') }}#contact" class="hover:text-conduit-light-gold transition pb-1 border-b-2 border-transparent text-conduit-cream/90">
                        Contact
                    </a>
                </nav>

                <!-- Right Admin / Auth Actions -->
                <div class="hidden sm:flex items-center gap-4">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-conduit-gold hover:bg-conduit-light-gold text-conduit-deep font-display font-bold text-xs uppercase tracking-wider shadow-md transition transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Editorial Portal
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs text-conduit-cream/60 hover:text-white underline font-mono">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-lg bg-conduit-gold hover:bg-conduit-light-gold text-conduit-deep font-display font-bold text-xs uppercase tracking-wider shadow-md transition transform hover:-translate-y-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            Staff Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex lg:hidden items-center">
                    <button type="button" id="mobile-menu-btn" class="p-2 rounded-lg text-conduit-cream hover:text-conduit-gold hover:bg-conduit-emerald/50 focus:outline-none" aria-label="Toggle navigation menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden lg:hidden bg-[#07241B] border-t border-conduit-emerald/60 px-6 py-6 space-y-4 text-sm font-medium">
            <a href="{{ route('home') }}" class="block py-2 text-conduit-gold font-bold">Cover Story</a>
            <a href="{{ route('articles.index') }}" class="block py-2 text-conduit-cream hover:text-conduit-light-gold">Investigations & Archive</a>
            <a href="{{ route('home') }}#multimedia" class="block py-2 text-conduit-cream hover:text-conduit-light-gold">Visual Documentary</a>
            <a href="{{ route('home') }}#about" class="block py-2 text-conduit-cream hover:text-conduit-light-gold">About Bureau</a>
            <a href="{{ route('home') }}#contact" class="block py-2 text-conduit-cream hover:text-conduit-light-gold">Contact Desk</a>
            <div class="pt-4 border-t border-conduit-emerald/40">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="block text-center w-full py-2.5 rounded bg-conduit-gold text-conduit-deep font-bold text-xs uppercase tracking-wider">Editorial Portal</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="w-full text-center text-xs text-conduit-cream/60 underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block text-center w-full py-2.5 rounded bg-conduit-gold text-conduit-deep font-bold text-xs uppercase tracking-wider">Staff Login</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Dynamic Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Bespoke Editorial Footer -->
    <footer class="bg-[#051F17] text-conduit-cream border-t border-conduit-emerald/50 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-14 border-b border-conduit-emerald/30">
                
                <!-- Col 1: Emblem & Bureau Statement -->
                <div class="md:col-span-5 space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-conduit-emerald border-2 border-conduit-gold flex items-center justify-center overflow-hidden flex-shrink-0">
                            <img src="{{ $siteLogo }}" alt="Emblem" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="font-display font-extrabold text-2xl tracking-tight text-white block">{{ setting('site_title', 'The Conduit') }}</span>
                            <span class="text-[10px] uppercase font-mono tracking-widest text-conduit-gold">{{ setting('site_tagline', 'Publication and Multimedia Organization') }}</span>
                        </div>
                    </div>

                    <p class="text-conduit-cream/80 text-sm leading-relaxed font-serif text-base max-w-md">
                        {{ setting('about_snippet', 'The Conduit is an independent publication and multimedia documentary organization dedicated to ethical healthcare investigations, translational science, and human resilience in underserved frontiers.') }}
                    </p>

                    <div class="text-xs text-conduit-light-gold font-mono flex items-center gap-2">
                        <span>Flame</span> • <span>Shutter</span> • <span>Asclepius</span> • <span>Heartbeat</span> • <span>Quill</span>
                    </div>
                </div>

                <!-- Col 2: Editorial Departments -->
                <div class="md:col-span-3 space-y-4">
                    <h3 class="font-mono text-xs uppercase tracking-widest text-conduit-gold font-semibold">Editorial Desks</h3>
                    <ul class="space-y-2.5 text-sm text-conduit-cream/80">
                        <li><a href="{{ route('articles.index', ['category' => 'News']) }}" class="hover:text-conduit-light-gold transition">Clinical Investigation</a></li>
                        <li><a href="{{ route('articles.index', ['category' => 'Multimedia']) }}" class="hover:text-conduit-light-gold transition">Documentary Photography</a></li>
                        <li><a href="{{ route('articles.index', ['category' => 'Feature']) }}" class="hover:text-conduit-light-gold transition">Global Health Policy</a></li>
                        <li><a href="{{ route('articles.index', ['category' => 'Opinion']) }}" class="hover:text-conduit-light-gold transition">Ethics & Discourse</a></li>
                    </ul>
                </div>

                <!-- Col 3: Bureau & Inquiries -->
                <div class="md:col-span-4 space-y-4">
                    <h3 class="font-mono text-xs uppercase tracking-widest text-conduit-gold font-semibold">Bureau Inquiries</h3>
                    <p class="text-xs text-conduit-cream/70 leading-relaxed">
                        For confidential tips, medical reporting inquiries, or documentary collaboration requests:
                    </p>
                    <div class="p-3.5 rounded-xl bg-conduit-deep/80 border border-conduit-emerald/40 text-xs font-mono">
                        <span class="text-conduit-light-gold">Email:</span> 
                        <a href="mailto:{{ setting('contact_email', 'editorial@theconduit.org') }}" class="text-white hover:underline ml-1">
                            {{ setting('contact_email', 'editorial@theconduit.org') }}
                        </a>
                    </div>
                    <div class="flex items-center gap-4 pt-1 text-xs text-conduit-cream/70">
                        @if(setting('social_twitter'))
                            <span class="text-conduit-light-gold font-mono">{{ setting('social_twitter') }}</span>
                        @endif
                        @if(setting('social_instagram'))
                            <span>•</span>
                            <span class="text-conduit-light-gold font-mono">{{ setting('social_instagram') }}</span>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Bottom Legal & Standards -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-conduit-cream/50 font-mono">
                <p>&copy; {{ date('Y') }} {{ setting('site_title', 'The Conduit') }}. Independent Publication & Multimedia Organization. All rights reserved.</p>
                <div class="flex items-center gap-4 mt-3 sm:mt-0">
                    <span>Truth & Precision</span>
                    <span>•</span>
                    <a href="{{ route('login') }}" class="text-conduit-gold hover:underline">Editorial CMS</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- Vanilla Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>

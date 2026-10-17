<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') — The Conduit</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
      theme: { extend: {
        colors: {
          conduit: {
            deep:'#0B3D2E', emerald:'#1B6B4A', gold:'#F5A623',
            'light-gold':'#FFC857', cream:'#FDFBF7', dark:'#1A1A1A'
          }
        },
        fontFamily: {
          sans: ['Inter','ui-sans-serif','system-ui'],
          display: ['Poppins','ui-sans-serif']
        }
      }}
    }
    </script>

    @stack('styles')
</head>
<body class="bg-[#F8F6F0] text-conduit-dark font-sans antialiased min-h-screen flex selection:bg-conduit-gold selection:text-conduit-deep">

    <aside class="w-64 bg-conduit-deep text-conduit-cream flex-shrink-0 flex flex-col min-h-screen border-r border-conduit-emerald/50">
        
        <div class="h-20 flex items-center px-6 border-b border-conduit-emerald/40 gap-3">
            <div class="w-10 h-10 rounded-full bg-conduit-emerald border border-conduit-gold flex items-center justify-center font-display font-bold text-conduit-gold text-lg">
                C
            </div>
            <div>
                <h1 class="font-display font-bold text-lg leading-tight tracking-tight text-conduit-cream">The Conduit</h1>
                <span class="text-[10px] uppercase tracking-wider text-conduit-gold font-semibold">Editorial Admin</span>
            </div>
        </div>

        <nav class="flex-grow py-6 px-3 space-y-1.5 font-medium text-sm">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-conduit-emerald text-white border-l-4 border-conduit-gold font-semibold shadow-inner' : 'text-conduit-cream/80 hover:bg-conduit-emerald/40 hover:text-white' }}">
                <svg class="w-5 h-5 text-conduit-light-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.articles.index') }}" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition {{ request()->routeIs('admin.articles.*') ? 'bg-conduit-emerald text-white border-l-4 border-conduit-gold font-semibold shadow-inner' : 'text-conduit-cream/80 hover:bg-conduit-emerald/40 hover:text-white' }}">
                <svg class="w-5 h-5 text-conduit-light-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Articles
            </a>

            <a href="{{ route('admin.settings.index') }}" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition {{ request()->routeIs('admin.settings.*') ? 'bg-conduit-emerald text-white border-l-4 border-conduit-gold font-semibold shadow-inner' : 'text-conduit-cream/80 hover:bg-conduit-emerald/40 hover:text-white' }}">
                <svg class="w-5 h-5 text-conduit-light-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                System Settings
            </a>

            <a href="{{ route('home') }}" target="_blank" 
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-conduit-cream/80 hover:bg-conduit-emerald/40 hover:text-white transition">
                <svg class="w-5 h-5 text-conduit-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Public Site
            </a>
        </nav>

        <div class="p-4 border-t border-conduit-emerald/40">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-conduit-emerald text-conduit-cream flex items-center justify-center font-bold text-xs uppercase border border-conduit-gold">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="truncate">
                    <p class="text-xs font-semibold text-conduit-cream truncate">{{ auth()->user()->name }}</p>
                    <span class="text-[10px] text-conduit-gold font-medium uppercase tracking-wide">Administrator</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-center py-1.5 px-3 rounded text-xs bg-conduit-emerald/50 hover:bg-conduit-emerald text-conduit-cream font-medium transition">
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-grow flex flex-col min-w-0">
        <header class="h-20 bg-white border-b border-gray-200 px-6 sm:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-4">
                <h2 class="font-display font-bold text-xl text-conduit-deep">@yield('header')</h2>
            </div>
            <div>
                <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-conduit-gold hover:bg-conduit-light-gold text-conduit-deep font-bold text-sm shadow transition transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Article
                </a>
            </div>
        </header>

        <div class="px-6 sm:px-8 pt-6">
            @if(session('success'))
                <div class="p-4 rounded-lg bg-emerald-50 border border-emerald-300 text-emerald-800 flex items-center justify-between shadow-sm mb-4">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-lg bg-red-50 border border-red-300 text-red-800 flex items-center justify-between shadow-sm mb-4">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">&times;</button>
                </div>
            @endif
        </div>

        <main class="flex-grow px-6 sm:px-8 pb-12">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>

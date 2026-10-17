<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sign In — The Conduit Editorial Administration</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

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
</head>
<body class="bg-gradient-to-br from-conduit-deep via-[#0d4736] to-conduit-emerald min-h-screen flex items-center justify-center p-4 font-sans text-conduit-dark">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-conduit-gold/30">
        
        <div class="bg-conduit-deep px-8 pt-10 pb-8 text-center text-conduit-cream relative">
            <div class="w-16 h-16 mx-auto rounded-full bg-conduit-emerald border-2 border-conduit-gold flex items-center justify-center font-display font-bold text-conduit-gold text-2xl shadow-inner mb-4">
                C
            </div>
            <h1 class="font-display font-bold text-2xl text-white">The Conduit</h1>
            <p class="text-xs uppercase tracking-widest text-conduit-light-gold font-semibold mt-1">
                Editorial Administration
            </p>
        </div>

        <div class="p-8 sm:p-10">
            @if(session('status'))
                <div class="mb-4 text-xs font-semibold text-emerald-700 bg-emerald-50 p-3 rounded-lg border border-emerald-200">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 text-xs text-red-700 bg-red-50 p-3.5 rounded-xl border border-red-200">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider mb-1.5">
                        Account Email
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', 'admin@conduit.test') }}" 
                           required 
                           autofocus 
                           placeholder="admin@conduit.test" 
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold text-conduit-deep uppercase tracking-wider">
                            Password
                        </label>
                    </div>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           value="password"
                           placeholder="••••••••" 
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-conduit-emerald focus:outline-none">
                </div>

                <div class="flex items-center justify-between text-xs text-gray-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-conduit-emerald focus:ring-conduit-emerald">
                        <span>Stay signed in</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-xl bg-conduit-gold hover:bg-conduit-light-gold text-conduit-deep font-display font-bold text-sm tracking-wide shadow-lg transition transform hover:-translate-y-0.5">
                    Enter Portal
                </button>

            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <a href="{{ route('home') }}" class="text-xs font-semibold text-conduit-emerald hover:text-conduit-deep transition inline-flex items-center gap-1">
                    &larr; Return to The Conduit Front Page
                </a>
            </div>

        </div>

    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-slate-50 text-slate-800 relative overflow-hidden min-h-screen flex flex-col justify-between">
        
        <!-- Background Soft Glow Effects -->
        <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] rounded-full bg-indigo-500/5 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] rounded-full bg-sky-500/5 blur-[100px] pointer-events-none"></div>

        <!-- Upper Navigation - Glassmorphic Navbar -->
        <header class="w-full max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative z-10">
            <div class="flex items-center gap-2">
                <img src="{{ asset('logo.jpeg') }}" alt="Mini Logo" class="h-7 w-auto object-contain">
                <span class="text-sm font-semibold tracking-wider uppercase text-slate-500">{{ config('app.name') }}</span>
            </div>
            
            @if (Route::has('login'))
                <nav class="flex items-center gap-3 bg-white/60 backdrop-blur-md p-1.5 px-3 rounded-full border border-slate-200/80 shadow-sm">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-full px-4 py-1.5 bg-indigo-600 text-white hover:bg-indigo-700 transition text-sm font-medium shadow-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full px-4 py-1.5 text-slate-600 hover:text-slate-900 font-medium text-sm transition">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-full px-4 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 transition text-sm font-medium">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Main Panel Card -->
        <main class="flex-grow flex items-center justify-center px-4 relative z-10 py-12">
            <div class="w-full max-w-md bg-white/70 backdrop-blur-xl border border-slate-200/60 p-8 rounded-3xl shadow-xl shadow-slate-200/50 text-center relative">
                
                <!-- Top Decorative Line Gradient -->
                <div class="absolute top-0 left-1/4 right-1/4 h-[1px] bg-gradient-to-r from-transparent via-indigo-400 to-transparent"></div>

                <!-- Central Logo Wrapper -->
                <div class="mb-8 flex justify-center relative group">
                    <div class="absolute inset-0 bg-indigo-500/10 rounded-full blur-2xl transform scale-75 group-hover:scale-100 transition duration-500"></div>
                    <img src="{{ asset('logo.jpeg') }}" alt="System Logo" class="h-28 w-auto max-w-xs object-contain drop-shadow-[0_8px_8px_rgba(0,0,0,0.06)] relative z-10 transform hover:scale-105 transition duration-300">
                </div>

                <!-- Text Headings -->
                <div class="space-y-3 mb-8">
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        {{ config('app.name', 'Laravel') }}
                    </h1>
                    <p class="text-sm text-slate-500 max-w-xs mx-auto leading-relaxed">
                        Secure infrastructure management panel. Please authenticate to access the system.
                    </p>
                </div>

                <!-- Action Button -->
                <div class="space-y-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="flex items-center justify-center w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition shadow-sm group">
                            Go to Dashboard 
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition shadow-sm group">
                            Management Portal Login
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        </a>
                    @endauth
                </div>

            </div>
        </main>

        <!-- Footer -->
        <footer class="py-6 text-center text-xs text-slate-400 relative z-10 border-t border-slate-200/60 bg-white/30">
            <div>&copy; {{ date('Y') }} <span class="text-slate-500 font-medium">{{ config('app.name') }}</span>. Terminal Node: homelab01</div>
        </footer>
    </body>
</html>

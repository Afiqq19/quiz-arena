<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-slate-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quiz Arena') }}</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23c026d3'/><path d='M60 20L30 55h20v25l30-35H60v-25z' fill='%23fff'/></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,600,700,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html, body { 
                background-color: #0f172a !important; 
                overscroll-behavior-y: none;
                margin: 0;
                padding: 0;
                min-height: 100vh;
            }
            body { font-family: 'Outfit', sans-serif; }
            
            /* Premium Dark Mesh Gradient Background */
            body::before {
                content: "";
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                width: 100vw; height: 100vh;
                background-color: #09090b;
                background-image: 
                    radial-gradient(circle at 15% 50%, rgba(76, 29, 149, 0.15), transparent 25%),
                    radial-gradient(circle at 85% 30%, rgba(37, 99, 235, 0.15), transparent 25%),
                    radial-gradient(circle at 50% 80%, rgba(131, 24, 67, 0.15), transparent 25%);
                z-index: -999;
            }
            .glass-panel {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="antialiased text-white min-h-screen selection:bg-fuchsia-500 selection:text-white flex flex-col sm:justify-center items-center py-10 relative overflow-x-hidden">
        
        <!-- Decorative Elements -->
        <div class="fixed top-0 right-0 w-96 h-96 bg-fuchsia-600/20 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>
        <div class="fixed bottom-0 left-0 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

        <div class="relative z-10 w-full flex flex-col items-center">
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center gap-3">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-fuchsia-600 to-blue-600 flex items-center justify-center shadow-lg shadow-fuchsia-500/50">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="font-black text-3xl tracking-tight text-white">QUIZ<span class="text-fuchsia-500">ARENA</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 glass-panel shadow-2xl rounded-3xl relative">
                <!-- For inner inputs to look good in dark mode, we add global styles for inputs inside guest -->
                <style>
                    .glass-panel input:not([type="checkbox"]), .glass-panel select {
                        background: rgba(0,0,0,0.2) !important;
                        border: 1px solid rgba(255,255,255,0.1) !important;
                        color: white !important;
                    }
                    .glass-panel input::placeholder { color: rgba(255,255,255,0.5); }
                    .glass-panel label { color: rgba(255,255,255,0.8) !important; }
                    .glass-panel .text-gray-600, .glass-panel .text-sm { color: rgba(255,255,255,0.6) !important; }
                    .glass-panel a { color: #c084fc !important; }
                    .glass-panel a:hover { color: #e879f9 !important; }
                    .glass-panel button { background: linear-gradient(to right, #c026d3, #2563eb) !important; color: white !important; border: none !important; }
                    .glass-panel button:hover { background: linear-gradient(to right, #d946ef, #3b82f6) !important; }
                </style>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

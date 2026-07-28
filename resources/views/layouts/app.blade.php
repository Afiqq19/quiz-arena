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
                background: rgba(255, 255, 255, 0.05) !important;
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
            }
            
            /* Global Overrides to Dark Theme all child views automatically */
            main .bg-white, main .bg-gray-50 {
                background: rgba(255, 255, 255, 0.05) !important;
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                color: white !important;
            }
            main .text-gray-900, main .text-gray-800 { color: #f8fafc !important; }
            main .text-gray-700, main .text-gray-600 { color: #cbd5e1 !important; }
            main .text-gray-500 { color: #94a3b8 !important; }
            main .border-gray-200, main .border-gray-100, main .border-b, main .border { border-color: rgba(255,255,255,0.1) !important; }
            
            main input:not([type="checkbox"]):not([type="radio"]), main select, main textarea {
                background: rgba(0,0,0,0.2) !important;
                border: 1px solid rgba(255,255,255,0.1) !important;
                color: white !important;
            }
            main th { color: #cbd5e1 !important; background: rgba(255, 255, 255, 0.02) !important; }
            main td { color: #f8fafc !important; border-bottom: 1px solid rgba(255,255,255,0.05) !important; }
            main tr:hover td { background: rgba(255,255,255,0.05) !important; }
            
            header {
                background: rgba(255, 255, 255, 0.05) !important;
                backdrop-filter: blur(16px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            }
            header h2 { color: white !important; }
        </style>
    </head>
    <body class="antialiased text-white min-h-screen selection:bg-fuchsia-500 selection:text-white">
        <div class="min-h-screen flex flex-col relative overflow-x-hidden">
            
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-fuchsia-600/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none fixed"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none fixed"></div>

            <div class="relative z-10 flex flex-col flex-grow w-full">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="shadow-lg">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="py-6 flex-grow">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="mt-auto py-6 border-t border-white/10 text-center text-sm text-gray-400 glass-panel">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
                        <p>&copy; {{ date('Y') }} Quiz Arena. Hak Cipta Dilindungi Undang-Undang.</p>
                        <div class="flex gap-6">
                            <a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang</a>
                            <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privasi</a>
                            <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Ketentuan</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#1f2937',
                    color: '#fff',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                @if(session('success'))
                    Toast.fire({
                        icon: 'success',
                        title: "{{ session('success') }}"
                    });
                @endif

                @if(session('error'))
                    Toast.fire({
                        icon: 'error',
                        title: "{{ session('error') }}"
                    });
                @endif
            });
        </script>
    </body>
</html>

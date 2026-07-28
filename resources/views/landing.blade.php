<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quiz Arena - Platform Kuis Interaktif</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23c026d3'/><path d='M60 20L30 55h20v25l30-35H60v-25z' fill='%23fff'/></svg>">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,600,700,900&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass-panel {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .text-gradient {
                background: linear-gradient(to right, #4ade80, #3b82f6, #9333ea);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }
            html, body { 
                background-color: #0f172a !important; 
                overscroll-behavior-y: none;
                margin: 0;
                padding: 0;
                min-height: 100vh;
            }
            body { font-family: 'Outfit', sans-serif; }
            
            /* Fixed Animated Background via Pseudo-element (Bulletproof for all browsers) */
            body::before {
                content: "";
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                width: 100vw; height: 100vh;
                background: linear-gradient(-45deg, #0f172a, #312e81, #4c1d95, #0f172a);
                background-size: 400% 400%;
                animation: gradientBG 15s ease infinite;
                z-index: -999;
            }

            @keyframes gradientBG {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#0a0a1a] text-white selection:bg-fuchsia-500 selection:text-white" x-data="{ joinModalOpen: false }">
    <!-- Background Elements -->
    <div class="fixed inset-0 z-[-1] bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 pointer-events-none"></div>
    <div class="fixed top-0 left-0 w-full h-full bg-gradient-to-b from-[#0a0a1a] via-[#111122] to-[#0a0a1a] z-[-2] pointer-events-none"></div>

    <div class="min-h-screen flex flex-col relative">
        <!-- Navigation -->
        <nav class="border-b border-white/5 bg-black/20 backdrop-blur-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20 gap-2">
                    <div class="flex items-center gap-2 sm:gap-3 cursor-pointer">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-fuchsia-600 to-blue-600 flex items-center justify-center shadow-lg shadow-fuchsia-500/30 flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="font-black text-lg sm:text-2xl tracking-tight hidden min-[380px]:block">QUIZ<span class="text-fuchsia-500">ARENA</span></span>
                    </div>
                    <div class="flex items-center gap-2 sm:gap-4">
                        <button @click="joinModalOpen = true" class="px-3 sm:px-5 py-1.5 sm:py-2 rounded-full font-bold text-xs sm:text-sm border-2 border-fuchsia-500 text-fuchsia-400 hover:bg-fuchsia-500 hover:text-white transition-all h-[36px] sm:h-[44px] flex items-center justify-center whitespace-nowrap">
                            Gabung<span class="hidden sm:inline">&nbsp;Room</span>
                        </button>

                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 sm:px-6 py-1.5 sm:py-2 rounded-full font-semibold text-xs sm:text-sm bg-white/10 hover:bg-white/20 transition-all border border-white/10 hover:border-white/30 backdrop-blur-md h-[36px] sm:h-[44px] flex items-center justify-center">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center font-semibold text-gray-300 hover:text-white transition-colors px-1 sm:px-2 text-xs sm:text-base">Masuk</a>
                            <a href="{{ route('register') }}" class="px-4 sm:px-6 py-1.5 sm:py-2 rounded-full font-bold text-xs sm:text-sm bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 shadow-lg shadow-blue-500/30 transition-all hover:scale-105 active:scale-95 h-[36px] sm:h-[44px] flex items-center justify-center whitespace-nowrap">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow flex items-center justify-center relative overflow-hidden pt-20">
            <!-- Decorative Elements -->
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-fuchsia-600/20 rounded-full mix-blend-screen filter blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] animate-pulse" style="animation-delay: 2s;"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 py-12 md:py-20 flex flex-col lg:flex-row items-center gap-12">
                
                <!-- Left Content -->
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-panel mb-8 border-fuchsia-500/30 text-fuchsia-300 font-medium text-sm">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-fuchsia-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-fuchsia-500"></span>
                        </span>
                        Platform Kuis Generasi Baru
                    </div>
                    
                    <h1 class="text-5xl md:text-7xl font-black leading-tight mb-6">
                        Uji Pengetahuanmu,<br />
                        Jadilah Sang <span class="text-gradient">Juara!</span>
                    </h1>
                    
                    <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto lg:mx-0 font-light leading-relaxed">
                        Tantang dirimu dengan berbagai kuis interaktif yang seru. Raih skor tertinggi, kalahkan pemain lain, dan ukir namamu di puncak Leaderboard global kami.
                    </p>
                    
                    <div class="flex flex-col gap-6">
                        @if(session('error'))
                            <div class="bg-red-500/20 border border-red-500/50 text-red-200 px-4 py-3 rounded-xl text-sm max-w-lg mx-auto lg:mx-0">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-8 py-4 rounded-full font-bold text-lg bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 shadow-xl shadow-fuchsia-500/25 transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Mainkan Sekarang
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="px-8 py-4 rounded-full font-bold text-lg bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 shadow-xl shadow-fuchsia-500/25 transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                                    Mulai Petualangan
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </a>
                                <a href="{{ route('leaderboard') }}" class="px-8 py-4 rounded-full font-bold text-lg glass-panel hover:bg-white/10 transition-all hover:-translate-y-1 flex items-center justify-center">
                                    Lihat Leaderboard
                                </a>
                            @endauth
                        </div>

                        <!-- Mobile Join Button (Shown only on small screens) -->
                        <div class="sm:hidden w-full max-w-sm mx-auto mt-2">
                            <button @click="joinModalOpen = true" class="w-full bg-fuchsia-600 hover:bg-fuchsia-500 text-white px-6 py-3 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-fuchsia-500/30">
                                Masukkan Kode Room
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Leaderboard Preview) -->
                <div class="flex-1 w-full max-w-lg animate-float">
                    <div class="glass-panel rounded-3xl p-1 relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-500/20 to-blue-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="bg-gray-900/80 rounded-[22px] p-6 backdrop-blur-xl relative z-10 border border-gray-700/50">
                            
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-2xl font-bold flex items-center gap-2">
                                    <svg class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    Top 5 Global
                                </h2>
                                <a href="{{ route('leaderboard') }}" class="text-sm font-semibold text-fuchsia-400 hover:text-fuchsia-300 flex items-center gap-1">
                                    Full List <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                            
                            <div class="space-y-3">
                                @forelse($leaderboard as $index => $row)
                                    <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-lg shadow-inner
                                                {{ $index == 0 ? 'bg-gradient-to-br from-yellow-300 to-yellow-600 text-yellow-900 shadow-yellow-500/50' : 
                                                  ($index == 1 ? 'bg-gradient-to-br from-gray-300 to-gray-500 text-gray-900 shadow-gray-500/50' : 
                                                  ($index == 2 ? 'bg-gradient-to-br from-amber-600 to-amber-800 text-amber-100 shadow-amber-700/50' : 'bg-white/10 text-white')) }}">
                                                {{ $index + 1 }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-100">{{ $row->user->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $row->quizzes_taken }} Kuis Diselesaikan</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-black text-xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-blue-400">
                                                {{ number_format($row->total_score) }}
                                            </div>
                                            <div class="text-[10px] uppercase tracking-wider text-gray-500 font-bold">Points</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-10 text-center text-gray-400 flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        Belum ada data.<br>Jadilah yang pertama!
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="glass-panel mt-auto border-t-0 border-b-0 border-x-0 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-400">
                <div>&copy; {{ date('Y') }} Quiz Arena. Hak Cipta Dilindungi.</div>
                <div class="flex gap-6">
                    <a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang</a>
                    <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privasi</a>
                    <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Ketentuan</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Join Room Modal -->
    <div x-show="joinModalOpen" class="fixed inset-0 flex items-center justify-center" style="z-index: 9999; display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" @click="joinModalOpen = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Modal Content -->
        <div class="bg-gray-900 border border-fuchsia-500/30 rounded-3xl p-8 max-w-md w-full mx-4 relative z-10 shadow-[0_0_50px_-12px_rgba(217,70,239,0.5)]"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95">
            
            <button @click="joinModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-fuchsia-600/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-fuchsia-500/50 text-fuchsia-400 shadow-[0_0_15px_rgba(217,70,239,0.5)]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </div>
                <h3 class="text-3xl font-black text-white">Masuk Room</h3>
                <p class="text-gray-400 text-sm mt-2">Masukkan kode dan nama untuk bermain.</p>
            </div>

            <form action="{{ route('rooms.join') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Kode Room</label>
                    <input type="text" name="code" placeholder="Contoh: ABCDEF" required
                           class="w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:border-fuchsia-500 focus:ring-1 focus:ring-fuchsia-500 font-mono text-center uppercase text-lg transition-colors shadow-inner">
                </div>
                
                @guest
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama Panggilan</label>
                    <input type="text" name="guest_name" placeholder="Nama kamu" required
                           class="w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-fuchsia-500 focus:ring-1 focus:ring-fuchsia-500 text-center font-medium transition-colors shadow-inner">
                </div>
                @endguest

                <button type="submit" class="w-full bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-fuchsia-500/30 transition-all hover:scale-[1.02] active:scale-[0.98] mt-6 text-lg">
                    Ayo Bermain!
                </button>
                @guest
                    <p class="text-xs text-gray-500 text-center mt-4 bg-gray-800/50 p-2 rounded-lg border border-gray-700">Login untuk menyimpan riwayat dan mengumpulkan bintang.</p>
                @endguest
            </form>
        </div>
    </div>
</body>
</html>

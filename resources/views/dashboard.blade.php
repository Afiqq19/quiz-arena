<x-app-layout>
    <!-- Background Accents -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-fuchsia-600/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[150px]"></div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl relative flex items-center gap-3 shadow-lg shadow-green-500/10" role="alert">
                    <svg class="w-6 h-6 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-bold text-lg">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Hero Stats Section -->
            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-gray-900 to-black border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl">
                <!-- Decorative BG -->
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-b from-fuchsia-500/30 to-transparent rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                    <!-- User Greeting -->
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-fuchsia-500 to-blue-600 p-1 shadow-lg shadow-fuchsia-500/30 flex-shrink-0">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-full h-full rounded-xl object-cover" referrerpolicy="no-referrer">
                            @else
                                <div class="w-full h-full bg-gray-900 rounded-xl flex items-center justify-center">
                                    <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-br from-white to-gray-400">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-3xl sm:text-4xl font-black text-white mb-2 tracking-tight flex flex-wrap items-center gap-2 sm:gap-3">
                                <span>Halo, {{ explode(' ', auth()->user()->name)[0] }}!</span> <x-rank-badge :streak="auth()->user()->room_streak" /> 🚀
                            </h2>
                            <p class="text-indigo-200 font-medium text-lg">Siap untuk menaklukkan tantangan hari ini?</p>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-3 sm:gap-4 w-full md:w-auto md:flex md:gap-6 mt-4 md:mt-0">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 sm:p-5 backdrop-blur-sm text-center md:min-w-[120px] transition-transform hover:scale-105">
                            <p class="text-gray-400 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1">Total Poin</p>
                            <p class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">
                                {{ number_format($totalScore) }}
                            </p>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 sm:p-5 backdrop-blur-sm text-center md:min-w-[120px] transition-transform hover:scale-105">
                            <p class="text-gray-400 text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1">Misi Selesai</p>
                            <p class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-500">
                                {{ $totalCompleted }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header & Filter -->
            <div class="flex flex-col sm:flex-row justify-between items-end sm:items-center gap-4 mt-12 mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                        <svg class="w-6 h-6 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Misi Tersedia
                    </h3>
                    <p class="text-gray-400 text-sm mt-1">Pilih kuis di bawah ini dan uji kemampuanmu.</p>
                </div>
                <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-2 sm:gap-3 mt-4 sm:mt-0 w-full sm:w-auto">
                    <a href="{{ route('quizzes.create') }}" class="px-2 sm:px-5 py-2.5 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-400 hover:to-emerald-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-green-500/30 transition-all flex items-center justify-center gap-1 sm:gap-2 border border-green-400/50 text-center">
                        <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Kuis
                    </a>
                    <a href="{{ route('rooms.create') }}" class="px-2 sm:px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-blue-500/30 transition-all flex items-center justify-center gap-1 sm:gap-2 border border-blue-400/50 text-center">
                        <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Buat Room
                    </a>
                    <a href="{{ route('rooms.joinForm') }}" class="px-2 sm:px-5 py-2.5 rounded-xl bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-fuchsia-500/30 transition-all flex items-center justify-center gap-1 sm:gap-2 border border-fuchsia-400/50 text-center">
                        Gabung
                        <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </a>
                    <a href="{{ route('quiz.history') }}" class="px-2 sm:px-5 py-2.5 rounded-xl bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-300 hover:text-indigo-100 font-semibold text-xs sm:text-sm transition-all flex items-center justify-center gap-1 sm:gap-2 border border-indigo-500/30 text-center">
                        <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Histori
                    </a>
                </div>
            </div>

            <!-- Search Bar -->
            <form action="{{ route('dashboard') }}" method="GET" class="mb-8 relative max-w-2xl">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul kuis, kategori, atau deskripsi..." class="w-full pl-12 pr-10 py-3.5 bg-gray-900/60 border border-white/10 rounded-2xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 focus:border-fuchsia-500/50 backdrop-blur-md transition-all shadow-inner">
                    @if(request('search'))
                        <a href="{{ route('dashboard') }}" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </div>
            </form>

            <!-- Quiz Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($quizzes as $quiz)
                    @php
                        $isCompleted = in_array($quiz->id, $completedQuizIds);
                    @endphp
                    <div class="group relative overflow-hidden rounded-3xl p-[1px] transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-fuchsia-500/20">
                        <!-- Animated Border Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-700 via-gray-800 to-gray-700 group-hover:from-fuchsia-500 group-hover:to-blue-600 transition-colors duration-500"></div>
                        
                        <!-- Card Content -->
                        <div class="bg-[#0f111a] relative z-10 rounded-[23px] h-full flex flex-col p-6 overflow-hidden">
                            <!-- Background Glow on Hover -->
                            <div class="absolute -top-20 -right-20 w-40 h-40 bg-fuchsia-500/20 blur-3xl rounded-full group-hover:bg-fuchsia-500/40 transition-colors duration-500 pointer-events-none"></div>
                            
                            <div class="flex justify-between items-start mb-5 relative z-10">
                                <div class="flex flex-col items-start gap-2">
                                    <span class="px-3 py-1.5 text-[11px] font-black tracking-wider uppercase rounded-lg bg-gray-800 text-gray-300 border border-gray-700">
                                        {{ $quiz->category ?? 'Umum' }}
                                    </span>
                                    @if($isCompleted)
                                        <div class="flex items-center gap-1.5 text-[11px] font-black uppercase tracking-wider text-green-400 bg-green-900/40 px-3 py-1.5 rounded-lg border border-green-500/30 shadow-[0_0_10px_rgba(74,222,128,0.2)]">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                            Selesai
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col items-end gap-1.5">
                                    <div class="flex items-center gap-1.5 text-xs text-blue-300 font-bold bg-blue-900/30 px-3 py-1.5 rounded-lg border border-blue-800/50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $quiz->questions_count }} Soal
                                    </div>
                                    <div class="flex items-center gap-1.5 text-xs text-fuchsia-300 font-bold bg-fuchsia-900/30 px-3 py-1.5 rounded-lg border border-fuchsia-800/50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        {{ $quiz->attempts_count ?? 0 }} Dimainkan
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="text-xl font-black text-white mb-1 leading-tight group-hover:text-fuchsia-300 transition-colors relative z-10">{{ $quiz->title }}</h4>
                            <p class="text-xs text-fuchsia-400/80 mb-3 relative z-10 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Dibuat oleh: {{ $quiz->creator->name ?? 'Admin' }}
                            </p>
                            <p class="text-gray-400 text-sm mb-8 flex-grow leading-relaxed relative z-10">{{ $quiz->description }}</p>
                            
                            <div class="relative z-10 mt-auto">
                                @if($quiz->questions_count > 0)
                                    @if($isCompleted)
                                        <a href="{{ route('quiz.play', $quiz) }}" class="block w-full text-center px-4 py-3.5 bg-gray-800 hover:bg-gray-700 border border-gray-600 rounded-xl font-bold text-gray-300 transition-all transform active:scale-95 group-hover:border-gray-500">
                                            Ulangi (Mode Latihan)
                                        </a>
                                    @else
                                        <a href="{{ route('quiz.play', $quiz) }}" class="block w-full text-center px-4 py-3.5 bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 shadow-[0_0_20px_rgba(192,38,211,0.3)] border border-transparent rounded-xl font-bold text-white transition-all transform active:scale-95">
                                            Mulai Tantangan
                                        </a>
                                    @endif
                                @else
                                    <button disabled class="block w-full text-center px-4 py-3.5 bg-gray-800/50 border border-gray-800 rounded-xl font-bold text-gray-600 cursor-not-allowed">
                                        Belum Ada Soal
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div class="bg-gray-900/50 border border-white/5 p-16 rounded-3xl text-center backdrop-blur-sm">
                            <div class="w-24 h-24 mx-auto bg-gray-800/50 rounded-full flex items-center justify-center mb-6 border border-gray-700">
                                <svg class="h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-3">Belum ada misi tersedia</h3>
                            <p class="text-gray-400 max-w-md mx-auto text-lg">Admin sedang menyiapkan kuis-kuis seru untukmu. Silakan kembali lagi nanti!</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8">
                {{ $quizzes->links() }}
            </div>

            <!-- Kuis Buatan Saya -->
            <div class="mt-16 mb-8 bg-gradient-to-r from-gray-900 to-indigo-950 border border-indigo-900/50 rounded-3xl p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-fuchsia-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/3 pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-black text-white flex items-center gap-3 mb-2">
                            <svg class="w-8 h-8 text-green-400 drop-shadow-[0_0_10px_rgba(74,222,128,0.5)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Kuis Buatan Saya
                        </h3>
                        <p class="text-indigo-200 text-sm sm:text-base leading-relaxed max-w-2xl">
                            Teruslah berkarya! 🌟 Setiap kuis yang kamu buat adalah jembatan ilmu bagi pejuang lain. Jangan ragu membagikan pengetahuanmu, dan jadilah <strong>Kreator Legendaris</strong> di Quiz Arena!
                        </p>
                    </div>

                    @php
                        $quizCount = $myQuizzes->where('status', 'approved')->count();
                        $targetQuizzes = 3;
                        $progressPercent = min(100, ($quizCount / $targetQuizzes) * 100);
                    @endphp

                    <div class="bg-black/40 border border-white/10 rounded-2xl p-4 min-w-[250px] backdrop-blur-md">
                        <div class="flex justify-between items-end mb-2">
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Misi Sertifikat Kreator</div>
                            <div class="text-fuchsia-400 font-black text-lg">{{ $quizCount }}/{{ $targetQuizzes }}</div>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2.5 mb-2 overflow-hidden shadow-inner border border-gray-700/50">
                            <div class="bg-gradient-to-r from-fuchsia-500 to-blue-500 h-2.5 rounded-full shadow-[0_0_10px_rgba(192,38,211,0.5)] transition-all duration-1000" style="width: {{ $progressPercent }}%"></div>
                        </div>
                        
                        @if($quizCount >= $targetQuizzes)
                            <a href="{{ route('certificate.creator') }}" target="_blank" class="mt-3 w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-300 hover:to-yellow-500 border border-yellow-300/50 rounded-xl font-bold text-black text-xs uppercase tracking-wider shadow-[0_0_15px_rgba(250,204,21,0.4)] transition-all hover:scale-105 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                Buka Sertifikat
                            </a>
                        @else
                            <p class="text-[10px] text-gray-500 font-medium">
                                Kumpulkan {{ $targetQuizzes - $quizCount }} kuis yang berstatus <strong>Disetujui</strong> (Public) untuk membuka sertifikat!
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @forelse($myQuizzes as $quiz)
                    <div class="bg-gray-900 border border-gray-700 rounded-2xl p-5 hover:border-gray-500 transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <span class="px-2 py-1 text-[10px] font-bold tracking-wider uppercase rounded bg-gray-800 text-gray-400">
                                {{ $quiz->category ?? 'Umum' }}
                            </span>
                            @if($quiz->status === 'approved')
                                <span class="px-2 py-1 text-[10px] font-bold tracking-wider uppercase rounded bg-green-900/30 text-green-400 border border-green-500/30">Disetujui</span>
                            @elseif($quiz->status === 'rejected')
                                <span class="px-2 py-1 text-[10px] font-bold tracking-wider uppercase rounded bg-red-900/30 text-red-400 border border-red-500/30">Ditolak</span>
                            @else
                                <span class="px-2 py-1 text-[10px] font-bold tracking-wider uppercase rounded bg-yellow-900/30 text-yellow-400 border border-yellow-500/30">Menunggu</span>
                            @endif
                        </div>
                        <h4 class="text-lg font-bold text-white mb-1">{{ $quiz->title }}</h4>
                        <div class="flex items-center gap-3 text-xs text-gray-500 mb-4">
                            <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $quiz->questions_count }} Soal</span>
                            <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>{{ $quiz->attempts_count ?? 0 }} Dimainkan</span>
                        </div>
                        <div class="flex gap-2 mt-auto">
                            <a href="{{ route('quizzes.edit', $quiz) }}" class="flex-1 text-center px-3 py-2 bg-gray-800 hover:bg-gray-700 rounded-lg text-sm font-semibold text-gray-300 transition-colors">Edit Kuis</a>
                            @if($quiz->status === 'approved')
                            <a href="{{ route('rooms.create', ['quiz_id' => $quiz->id]) }}" class="flex-1 text-center px-3 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-sm font-semibold text-white transition-colors">Mainkan</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div class="bg-gray-900/30 border border-dashed border-gray-700 p-8 rounded-2xl text-center">
                            <p class="text-gray-500 mb-4">Kamu belum membuat kuis apapun.</p>
                            <a href="{{ route('quizzes.create') }}" class="inline-flex items-center gap-2 text-green-400 hover:text-green-300 font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Buat Kuis Pertamamu
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $myQuizzes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

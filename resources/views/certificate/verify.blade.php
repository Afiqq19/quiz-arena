<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sertifikat - Quiz Arena</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #0f172a; }
        .glass-panel { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center py-12 px-4 relative overflow-x-hidden text-slate-200">
    <!-- Background Decor -->
    <div class="fixed top-[-20%] left-[-10%] w-[50%] h-[50%] bg-fuchsia-600/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-[-20%] right-[-10%] w-[50%] h-[50%] bg-blue-600/20 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="glass-panel border border-slate-700/50 rounded-3xl p-6 md:p-12 max-w-lg w-full relative z-10 shadow-2xl my-auto">
        
        <!-- Header -->
        <div class="flex flex-col items-center mb-8">
            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-fuchsia-500 to-blue-600 flex items-center justify-center transform rotate-12 shadow-lg mb-4">
                <svg class="w-8 h-8 text-white transform -rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h1 class="text-2xl font-black text-white tracking-wide">VERIFIKASI RESMI</h1>
            <p class="text-emerald-400 font-bold text-sm tracking-widest uppercase mt-1 flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                Sertifikat Valid
            </p>
        </div>

        <!-- Avatar -->
        <div class="flex justify-center mb-6">
            <div class="w-32 h-32 rounded-full p-1 bg-gradient-to-tr from-fuchsia-500 to-blue-500 shadow-[0_0_20px_rgba(217,70,239,0.3)]">
                <div class="w-full h-full rounded-full border-4 border-slate-900 overflow-hidden bg-slate-800 flex items-center justify-center">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-4xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- User Details -->
        <div class="text-center mb-8 space-y-4">
            <div>
                <p class="text-slate-400 text-xs font-bold tracking-widest uppercase mb-1">Dianugerahkan Kepada</p>
                <h2 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-500">{{ $user->name }}</h2>
            </div>
            
            <div class="bg-slate-900/50 rounded-xl p-5 border border-slate-700/50 inline-block w-full text-left space-y-4">
                <div class="border-b border-slate-700/50 pb-3">
                    <p class="text-slate-500 text-[10px] font-bold tracking-widest uppercase mb-1">No. Sertifikat</p>
                    <p class="text-sm md:text-base font-bold text-indigo-300 break-all">{{ $certNumber }}</p>
                </div>
                <div>
                    <p class="text-slate-500 text-[10px] font-bold tracking-widest uppercase mb-1">Total Kuis Publik</p>
                    <p class="text-sm font-bold text-emerald-400">{{ $quizCount }} Kuis Terverifikasi</p>
                </div>
            </div>

            <!-- Quiz List -->
            <div class="bg-slate-800/40 rounded-xl p-5 border border-slate-700/50 text-left mt-4 w-full">
                <p class="text-slate-500 text-[10px] font-bold tracking-widest uppercase mb-3 flex items-center gap-2">
                    <svg class="w-3 h-3 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Daftar Kuis yang Dibuat
                </p>
                <ul class="space-y-2">
                    @foreach($approvedQuizzes as $q)
                        <li class="text-xs text-slate-300 flex items-start gap-2 bg-slate-900/40 px-3 py-2 rounded-lg">
                            <span class="text-emerald-400 mt-0.5">✓</span>
                            <span>{{ $q->title }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="text-slate-500 text-xs mt-2">Dianugerahkan pada tanggal <strong>{{ $achievementDate }}</strong></p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center border-t border-slate-700/50 pt-6">
            <h3 class="text-lg font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 tracking-tight">QUIZ<span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-blue-400">ARENA</span></h3>
            <p class="text-[10px] text-slate-500 mt-2 uppercase tracking-widest">Sistem Verifikasi Otomatis</p>
        </div>
    </div>
</body>
</html>

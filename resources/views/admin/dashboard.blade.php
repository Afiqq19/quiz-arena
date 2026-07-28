<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h2 class="text-3xl font-black text-white tracking-tight flex items-center gap-3">
                    <svg class="w-8 h-8 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Admin Dashboard
                </h2>
                <p class="text-indigo-200 mt-1">Kelola seluruh sistem dan awasi aktivitas pemain.</p>
            </div>
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/50 text-green-700 px-4 py-3 rounded-xl relative flex items-center gap-3 shadow-[0_0_15px_rgba(34,197,94,0.2)]" role="alert">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/50 text-red-700 px-4 py-3 rounded-xl relative flex items-center gap-3 shadow-[0_0_15px_rgba(239,68,68,0.2)]" role="alert">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-bold">{{ session('error') }}</span>
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Stats Quizzes -->
                <div class="bg-gray-900 overflow-hidden shadow-xl rounded-2xl border border-indigo-500/30 relative group hover:border-indigo-500/60 transition-all">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="p-6 relative z-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-500/20 flex items-center justify-center text-indigo-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <div>
                                <div class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Kuis</div>
                                <div class="text-3xl font-black text-white mt-1">{{ $totalQuizzes }}</div>
                            </div>
                        </div>
                        <a href="{{ route('quizzes.index') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-bold flex items-center gap-1 transition-colors">
                            Kelola Kuis <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Stats Pending Quizzes -->
                <div class="bg-gray-900 overflow-hidden shadow-xl rounded-2xl border {{ $pendingQuizzes > 0 ? 'border-red-500/50' : 'border-gray-800' }} relative group hover:border-red-500/60 transition-all">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    @if($pendingQuizzes > 0)
                        <span class="absolute top-4 right-4 flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.8)]"></span>
                        </span>
                    @endif
                    <div class="p-6 relative z-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-xl {{ $pendingQuizzes > 0 ? 'bg-red-500/20 text-red-400' : 'bg-gray-800 text-gray-500' }} flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <div>
                                <div class="text-gray-400 text-[10px] font-bold uppercase tracking-wider">Menunggu Persetujuan</div>
                                <div class="text-3xl font-black {{ $pendingQuizzes > 0 ? 'text-red-400' : 'text-gray-500' }} mt-1">{{ $pendingQuizzes }}</div>
                            </div>
                        </div>
                        <a href="{{ route('quizzes.index', ['status' => 'pending']) }}" class="{{ $pendingQuizzes > 0 ? 'text-red-400 hover:text-red-300' : 'text-gray-500 hover:text-gray-400' }} text-sm font-bold flex items-center gap-1 transition-colors">
                            Cek Kuis Baru <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Stats Users -->
                <div class="bg-gray-900 overflow-hidden shadow-xl rounded-2xl border border-emerald-500/30 relative group hover:border-emerald-500/60 transition-all">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="p-6 relative z-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Pemain</div>
                                <div class="text-3xl font-black text-white mt-1">{{ $totalUsers }}</div>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="text-emerald-400 hover:text-emerald-300 text-sm font-bold flex items-center gap-1 transition-colors">
                            Lihat Pemain <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Stats Attempts -->
                <div class="bg-gray-900 overflow-hidden shadow-xl rounded-2xl border border-amber-500/30 relative group hover:border-amber-500/60 transition-all">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="p-6 relative z-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center text-amber-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <div>
                                <div class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Pengerjaan</div>
                                <div class="text-3xl font-black text-white mt-1">{{ $totalAttempts }}</div>
                            </div>
                        </div>
                        <a href="{{ route('admin.attempts.index') }}" class="text-amber-400 hover:text-amber-300 text-sm font-bold flex items-center gap-1 transition-colors">
                            Lihat Histori <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Usulan Revisi Soal -->
            @if($pendingRevisions->count() > 0)
            <div class="mt-12">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <span class="bg-yellow-500 text-yellow-900 text-sm font-black px-3 py-1 rounded-lg shadow-[0_0_15px_rgba(234,179,8,0.3)]">{{ $pendingRevisions->count() }}</span>
                    Usulan Revisi Soal
                </h3>
                <div class="bg-gray-900 overflow-hidden shadow-xl rounded-2xl border border-gray-800">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-800">
                            <thead class="bg-gray-800/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Kuis</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Soal Lama</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Usulan Revisi (Perubahan)</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-900 divide-y divide-gray-800">
                                @foreach($pendingRevisions as $revision)
                                    <tr class="hover:bg-gray-800/30 transition-colors">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="text-sm font-bold text-white">{{ $revision->question->quiz->title }}</div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-sm text-gray-400 mb-2">
                                                <span class="font-bold text-gray-500 uppercase text-[10px] tracking-wider block mb-1">Pertanyaan Asli</span>
                                                {{ Str::limit($revision->question->question_text, 100) }}
                                            </div>
                                            <div class="text-[11px] font-bold text-gray-500 bg-gray-800 inline-block px-2 py-1 rounded border border-gray-700">
                                                Tipe: {{ $revision->question->question_type === 'essay' ? 'Esai' : 'Pilihan Ganda' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="bg-yellow-900/10 border border-yellow-500/20 p-3 rounded-xl">
                                                @if($revision->question->question_text !== $revision->question_text)
                                                    <div class="mb-2">
                                                        <span class="font-bold text-yellow-500 uppercase text-[10px] tracking-wider block mb-1">Perubahan Teks Pertanyaan</span>
                                                        <div class="text-sm text-yellow-100 line-clamp-2">{{ $revision->question_text }}</div>
                                                    </div>
                                                @endif
                                                
                                                @if($revision->question->question_type === 'essay' && $revision->question->essay_answer !== $revision->essay_answer)
                                                    <div class="mb-2">
                                                        <span class="font-bold text-yellow-500 uppercase text-[10px] tracking-wider block mb-1">Perubahan Jawaban Esai</span>
                                                        <div class="text-sm text-yellow-100"><del class="text-gray-500 mr-2">{{ $revision->question->essay_answer }}</del> <span class="font-bold text-green-400">&rarr; {{ $revision->essay_answer }}</span></div>
                                                    </div>
                                                @endif

                                                @if($revision->question->question_type === 'multiple_choice')
                                                    @foreach(['a', 'b', 'c', 'd'] as $opt)
                                                        @php
                                                            $origOpt = 'option_' . $opt;
                                                            $revOpt = 'option_' . $opt;
                                                        @endphp
                                                        @if($revision->question->$origOpt !== $revision->$revOpt)
                                                            <div class="mb-2">
                                                                <span class="font-bold text-yellow-500 uppercase text-[10px] tracking-wider block mb-1">Perubahan Opsi {{ strtoupper($opt) }}</span>
                                                                <div class="text-sm text-yellow-100"><del class="text-gray-500 mr-2">{{ $revision->question->$origOpt }}</del> <span class="font-bold text-green-400">&rarr; {{ $revision->$revOpt }}</span></div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    
                                                    @if($revision->question->correct_option !== $revision->correct_option)
                                                        <div class="mb-2">
                                                            <span class="font-bold text-yellow-500 uppercase text-[10px] tracking-wider block mb-1">Perubahan Kunci Jawaban</span>
                                                            <div class="text-sm text-yellow-100"><del class="text-gray-500 mr-2">{{ $revision->question->correct_option }}</del> <span class="font-bold text-green-400">&rarr; {{ $revision->correct_option }}</span></div>
                                                        </div>
                                                    @endif
                                                @endif
                                                
                                                @if($revision->question->timer_seconds !== $revision->timer_seconds)
                                                    <div class="mb-2">
                                                        <span class="font-bold text-yellow-500 uppercase text-[10px] tracking-wider block mb-1">Perubahan Waktu</span>
                                                        <div class="text-sm text-yellow-100"><del class="text-gray-500 mr-2">{{ $revision->question->timer_seconds }}s</del> <span class="font-bold text-green-400">&rarr; {{ $revision->timer_seconds }}s</span></div>
                                                    </div>
                                                @endif
                                                
                                                @if(
                                                    $revision->question->question_text === $revision->question_text &&
                                                    $revision->question->essay_answer === $revision->essay_answer &&
                                                    $revision->question->option_a === $revision->option_a &&
                                                    $revision->question->option_b === $revision->option_b &&
                                                    $revision->question->option_c === $revision->option_c &&
                                                    $revision->question->option_d === $revision->option_d &&
                                                    $revision->question->correct_option === $revision->correct_option &&
                                                    $revision->question->timer_seconds === $revision->timer_seconds
                                                )
                                                    <div class="text-sm text-gray-500 italic">Tidak ada perubahan terdeteksi.</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <form action="{{ route('admin.revisions.moderate', $revision) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="text-white bg-green-500/20 hover:bg-green-500/40 border border-green-500/50 px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-[0_0_15px_rgba(34,197,94,0.2)]">
                                                        Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.revisions.moderate', $revision) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="text-white bg-red-500/20 hover:bg-red-500/40 border border-red-500/50 px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Admin Actions -->
            <div class="mt-12">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-fuchsia-500/20 text-fuchsia-400 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    Aksi Cepat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-fuchsia-600 to-purple-700 rounded-2xl p-8 text-white shadow-[0_0_30px_rgba(192,38,211,0.2)] flex justify-between items-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10 max-w-[60%]">
                            <h4 class="font-black text-2xl mb-2">Multiplayer Room</h4>
                            <p class="text-purple-200 text-sm font-medium leading-relaxed">Buat room baru, undang pemain, dan pantau sesi kuis secara real-time.</p>
                        </div>
                        <a href="{{ route('rooms.create') }}" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white px-6 py-3 rounded-xl font-bold shadow-lg backdrop-blur-md transition-all hover:scale-105 active:scale-95 flex items-center gap-2 relative z-10 shrink-0">
                            Buka Room
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="min-h-screen bg-gray-900 pb-20 relative overflow-hidden" x-data="monitorRoom()">
        <!-- Background Effects -->
        <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-indigo-900/50 to-transparent pointer-events-none"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-fuchsia-600/20 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute top-40 -left-40 w-96 h-96 bg-blue-600/20 blur-[100px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10 pt-12">
            
            <!-- Custom Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white/5 backdrop-blur-xl border border-white/10 p-6 rounded-3xl shadow-2xl">
                <div>
                    <h2 class="font-black text-3xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-cyan-400 flex items-center gap-3">
                        <svg class="w-8 h-8 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Pemantauan Room
                    </h2>
                    <p class="text-gray-300 mt-1 text-lg font-medium">{{ $room->title }}</p>
                </div>
                <div class="flex items-center gap-3 bg-gray-900/80 border border-white/10 pl-5 pr-2 py-2 rounded-2xl shadow-inner">
                    <span class="text-gray-400 font-bold text-sm tracking-widest uppercase">Kode Akses</span>
                    <span class="text-2xl font-mono font-black text-white bg-gradient-to-r from-fuchsia-600 to-blue-600 px-4 py-1.5 rounded-xl shadow-lg cursor-pointer hover:opacity-90 transition-opacity" onclick="navigator.clipboard.writeText('{{ $room->code }}'); alert('Kode disalin!')">{{ $room->code }}</span>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 p-4 rounded-2xl shadow-lg backdrop-blur-md flex items-center gap-3" role="alert">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Kontrol Permainan -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Status Card -->
                <div class="lg:col-span-1 bg-gradient-to-br from-gray-800 to-gray-900 p-8 rounded-3xl border border-white/10 shadow-xl relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-fuchsia-500/10 rounded-full blur-2xl group-hover:bg-fuchsia-500/20 transition-all"></div>
                    
                    <div class="text-gray-400 text-sm mb-2 uppercase tracking-widest font-bold flex items-center gap-2 relative z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Status Permainan
                    </div>
                    
                    <div class="text-3xl font-black mb-6 relative z-10" :class="status === 'waiting' ? 'text-yellow-400 drop-shadow-[0_0_10px_rgba(250,204,21,0.5)]' : (status === 'playing' ? 'text-green-400 drop-shadow-[0_0_10px_rgba(74,222,128,0.5)]' : 'text-rose-400 drop-shadow-[0_0_10px_rgba(251,113,133,0.5)]')">
                        <span x-text="status === 'waiting' ? 'Menunggu Peserta' : (status === 'playing' ? 'Sedang Berlangsung' : 'Telah Selesai')"></span>
                    </div>

                    <div class="space-y-3 relative z-10">
                        <div class="flex justify-between items-center bg-black/30 px-5 py-3.5 rounded-xl border border-white/5">
                            <span class="text-gray-400 text-sm font-medium">Total Soal</span>
                            <span class="text-white font-bold">{{ $room->total_questions }}</span>
                        </div>
                        <div class="flex justify-between items-center bg-black/30 px-5 py-3.5 rounded-xl border border-white/5">
                            <span class="text-gray-400 text-sm font-medium">Waktu per Soal</span>
                            <span class="text-white font-bold">{{ $room->timer_per_question }} Detik</span>
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="lg:col-span-2 bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 shadow-xl flex items-center justify-center">
                    <div class="w-full flex flex-col sm:flex-row gap-4 justify-center">
                        @if($room->status === 'waiting')
                            <button @click="isSettingsModalOpen = true" class="px-8 py-4 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold rounded-2xl shadow-lg transition-all flex items-center justify-center gap-3 group">
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors group-hover:rotate-90 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Pengaturan Room
                            </button>
                            <form action="{{ route('rooms.start', $room->id) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-400 hover:to-emerald-500 text-white font-black text-lg rounded-2xl shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] transition-all hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    MULAI SEKARANG!
                                </button>
                            </form>
                        @elseif($room->status === 'playing')
                            <form action="{{ route('rooms.close', $room->id) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full px-10 py-5 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white font-black text-xl rounded-2xl shadow-[0_0_30px_rgba(225,29,72,0.4)] hover:shadow-[0_0_40px_rgba(225,29,72,0.6)] transition-all hover:-translate-y-1 flex items-center justify-center gap-3">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path></svg>
                                    AKHIRI PERMAINAN
                                </button>
                            </form>
                        @else
                            <div class="flex flex-col sm:flex-row items-center gap-6">
                                <a href="{{ route('rooms.export', $room->id) }}" class="px-8 py-4 bg-emerald-500/20 border border-emerald-500/40 hover:bg-emerald-500 hover:text-white text-emerald-400 font-bold rounded-2xl shadow-[0_0_20px_rgba(16,185,129,0.2)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] transition-all flex items-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Unduh Hasil (Excel)
                                </a>
                                <div class="px-6 py-4 bg-white/5 border border-white/10 text-gray-400 font-bold rounded-2xl flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full bg-rose-500 shadow-[0_0_10px_rgba(244,63,94,0.8)]"></span>
                                    Sesi Telah Selesai
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal Pengaturan -->
            <div x-show="isSettingsModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" style="display: none;" x-transition>
                <div class="bg-gray-900 border border-white/10 rounded-3xl shadow-2xl w-full max-w-3xl p-6 md:p-8 m-4 max-h-[90vh] overflow-y-auto" @click.away="isSettingsModalOpen = false">
                    <h3 class="text-2xl font-black text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan Room
                    </h3>
                    
                    <form action="{{ route('rooms.updateSettings', $room->id) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label class="block text-sm font-bold text-gray-300 mb-2">Judul Ruangan</label>
                            <input type="text" name="title" value="{{ $room->title }}" required class="w-full bg-black/50 border border-gray-700 text-white rounded-xl shadow-sm focus:border-fuchsia-500 focus:ring-fuchsia-500 px-4 py-3">
                        </div>
                        
                        <div class="mb-5" x-data="{ searchCategory: '' }">
                            <label class="block text-sm font-bold text-gray-300 mb-2">Pilih Sumber Soal Quiz</label>
                            <input type="text" x-model="searchCategory" placeholder="Cari kategori kuis..." class="w-full mb-3 bg-black/50 border border-gray-700 text-white rounded-xl shadow-sm focus:border-fuchsia-500 focus:ring-fuchsia-500 px-4 py-2 text-sm">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 max-h-64 overflow-y-auto p-3 border border-gray-700 rounded-xl bg-black/50">
                                @foreach($quizzes as $quiz)
                                    <label x-show="'{{ strtolower(addslashes($quiz->title)) }}'.includes(searchCategory.toLowerCase())" class="flex items-center space-x-3 p-3 border border-gray-700 rounded-lg hover:bg-white/5 cursor-pointer transition-colors">
                                        <input type="checkbox" name="quizzes[]" value="{{ $quiz->id }}" {{ in_array($quiz->id, $selectedQuizzes) ? 'checked' : '' }} class="h-5 w-5 text-fuchsia-600 bg-gray-800 border-gray-600 rounded focus:ring-fuchsia-500 flex-shrink-0">
                                        <div class="flex-1 min-w-0">
                                            <span class="block text-sm font-bold text-gray-200 truncate" title="{{ $quiz->title }}">{{ $quiz->title }}</span>
                                            <span class="block text-[11px] text-gray-400">{{ $quiz->questions()->count() }} Soal tersedia</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mb-5">
                            <label class="block text-sm font-bold text-gray-300 mb-2">Jumlah Pertanyaan</label>
                            <input type="number" name="total_questions" value="{{ $room->total_questions }}" min="1" class="w-full bg-black/50 border border-gray-700 text-white rounded-xl shadow-sm focus:border-fuchsia-500 focus:ring-fuchsia-500 px-4 py-3">
                            <p class="text-xs text-gray-500 mt-2">Soal akan diacak ulang berdasarkan jumlah ini.</p>
                        </div>
                        
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-300 mb-2">Waktu per Soal (Detik)</label>
                            <input type="number" name="timer_per_question" value="{{ $room->timer_per_question }}" min="5" class="w-full bg-black/50 border border-gray-700 text-white rounded-xl shadow-sm focus:border-fuchsia-500 focus:ring-fuchsia-500 px-4 py-3">
                        </div>
                        
                        <div class="flex justify-end gap-4">
                            <button type="button" @click="isSettingsModalOpen = false" class="px-5 py-2.5 bg-gray-800 text-gray-300 font-bold rounded-xl hover:bg-gray-700 transition">Batal</button>
                            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-fuchsia-600 to-blue-600 text-white font-bold rounded-xl hover:from-fuchsia-500 hover:to-blue-500 transition shadow-lg">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Leaderboard Live -->
            <div class="bg-gray-900/80 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-2xl relative overflow-hidden mt-8">
                <div class="absolute top-0 right-0 p-10 opacity-5 pointer-events-none">
                    <svg class="w-64 h-64 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                
                <h3 class="font-black text-2xl text-white mb-8 flex items-center gap-3 relative z-10">
                    <div class="p-3 bg-indigo-500/20 rounded-xl text-indigo-400 border border-indigo-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    Daftar Peserta & Live Score
                </h3>
                
                <div class="overflow-x-auto relative z-10">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-gray-400 text-sm border-b border-white/10 uppercase tracking-wider">
                                <th class="py-4 px-6 font-bold w-24">Posisi</th>
                                <th class="py-4 px-6 font-bold">Peserta</th>
                                <th class="py-4 px-6 font-bold text-center">Status</th>
                                <th class="py-4 px-6 font-bold text-right">Skor Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <template x-for="(p, index) in participants" :key="p.id">
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="py-5 px-6">
                                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-black text-lg transition-transform group-hover:scale-110 shadow-inner"
                                             :class="index == 0 ? 'bg-gradient-to-br from-yellow-300 to-yellow-600 text-yellow-900 shadow-[0_0_15px_rgba(234,179,8,0.5)]' : 
                                                    (index == 1 ? 'bg-gradient-to-br from-gray-300 to-gray-500 text-gray-900 shadow-[0_0_15px_rgba(156,163,175,0.5)]' : 
                                                    (index == 2 ? 'bg-gradient-to-br from-amber-600 to-amber-800 text-amber-100 shadow-[0_0_15px_rgba(180,83,9,0.5)]' : 'bg-white/10 text-white'))">
                                            <span x-text="index + 1"></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex flex-col">
                                                <div class="flex items-center">
                                                    <span class="text-white font-bold text-lg" x-text="p.user ? p.user.name : (p.guest_name + ' (Guest)')"></span>
                                                    <template x-if="p.user && p.user.room_streak >= 4">
                                                        <span class="inline-flex items-center justify-center text-yellow-400 text-xl ml-2 drop-shadow-[0_0_8px_rgba(250,204,21,0.8)]" title="Mahkota">👑</span>
                                                    </template>
                                                    <template x-if="p.user && p.user.room_streak == 3">
                                                        <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 3">⭐⭐⭐</span>
                                                    </template>
                                                    <template x-if="p.user && p.user.room_streak == 2">
                                                        <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 2">⭐⭐</span>
                                                    </template>
                                                    <template x-if="p.user && p.user.room_streak == 1">
                                                        <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 1">⭐</span>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        <span x-show="p.status === 'joined'" class="inline-flex items-center text-xs bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 px-4 py-2 rounded-xl font-bold uppercase tracking-wider">Menunggu</span>
                                        <span x-show="p.status === 'playing'" class="inline-flex items-center text-xs bg-blue-500/10 text-blue-400 border border-blue-500/20 px-4 py-2 rounded-xl font-bold uppercase tracking-wider gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-ping"></span>
                                            Mengerjakan
                                        </span>
                                        <span x-show="p.status === 'finished'" class="inline-flex items-center text-xs bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-4 py-2 rounded-xl font-bold uppercase tracking-wider">Selesai</span>
                                    </td>
                                    <td class="py-5 px-6 text-right font-black text-3xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-cyan-400 drop-shadow-sm" x-text="p.score"></td>
                                </tr>
                            </template>
                            <tr x-show="participants.length === 0">
                                <td colspan="4" class="py-20 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <div class="w-20 h-20 mb-6 border-4 border-gray-800 border-t-gray-600 rounded-full animate-spin"></div>
                                        <span class="text-xl font-medium">Belum ada pemain...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function monitorRoom() {
            return {
                status: '{{ $room->status }}',
                participants: [],
                isSettingsModalOpen: false,
                
                init() {
                    this.fetchData();
                    // Refresh data setiap 3 detik
                    setInterval(() => {
                        this.fetchData();
                    }, 3000);
                },

                fetchData() {
                    fetch('{{ route('rooms.data', $room->id) }}')
                        .then(res => res.json())
                        .then(data => {
                            this.status = data.status;
                            this.participants = data.participants;
                        });
                }
            }
        }
    </script>
</x-app-layout>

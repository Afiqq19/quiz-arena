<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl tracking-tight text-gray-800 flex justify-between items-center">
            <span>Pemantauan Room: {{ $room->title }}</span>
            <span class="text-indigo-600 bg-indigo-100 px-4 py-2 rounded-full font-mono text-xl">KODE: {{ $room->code }}</span>
        </h2>
    </x-slot>

    <div class="py-12" x-data="monitorRoom()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-r-lg shadow-sm" role="alert">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Kontrol Permainan -->
            <div class="flex flex-col sm:flex-row justify-between items-center bg-indigo-800 p-6 rounded-lg shadow-inner gap-4">
                <div>
                    <div class="text-indigo-200 text-sm mb-1 uppercase tracking-wider font-bold">Status Permainan: 
                        <span class="{{ $room->status === 'waiting' ? 'text-yellow-400' : ($room->status === 'playing' ? 'text-green-400' : 'text-gray-400') }}">
                            {{ $room->status === 'waiting' ? 'Menunggu Peserta' : ($room->status === 'playing' ? 'Sedang Berlangsung' : 'Selesai') }}
                        </span>
                    </div>
                    <div class="text-indigo-300 text-xs">
                        Total Soal: {{ $room->total_questions }} | Waktu per Soal: {{ $room->timer_per_question }} Detik
                    </div>
                </div>
                
                <div class="flex gap-2">
                    @if($room->status === 'waiting')
                        <button @click="isSettingsModalOpen = true" class="px-6 py-3 bg-gray-200 hover:bg-white text-indigo-900 font-bold rounded-lg shadow transition">
                            ⚙️ Pengaturan Room
                        </button>
                        <form action="{{ route('rooms.start', $room->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-green-500 hover:bg-green-400 text-white font-bold rounded-lg shadow transition">
                                Mulai Permainan Sekarang!
                            </button>
                        </form>
                    @elseif($room->status === 'playing')
                        <form action="{{ route('rooms.close', $room->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-rose-500 hover:bg-rose-400 text-white font-bold rounded-lg shadow transition">
                                Akhiri Permainan
                            </button>
                        </form>
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('rooms.export', $room->id) }}" class="px-6 py-2.5 bg-green-500/10 border border-green-500/30 hover:bg-green-500 hover:text-white text-green-400 font-bold rounded-xl shadow-[0_0_15px_rgba(34,197,94,0.15)] hover:shadow-[0_0_25px_rgba(34,197,94,0.4)] transition-all flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Unduh Excel
                            </a>
                            <div class="px-5 py-2.5 bg-white/5 border border-white/10 text-gray-400 font-bold rounded-xl flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                Permainan Selesai
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Modal Pengaturan -->
            <div x-show="isSettingsModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 m-4" @click.away="isSettingsModalOpen = false">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 border-b pb-2">Pengaturan Room</h3>
                    
                    <form action="{{ route('rooms.updateSettings', $room->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah Pertanyaan</label>
                            <input type="number" name="total_questions" value="{{ $room->total_questions }}" min="1" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Soal akan diacak ulang berdasarkan jumlah ini.</p>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Waktu per Soal (Detik)</label>
                            <input type="number" name="timer_per_question" value="{{ $room->timer_per_question }}" min="5" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div class="flex justify-end gap-3">
                            <button type="button" @click="isSettingsModalOpen = false" class="px-4 py-2 bg-gray-200 text-gray-800 font-bold rounded-md hover:bg-gray-300 transition">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-bold rounded-md hover:bg-indigo-700 transition">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Leaderboard Live -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Daftar Peserta & Live Score
                </h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/5 text-gray-400 text-sm border-b border-white/10">
                                <th class="py-4 px-6 font-semibold">Peringkat</th>
                                <th class="py-4 px-6 font-semibold">Nama Peserta</th>
                                <th class="py-4 px-6 font-semibold text-center">Status</th>
                                <th class="py-4 px-6 font-semibold text-right">Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(p, index) in participants" :key="p.id">
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm shadow-inner"
                                             :class="index == 0 ? 'bg-gradient-to-br from-yellow-300 to-yellow-600 text-yellow-900 shadow-yellow-500/50' : 
                                                    (index == 1 ? 'bg-gradient-to-br from-gray-300 to-gray-500 text-gray-900 shadow-gray-500/50' : 
                                                    (index == 2 ? 'bg-gradient-to-br from-amber-600 to-amber-800 text-amber-100 shadow-amber-700/50' : 'bg-white/10 text-white'))">
                                            <span x-text="index + 1"></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">
                                        <div class="flex items-center">
                                            <span x-text="p.user ? p.user.name : (p.guest_name + ' (Guest)')"></span>
                                            <template x-if="p.user && p.user.room_streak >= 4">
                                                <span class="inline-flex items-center justify-center text-yellow-400 text-lg ml-2 drop-shadow-[0_0_8px_rgba(250,204,21,0.8)]" title="Mahkota (Juara Bertahan)">👑</span>
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
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span x-show="p.status === 'joined'" class="text-xs bg-yellow-500/20 text-yellow-300 border border-yellow-500/30 px-3 py-1.5 rounded-full font-medium">Di Ruang Tunggu</span>
                                        <span x-show="p.status === 'finished'" class="text-xs bg-green-500/20 text-green-300 border border-green-500/30 px-3 py-1.5 rounded-full font-medium">Selesai</span>
                                    </td>
                                    <td class="py-4 px-6 text-right font-black text-xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-blue-400" x-text="p.score"></td>
                                </tr>
                            </template>
                            <tr x-show="participants.length === 0">
                                <td colspan="4" class="py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <span class="text-4xl mb-3 opacity-50">👥</span>
                                        Belum ada peserta yang bergabung. Minta peserta memasukkan KODE ROOM.
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

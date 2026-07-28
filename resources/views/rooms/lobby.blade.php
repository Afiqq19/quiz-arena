<x-app-layout>
    <div class="py-20" x-data="lobbyRoom()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 border border-white/10 overflow-hidden shadow-2xl rounded-3xl p-10 text-center relative">
                
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-fuchsia-500/20 blur-3xl rounded-full pointer-events-none"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl font-black text-white mb-2">{{ $room->title }}</h2>
                    <p class="text-indigo-300 font-mono text-xl mb-12 border border-indigo-500/30 bg-indigo-900/30 inline-block px-4 py-2 rounded-lg">KODE: {{ $room->code }}</p>

                    @if(auth()->id() === $room->user_id)
                        <div class="mb-10 p-6 bg-fuchsia-900/30 border border-fuchsia-500/50 rounded-2xl shadow-inner">
                            <h3 class="text-xl font-bold text-white mb-2">👑 Anda adalah Ketua Room!</h3>
                            <p class="text-fuchsia-200 mb-6 text-sm">Anda memegang kendali atas ruangan ini. Ingin ikut bermain atau hanya memantau?</p>
                            <div class="flex flex-wrap justify-center gap-4">
                                <a href="{{ route('rooms.monitor', $room->id) }}" target="_blank" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-all shadow-lg shadow-indigo-500/30 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    Buka Layar Monitor
                                </a>
                                <form action="{{ route('rooms.start', $room->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-6 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-bold transition-all shadow-lg shadow-green-500/30 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Mulai Permainan
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="w-16 h-16 mx-auto border-4 border-fuchsia-500 border-t-transparent rounded-full animate-spin mb-6"></div>
                        
                        <h3 class="text-2xl font-bold text-white mb-2">Menunggu Ketua Room Memulai...</h3>
                        <p class="text-gray-400 mb-10">Kamu sudah berhasil masuk ke ruang tunggu. Permainan akan otomatis dimulai saat Ketua Room menekan tombol mulai.</p>
                    @endif

                    <!-- Daftar Pemain -->
                    <div class="text-left bg-gray-800/50 rounded-2xl p-6 border border-gray-700">
                        <h4 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Pemain yang Bergabung (<span x-text="participants.length"></span>)
                        </h4>
                        
                        <div class="flex flex-wrap gap-3">
                            <template x-for="p in participants" :key="p.id">
                                <div class="bg-gray-700/50 border border-gray-600 px-4 py-2 rounded-lg flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xs">
                                        <span x-text="p.name.substring(0, 1)"></span>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-center">
                                            <span class="text-gray-200 font-bold text-sm" x-text="p.name"></span>
                                            <template x-if="p.room_streak >= 4">
                                                <span class="inline-flex items-center justify-center text-yellow-400 text-lg ml-2 drop-shadow-[0_0_8px_rgba(250,204,21,0.8)]" title="Mahkota (Juara Bertahan)">👑</span>
                                            </template>
                                            <template x-if="p.room_streak == 3">
                                                <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 3">⭐⭐⭐</span>
                                            </template>
                                            <template x-if="p.room_streak == 2">
                                                <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 2">⭐⭐</span>
                                            </template>
                                            <template x-if="p.room_streak == 1">
                                                <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 1">⭐</span>
                                            </template>
                                        </div>
                                        <div class="text-xs text-gray-400 flex items-center mt-0.5">
                                            <svg class="w-3 h-3 text-yellow-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                            Rank Global: <span class="font-mono text-yellow-400 ml-1" x-text="p.global_rank !== '-' ? '#' + p.global_rank : 'Unranked'"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="participants.length === 0" class="text-gray-500 text-sm italic">Belum ada peserta yang memuat...</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function lobbyRoom() {
            return {
                participants: [],
                init() {
                    this.fetchStatus();
                    setInterval(() => {
                        this.fetchStatus();
                    }, 3000);
                },
                fetchStatus() {
                    fetch('{{ route('rooms.status', $room->id) }}')
                        .then(res => res.json())
                        .then(data => {
                            this.participants = data.participants;
                            if (data.status === 'playing') {
                                window.location.href = '{{ route('rooms.play', $room->id) }}';
                            }
                        });
                }
            }
        }
    </script>
</x-app-layout>

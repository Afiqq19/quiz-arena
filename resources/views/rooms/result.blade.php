<x-app-layout>
    <!-- Confetti Script (hanya jalan jika Rank 1) -->
    @if($rank == 1)
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script>
        window.onload = function() {
            var duration = 3 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 100 };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function() {
                var timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                var particleCount = 50 * (timeLeft / duration);
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);
        };
    </script>
    @endif

    <div class="py-12" x-data="resultPolling()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-700/50 mb-6">
                <!-- Header Peringkat Pribadi -->
                <div class="p-8 text-center relative transition-colors duration-500"
                    :class="myRank === 1 ? 'bg-gradient-to-br from-yellow-500 to-amber-700 text-white' : 'bg-gradient-to-br from-fuchsia-600 to-indigo-800 text-white'">
                    
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-30 mix-blend-overlay"></div>

                    <div class="relative z-10">
                        <template x-if="myRank === 1">
                            <div>
                                <h3 class="text-4xl font-black mb-2 drop-shadow-md">🏆 LUAR BIASA! JUARA 1! 🏆</h3>
                                <p class="text-yellow-100 font-medium mb-8 text-lg">Kamu berhasil mengalahkan semua peserta!</p>
                            </div>
                        </template>
                        <template x-if="myRank !== 1">
                            <div>
                                <h3 class="text-3xl font-bold mb-2">Permainan Selesai!</h3>
                                <p class="text-indigo-200 mb-8 font-medium">Kerja bagus! Terus berlatih untuk menjadi yang terbaik.</p>
                            </div>
                        </template>
                        
                        <div class="flex justify-center gap-8 mb-6">
                            <!-- Skor Kamu -->
                            <div class="bg-gray-900/40 backdrop-blur-md border border-white/20 rounded-3xl p-6 shadow-xl min-w-[150px] transform hover:scale-105 transition-transform">
                                <p class="text-sm font-bold text-white/70 uppercase tracking-widest mb-2">Skor Kamu</p>
                                <p class="text-5xl font-black text-white drop-shadow-lg" x-text="myScore"></p>
                            </div>
                            
                            <!-- Peringkat Kamu -->
                            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 shadow-xl min-w-[150px] transform hover:scale-105 transition-transform">
                                <p class="text-sm font-bold text-white/70 uppercase tracking-widest mb-2">Peringkat</p>
                                <p class="text-5xl font-black text-white drop-shadow-lg" x-text="'#' + myRank"></p>
                            </div>
                        </div>

                        <template x-if="roomStatus !== 'finished'">
                            <p class="text-sm text-white/70 mt-4 italic flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Peringkat masih bisa berubah hingga Ketua menutup Room.
                            </p>
                        </template>
                        <template x-if="roomStatus === 'finished'">
                            <p class="text-sm text-white/90 mt-4 font-bold bg-black/20 inline-block px-4 py-1.5 rounded-full">
                                Permainan telah ditutup. Hasil sudah final!
                            </p>
                        </template>
                    </div>
                </div>
                
                <!-- Papan Peringkat Room (Semua Peserta) -->
                <div class="p-8 bg-gray-900 relative">
                    <h4 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Klasemen Akhir Pemain
                    </h4>

                    <div class="space-y-3">
                        <template x-for="(p, idx) in sortedParticipants" :key="p.id">
                            <div class="flex items-center justify-between p-4 rounded-xl transition-all hover:bg-gray-700"
                                :class="p.id === myId ? 'bg-fuchsia-900/40 border border-fuchsia-500/50' : 'bg-gray-800 border border-gray-700/50'">
                                
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg"
                                        :class="idx === 0 ? 'bg-yellow-400 text-yellow-900 shadow-[0_0_10px_rgba(250,204,21,0.5)]' : 
                                               (idx === 1 ? 'bg-gray-300 text-gray-800' : 
                                               (idx === 2 ? 'bg-amber-600 text-amber-100' : 'bg-gray-700 text-gray-400'))" x-text="'#' + (idx + 1)">
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-200 text-lg flex items-center gap-2">
                                            <span x-text="p.name"></span>
                                            <template x-if="p.id === myId">
                                                <span class="text-xs font-semibold bg-fuchsia-500/20 text-fuchsia-400 px-2 py-0.5 rounded">Kamu</span>
                                            </template>
                                            <template x-if="p.room_streak >= 4">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-yellow-500 text-white rounded-full shadow-[0_0_10px_rgba(234,179,8,0.8)] text-xs" title="Veteran Room">👑</span>
                                            </template>
                                            <template x-if="p.room_streak >= 1 && p.room_streak < 4">
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-500 text-white rounded-full shadow-[0_0_10px_rgba(59,130,246,0.8)] text-xs" title="Pemain Aktif">⭐</span>
                                            </template>
                                        </p>
                                        <div class="text-sm text-gray-400 flex items-center gap-2 mt-1">
                                            <template x-if="p.status === 'finished'">
                                                <span class="text-emerald-400 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Selesai</span>
                                            </template>
                                            <template x-if="p.status !== 'finished'">
                                                <span class="text-amber-400 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Mengerjakan...</span>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-indigo-400" x-text="p.score"></p>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">Poin</p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mt-10 text-center border-t border-gray-800 pt-8">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-3 bg-gray-800 hover:bg-gray-700 border border-gray-600 rounded-xl font-bold text-sm text-white uppercase tracking-widest transition-all shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('resultPolling', () => ({
                    roomId: '{{ $room->id }}',
                    myId: {{ $participant->id }},
                    roomStatus: '{{ $room->status }}',
                    participants: @json($allParticipants->map(function($p) {
                        return [
                            'id' => $p->id,
                            'name' => $p->user_id ? $p->user->name : $p->guest_name . ' (Guest)',
                            'status' => $p->status,
                            'score' => $p->score,
                            'room_streak' => $p->user_id ? $p->user->room_streak : 0
                        ];
                    })),
                    pollInterval: null,
                    
                    init() {
                        this.pollInterval = setInterval(() => {
                            if (this.roomStatus === 'finished') {
                                clearInterval(this.pollInterval);
                                return;
                            }
                            this.fetchStatus();
                        }, 2000);
                    },
                    
                    get sortedParticipants() {
                        return this.participants.sort((a, b) => b.score - a.score);
                    },
                    
                    get myRank() {
                        let rank = 1;
                        for (let p of this.sortedParticipants) {
                            if (p.id === this.myId) return rank;
                            rank++;
                        }
                        return rank;
                    },
                    
                    get myScore() {
                        let me = this.participants.find(p => p.id === this.myId);
                        return me ? me.score : 0;
                    },

                    async fetchStatus() {
                        try {
                            let res = await fetch(`/room/${this.roomId}/status`);
                            let data = await res.json();
                            this.roomStatus = data.status;
                            this.participants = data.participants;
                            
                            // Triggers UI reactivity automatically
                        } catch(e) {
                            console.error('Failed to poll status', e);
                        }
                    }
                }));
            });
        </script>
    </div>
</x-app-layout>

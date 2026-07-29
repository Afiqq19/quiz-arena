<x-app-layout>
    <div class="min-h-[85vh] py-12 flex flex-col items-center justify-center relative overflow-hidden" x-data="lobbyRoom()">
        
        <!-- Animated Background Effects -->
        <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] rounded-full bg-fuchsia-600/20 blur-[120px] animate-pulse pointer-events-none"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[50%] h-[50%] rounded-full bg-blue-600/20 blur-[120px] animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>
        
        <div class="max-w-4xl w-full mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="bg-gray-900/60 backdrop-blur-3xl border border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.5)] rounded-3xl p-10 text-center relative overflow-hidden">
                
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 mix-blend-overlay"></div>

                <div class="relative z-10">
                    <h2 class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-cyan-400 mb-4">{{ $room->title }}</h2>
                    
                    <div class="inline-flex flex-col items-center justify-center mb-8">
                        <span class="text-gray-400 text-sm font-bold uppercase tracking-widest mb-3">Kode Akses Ruangan</span>
                        <div class="relative group cursor-pointer" onclick="navigator.clipboard.writeText('{{ $room->code }}'); alert('Kode disalin!')">
                            <div class="absolute -inset-1 bg-gradient-to-r from-fuchsia-600 to-blue-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500 group-hover:duration-200"></div>
                            <div class="relative bg-gray-900 border border-white/10 px-8 py-4 rounded-xl flex items-center gap-5">
                                <span class="text-5xl font-mono font-black tracking-[0.2em] text-white">{{ $room->code }}</span>
                                <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                    </div>

                    @if(auth()->id() === $room->user_id)
                        <!-- Ketua Room View -->
                        <div class="mb-12 p-8 bg-gradient-to-br from-fuchsia-900/40 to-blue-900/40 border border-fuchsia-500/30 rounded-3xl shadow-2xl backdrop-blur-sm relative overflow-hidden group">
                            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-32 h-32 text-fuchsia-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2l1.6 4.8H17l-4.2 3.2 1.6 4.8-4.4-3.2-4.4 3.2 1.6-4.8L3 6.8h5.4L10 2z" clip-rule="evenodd"></path></svg>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-white mb-3 flex items-center justify-center gap-3">
                                <span class="text-3xl">👑</span> Anda adalah Ketua Room!
                            </h3>
                            <p class="text-indigo-200 mb-8 text-base">Anda memegang kendali atas ruangan ini. Ingin ikut bermain atau hanya memantau jalannya pertandingan?</p>
                            
                            <div class="flex flex-col sm:flex-row justify-center gap-5 relative z-10">
                                <a href="{{ route('rooms.monitor', $room->id) }}" target="_blank" class="px-8 py-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold transition-all flex items-center justify-center gap-3 group/btn">
                                    <svg class="w-6 h-6 text-indigo-400 group-hover/btn:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    Buka Layar Monitor
                                </a>
                                <form action="{{ route('rooms.start', $room->id) }}" method="POST" class="inline w-full sm:w-auto">
                                    @csrf
                                    <button type="submit" class="w-full px-8 py-4 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-400 hover:to-emerald-500 text-white font-black text-lg transition-all shadow-[0_0_20px_rgba(16,185,129,0.4)] hover:shadow-[0_0_30px_rgba(16,185,129,0.6)] hover:scale-105 active:scale-95 flex items-center justify-center gap-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        MULAI PERMAINAN
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Player Waiting View -->
                        <div class="mb-8 flex flex-col items-center mt-2">
                            <div class="relative w-24 h-24 mb-6 flex items-center justify-center">
                                <div class="absolute inset-0 border-4 border-fuchsia-500/30 rounded-full"></div>
                                <div class="absolute inset-0 border-4 border-fuchsia-400 border-t-transparent rounded-full animate-spin"></div>
                                <div class="absolute inset-2 border-4 border-cyan-500/30 rounded-full"></div>
                                <div class="absolute inset-2 border-4 border-cyan-400 border-b-transparent rounded-full animate-[spin_1.5s_linear_reverse_infinite]"></div>
                                <svg class="w-8 h-8 text-fuchsia-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            
                            <h3 class="text-2xl sm:text-3xl font-black text-white mb-2 tracking-tight">Menunggu Ketua Room Memulai...</h3>
                            <p class="text-gray-400 max-w-lg mx-auto text-sm sm:text-base">Kamu sudah berhasil masuk ke ruang tunggu. Siapkan dirimu, permainan akan otomatis dimulai saat Ketua menekan tombol mulai.</p>
                        </div>
                    @endif

                    <!-- Daftar Pemain -->
                    <div class="text-left bg-black/40 backdrop-blur-xl rounded-3xl p-8 border border-white/5 shadow-inner">
                        <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4">
                            <h4 class="text-xl font-bold text-white flex items-center gap-3">
                                <div class="p-2.5 bg-fuchsia-500/20 rounded-xl text-fuchsia-400 border border-fuchsia-500/30">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                Pemain yang Bergabung
                            </h4>
                            <div class="px-5 py-2 bg-white/10 rounded-full border border-white/10 text-white font-bold flex items-center gap-2.5 shadow-sm">
                                <span class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,1)]"></span>
                                <span x-text="participants.length"></span> Pemain
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <template x-for="p in participants" :key="p.id">
                                <div class="bg-white/5 hover:bg-white/10 border border-white/10 px-5 py-4 rounded-2xl flex items-center gap-4 transition-all hover:-translate-y-1 hover:shadow-lg hover:shadow-fuchsia-500/20">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-fuchsia-500 flex items-center justify-center text-white font-black text-xl shadow-lg border border-white/20 flex-shrink-0">
                                        <span x-text="p.name.substring(0, 1).toUpperCase()"></span>
                                    </div>
                                    <div class="flex flex-col flex-1 min-w-0">
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-white font-bold truncate text-base" x-text="p.name"></span>
                                            <template x-if="p.room_streak >= 4">
                                                <span class="inline-flex flex-shrink-0 text-xl drop-shadow-[0_0_8px_rgba(250,204,21,0.8)]" title="Mahkota (Juara Bertahan)">👑</span>
                                            </template>
                                            <template x-if="p.room_streak > 0 && p.room_streak < 4">
                                                <div class="flex -space-x-1 flex-shrink-0">
                                                    <template x-for="i in p.room_streak">
                                                        <svg class="w-4 h-4 text-yellow-400 drop-shadow-[0_0_4px_rgba(250,204,21,0.5)]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="text-[11px] font-medium text-gray-400 flex items-center mt-1 bg-black/40 w-fit px-2 py-0.5 rounded border border-white/5">
                                            <svg class="w-3 h-3 text-yellow-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                            Global Rank: <span class="font-bold text-yellow-400 ml-1" x-text="p.global_rank !== '-' ? '#' + p.global_rank : 'Unranked'"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            
                            <!-- Placeholder Loading -->
                            <div x-show="participants.length === 0" class="col-span-full py-12 flex flex-col items-center justify-center text-gray-500">
                                <div class="w-12 h-12 mb-4 border-4 border-gray-700 border-t-gray-500 rounded-full animate-spin"></div>
                                <span class="font-medium">Belum ada pemain yang masuk...</span>
                            </div>
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

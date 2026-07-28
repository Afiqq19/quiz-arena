<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-indigo-400 leading-tight">
            {{ __('Histori Kuis Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- HISTORI MISI SOAL (SOLO) -->
            <div class="bg-indigo-900/40 backdrop-blur-xl overflow-hidden rounded-2xl border border-white/10 shadow-[0_0_40px_rgba(79,70,229,0.15)] transition-all hover:shadow-[0_0_50px_rgba(79,70,229,0.25)] mt-10">
                <div class="p-8 border-b border-white/10 relative overflow-hidden">
                    <!-- Decor -->
                    <div class="absolute -top-24 -left-24 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl"></div>

                    <div class="mb-8 flex justify-between items-center relative z-10">
                        <h3 class="text-2xl font-black text-white flex items-center gap-3 tracking-wide">
                            <span class="text-3xl drop-shadow-[0_0_10px_rgba(99,102,241,0.8)]">👤</span> 
                            Riwayat Misi Soal (Individu)
                        </h3>
                    </div>

                    @if($attempts->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-white/5 shadow-2xl">
                            <table class="min-w-full divide-y divide-white/10">
                                <thead class="bg-black/20">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-indigo-300 uppercase tracking-widest">Tanggal</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-indigo-300 uppercase tracking-widest">Judul Kuis</th>
                                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-indigo-300 uppercase tracking-widest">Total Soal</th>
                                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-indigo-300 uppercase tracking-widest">Skor</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-indigo-300 uppercase tracking-widest">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 bg-black/10">
                                    @foreach($attempts as $attempt)
                                        <tr class="hover:bg-white/5 transition duration-300 ease-in-out group">
                                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-300 font-medium">
                                                {{ $attempt->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-base font-bold text-white group-hover:text-indigo-200 transition-colors flex items-center gap-3">
                                                    <span>{{ optional($attempt->quiz)->title ?? 'Kuis Telah Dihapus' }}</span>
                                                    @if($attempt->is_practice)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-yellow-500/20 text-yellow-300 border border-yellow-500/50 shadow-[0_0_8px_rgba(234,179,8,0.3)]">
                                                            Latihan
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-center text-sm font-bold text-gray-300">
                                                {{ $attempt->total_questions }}
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                                <span class="px-4 py-1.5 inline-flex text-sm font-black rounded-full shadow-lg {{ $attempt->score > 50 ? 'bg-green-500/20 text-green-300 border border-green-500/50 shadow-green-500/20' : 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/50 shadow-yellow-500/20' }}">
                                                    {{ $attempt->score }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('quiz.result', $attempt->id) }}" class="inline-flex items-center justify-center text-indigo-200 hover:text-white font-bold border border-indigo-400/50 px-4 py-2 rounded-lg hover:bg-indigo-500 hover:border-transparent transition-all shadow-[0_0_10px_rgba(99,102,241,0.2)] hover:shadow-[0_0_20px_rgba(99,102,241,0.5)]">
                                                    Lihat Hasil &rarr;
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-12 text-center bg-black/20 rounded-xl border border-white/5">
                            <div class="text-5xl mb-4 opacity-50">📭</div>
                            <p class="text-gray-400 text-lg">Kamu belum pernah mengerjakan kuis di Mode Individu.</p>
                        </div>
                    @endif
                </div>
            </div>

<!-- HISTORI ROOM -->
            <div class="bg-indigo-900/40 backdrop-blur-xl overflow-hidden rounded-2xl border border-white/10 shadow-[0_0_40px_rgba(79,70,229,0.15)] transition-all hover:shadow-[0_0_50px_rgba(79,70,229,0.25)]">
                <div class="p-8 border-b border-white/10 relative overflow-hidden">
                    <!-- Decor -->
                    <div class="absolute -top-24 -right-24 w-48 h-48 bg-fuchsia-500/20 rounded-full blur-3xl"></div>
                    
                    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center relative z-10">
                        <h3 class="text-2xl font-black text-white flex items-center gap-3 tracking-wide">
                            <span class="text-3xl drop-shadow-[0_0_10px_rgba(217,70,239,0.8)]">🏫</span> 
                            Riwayat Kuis Room
                        </h3>
                        <a href="{{ route('dashboard') }}" class="mt-4 sm:mt-0 text-fuchsia-300 hover:text-fuchsia-100 font-semibold text-sm transition-all hover:translate-x-1 flex items-center gap-2">
                            &larr; Kembali ke Dashboard
                        </a>
                    </div>

                    @if(isset($roomParticipants) && $roomParticipants->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-white/5 shadow-2xl">
                            <table class="min-w-full divide-y divide-white/10">
                                <thead class="bg-black/20">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-fuchsia-300 uppercase tracking-widest">Tanggal</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-fuchsia-300 uppercase tracking-widest">Nama Kuis / Kode Room</th>
                                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-fuchsia-300 uppercase tracking-widest">Skor Saya</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-fuchsia-300 uppercase tracking-widest">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 bg-black/10">
                                    @foreach($roomParticipants as $participant)
                                        <tr class="hover:bg-white/5 transition duration-300 ease-in-out group">
                                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-300 font-medium">
                                                {{ $participant->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-base font-bold text-white group-hover:text-fuchsia-200 transition-colors">
                                                    {{ optional($participant->room)->title ?? 'Room Tidak Diketahui' }}
                                                </div>
                                                <div class="text-xs text-gray-400 mt-1 flex items-center gap-2">
                                                    Kode: <span class="font-mono font-bold px-2 py-0.5 bg-fuchsia-500/20 text-fuchsia-300 rounded border border-fuchsia-500/30">{{ optional($participant->room)->code }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                                <span class="px-4 py-1.5 inline-flex text-sm font-black rounded-full shadow-lg {{ $participant->score > 50 ? 'bg-green-500/20 text-green-300 border border-green-500/50 shadow-green-500/20' : 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/50 shadow-yellow-500/20' }}">
                                                    {{ $participant->score }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('rooms.result', $participant->room_id) }}" class="inline-flex items-center justify-center text-fuchsia-200 hover:text-white font-bold border border-fuchsia-400/50 px-4 py-2 rounded-lg hover:bg-fuchsia-500 hover:border-transparent transition-all shadow-[0_0_10px_rgba(217,70,239,0.2)] hover:shadow-[0_0_20px_rgba(217,70,239,0.5)]">
                                                    Peringkat Room &rarr;
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-12 text-center bg-black/20 rounded-xl border border-white/5">
                            <div class="text-5xl mb-4 opacity-50">🏚️</div>
                            <p class="text-gray-400 text-lg">Kamu belum pernah menyelesaikan kuis di Room.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ROOM YANG SAYA BUAT -->
            <div class="bg-indigo-900/40 backdrop-blur-xl overflow-hidden rounded-2xl border border-white/10 shadow-[0_0_40px_rgba(79,70,229,0.15)] transition-all hover:shadow-[0_0_50px_rgba(79,70,229,0.25)] mt-10">
                <div class="p-8 border-b border-white/10 relative overflow-hidden">
                    <!-- Decor -->
                    <div class="absolute -top-24 -right-24 w-48 h-48 bg-fuchsia-500/20 rounded-full blur-3xl"></div>

                    <div class="mb-8 flex justify-between items-center relative z-10">
                        <h3 class="text-2xl font-black text-white flex items-center gap-3 tracking-wide">
                            <span class="text-3xl drop-shadow-[0_0_10px_rgba(217,70,239,0.8)]">👑</span> 
                            Room Multiplayer yang Saya Buat
                        </h3>
                    </div>

                    @if(isset($ownedRooms) && $ownedRooms->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-white/5 shadow-2xl">
                            <table class="min-w-full divide-y divide-white/10">
                                <thead class="bg-black/20">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-fuchsia-300 uppercase tracking-widest">Tanggal Dibuat</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-fuchsia-300 uppercase tracking-widest">Nama Room</th>
                                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-fuchsia-300 uppercase tracking-widest">Status</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-fuchsia-300 uppercase tracking-widest">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 bg-black/10">
                                    @foreach($ownedRooms as $room)
                                        <tr class="hover:bg-white/5 transition duration-300 ease-in-out group">
                                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-300 font-medium">
                                                {{ $room->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-base font-bold text-white group-hover:text-fuchsia-200 transition-colors flex items-center gap-3">
                                                    <span>{{ $room->title }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                                @if($room->status === 'waiting')
                                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-yellow-500/20 text-yellow-300 border border-yellow-500/50">Menunggu</span>
                                                @elseif($room->status === 'playing')
                                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-blue-500/20 text-blue-300 border border-blue-500/50">Bermain</span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-500/20 text-green-300 border border-green-500/50">Selesai</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('rooms.monitor', $room->id) }}" class="inline-flex items-center justify-center text-fuchsia-200 hover:text-white font-bold border border-fuchsia-400/50 px-4 py-2 rounded-lg hover:bg-fuchsia-500 hover:border-transparent transition-all shadow-[0_0_10px_rgba(217,70,239,0.2)] hover:shadow-[0_0_20px_rgba(217,70,239,0.5)]">
                                                    Pantau / Hasil &rarr;
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-12 text-center bg-black/20 rounded-xl border border-white/5">
                            <div class="text-5xl mb-4 opacity-50">🎮</div>
                            <p class="text-gray-400 text-lg">Kamu belum pernah membuat Room Multiplayer.</p>
                        </div>
                    @endif
                </div>
            </div>

                    </div>
    </div>
</x-app-layout>

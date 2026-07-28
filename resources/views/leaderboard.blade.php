<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Papan Peringkat Global') }}
        </h2>
    </x-slot>

    <div class="py-12 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-fuchsia-600/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-black text-white mb-4">Papan Peringkat <span class="bg-clip-text text-transparent bg-gradient-to-r from-fuchsia-400 to-blue-400">Global</span></h1>
                <p class="text-lg text-gray-300">Siapa yang pantas menyandang gelar juara kuis sejati?</p>
            </div>

            <div class="bg-gray-900/80 rounded-[22px] p-1 shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-500/20 to-blue-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="bg-gray-900 rounded-[20px] p-6 md:p-10 backdrop-blur-xl relative z-10 border border-gray-700/50">
                    
                    <div class="space-y-4">
                        @forelse($leaderboard as $index => $row)
                            <div class="flex items-center justify-between p-4 md:p-6 rounded-2xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                                <div class="flex items-center gap-6">
                                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center font-black text-2xl md:text-3xl shadow-inner
                                        {{ $index == 0 ? 'bg-gradient-to-br from-yellow-300 to-yellow-600 text-yellow-900 shadow-yellow-500/50 scale-110' : 
                                          ($index == 1 ? 'bg-gradient-to-br from-gray-300 to-gray-500 text-gray-900 shadow-gray-500/50' : 
                                          ($index == 2 ? 'bg-gradient-to-br from-amber-600 to-amber-800 text-amber-100 shadow-amber-700/50' : 'bg-white/10 text-white')) }}">
                                        #{{ $index + 1 }}
                                    </div>
                                    <div>
                                        <p class="font-black text-xl md:text-2xl text-gray-100">{{ $row->user->name }}</p>
                                        <p class="text-sm md:text-base text-gray-400 mt-1">
                                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                            {{ $row->quizzes_taken }} Kuis Selesai
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-black text-3xl md:text-4xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-blue-400">
                                        {{ number_format($row->total_score) }}
                                    </div>
                                    <div class="text-xs md:text-sm uppercase tracking-widest text-gray-500 font-bold mt-1">Total Skor</div>
                                </div>
                            </div>
                        @empty
                            <div class="py-20 text-center text-gray-400 flex flex-col items-center">
                                <svg class="w-20 h-20 mb-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <p class="text-2xl font-bold mb-2">Papan Peringkat Kosong</p>
                                <p class="text-gray-500">Belum ada skor yang tercatat. Mari jadi sang legenda pertama!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

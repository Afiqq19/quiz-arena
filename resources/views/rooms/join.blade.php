<x-app-layout>
    <div class="py-20">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 border border-white/10 overflow-hidden shadow-2xl rounded-3xl p-10 text-center relative">
                
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-fuchsia-500/20 blur-3xl rounded-full pointer-events-none"></div>
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-500/20 blur-3xl rounded-full pointer-events-none"></div>

                <div class="relative z-10">
                    <svg class="w-16 h-16 mx-auto text-fuchsia-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    
                    <h2 class="text-3xl font-black text-white mb-2">Masuk Room</h2>
                    <p class="text-gray-400 mb-8">Masukkan kode ruangan yang diberikan oleh guru untuk bergabung ke dalam permainan multiplayer.</p>

                    @if(session('error'))
                        <div class="bg-red-900/30 border border-red-500/30 text-red-400 p-3 rounded-lg mb-6 text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('rooms.join') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <input type="text" name="code" required 
                                class="w-full bg-black/50 border border-gray-700 rounded-xl px-4 py-4 text-center text-3xl font-mono text-white tracking-[0.5em] focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent placeholder-gray-600 transition-all uppercase" 
                                placeholder="XXXXXX" 
                                maxlength="6">
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 shadow-lg shadow-fuchsia-500/25 text-white font-bold py-4 px-6 rounded-xl transition-all transform active:scale-95 text-lg">
                            Gabung Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

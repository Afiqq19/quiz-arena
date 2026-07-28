<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-black text-white mb-2">Satu Langkah Lagi!</h2>
        <p class="text-gray-400 text-sm">Masukkan nama panggilan kamu untuk bergabung ke room <span class="font-bold text-fuchsia-400">{{ $code }}</span>.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    @if(session('error'))
        <div class="mb-4 text-sm font-medium text-red-500 text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('rooms.join') }}">
        @csrf
        <input type="hidden" name="code" value="{{ $code }}">

        <!-- Guest Name -->
        <div>
            <x-input-label for="guest_name" value="Nama Panggilan" />
            <x-text-input id="guest_name" class="block mt-1 w-full text-center font-bold text-lg" type="text" name="guest_name" :value="old('guest_name')" required autofocus autocomplete="off" placeholder="Contoh: Budi" />
            <x-input-error :messages="$errors->get('guest_name')" class="mt-2" />
        </div>

        <div class="mt-8 mb-4">
            <button type="submit" class="w-full bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-fuchsia-500/30 transition-all transform hover:scale-105">
                Mulai Bermain!
            </button>
        </div>

        <!-- Back Button -->
        <div class="mt-6 text-center border-t border-white/10 pt-4">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>
    </form>
</x-guest-layout>

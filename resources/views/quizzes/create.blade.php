<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition-colors bg-gray-800 hover:bg-gray-700 p-2 rounded-xl border border-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                {{ __('Tambah Kuis Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800">
                <div class="p-8">
                    <!-- Info Alur -->
                    <div class="mb-8 bg-fuchsia-500/10 border border-fuchsia-500/30 text-fuchsia-300 px-5 py-4 rounded-xl flex items-start gap-3" role="alert">
                        <svg class="w-6 h-6 text-fuchsia-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <span class="block font-bold text-white text-lg mb-1">📋 Langkah Membuat Kuis</span>
                            <span class="block text-sm opacity-90"><strong>Langkah 1:</strong> Isi judul, kategori & deskripsi kuis di bawah ini, lalu klik <strong>"Simpan Kuis"</strong>.</span>
                            <span class="block text-sm opacity-90 mt-1"><strong>Langkah 2:</strong> Anda akan diarahkan ke halaman edit untuk <strong>menambahkan soal</strong> (minimal 10 soal).</span>
                            <span class="block text-sm opacity-90 mt-1">💾 <strong>Setiap soal langsung tersimpan otomatis</strong> ke server — jadi meski laptop mati atau jaringan putus, soal yang sudah disimpan tetap aman!</span>
                        </div>
                    </div>

                    <form action="{{ route('quizzes.store') }}" method="POST" x-data="{ isSubmitting: false }" @submit="if(isSubmitting) { $event.preventDefault(); return; } isSubmitting = true;">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-bold text-gray-300 mb-2">Judul Kuis</label>
                            <input type="text" name="title" id="title" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" required placeholder="Contoh: Kuis Sejarah Nasional">
                        </div>

                        <div class="mb-6" x-data="{ 
                            selectedCategory: '',
                            isOther: false,
                            init() {
                                this.$watch('selectedCategory', value => {
                                    this.isOther = value === 'other';
                                });
                            }
                        }">
                            <label for="category_select" class="block text-sm font-bold text-gray-300 mb-2">Kategori</label>
                            
                            <select id="category_select" x-model="selectedCategory" :name="isOther ? '' : 'category'" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all appearance-none">
                                <option value="" class="bg-gray-800 text-gray-400">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" class="bg-gray-800 text-white">{{ $cat }}</option>
                                @endforeach
                                <option value="other" class="bg-gray-800 text-white">Lainnya</option>
                            </select>
                            
                            <div x-show="isOther" x-cloak class="mt-4" x-transition>
                                <input type="text" x-bind:name="isOther ? 'category' : ''" placeholder="Ketik kategori baru di sini..." class="w-full bg-gray-800 border border-fuchsia-500/50 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all shadow-[0_0_15px_rgba(217,70,239,0.1)]">
                            </div>
                        </div>

                        <div class="mb-8">
                            <label for="description" class="block text-sm font-bold text-gray-300 mb-2">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" placeholder="Jelaskan secara singkat tentang kuis ini..."></textarea>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800">
                            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl font-bold text-gray-400 hover:text-white hover:bg-gray-800 transition-all">Batal</a>
                            <button type="submit" x-bind:disabled="isSubmitting" x-bind:class="{ 'opacity-50 cursor-not-allowed': isSubmitting }" class="px-6 py-3 rounded-xl bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500 text-white font-bold shadow-lg shadow-fuchsia-500/30 transition-all">
                                <span x-show="!isSubmitting">Simpan Kuis</span>
                                <span x-show="isSubmitting" x-cloak>Menyimpan...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

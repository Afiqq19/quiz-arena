<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center gap-3">
                <a href="{{ auth()->user()->role === 'admin' ? route('quizzes.index') : route('dashboard') }}" class="text-gray-400 hover:text-white transition-colors bg-gray-800 hover:bg-gray-700 p-2 rounded-xl border border-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                {{ __('Edit Kuis') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl relative flex items-center gap-3 shadow-lg shadow-green-500/10" role="alert">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800">
                <div class="p-8">
                    <form action="{{ route('quizzes.update', $quiz) }}" method="POST" x-data="{ isSubmitting: false }" @submit="if(isSubmitting) { $event.preventDefault(); return; } isSubmitting = true;">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-bold text-gray-300 mb-2">Judul Kuis</label>
                            <input type="text" name="title" id="title" value="{{ $quiz->title }}" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all" required>
                        </div>

                        <div class="mb-6" x-data="{ 
                            selectedCategory: '{{ in_array($quiz->category, $categories->toArray()) ? $quiz->category : ($quiz->category ? 'other' : '') }}',
                            isOther: false,
                            init() {
                                this.isOther = this.selectedCategory === 'other';
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
                                <input type="text" x-bind:name="isOther ? 'category' : ''" value="{{ !in_array($quiz->category, $categories->toArray()) ? $quiz->category : '' }}" placeholder="Ketik kategori baru di sini..." class="w-full bg-gray-800 border border-fuchsia-500/50 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all shadow-[0_0_15px_rgba(217,70,239,0.1)]">
                            </div>
                        </div>

                        <div class="mb-8">
                            <label for="description" class="block text-sm font-bold text-gray-300 mb-2">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all">{{ $quiz->description }}</textarea>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-800">
                            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl font-bold text-gray-400 hover:text-white hover:bg-gray-800 transition-all">Batal</a>
                            @if($quiz->status !== 'approved' || auth()->user()->role === 'admin')
                                <button type="submit" x-bind:disabled="isSubmitting" x-bind:class="{ 'opacity-50 cursor-not-allowed': isSubmitting }" class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold shadow-lg shadow-blue-500/30 transition-all">
                                    <span x-show="!isSubmitting">Simpan Perubahan</span>
                                    <span x-show="isSubmitting" x-cloak>Menyimpan...</span>
                                </button>
                            @else
                                <span class="text-gray-400 text-sm font-bold bg-gray-800 px-4 py-2 rounded-lg">Kuis sudah dirilis. Tidak dapat diubah.</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Daftar Soal -->
            <div class="mt-8 bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800">
                <div class="p-8 border-b border-gray-800">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-bold text-xl text-white">Daftar Soal ({{ $quiz->questions->count() }})</h3>
                        @if($quiz->status !== 'approved' || auth()->user()->role === 'admin')
                            <a href="{{ route('quizzes.questions.create', $quiz) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-green-400 hover:to-emerald-500 shadow-lg shadow-green-500/30 transition-all">
                                + Tambah Soal
                            </a>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        💾 Setiap soal <strong class="text-green-500">langsung tersimpan ke server</strong> saat diklik "Simpan Soal". Aman dari laptop mati / jaringan putus!
                    </p>
                </div>
                
                @if($quiz->questions->count() < 10)
                    <div class="m-6 bg-yellow-500/10 border border-yellow-500/50 text-yellow-400 px-6 py-4 rounded-xl relative flex items-start gap-3 shadow-lg shadow-yellow-500/5" role="alert">
                        <svg class="w-6 h-6 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <div>
                            <span class="block font-bold text-lg mb-1">Perhatian: Butuh Minimal 10 Soal</span>
                            <span class="block text-sm opacity-90">Saat ini kuis Anda baru memiliki <strong>{{ $quiz->questions->count() }} soal</strong>. Sistem mewajibkan setiap kuis memiliki minimal 10 soal agar dapat disetujui oleh Admin dan dirilis ke publik. Yuk, semangat tambah soal lagi!</span>
                        </div>
                    </div>
                @endif
                
                <div class="divide-y divide-gray-800">
                    @forelse($quiz->questions as $index => $question)
                        <div class="p-6 hover:bg-gray-800/30 transition-colors">
                            <div class="flex justify-between gap-4">
                                <div class="flex-grow">
                                    <h4 class="text-white font-bold mb-3 flex items-center gap-2">
                                        <span class="text-fuchsia-400 mr-1">{{ $index + 1 }}.</span> 
                                        {{ $question->question_text }}
                                        @if($question->question_type === 'essay')
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 uppercase">Esai</span>
                                        @else
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-fuchsia-500/20 text-fuchsia-400 border border-fuchsia-500/30 uppercase">PG</span>
                                        @endif
                                    </h4>
                                    @if($question->question_type === 'essay')
                                        <div class="p-3 rounded-lg border bg-cyan-500/10 border-cyan-500/30 text-cyan-400 font-bold text-sm flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Jawaban: {{ $question->essay_answer }}
                                        </div>
                                    @else
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                                            <div class="p-2 rounded-lg border {{ $question->correct_option === 'A' ? 'bg-green-500/10 border-green-500/50 text-green-400 font-bold' : 'bg-gray-800/50 border-gray-700 text-gray-400' }}">
                                                <span class="mr-2">A.</span> {{ $question->option_a }}
                                            </div>
                                            <div class="p-2 rounded-lg border {{ $question->correct_option === 'B' ? 'bg-green-500/10 border-green-500/50 text-green-400 font-bold' : 'bg-gray-800/50 border-gray-700 text-gray-400' }}">
                                                <span class="mr-2">B.</span> {{ $question->option_b }}
                                            </div>
                                            <div class="p-2 rounded-lg border {{ $question->correct_option === 'C' ? 'bg-green-500/10 border-green-500/50 text-green-400 font-bold' : 'bg-gray-800/50 border-gray-700 text-gray-400' }}">
                                                <span class="mr-2">C.</span> {{ $question->option_c }}
                                            </div>
                                            <div class="p-2 rounded-lg border {{ $question->correct_option === 'D' ? 'bg-green-500/10 border-green-500/50 text-green-400 font-bold' : 'bg-gray-800/50 border-gray-700 text-gray-400' }}">
                                                <span class="mr-2">D.</span> {{ $question->option_d }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col items-end gap-2 shrink-0">
                                    <span class="text-xs font-bold text-gray-500 bg-gray-800 px-2 py-1 rounded-md border border-gray-700">Waktu: {{ $question->timer_seconds ?? 30 }}s</span>
                                    <div class="flex gap-2 mt-auto">
                                        @if($quiz->status !== 'approved' || auth()->user()->role === 'admin')
                                            <a href="{{ route('quizzes.questions.edit', [$quiz, $question]) }}" class="text-blue-400 hover:text-blue-300 bg-blue-500/10 hover:bg-blue-500/20 px-3 py-1.5 rounded-lg transition-all border border-blue-500/20 text-xs font-bold flex items-center gap-1">
                                                Edit
                                            </a>
                                            <form action="{{ route('quizzes.questions.destroy', [$quiz, $question]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg transition-all border border-red-500/20 text-xs font-bold flex items-center gap-1">
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            @php
                                                $latestRevision = $question->revisions()->latest()->first();
                                            @endphp
                                            @if($latestRevision)
                                                @if($latestRevision->status === 'pending')
                                                    <span class="text-yellow-400 bg-yellow-500/10 px-3 py-1.5 rounded-lg border border-yellow-500/20 text-xs font-bold flex items-center gap-1" title="Menunggu Admin">
                                                        ⏳ Menunggu Persetujuan
                                                    </span>
                                                @elseif($latestRevision->status === 'rejected')
                                                    <span class="text-red-400 bg-red-500/10 px-3 py-1.5 rounded-lg border border-red-500/20 text-xs font-bold flex items-center gap-1" title="Usulan sebelumnya ditolak Admin">
                                                        ❌ Usulan Ditolak
                                                    </span>
                                                @elseif($latestRevision->status === 'approved')
                                                    <span class="text-green-400 bg-green-500/10 px-3 py-1.5 rounded-lg border border-green-500/20 text-xs font-bold flex items-center gap-1" title="Usulan sebelumnya telah disetujui">
                                                        ✅ Revisi Disetujui
                                                    </span>
                                                @endif
                                            @endif
                                            <a href="{{ route('quizzes.questions.edit', [$quiz, $question]) }}" class="text-yellow-400 hover:text-yellow-300 bg-yellow-500/10 hover:bg-yellow-500/20 px-3 py-1.5 rounded-lg transition-all border border-yellow-500/20 text-xs font-bold flex items-center gap-1">
                                                {{ $question->activeRevision ? 'Edit Usulan' : 'Ajukan Perbaikan' }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-4">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-1">Belum ada soal</h3>
                            <p class="text-gray-500 text-sm">Kuis ini belum memiliki soal. Tambahkan soal pertama sekarang!</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

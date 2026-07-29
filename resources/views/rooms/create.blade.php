<x-app-layout>
    <div class="py-12 relative min-h-screen bg-gray-900 overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-fuchsia-600/20 blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-cyan-600/20 blur-[100px] pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-8 px-4 sm:px-0">
                <h2 class="font-black text-3xl md:text-4xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-cyan-400 flex items-center gap-3">
                    <svg class="w-8 h-8 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Buat Room Baru
                </h2>
                <p class="text-gray-400 mt-2 text-sm sm:text-base">Sesuaikan pengaturan room, kumpulkan soal dari berbagai kategori kuis, dan bersiaplah untuk memulai permainan yang menegangkan!</p>
            </div>
            
            <div class="bg-gray-800/60 backdrop-blur-2xl border border-white/10 shadow-[0_0_40px_rgba(0,0,0,0.5)] rounded-3xl p-6 sm:p-10 mx-4 sm:mx-0">
                <form action="{{ route('rooms.store') }}" method="POST">
                    @csrf
                    
                    <!-- Judul Room -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-300 mb-2">Judul Ruangan (Room Title)</label>
                        <input type="text" name="title" required class="w-full bg-black/40 border border-gray-700 text-white rounded-xl shadow-inner focus:border-fuchsia-500 focus:ring-fuchsia-500 px-5 py-4 placeholder-gray-600 transition-colors" placeholder="Misal: Ujian Tengah Semester IPA">
                    </div>

                    <!-- Pilih Kuis (Searchable) -->
                    <div class="mb-8" x-data="{ searchCategory: '' }">
                        <label class="block text-sm font-bold text-gray-300 mb-2">Pilih Sumber Soal Kuis</label>
                        <p class="text-xs text-gray-400 mb-4 leading-relaxed">Anda bisa memilih lebih dari satu kuis. Sistem akan mengumpulkan dan mengacak semua soal dari sumber yang Anda centang di bawah ini.</p>
                        
                        <div class="relative mb-4">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" x-model="searchCategory" placeholder="Cari topik atau kategori kuis..." class="w-full bg-black/40 border border-gray-700 text-white rounded-xl shadow-inner focus:border-fuchsia-500 focus:ring-fuchsia-500 pl-11 pr-4 py-3 text-sm placeholder-gray-600 transition-colors">
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-72 overflow-y-auto p-4 border border-gray-700/50 rounded-xl bg-black/20 shadow-inner">
                            @foreach($quizzes as $quiz)
                                <label x-show="'{{ strtolower(addslashes($quiz->title)) }}'.includes(searchCategory.toLowerCase())" class="flex items-center space-x-3 p-3.5 border border-gray-700/80 rounded-lg hover:bg-white/5 cursor-pointer transition-colors group">
                                    <input type="checkbox" name="quizzes[]" value="{{ $quiz->id }}" class="h-5 w-5 text-fuchsia-600 bg-gray-900 border-gray-600 rounded focus:ring-fuchsia-500 flex-shrink-0 transition-all">
                                    <div class="flex-1 min-w-0">
                                        <span class="block text-sm font-bold text-gray-200 truncate group-hover:text-white transition-colors" title="{{ $quiz->title }}">{{ $quiz->title }}</span>
                                        <span class="block text-[11px] text-gray-400 mt-0.5"><span class="text-fuchsia-400 font-semibold">{{ $quiz->questions()->count() }}</span> Soal tersedia</span>
                                    </div>
                                </label>
                            @endforeach
                            @if($quizzes->isEmpty())
                                <div class="col-span-full py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    Belum ada satupun kuis/bank soal yang dibuat di sistem.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <!-- Jumlah Pertanyaan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Total Pertanyaan yang Ditampilkan</label>
                            <input type="number" name="total_questions" min="1" required class="w-full bg-black/40 border border-gray-700 text-white rounded-xl shadow-inner focus:border-fuchsia-500 focus:ring-fuchsia-500 px-5 py-4 placeholder-gray-600 transition-colors" placeholder="Misal: 10">
                            <p class="text-[11px] text-gray-500 mt-2">Sistem akan memilih <span class="text-gray-300 font-bold">acak</span> soal sebanyak jumlah ini dari semua kuis yang dicentang di atas.</p>
                        </div>

                        <!-- Waktu Pengerjaan Per Soal -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Waktu per Soal (Detik)</label>
                            <div class="relative">
                                <input type="number" name="timer_per_question" min="5" required class="w-full bg-black/40 border border-gray-700 text-white rounded-xl shadow-inner focus:border-fuchsia-500 focus:ring-fuchsia-500 pl-5 pr-16 py-4 placeholder-gray-600 transition-colors" value="30" placeholder="Misal: 30">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-bold text-sm">Detik</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-8 border-t border-white/5">
                        <button type="submit" class="w-full md:w-auto px-10 py-4 bg-gradient-to-r from-fuchsia-600 to-cyan-600 text-white rounded-xl font-black text-lg hover:from-fuchsia-500 hover:to-cyan-500 transition-all shadow-[0_0_20px_rgba(192,38,211,0.3)] hover:shadow-[0_0_30px_rgba(192,38,211,0.5)] flex items-center justify-center gap-3 transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            GENERATE ROOM SEKARANG
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

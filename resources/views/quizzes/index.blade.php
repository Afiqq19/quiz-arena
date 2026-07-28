<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Kelola Kuis') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('quizzes.export') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-gray-700 rounded-xl font-bold text-xs text-gray-300 uppercase tracking-widest hover:bg-gray-700 hover:text-white shadow-lg shadow-black/20 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Ekspor JSON
                </a>

                <button onclick="document.getElementById('import-modal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-gray-700 rounded-xl font-bold text-xs text-gray-300 uppercase tracking-widest hover:bg-gray-700 hover:text-white shadow-lg shadow-black/20 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Impor JSON
                </button>

                <a href="{{ route('quizzes.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-fuchsia-600 to-purple-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-fuchsia-500 hover:to-purple-500 shadow-lg shadow-fuchsia-500/30 focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Kuis
                </a>
            </div>
        </div>

        <!-- Import Modal -->
        <div id="import-modal" class="fixed inset-0 z-50 hidden bg-black/70 backdrop-blur-sm flex items-center justify-center">
            <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Impor Kuis Baru (JSON)</h3>
                    <button onclick="document.getElementById('import-modal').classList.add('hidden')" class="text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <p class="text-gray-400 text-sm mb-6">Unggah file JSON hasil ekspor kuis sebelumnya. Kuis beserta seluruh pertanyaannya akan ditambahkan ke akun Anda sebagai kuis baru.</p>
                <form action="{{ route('quizzes.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <input type="file" name="quiz_file" accept=".json" required
                                class="block w-full text-sm text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-xl file:border-0
                                file:text-sm file:font-bold
                                file:bg-gray-800 file:text-white
                                hover:file:bg-gray-700 transition-all cursor-pointer bg-gray-900 border border-gray-700 rounded-xl p-1">
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('import-modal').classList.add('hidden')" class="px-4 py-2 bg-gray-800 text-gray-300 font-bold rounded-xl hover:bg-gray-700 transition-colors text-sm">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-fuchsia-600 to-blue-600 text-white font-bold rounded-xl hover:from-fuchsia-500 hover:to-blue-500 shadow-lg shadow-fuchsia-500/30 transition-all text-sm">
                            Mulai Impor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl relative flex items-center gap-3" role="alert">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl relative flex items-center gap-3" role="alert">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-800">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider w-16">No.</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Judul Kuis</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Jumlah Soal</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Dibuat Oleh</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-800">
                            @forelse($quizzes as $quiz)
                                <tr class="hover:bg-gray-800/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-white">{{ $quiz->title }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-[200px] mt-1">{{ $quiz->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-blue-900/40 text-blue-400 border border-blue-800/50">
                                            {{ $quiz->category ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="text-sm font-medium text-gray-300 bg-gray-800 px-3 py-1 rounded-lg border border-gray-700">
                                            {{ $quiz->questions_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($quiz->status === 'approved')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-green-900/40 text-green-400 border border-green-800/50">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Disetujui
                                            </span>
                                        @elseif($quiz->status === 'rejected')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-red-900/40 text-red-400 border border-red-800/50">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-yellow-900/40 text-yellow-400 border border-yellow-800/50">
                                                <svg class="w-3.5 h-3.5 mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-gradient-to-r from-fuchsia-600 to-blue-600 flex items-center justify-center text-[10px] font-bold text-white">
                                                {{ substr($quiz->creator->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-medium text-gray-300">{{ $quiz->creator->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-3">
                                            @if($quiz->status === 'pending')
                                                <form action="{{ route('admin.quizzes.moderate', $quiz) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    @if($quiz->questions_count >= 10)
                                                        <button type="submit" class="text-white bg-green-500/20 hover:bg-green-500/40 border border-green-500/50 px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                            Setujui
                                                        </button>
                                                    @else
                                                        <button type="button" onclick="alert('Kuis harus memiliki minimal 10 soal untuk disetujui!')" class="text-gray-400 bg-gray-800 border border-gray-700 px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1 cursor-not-allowed" title="Minimal 10 soal">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                            Setujui
                                                        </button>
                                                    @endif
                                                </form>
                                                <form action="{{ route('admin.quizzes.moderate', $quiz) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="text-white bg-red-500/20 hover:bg-red-500/40 border border-red-500/50 px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        Tolak
                                                    </button>
                                                </form>
                                                <div class="w-px h-6 bg-gray-700 mx-1"></div>
                                            @elseif($quiz->status === 'approved' && auth()->user()->role === 'admin')
                                                <form action="{{ route('admin.quizzes.togglePublish', $quiz) }}" method="POST" class="inline" onsubmit="return confirm('Tarik kuis ini dari peredaran? (Status akan kembali menjadi Pending)');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit" class="text-white bg-orange-500/20 hover:bg-orange-500/40 border border-orange-500/50 px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1" title="Tarik Kuis (Non-Rilis)">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path></svg>
                                                        Tarik Kuis
                                                    </button>
                                                </form>
                                                <div class="w-px h-6 bg-gray-700 mx-1"></div>
                                            @endif
                                            
                                            <a href="{{ route('quizzes.questions.create', $quiz) }}" class="text-fuchsia-400 hover:text-fuchsia-300 bg-fuchsia-500/10 hover:bg-fuchsia-500/20 px-3 py-1.5 rounded-lg transition-all border border-fuchsia-500/20 text-xs font-bold flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                Soal
                                            </a>
                                            <a href="{{ route('quizzes.edit', $quiz) }}" class="text-blue-400 hover:text-blue-300 bg-blue-500/10 hover:bg-blue-500/20 px-3 py-1.5 rounded-lg transition-all border border-blue-500/20 text-xs font-bold flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg transition-all border border-red-500/20 text-xs font-bold flex items-center gap-1" onclick="return confirm('Yakin ingin menghapus kuis ini? Seluruh soal juga akan terhapus.')">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-800 mb-4">
                                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-white mb-1">Belum ada data kuis</h3>
                                        <p class="text-gray-500 text-sm">Silakan buat kuis baru untuk memulai.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

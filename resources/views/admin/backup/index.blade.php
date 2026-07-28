<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-black text-white tracking-tight">Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-blue-500">Backup Data</span></h1>
                <p class="text-gray-400 mt-2">Amankan seluruh data aplikasi, dari pengguna hingga histori kuis.</p>
            </div>

            <div class="bg-gray-900/50 backdrop-blur-xl rounded-2xl border border-white/10 shadow-2xl p-8 max-w-2xl">
                <div class="flex items-start gap-6">
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-gradient-to-tr from-fuchsia-600/20 to-blue-600/20 flex items-center justify-center border border-white/10">
                        <svg class="w-8 h-8 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white mb-2">Download Backup Database (.sql)</h2>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">
                            Dengan mengunduh backup ini, Anda akan menyimpan seluruh struktur dan data aplikasi saat ini. File ini dapat digunakan untuk memulihkan (restore) sistem kapan pun terjadi masalah. Pastikan untuk menyimpan file ini di tempat yang aman.
                        </p>
                        
                        <form action="{{ route('admin.backup.download') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-fuchsia-600 to-blue-600 hover:from-fuchsia-500 hover:to-blue-500 text-white font-bold rounded-xl shadow-lg shadow-fuchsia-500/30 hover:shadow-fuchsia-500/50 transition-all hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh File Backup Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Restore Section -->
            <div class="mt-8 bg-gray-900/50 backdrop-blur-xl rounded-2xl border border-white/10 shadow-2xl p-8 max-w-2xl">
                <div class="flex items-start gap-6">
                    <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-gradient-to-tr from-orange-600/20 to-red-600/20 flex items-center justify-center border border-white/10">
                        <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-xl font-bold text-white mb-2">Restore Database (.sql)</h2>
                        <p class="text-gray-400 text-sm leading-relaxed mb-4">
                            Pilih file backup (.sql) yang sebelumnya Anda unduh untuk memulihkan seluruh data. <strong class="text-red-400">Peringatan: Seluruh data saat ini akan ditimpa (dihapus dan diganti) dengan data dari file backup tersebut.</strong>
                        </p>

                        <!-- Alerts -->
                        @if (session('status'))
                            <div class="mb-4 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3 text-emerald-400 text-sm font-bold">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-4 p-4 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center gap-3 text-red-400 text-sm font-bold">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                {{ session('error') }}
                            </div>
                        @endif

                        @error('backup_file')
                            <div class="mb-4 p-4 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center gap-3 text-red-400 text-sm font-bold">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <form action="{{ route('admin.backup.restore') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                            @csrf
                            <div>
                                <input type="file" name="backup_file" accept=".sql" required
                                    class="block w-full text-sm text-gray-400
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-xl file:border-0
                                    file:text-sm file:font-bold
                                    file:bg-white/10 file:text-white
                                    hover:file:bg-white/20 transition-all cursor-pointer bg-gray-800/50 rounded-xl border border-white/10 p-1">
                            </div>
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin me-restore database? Seluruh data saat ini akan terganti total!')" class="inline-flex items-center justify-center gap-3 px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 transition-all hover:scale-105 active:scale-95 w-full sm:w-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Proses Restore Database
                            </button>
                        </form>
                    </div>
                </div>
            </div>            
            <!-- Warning Notice -->
            <div class="mt-6 max-w-2xl p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl flex items-start gap-3">
                <svg class="w-6 h-6 text-yellow-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <div class="text-sm text-yellow-200/80">
                    <strong class="text-yellow-400 font-bold block mb-1">Penting:</strong>
                    File SQL ini mengandung data sensitif (seperti kredensial pengguna dan skor kuis). Jangan bagikan file backup ini kepada siapapun secara publik.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

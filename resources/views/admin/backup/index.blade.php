<x-app-layout>
    <div class="py-12 relative min-h-screen bg-gray-900 overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-fuchsia-600/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute top-[40%] right-[-5%] w-[30%] h-[30%] rounded-full bg-orange-600/10 blur-[100px] pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-10 px-4 sm:px-0 text-center sm:text-left flex flex-col sm:flex-row items-center gap-4">
                <div class="p-3 bg-gray-800/80 rounded-2xl border border-white/10 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight">Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-cyan-400">Backup & Restore</span></h1>
                    <p class="text-gray-400 mt-2 text-sm md:text-base">Amankan seluruh data aplikasi Anda, atau pulihkan data dari file backup sebelumnya.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                <!-- Download Section -->
                <div class="bg-gray-800/60 backdrop-blur-2xl rounded-3xl border border-white/10 shadow-[0_0_40px_rgba(0,0,0,0.3)] p-6 sm:p-10 mx-4 sm:mx-0 group hover:border-fuchsia-500/30 transition-colors">
                    <div class="flex flex-col sm:flex-row items-start gap-6 sm:gap-8">
                        <div class="flex-shrink-0 w-20 h-20 rounded-3xl bg-gradient-to-br from-fuchsia-600/20 to-blue-600/20 flex items-center justify-center border border-white/10 shadow-inner group-hover:scale-105 transition-transform">
                            <svg class="w-10 h-10 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-white mb-3 flex items-center gap-2">Backup Database Sekarang</h2>
                            <p class="text-gray-400 text-sm md:text-base leading-relaxed mb-6">
                                Dengan mengunduh backup ini, Anda akan menyimpan seluruh struktur dan data aplikasi saat ini (termasuk kuis, peserta, dan skor). File SQL ini dapat digunakan untuk memulihkan sistem kapan pun. <strong class="text-gray-300">Pastikan untuk menyimpan file ini di tempat yang aman.</strong>
                            </p>
                            
                            <form action="{{ route('admin.backup.create') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-fuchsia-600 to-cyan-600 hover:from-fuchsia-500 hover:to-cyan-500 text-white font-bold rounded-xl shadow-[0_0_20px_rgba(192,38,211,0.3)] hover:shadow-[0_0_30px_rgba(192,38,211,0.5)] transition-all hover:-translate-y-1">
                                    <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Buat Backup Baru
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Backup History Section -->
                <div class="bg-gray-800/60 backdrop-blur-2xl rounded-3xl border border-white/10 shadow-[0_0_40px_rgba(0,0,0,0.3)] p-6 sm:p-10 mx-4 sm:mx-0">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Riwayat Backup
                    </h2>
                    
                    <div class="overflow-x-auto rounded-xl border border-gray-700/50">
                        <table class="min-w-full text-left text-sm text-gray-300">
                            <thead class="bg-gray-900/80 text-xs uppercase font-bold text-gray-400 border-b border-gray-700/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Nama File</th>
                                    <th scope="col" class="px-6 py-4">Tanggal Pembuatan</th>
                                    <th scope="col" class="px-6 py-4">Ukuran</th>
                                    <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700/50 bg-black/20">
                                @forelse($backups as $backup)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-6 py-4 font-mono text-cyan-400 whitespace-nowrap">{{ $backup['name'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ date('d M Y, H:i', $backup['date']) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($backup['size'] / 1024, 2) }} KB</td>
                                        <td class="px-6 py-4 flex justify-center gap-3 whitespace-nowrap">
                                            <a href="{{ route('admin.backup.downloadFile', $backup['name']) }}" class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all" title="Download">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            </a>
                                            <form action="{{ route('admin.backup.deleteFile', $backup['name']) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus file backup {{ $backup['name'] }}?')" class="p-2 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                            <svg class="w-12 h-12 mx-auto mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            Belum ada file backup yang tersimpan di server.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Restore Section -->
                <div class="bg-gray-800/60 backdrop-blur-2xl rounded-3xl border border-white/10 shadow-[0_0_40px_rgba(0,0,0,0.3)] p-6 sm:p-10 mx-4 sm:mx-0 group hover:border-orange-500/30 transition-colors">
                    <div class="flex flex-col sm:flex-row items-start gap-6 sm:gap-8">
                        <div class="flex-shrink-0 w-20 h-20 rounded-3xl bg-gradient-to-br from-orange-600/20 to-red-600/20 flex items-center justify-center border border-white/10 shadow-inner group-hover:scale-105 transition-transform">
                            <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <div class="flex-1 w-full">
                            <h2 class="text-2xl font-bold text-white mb-3 flex items-center gap-2">Restore dari Backup (.sql)</h2>
                            <p class="text-gray-400 text-sm md:text-base leading-relaxed mb-6">
                                Pilih file backup yang sebelumnya Anda unduh untuk memulihkan seluruh data. <strong class="text-red-400 font-bold bg-red-500/10 px-2 py-1 rounded">Peringatan: Seluruh data saat ini akan ditimpa total!</strong>
                            </p>

                            <!-- Alerts -->
                            @if (session('status'))
                                <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3 text-emerald-400 text-sm font-bold shadow-inner">
                                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center gap-3 text-red-400 text-sm font-bold shadow-inner">
                                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ session('error') }}
                                </div>
                            @endif

                            @error('backup_file')
                                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center gap-3 text-red-400 text-sm font-bold shadow-inner">
                                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            <form action="{{ route('admin.backup.restore') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5 bg-black/20 p-5 rounded-2xl border border-white/5">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-gray-300 mb-2">Pilih File Backup</label>
                                    <input type="file" name="backup_file" accept=".sql" required
                                        class="block w-full text-sm text-gray-400
                                        file:mr-4 file:py-3 file:px-5
                                        file:rounded-xl file:border-0
                                        file:text-sm file:font-bold
                                        file:bg-white/10 file:text-white
                                        hover:file:bg-white/20 transition-all cursor-pointer bg-black/40 rounded-xl border border-gray-700 p-1 focus:ring-orange-500 focus:border-orange-500">
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" onclick="return confirm('APAKAH ANDA YAKIN? Tindakan ini tidak bisa dibatalkan dan akan menghapus data yang ada saat ini!')" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white font-bold rounded-xl shadow-[0_0_20px_rgba(234,88,12,0.3)] hover:shadow-[0_0_30px_rgba(234,88,12,0.5)] transition-all hover:-translate-y-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        Jalankan Proses Restore
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>            
                
                <!-- Warning Notice -->
                <div class="mx-4 sm:mx-0 p-5 bg-gradient-to-r from-yellow-500/10 to-transparent border-l-4 border-yellow-500 rounded-r-xl flex items-start gap-4">
                    <svg class="w-8 h-8 text-yellow-500 flex-shrink-0 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div class="text-sm md:text-base text-yellow-200/90 leading-relaxed">
                        <strong class="text-yellow-400 font-black block mb-1">PENTING:</strong>
                        File SQL ini mengandung data yang sangat sensitif seperti email pengguna, kata sandi terenkripsi, dan skor kuis rahasia. <strong class="text-white">Dilarang membagikan file backup ini kepada siapapun secara publik.</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

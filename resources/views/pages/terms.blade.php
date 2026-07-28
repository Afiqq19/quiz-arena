<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition-colors" title="Kembali ke Beranda">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-indigo-400 leading-tight">
                {{ __('Syarat dan Ketentuan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-10">
            <div class="bg-indigo-900/40 backdrop-blur-xl overflow-hidden rounded-2xl border border-white/10 shadow-[0_0_40px_rgba(79,70,229,0.15)]">
                <div class="p-8 sm:p-12 relative overflow-hidden text-gray-300 leading-relaxed space-y-6">
                    <!-- Decor -->
                    <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-fuchsia-500/20 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10">
                        <p class="text-sm font-bold text-indigo-400 tracking-widest uppercase mb-2">Terakhir Diperbarui: 27 Juli 2026</p>
                        <h1 class="text-3xl font-black text-white mb-8">Syarat dan Ketentuan Layanan</h1>
                        
                        <p class="mb-4">Selamat datang di Quiz Arena. Dengan mendaftar dan menggunakan platform kami, Anda setuju untuk mematuhi Syarat dan Ketentuan berikut.</p>

                        <h2 class="text-xl font-bold text-white mb-3 mt-8">1. Penggunaan Platform</h2>
                        <p class="mb-4">Anda setuju untuk menggunakan Quiz Arena hanya untuk tujuan edukasi yang sah. Anda dilarang melakukan eksploitasi celah keamanan (hacking), melakukan manipulasi skor (cheating), atau mengganggu kenyamanan pengguna lain.</p>

                        <h2 class="text-xl font-bold text-white mb-3 mt-8">2. Akun Pengguna</h2>
                        <ul class="list-disc list-inside space-y-2 mb-4 ml-4">
                            <li>Anda bertanggung jawab menjaga kerahasiaan kata sandi Anda.</li>
                            <li>Informasi pendaftaran harus akurat dan valid.</li>
                            <li>Kami berhak menangguhkan atau menghapus akun yang terbukti melanggar aturan tanpa pemberitahuan sebelumnya.</li>
                        </ul>

                        <h2 class="text-xl font-bold text-white mb-3 mt-8">3. Hak Cipta dan Konten Kuis</h2>
                        <p class="mb-4">Semua aset desain, tata letak, dan kode sumber adalah hak milik intelektual Quiz Arena. Adapun konten soal yang diinput oleh Guru/Admin tetap menjadi hak dari pembuat aslinya, namun pengguna setuju untuk tidak memasukkan materi yang melanggar hukum, SARA, atau pornografi.</p>
                        
                        <h2 class="text-xl font-bold text-white mb-3 mt-8">4. Sistem Papan Peringkat (Leaderboard)</h2>
                        <p class="mb-4">Hasil kuis Mode Individu akan dicatat secara otomatis ke dalam Leaderboard Global. Pengguna tidak diperkenankan menggunakan bot atau skrip otomatis untuk memanipulasi posisi papan peringkat.</p>

                        <h2 class="text-xl font-bold text-white mb-3 mt-8">5. Perubahan Ketentuan</h2>
                        <p class="mb-4">Quiz Arena sewaktu-waktu berhak mengubah Syarat dan Ketentuan ini tanpa pemberitahuan individual. Pengguna dianjurkan untuk memeriksa halaman ini secara berkala.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

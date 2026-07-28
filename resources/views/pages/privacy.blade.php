<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition-colors" title="Kembali ke Beranda">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-indigo-400 leading-tight">
                {{ __('Kebijakan Privasi') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-10">
            <div class="bg-indigo-900/40 backdrop-blur-xl overflow-hidden rounded-2xl border border-white/10 shadow-[0_0_40px_rgba(79,70,229,0.15)]">
                <div class="p-8 sm:p-12 relative overflow-hidden text-gray-300 leading-relaxed space-y-6">
                    <!-- Decor -->
                    <div class="absolute -top-24 -left-24 w-48 h-48 bg-blue-500/20 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10">
                        <p class="text-sm font-bold text-indigo-400 tracking-widest uppercase mb-2">Terakhir Diperbarui: 27 Juli 2026</p>
                        <h1 class="text-3xl font-black text-white mb-8">Kebijakan Privasi Quiz Arena</h1>
                        
                        <p class="mb-4">Privasi Anda adalah prioritas utama kami. Kebijakan ini menjelaskan bagaimana Quiz Arena mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan layanan kami.</p>

                        <h2 class="text-xl font-bold text-white mb-3 mt-8">1. Informasi yang Kami Kumpulkan</h2>
                        <p class="mb-4">Saat Anda mendaftar atau menggunakan platform kami, kami mungkin mengumpulkan data dasar seperti:</p>
                        <ul class="list-disc list-inside space-y-2 mb-4 ml-4">
                            <li>Nama lengkap / nama tampilan</li>
                            <li>Alamat email</li>
                            <li>Data permainan (skor, waktu pengerjaan, histori kuis)</li>
                            <li>Peran (Siswa atau Guru)</li>
                        </ul>

                        <h2 class="text-xl font-bold text-white mb-3 mt-8">2. Penggunaan Informasi</h2>
                        <p class="mb-4">Informasi yang dikumpulkan akan digunakan secara eksklusif untuk:</p>
                        <ul class="list-disc list-inside space-y-2 mb-4 ml-4">
                            <li>Mengelola dan memfasilitasi akun Anda.</li>
                            <li>Menampilkan nama dan skor Anda di papan peringkat (Leaderboard).</li>
                            <li>Memberikan laporan performa kuis kepada guru (jika berada dalam Room).</li>
                            <li>Meningkatkan kualitas layanan dan keamanan sistem.</li>
                        </ul>

                        <h2 class="text-xl font-bold text-white mb-3 mt-8">3. Keamanan Data</h2>
                        <p class="mb-4">Kami menerapkan standar keamanan enkripsi terkini untuk melindungi data akun Anda, khususnya kata sandi, yang tidak akan pernah kami distribusikan atau tampilkan secara publik.</p>
                        
                        <h2 class="text-xl font-bold text-white mb-3 mt-8">4. Pembagian Data kepada Pihak Ketiga</h2>
                        <p class="mb-4">Kami <strong>tidak pernah menjual, menukar, atau menyewakan</strong> informasi identitas pribadi pengguna kepada pihak ketiga dengan alasan apapun.</p>

                        <h2 class="text-xl font-bold text-white mb-3 mt-8">5. Persetujuan</h2>
                        <p class="mb-4">Dengan menggunakan layanan Quiz Arena, Anda menyatakan setuju dan tunduk pada Kebijakan Privasi ini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

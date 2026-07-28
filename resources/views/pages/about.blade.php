<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition-colors" title="Kembali ke Beranda">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-indigo-400 leading-tight">
                {{ __('Tentang Kami') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-10">
            <div class="bg-indigo-900/40 backdrop-blur-xl overflow-hidden rounded-2xl border border-white/10 shadow-[0_0_40px_rgba(79,70,229,0.15)]">
                <div class="p-8 sm:p-12 relative overflow-hidden text-gray-300 leading-relaxed space-y-6">
                    <!-- Decor -->
                    <div class="absolute -top-24 -right-24 w-48 h-48 bg-fuchsia-500/20 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10 text-center mb-10">
                        <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-tr from-fuchsia-600 to-blue-600 flex items-center justify-center shadow-lg shadow-fuchsia-500/30 mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h1 class="text-4xl font-black text-white tracking-wide">QUIZ<span class="text-fuchsia-400">ARENA</span></h1>
                        <p class="text-indigo-300 font-bold tracking-widest uppercase mt-2 text-sm">Platform Kuis Generasi Baru</p>
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-white mb-4">Visi Kami</h2>
                        <p class="mb-6">Quiz Arena dibangun dengan satu tujuan utama: <strong>membuat proses belajar dan evaluasi menjadi menyenangkan dan interaktif</strong>. Kami percaya bahwa edukasi tidak harus membosankan. Melalui sentuhan gamifikasi, efek visual yang memukau, dan pengalaman kompetitif yang sehat, kami ingin memotivasi peserta didik untuk terus berkembang.</p>
                        
                        <h2 class="text-2xl font-bold text-white mb-4 mt-10">Mengapa Memilih Kami?</h2>
                        <ul class="list-none space-y-4 mb-6">
                            <li class="flex gap-3">
                                <span class="text-fuchsia-400">✅</span>
                                <span><strong>Desain Premium & Interaktif:</strong> Tampilan glassmorphism yang modern membuat mata tidak cepat lelah dan meningkatkan fokus.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-fuchsia-400">✅</span>
                                <span><strong>Mode Fleksibel:</strong> Tersedia Mode Individu (Solo) untuk berlatih mandiri dan Mode Room untuk kompetisi langsung bersama teman-teman.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-fuchsia-400">✅</span>
                                <span><strong>Efek Visual & Audio:</strong> Kami menyertakan efek suara dramatis dan animasi mulus untuk menciptakan suasana "arena" yang menegangkan namun menyenangkan.</span>
                            </li>
                        </ul>
                        
                        <h2 class="text-2xl font-bold text-white mb-4 mt-10">Tim Pengembang</h2>
                        <p class="mb-6">Dikembangkan pada tahun 2026, Quiz Arena terus diperbarui dengan fitur-fitur terbaru yang disesuaikan dengan kebutuhan pendidikan digital masa kini. Masukan dari pengajar dan peserta sangat kami hargai untuk pengembangan di masa mendatang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

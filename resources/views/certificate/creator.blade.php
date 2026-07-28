<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kreator - {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Montserrat:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Certificate Container: A4 Landscape Proportion */
        .certificate {
            width: 1123px; /* A4 Width at 96 DPI */
            height: 794px; /* A4 Height at 96 DPI */
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%);
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 20px solid transparent;
            border-image: linear-gradient(to right, #d946ef, #3b82f6) 1;
        }

        /* Decorative Backgrounds */
        .deco-1 {
            position: absolute;
            top: -150px;
            left: -150px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(217, 70, 239, 0.2) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
        }
        .deco-2 {
            position: absolute;
            bottom: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
        }

        /* Corner Ornaments */
        .corner {
            position: absolute;
            width: 80px;
            height: 80px;
            border: 4px solid #fbcfe8;
        }
        .corner-tl { top: 20px; left: 20px; border-right: none; border-bottom: none; }
        .corner-tr { top: 20px; right: 20px; border-left: none; border-bottom: none; }
        .corner-bl { bottom: 20px; left: 20px; border-right: none; border-top: none; }
        .corner-br { bottom: 20px; right: 20px; border-left: none; border-top: none; }

        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }

        /* Print Settings */
        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }
            body {
                background: none;
                padding: 0;
            }
            .certificate {
                box-shadow: none;
                width: 100%;
                height: 100vh;
                border-image: none; /* Browsers sometimes struggle with border-image in print */
                border: 20px solid #d946ef; /* Fallback for print */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            #print-btn {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Print Button (Hidden in Print Mode) -->
    <button id="print-btn" onclick="window.print()" class="fixed top-6 right-6 z-50 bg-gradient-to-r from-fuchsia-600 to-blue-600 text-white font-bold py-3 px-6 rounded-full shadow-[0_0_20px_rgba(217,70,239,0.5)] hover:scale-105 transition-transform flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
        Simpan sebagai PDF / Cetak
    </button>

    <div class="certificate">
        <div class="deco-1"></div>
        <div class="deco-2"></div>
        
        <div class="corner corner-tl"></div>
        <div class="corner corner-tr"></div>
        <div class="corner corner-bl"></div>
        <div class="corner corner-br"></div>

        <!-- Certificate Number -->
        <div class="absolute top-10 left-10 z-20 bg-black/30 px-3 py-1 rounded border border-white/10 backdrop-blur-sm">
            <span class="font-montserrat text-xs text-indigo-300 tracking-[0.15em] font-bold">NO: {{ $certNumber }}</span>
        </div>

        <div class="relative z-10 w-full flex flex-col items-center text-center px-20">
            <!-- Header -->
            <div class="mb-4">
                <span class="text-fuchsia-400 font-montserrat font-bold tracking-[0.3em] uppercase text-sm">PENGHARGAAN RESMI</span>
            </div>

            <!-- Logo Area (Quiz Arena Text Logo) -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-fuchsia-500 to-blue-600 flex items-center justify-center transform rotate-12 shadow-lg shadow-fuchsia-500/50">
                    <svg class="w-7 h-7 text-white transform -rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300 font-montserrat tracking-tight">QUIZ<span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-blue-400">ARENA</span></h1>
            </div>

            <!-- Title -->
            <h1 class="font-cinzel text-6xl md:text-7xl font-black text-white mb-6 drop-shadow-[0_0_15px_rgba(255,255,255,0.3)]">
                SERTIFIKAT KREATOR
            </h1>

            <p class="font-montserrat text-indigo-200 text-lg mb-8 tracking-widest uppercase">
                Dianugerahkan Dengan Bangga Kepada
            </p>

            <!-- Recipient Name -->
            <div class="relative w-full max-w-3xl mb-8">
                <h2 class="font-playfair text-6xl md:text-7xl font-bold italic text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-100 to-yellow-300 drop-shadow-md">
                    {{ $user->name }}
                </h2>
                <div class="absolute bottom-[-10px] left-1/2 transform -translate-x-1/2 w-3/4 h-[2px] bg-gradient-to-r from-transparent via-yellow-400/50 to-transparent"></div>
            </div>

            <!-- Description -->
            <p class="font-montserrat text-gray-300 text-lg leading-relaxed max-w-4xl mx-auto mb-16">
                Atas dedikasi, kreativitas, dan kontribusinya yang luar biasa dalam menciptakan <strong>{{ $quizCount }} Kuis Interaktif</strong> di platform Quiz Arena. <br>Anda telah resmi diakui sebagai <strong>Kreator Legendaris</strong> yang menyebarkan pengetahuan kepada para pejuang ilmu lainnya.
            </p>

            <!-- Footer / Signatures -->
            <div class="flex justify-between items-end w-full max-w-4xl px-12 relative mt-4">
                <div class="flex flex-col items-center">
                    <div class="h-24 flex items-end pb-2">
                        <span class="text-fuchsia-300 font-playfair italic text-3xl">{{ $date }}</span>
                    </div>
                    <div class="w-48 h-[1px] bg-gray-500 mb-2"></div>
                    <span class="font-montserrat text-sm font-bold text-gray-400 tracking-wider">TANGGAL PENGHARGAAN</span>
                </div>
                
                <!-- Validation QR Code -->
                <div class="absolute left-1/2 bottom-0 transform -translate-x-1/2 flex flex-col items-center pb-2">
                    
                    @php
                        // URL untuk halaman verifikasi publik
                        $verifyUrl = route('certificate.verify', ['id' => $user->id]);
                        $qrData = urlencode($verifyUrl);
                    @endphp
                    <div class="bg-white p-1 rounded-lg shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{ $qrData }}" alt="QR Code Verifikasi" class="w-20 h-20 rounded">
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="h-24 flex items-center justify-center relative w-full mb-2">
                        <img src="{{ asset('sertifikat/ttd.png') }}" alt="Tanda Tangan Admin" class="h-48 md:h-56 absolute bottom-[-45px] object-contain drop-shadow-[0_0_8px_rgba(255,255,255,0.2)]">
                    </div>
                    <div class="w-64 h-[1px] bg-gray-500 mb-2"></div>
                    <span class="font-montserrat text-sm font-bold text-gray-400 tracking-wider">PENDIRI & CEO</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

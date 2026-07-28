<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function creator()
    {
        $user = Auth::user();
        
        // Ambil semua kuis yang disetujui, urutkan berdasarkan waktu disetujui paling awal
        $approvedQuizzes = $user->quizzes()
            ->where('status', 'approved')
            ->oldest('updated_at')
            ->get();
            
        $approvedQuizzesCount = $approvedQuizzes->count();
        
        if ($approvedQuizzesCount < 3) {
            abort(403, 'Sertifikat Kreator Legendaris ini baru bisa diakses setelah Anda memiliki minimal 3 kuis yang telah disetujui (di-publish) oleh Admin.');
        }

        // Ambil kuis ke-3 yang disetujui (index 2 karena dimulai dari 0)
        // Tanggal kuis ke-3 disetujui = Tanggal resmi pemain mendapatkan pencapaian ini!
        $achievementDate = $approvedQuizzes[2]->updated_at;

        // Konversi bulan pencapaian ke angka Romawi
        $romawiBulan = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        $bulanRomawi = $romawiBulan[(int)$achievementDate->format('n')];

        // Format Nomor: [ID_3_DIGIT]/QA/KREATOR/[BULAN_ROMAWI]/[TAHUN]
        // Jika ID < 1000, format jadi 3 digit (001, 012). Jika >= 1000, biarkan sesuai panjang aslinya (1000).
        $paddedId = str_pad($user->id, 3, '0', STR_PAD_LEFT);
        $certNumber = $paddedId . '/QA/KREATOR/' . $bulanRomawi . '/' . $achievementDate->format('Y');

        // Tampilkan halaman sertifikat yang dirancang khusus untuk cetak PDF
        return view('certificate.creator', [
            'user' => $user,
            'quizCount' => $approvedQuizzesCount,
            'certNumber' => $certNumber,
            'date' => $achievementDate->translatedFormat('d F Y') // Format tanggal bahasa Indonesia permanen
        ]);
    }

    public function verify($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        $approvedQuizzes = $user->quizzes()
            ->where('status', 'approved')
            ->oldest('updated_at')
            ->get();
            
        $approvedQuizzesCount = $approvedQuizzes->count();
        
        if ($approvedQuizzesCount < 3) {
            abort(404, 'Sertifikat tidak ditemukan atau belum memenuhi syarat.');
        }

        $achievementDate = $approvedQuizzes[2]->updated_at;

        $romawiBulan = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        $bulanRomawi = $romawiBulan[(int)$achievementDate->format('n')];

        $paddedId = str_pad($user->id, 3, '0', STR_PAD_LEFT);
        $certNumber = $paddedId . '/QA/KREATOR/' . $bulanRomawi . '/' . $achievementDate->format('Y');

        return view('certificate.verify', [
            'user' => $user,
            'quizCount' => $approvedQuizzesCount,
            'certNumber' => $certNumber,
            'achievementDate' => $achievementDate->translatedFormat('d F Y'),
            'approvedQuizzes' => $approvedQuizzes
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;

class MixedQuizzesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) return;

        $quizzes = [
            [
                'title' => 'Astronomi dan Tata Surya',
                'description' => 'Jelajahi misteri alam semesta. Kuis ini berisi campuran 7 soal Pilihan Ganda dan 3 soal Essay.',
                'category' => 'Sains (IPA)',
                'questions' => [
                    // Pilihan Ganda (7 Soal)
                    ['type' => 'multiple_choice', 'q' => 'Planet terdekat dengan matahari adalah...', 'a' => 'Venus', 'b' => 'Mars', 'c' => 'Merkurius', 'd' => 'Bumi', 'correct' => 'C'],
                    ['type' => 'multiple_choice', 'q' => 'Bintang terdekat dengan tata surya kita adalah...', 'a' => 'Sirius', 'b' => 'Alpha Centauri', 'c' => 'Proxima Centauri', 'd' => 'Betelgeuse', 'correct' => 'C'],
                    ['type' => 'multiple_choice', 'q' => 'Siapa manusia pertama yang menginjakkan kaki di bulan?', 'a' => 'Yuri Gagarin', 'b' => 'Neil Armstrong', 'c' => 'Buzz Aldrin', 'd' => 'Michael Collins', 'correct' => 'B'],
                    ['type' => 'multiple_choice', 'q' => 'Galaksi tempat bumi berada disebut...', 'a' => 'Andromeda', 'b' => 'Magellanic Cloud', 'c' => 'Bima Sakti (Milky Way)', 'd' => 'Sombrero', 'correct' => 'C'],
                    ['type' => 'multiple_choice', 'q' => 'Planet yang terkenal memiliki cincin raksasa di tata surya kita adalah...', 'a' => 'Jupiter', 'b' => 'Saturnus', 'c' => 'Uranus', 'd' => 'Neptunus', 'correct' => 'B'],
                    ['type' => 'multiple_choice', 'q' => 'Planet terbesar dalam sistem tata surya kita adalah...', 'a' => 'Matahari', 'b' => 'Bumi', 'c' => 'Jupiter', 'd' => 'Saturnus', 'correct' => 'C'],
                    ['type' => 'multiple_choice', 'q' => 'Benda langit yang mengeluarkan cahaya sendiri disebut...', 'a' => 'Planet', 'b' => 'Satelit', 'c' => 'Komet', 'd' => 'Bintang', 'correct' => 'D'],
                    
                    // Essay (3 Soal)
                    ['type' => 'essay', 'q' => 'Jelaskan secara singkat apa yang dimaksud dengan Lubang Hitam (Black Hole)!', 'answer' => 'Lubang hitam adalah wilayah di ruang angkasa di mana gravitasinya sangat kuat sehingga tidak ada satupun, bahkan cahaya, yang dapat meloloskan diri darinya.'],
                    ['type' => 'essay', 'q' => 'Apa nama teleskop luar angkasa canggih yang diluncurkan oleh NASA pada akhir tahun 2021 untuk menggantikan teleskop Hubble?', 'answer' => 'Teleskop Luar Angkasa James Webb (James Webb Space Telescope / JWST)'],
                    ['type' => 'essay', 'q' => 'Sebutkan 8 planet dalam tata surya secara berurutan mulai dari yang terdekat dengan Matahari!', 'answer' => 'Merkurius, Venus, Bumi, Mars, Jupiter, Saturnus, Uranus, Neptunus'],
                ]
            ],
            [
                'title' => 'Logika dan Asah Otak',
                'description' => 'Uji ketajaman logikamu. Kuis ini berisi campuran 7 soal Pilihan Ganda dan 3 soal Essay.',
                'category' => 'Umum',
                'questions' => [
                    // Pilihan Ganda (7 Soal)
                    ['type' => 'multiple_choice', 'q' => 'Jika A lebih berat dari B, dan C lebih ringan dari B, maka siapa yang paling berat?', 'a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'Tidak dapat ditentukan', 'correct' => 'A'],
                    ['type' => 'multiple_choice', 'q' => 'Mana yang tidak termasuk dalam kelompoknya?', 'a' => 'Apel', 'b' => 'Jeruk', 'c' => 'Wortel', 'd' => 'Pisang', 'correct' => 'C'],
                    ['type' => 'multiple_choice', 'q' => 'Seri angka: 2, 4, 8, 16, ... Angka selanjutnya adalah...', 'a' => '24', 'b' => '32', 'c' => '36', 'd' => '64', 'correct' => 'B'],
                    ['type' => 'multiple_choice', 'q' => 'Jika hari ini adalah hari Senin, hari apakah dua hari sebelum kemarin?', 'a' => 'Jumat', 'b' => 'Sabtu', 'c' => 'Kamis', 'd' => 'Rabu', 'correct' => 'A'],
                    ['type' => 'multiple_choice', 'q' => 'Jika 5 mesin memproduksi 5 piring dalam 5 menit, berapa lama waktu yang dibutuhkan 100 mesin untuk memproduksi 100 piring?', 'a' => '100 menit', 'b' => '50 menit', 'c' => '5 menit', 'd' => '1 menit', 'correct' => 'C'],
                    ['type' => 'multiple_choice', 'q' => 'Antonim (lawan kata) dari kata "PROGRESIF" adalah...', 'a' => 'Statis', 'b' => 'Regresif', 'c' => 'Agresif', 'd' => 'Konservatif', 'correct' => 'B'],
                    ['type' => 'multiple_choice', 'q' => 'Buku : Perpustakaan = Uang : ...', 'a' => 'Pasar', 'b' => 'Dompet', 'c' => 'Bank', 'd' => 'Kasir', 'correct' => 'C'],
                    
                    // Essay (3 Soal)
                    ['type' => 'essay', 'q' => 'Budi memiliki 3 buah apel. Kemudian Budi memberikan 1 apel kepada adiknya. Saat dalam perjalanan pulang, Budi membeli 4 apel lagi. Berapa total jumlah apel Budi sekarang?', 'answer' => 'Budi sekarang memiliki 6 apel.'],
                    ['type' => 'essay', 'q' => 'Seorang peternak memiliki 17 ekor domba. Semua domba tersebut terserang penyakit, dan semuanya kecuali 9 ekor mati. Berapa banyak domba yang masih tersisa hidup?', 'answer' => 'Tersisa 9 ekor domba (karena kata kuncinya adalah "semua kecuali 9 mati", artinya yang 9 tidak mati).'],
                    ['type' => 'essay', 'q' => 'Dalam sebuah lomba lari, Anda berhasil menyalip orang yang berada di posisi kedua. Sekarang, berada di posisi berapakah Anda?', 'answer' => 'Posisi kedua (Karena Anda mengambil alih tempat orang yang sebelumnya berada di posisi kedua, bukan posisi pertama).'],
                ]
            ]
        ];

        foreach ($quizzes as $quizData) {
            $quiz = Quiz::create([
                'title' => $quizData['title'],
                'description' => $quizData['description'],
                'category' => $quizData['category'],
                'status' => 'approved',
                'created_by' => $admin->id,
            ]);

            foreach ($quizData['questions'] as $q) {
                if ($q['type'] === 'multiple_choice') {
                    Question::create([
                        'quiz_id' => $quiz->id,
                        'question_text' => $q['q'],
                        'question_type' => 'multiple_choice',
                        'option_a' => $q['a'],
                        'option_b' => $q['b'],
                        'option_c' => $q['c'],
                        'option_d' => $q['d'],
                        'correct_option' => $q['correct'],
                        'timer_seconds' => 30,
                    ]);
                } else {
                    Question::create([
                        'quiz_id' => $quiz->id,
                        'question_text' => $q['q'],
                        'question_type' => 'essay',
                        'essay_answer' => $q['answer'],
                        'timer_seconds' => 60, // Essay biasanya butuh waktu lebih lama
                    ]);
                }
            }
        }
    }
}

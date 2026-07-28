<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;

class TenQuizzesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) return;

        $quizzes = [
            [
                'title' => 'Sejarah Dunia',
                'description' => 'Uji pengetahuanmu tentang peristiwa bersejarah di seluruh dunia.',
                'category' => 'Sejarah',
                'questions' => [
                    ['q' => 'Perang Dunia II berakhir pada tahun...', 'a' => '1940', 'b' => '1943', 'c' => '1945', 'd' => '1950', 'correct' => 'C'],
                    ['q' => 'Siapakah penemu bola lampu pijar?', 'a' => 'Nikola Tesla', 'b' => 'Thomas Alva Edison', 'c' => 'Alexander Graham Bell', 'd' => 'Albert Einstein', 'correct' => 'B'],
                    ['q' => 'Bangunan Tembok Besar berada di negara...', 'a' => 'Jepang', 'b' => 'Korea', 'c' => 'India', 'd' => 'China', 'correct' => 'D'],
                    ['q' => 'Proklamasi Kemerdekaan Indonesia dibacakan pada tanggal...', 'a' => '17 Agustus 1945', 'b' => '18 Agustus 1945', 'c' => '1 Juni 1945', 'd' => '20 Mei 1908', 'correct' => 'A'],
                    ['q' => 'Kerajaan Hindu tertua di Indonesia adalah...', 'a' => 'Majapahit', 'b' => 'Kutai', 'c' => 'Tarumanegara', 'd' => 'Sriwijaya', 'correct' => 'B'],
                ]
            ],
            [
                'title' => 'Geografi Global',
                'description' => 'Jelajahi benua, negara, dan keajaiban alam bumi.',
                'category' => 'Geografi',
                'questions' => [
                    ['q' => 'Gunung tertinggi di dunia adalah...', 'a' => 'Gunung Kilimanjaro', 'b' => 'Gunung Everest', 'c' => 'Gunung Fuji', 'd' => 'Gunung Elbrus', 'correct' => 'B'],
                    ['q' => 'Benua terkecil di dunia adalah...', 'a' => 'Eropa', 'b' => 'Antartika', 'c' => 'Australia', 'd' => 'Amerika Selatan', 'correct' => 'C'],
                    ['q' => 'Ibukota negara Jepang adalah...', 'a' => 'Kyoto', 'b' => 'Osaka', 'c' => 'Tokyo', 'd' => 'Seoul', 'correct' => 'C'],
                    ['q' => 'Sungai terpanjang di dunia adalah...', 'a' => 'Sungai Amazon', 'b' => 'Sungai Nil', 'c' => 'Sungai Kapuas', 'd' => 'Sungai Mississippi', 'correct' => 'B'],
                    ['q' => 'Gurun pasir terbesar di dunia adalah...', 'a' => 'Gurun Gobi', 'b' => 'Gurun Sahara', 'c' => 'Gurun Kalahari', 'd' => 'Gurun Atacama', 'correct' => 'B'],
                ]
            ],
            [
                'title' => 'Olahraga Internasional',
                'description' => 'Seberapa tahukah kamu tentang dunia olahraga?',
                'category' => 'Olahraga',
                'questions' => [
                    ['q' => 'Olimpiade Musim Panas 2020 diadakan di kota...', 'a' => 'London', 'b' => 'Rio de Janeiro', 'c' => 'Tokyo', 'd' => 'Paris', 'correct' => 'C'],
                    ['q' => 'Induk organisasi sepak bola dunia adalah...', 'a' => 'FIBA', 'b' => 'BWF', 'c' => 'FIFA', 'd' => 'IAAF', 'correct' => 'C'],
                    ['q' => 'Berapa jumlah pemain dalam satu tim bola basket yang berada di lapangan?', 'a' => '5', 'b' => '6', 'c' => '9', 'd' => '11', 'correct' => 'A'],
                    ['q' => 'Olahraga yang menggunakan raket dan *shuttlecock* adalah...', 'a' => 'Tenis', 'b' => 'Bulu Tangkis', 'c' => 'Squash', 'd' => 'Ping Pong', 'correct' => 'B'],
                    ['q' => 'Lari maraton memiliki jarak tempuh resmi sepanjang...', 'a' => '10 km', 'b' => '21.1 km', 'c' => '42.195 km', 'd' => '50 km', 'correct' => 'C'],
                ]
            ],
            [
                'title' => 'Kuliner Nusantara',
                'description' => 'Kuis menggiurkan tentang makanan khas Indonesia.',
                'category' => 'Kuliner',
                'questions' => [
                    ['q' => 'Rendang adalah makanan khas dari daerah...', 'a' => 'Jawa Barat', 'b' => 'Sumatera Barat', 'c' => 'Sumatera Utara', 'd' => 'Bali', 'correct' => 'B'],
                    ['q' => 'Bahan dasar utama dalam pembuatan tempe adalah...', 'a' => 'Kacang Hijau', 'b' => 'Kacang Merah', 'c' => 'Kacang Tanah', 'd' => 'Kacang Kedelai', 'correct' => 'D'],
                    ['q' => 'Gudeg adalah makanan khas dari...', 'a' => 'Solo', 'b' => 'Yogyakarta', 'c' => 'Semarang', 'd' => 'Surabaya', 'correct' => 'B'],
                    ['q' => 'Soto Betawi identik dengan penggunaan kuah yang terbuat dari...', 'a' => 'Santan / Susu', 'b' => 'Kecap', 'c' => 'Kacang', 'd' => 'Asam', 'correct' => 'A'],
                    ['q' => 'Pempek adalah makanan khas yang berasal dari kota...', 'a' => 'Medan', 'b' => 'Padang', 'c' => 'Palembang', 'd' => 'Bangka', 'correct' => 'C'],
                ]
            ],
            [
                'title' => 'Film dan Hiburan',
                'description' => 'Tebak film, aktor, dan pop culture populer.',
                'category' => 'Hiburan',
                'questions' => [
                    ['q' => 'Siapakah aktor yang memerankan tokoh Iron Man di Marvel Cinematic Universe?', 'a' => 'Chris Evans', 'b' => 'Chris Hemsworth', 'c' => 'Robert Downey Jr.', 'd' => 'Tom Holland', 'correct' => 'C'],
                    ['q' => 'Film animasi dengan tokoh utama ikan badut yang hilang bernama...', 'a' => 'Shark Tale', 'b' => 'Finding Nemo', 'c' => 'The Little Mermaid', 'd' => 'Moana', 'correct' => 'B'],
                    ['q' => 'Sutradara film "Avatar" dan "Titanic" adalah...', 'a' => 'Steven Spielberg', 'b' => 'Christopher Nolan', 'c' => 'James Cameron', 'd' => 'Quentin Tarantino', 'correct' => 'C'],
                    ['q' => 'Tokoh fiksi detektif terkenal ciptaan Sir Arthur Conan Doyle adalah...', 'a' => 'Hercule Poirot', 'b' => 'Sherlock Holmes', 'c' => 'James Bond', 'd' => 'Batman', 'correct' => 'B'],
                    ['q' => 'Dalam film "Harry Potter", asrama Harry di Hogwarts adalah...', 'a' => 'Slytherin', 'b' => 'Hufflepuff', 'c' => 'Ravenclaw', 'd' => 'Gryffindor', 'correct' => 'D'],
                ]
            ],
            [
                'title' => 'Seni dan Budaya',
                'description' => 'Mengenal karya seni dan budaya dari seluruh dunia.',
                'category' => 'Seni',
                'questions' => [
                    ['q' => 'Lukisan legendaris "Monalisa" adalah karya dari...', 'a' => 'Vincent van Gogh', 'b' => 'Pablo Picasso', 'c' => 'Leonardo da Vinci', 'd' => 'Michelangelo', 'correct' => 'C'],
                    ['q' => 'Tari Kecak merupakan tarian tradisional yang berasal dari...', 'a' => 'Jawa Timur', 'b' => 'Kalimantan', 'c' => 'Papua', 'd' => 'Bali', 'correct' => 'D'],
                    ['q' => 'Alat musik tradisional Sasando berasal dari daerah...', 'a' => 'Jawa Barat', 'b' => 'Nusa Tenggara Timur', 'c' => 'Sulawesi Selatan', 'd' => 'Maluku', 'correct' => 'B'],
                    ['q' => 'Kain tradisional Indonesia yang pembuatannya menggunakan lilin/malam disebut...', 'a' => 'Ulos', 'b' => 'Songket', 'c' => 'Batik', 'd' => 'Tenun Ikat', 'correct' => 'C'],
                    ['q' => 'Pencipta lagu kebangsaan "Indonesia Raya" adalah...', 'a' => 'Ismail Marzuki', 'b' => 'W.R. Supratman', 'c' => 'Cornel Simanjuntak', 'd' => 'Ibu Sud', 'correct' => 'B'],
                ]
            ],
            [
                'title' => 'Otomotif & Kendaraan',
                'description' => 'Uji wawasanmu seputar mobil, motor, dan dunia otomotif.',
                'category' => 'Otomotif',
                'questions' => [
                    ['q' => 'Perusahaan mobil Ferrari berasal dari negara...', 'a' => 'Jerman', 'b' => 'Prancis', 'c' => 'Italia', 'd' => 'Amerika Serikat', 'correct' => 'C'],
                    ['q' => 'Singkatan dari RPM pada panel instrumen kendaraan adalah...', 'a' => 'Revolutions Per Minute', 'b' => 'Rotations Per Meter', 'c' => 'Racing Power Mode', 'd' => 'Runs Per Mile', 'correct' => 'A'],
                    ['q' => 'Sistem rem yang mencegah roda terkunci saat pengereman mendadak disebut...', 'a' => 'EBD', 'b' => 'ABS', 'c' => 'TCS', 'd' => 'ESP', 'correct' => 'B'],
                    ['q' => 'Merek motor asal Jepang yang identik dengan warna hijau adalah...', 'a' => 'Honda', 'b' => 'Yamaha', 'c' => 'Suzuki', 'd' => 'Kawasaki', 'correct' => 'D'],
                    ['q' => 'Jenis bahan bakar diesel di Indonesia umumnya dikenal dengan nama...', 'a' => 'Pertalite', 'b' => 'Pertamax', 'c' => 'Solar', 'd' => 'Premium', 'correct' => 'C'],
                ]
            ],
            [
                'title' => 'Bahasa & Sastra',
                'description' => 'Berapa luas perbendaharaan kata dan sastranya?',
                'category' => 'Bahasa',
                'questions' => [
                    ['q' => 'Kata ganti orang pertama tunggal dalam bahasa Inggris adalah...', 'a' => 'He', 'b' => 'You', 'c' => 'I', 'd' => 'They', 'correct' => 'C'],
                    ['q' => 'Antonim (lawan kata) dari kata "Asli" adalah...', 'a' => 'Tulen', 'b' => 'Palsu', 'c' => 'Ori', 'd' => 'Murni', 'correct' => 'B'],
                    ['q' => 'Puisi lama yang terdiri dari empat baris bersajak a-b-a-b disebut...', 'a' => 'Gurindam', 'b' => 'Karmina', 'c' => 'Pantun', 'd' => 'Syair', 'correct' => 'C'],
                    ['q' => 'Kumpulan cerita rakyat yang tokohnya adalah hewan yang berperilaku seperti manusia disebut...', 'a' => 'Fabel', 'b' => 'Legenda', 'c' => 'Mite', 'd' => 'Sage', 'correct' => 'A'],
                    ['q' => 'Novel legendaris "Laskar Pelangi" ditulis oleh...', 'a' => 'Raditya Dika', 'b' => 'Andrea Hirata', 'c' => 'Tere Liye', 'd' => 'Pramoedya Ananta Toer', 'correct' => 'B'],
                ]
            ],
            [
                'title' => 'Kesehatan & Biologi Tubuh',
                'description' => 'Kenali lebih dalam tentang anatomi dan kesehatan tubuh.',
                'category' => 'Kesehatan',
                'questions' => [
                    ['q' => 'Organ tubuh manusia yang berfungsi memompa darah adalah...', 'a' => 'Paru-paru', 'b' => 'Hati', 'c' => 'Jantung', 'd' => 'Ginjal', 'correct' => 'C'],
                    ['q' => 'Vitamin yang banyak terdapat pada buah jeruk dan baik untuk daya tahan tubuh adalah...', 'a' => 'Vitamin A', 'b' => 'Vitamin B', 'c' => 'Vitamin C', 'd' => 'Vitamin D', 'correct' => 'C'],
                    ['q' => 'Penyakit Demam Berdarah ditularkan melalui gigitan nyamuk...', 'a' => 'Anopheles', 'b' => 'Culex', 'c' => 'Aedes aegypti', 'd' => 'Mansonia', 'correct' => 'C'],
                    ['q' => 'Tulang terbesar dan terpanjang pada tubuh manusia adalah...', 'a' => 'Tulang paha (femur)', 'b' => 'Tulang kering', 'c' => 'Tulang lengan atas', 'd' => 'Tulang belakang', 'correct' => 'A'],
                    ['q' => 'Golongan darah universal yang dapat mendonorkan darahnya ke semua golongan darah adalah...', 'a' => 'A', 'b' => 'B', 'c' => 'AB', 'd' => 'O', 'correct' => 'D'],
                ]
            ],
            [
                'title' => 'Pengetahuan Umum (Campuran)',
                'description' => 'Kuis gado-gado untuk menguji seberapa luas wawasanmu!',
                'category' => 'Umum',
                'questions' => [
                    ['q' => 'Mata uang negara Jepang adalah...', 'a' => 'Won', 'b' => 'Yen', 'c' => 'Yuan', 'd' => 'Ringgit', 'correct' => 'B'],
                    ['q' => 'Hewan mamalia terbesar di dunia saat ini adalah...', 'a' => 'Gajah Afrika', 'b' => 'Paus Biru', 'c' => 'Hiu Paus', 'd' => 'Jerapah', 'correct' => 'B'],
                    ['q' => 'Pohon bambu diklasifikasikan ke dalam keluarga...', 'a' => 'Pohon Kayu', 'b' => 'Rumput-rumputan', 'c' => 'Semak Berduri', 'd' => 'Paku-pakuan', 'correct' => 'B'],
                    ['q' => 'Di manakah letak Menara Eiffel?', 'a' => 'Roma', 'b' => 'Berlin', 'c' => 'London', 'd' => 'Paris', 'correct' => 'D'],
                    ['q' => 'Warna bendera PBB (Perserikatan Bangsa-Bangsa) didominasi oleh warna...', 'a' => 'Merah dan Putih', 'b' => 'Biru Muda dan Putih', 'c' => 'Hijau dan Kuning', 'd' => 'Hitam dan Putih', 'correct' => 'B'],
                ]
            ],
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
            }
        }
    }
}

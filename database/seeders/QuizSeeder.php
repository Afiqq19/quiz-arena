<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        $quiz = Quiz::create([
            'title' => 'Kuis Pengetahuan Umum & Sejarah Indonesia',
            'description' => 'Uji wawasan kebangsaan, sejarah pahlawan, dan pengetahuan alammu di kuis interaktif ini!',
            'category' => 'Sejarah & Umum',
            'created_by' => $admin->id,
        ]);

        $questions = [
            // Sejarah & Pahlawan
            [
                'q' => 'Siapakah pahlawan nasional dari Maluku yang memimpin perlawanan melawan Belanda pada tahun 1817?',
                'a' => 'Tuanku Imam Bonjol', 'b' => 'Pangeran Diponegoro', 'c' => 'Kapitan Pattimura', 'd' => 'Teuku Umar',
                'correct' => 'C'
            ],
            [
                'q' => 'Peristiwa Rengasdengklok terjadi pada tanggal...',
                'a' => '14 Agustus 1945', 'b' => '15 Agustus 1945', 'c' => '16 Agustus 1945', 'd' => '17 Agustus 1945',
                'correct' => 'C'
            ],
            [
                'q' => 'Siapa tokoh pahlawan wanita yang memperjuangkan emansipasi wanita Indonesia?',
                'a' => 'Cut Nyak Dien', 'b' => 'Martha Christina Tiahahu', 'c' => 'R.A. Kartini', 'd' => 'Dewi Sartika',
                'correct' => 'C'
            ],
            [
                'q' => 'Jenderal Besar yang memimpin perang gerilya saat Agresi Militer Belanda I dan II adalah...',
                'a' => 'Jenderal Soedirman', 'b' => 'Jenderal A.H. Nasution', 'c' => 'Jenderal Gatot Soebroto', 'd' => 'Jenderal Ahmad Yani',
                'correct' => 'A'
            ],
            [
                'q' => 'Organisasi pergerakan nasional pertama di Indonesia yang didirikan pada 20 Mei 1908 adalah...',
                'a' => 'Sarekat Islam', 'b' => 'Indische Partij', 'c' => 'Budi Utomo', 'd' => 'Perhimpunan Indonesia',
                'correct' => 'C'
            ],
            [
                'q' => 'Pahlawan yang dikenal dengan julukan "Bapak Pendidikan Nasional" adalah...',
                'a' => 'Soetomo', 'b' => 'Ki Hajar Dewantara', 'c' => 'Wahid Hasyim', 'd' => 'Cipto Mangunkusumo',
                'correct' => 'B'
            ],
            [
                'q' => 'Teks Proklamasi Kemerdekaan Indonesia diketik oleh...',
                'a' => 'Soekarno', 'b' => 'Mohammad Hatta', 'c' => 'Sayuti Melik', 'd' => 'Sutan Sjahrir',
                'correct' => 'C'
            ],
            [
                'q' => 'Siapakah Pahlawan Nasional yang memimpin perlawanan rakyat Bali dalam Puputan Margarana?',
                'a' => 'I Gusti Ngurah Rai', 'b' => 'I Gusti Ketut Jelantik', 'c' => 'Ida Anak Agung Gde Agung', 'd' => 'Untung Surapati',
                'correct' => 'A'
            ],

            // Geografi & Alam
            [
                'q' => 'Danau vulkanik terbesar di Indonesia dan Asia Tenggara adalah...',
                'a' => 'Danau Batur', 'b' => 'Danau Toba', 'c' => 'Danau Singkarak', 'd' => 'Danau Poso',
                'correct' => 'B'
            ],
            [
                'q' => 'Gunung tertinggi di Indonesia yang puncaknya tertutup salju abadi adalah...',
                'a' => 'Gunung Kerinci', 'b' => 'Gunung Rinjani', 'c' => 'Puncak Jaya (Cartstensz Pyramid)', 'd' => 'Gunung Semeru',
                'correct' => 'C'
            ],
            [
                'q' => 'Hewan endemik Indonesia yang merupakan kadal terbesar di dunia adalah...',
                'a' => 'Biawak', 'b' => 'Komodo', 'c' => 'Iguana', 'd' => 'Bunglon',
                'correct' => 'B'
            ],
            [
                'q' => 'Garis khayal yang membagi flora dan fauna Indonesia menjadi wilayah Asiatis dan Australis adalah...',
                'a' => 'Garis Khatulistiwa', 'b' => 'Garis Weber', 'c' => 'Garis Wallace', 'd' => 'Garis Bujur',
                'correct' => 'C'
            ],
            [
                'q' => 'Pulau terpadat di Indonesia adalah pulau...',
                'a' => 'Sumatera', 'b' => 'Kalimantan', 'c' => 'Jawa', 'd' => 'Sulawesi',
                'correct' => 'C'
            ],
            [
                'q' => 'Flora langka endemik Indonesia yang memiliki bau menyengat dan ukuran raksasa adalah...',
                'a' => 'Anggrek Hitam', 'b' => 'Bunga Bangkai (Amorphophallus titanum)', 'c' => 'Melati', 'd' => 'Kantong Semar',
                'correct' => 'B'
            ],

            // Pengetahuan Umum
            [
                'q' => 'Lagu kebangsaan Indonesia Raya diciptakan oleh...',
                'a' => 'W.R. Supratman', 'b' => 'Ismail Marzuki', 'c' => 'Ibu Sud', 'd' => 'Kusbini',
                'correct' => 'A'
            ],
            [
                'q' => 'Berapa jumlah provinsi di Indonesia saat ini (per 2024)?',
                'a' => '33 Provinsi', 'b' => '34 Provinsi', 'c' => '37 Provinsi', 'd' => '38 Provinsi',
                'correct' => 'D'
            ],
            [
                'q' => 'Sila ke-3 Pancasila dilambangkan dengan...',
                'a' => 'Bintang', 'b' => 'Rantai', 'c' => 'Pohon Beringin', 'd' => 'Padi dan Kapas',
                'correct' => 'C'
            ],
            [
                'q' => 'Candi Borobudur yang merupakan candi Buddha terbesar di dunia terletak di provinsi...',
                'a' => 'Daerah Istimewa Yogyakarta', 'b' => 'Jawa Tengah', 'c' => 'Jawa Timur', 'd' => 'Bali',
                'correct' => 'B'
            ],
            [
                'q' => 'Ibu kota negara Indonesia yang baru (IKN) direncanakan berada di pulau...',
                'a' => 'Kalimantan', 'b' => 'Sumatera', 'c' => 'Sulawesi', 'd' => 'Papua',
                'correct' => 'A'
            ],
            [
                'q' => 'Mata uang resmi negara Indonesia adalah...',
                'a' => 'Ringgit', 'b' => 'Baht', 'c' => 'Rupiah', 'd' => 'Peso',
                'correct' => 'C'
            ],
        ];

        foreach ($questions as $q) {
            Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $q['q'],
                'option_a' => $q['a'],
                'option_b' => $q['b'],
                'option_c' => $q['c'],
                'option_d' => $q['d'],
                'correct_option' => $q['correct'],
                'timer_seconds' => 30, // 30 seconds per question
            ]);
        }
    }
}

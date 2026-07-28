<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;

class ExtraQuizzesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) return;

        $quizzes = [
            [
                'title' => 'Psikologi Dasar',
                'description' => 'Berapa banyak yang kamu ketahui tentang cara kerja pikiran manusia?',
                'category' => 'Psikologi',
                'questions' => [
                    ['q' => 'Ilmuwan psikologi yang terkenal dengan teori psikoanalisis adalah...', 'a' => 'B.F. Skinner', 'b' => 'Carl Jung', 'c' => 'Sigmund Freud', 'd' => 'Ivan Pavlov', 'correct' => 'C'],
                    ['q' => 'Eksperimen anjing berliur saat mendengar bel (Classical Conditioning) dilakukan oleh...', 'a' => 'Ivan Pavlov', 'b' => 'John B. Watson', 'c' => 'Albert Bandura', 'd' => 'Jean Piaget', 'correct' => 'A'],
                    ['q' => 'Ketakutan berlebihan terhadap ruang sempit atau tertutup disebut...', 'a' => 'Agorafobia', 'b' => 'Klaustrofobia', 'c' => 'Arakhnofobia', 'd' => 'Akrofobia', 'correct' => 'B'],
                    ['q' => 'Tingkatan tertinggi dalam hierarki kebutuhan Maslow adalah...', 'a' => 'Kebutuhan Rasa Aman', 'b' => 'Harga Diri', 'c' => 'Aktualisasi Diri', 'd' => 'Kasih Sayang', 'correct' => 'C'],
                    ['q' => 'Kepribadian yang cenderung lebih suka menyendiri dan mengisi energi dari dalam diri disebut...', 'a' => 'Ekstrovert', 'b' => 'Ambivert', 'c' => 'Omnivert', 'd' => 'Introvert', 'correct' => 'D'],
                    ['q' => 'Mimpi terjadi pada fase tidur yang disebut...', 'a' => 'NREM', 'b' => 'REM', 'c' => 'Deep Sleep', 'd' => 'Alpha Stage', 'correct' => 'B'],
                    ['q' => 'Gangguan kejiwaan di mana penderitanya memiliki kepribadian ganda disebut...', 'a' => 'Bipolar', 'b' => 'Skizofrenia', 'c' => 'DID (Dissociative Identity Disorder)', 'd' => 'OCD', 'correct' => 'C'],
                    ['q' => 'Tes bercak tinta yang digunakan untuk analisis psikologis disebut tes...', 'a' => 'MBTI', 'b' => 'Rorschach', 'c' => 'TAT', 'd' => 'MMPI', 'correct' => 'B'],
                    ['q' => 'IQ rata-rata populasi manusia normal berada di angka...', 'a' => '70 - 85', 'b' => '90 - 109', 'c' => '115 - 130', 'd' => '130+', 'correct' => 'B'],
                    ['q' => 'Bapak Psikologi Modern yang mendirikan laboratorium psikologi pertama adalah...', 'a' => 'Wilhelm Wundt', 'b' => 'William James', 'c' => 'Sigmund Freud', 'd' => 'Carl Rogers', 'correct' => 'A'],
                ]
            ],
            [
                'title' => 'Mitologi Yunani & Nordik',
                'description' => 'Uji pengetahuanmu tentang dewa-dewi kuno dari Gunung Olympus hingga Asgard.',
                'category' => 'Sejarah',
                'questions' => [
                    ['q' => 'Dewa petir dan raja para dewa dalam mitologi Yunani adalah...', 'a' => 'Hades', 'b' => 'Poseidon', 'c' => 'Ares', 'd' => 'Zeus', 'correct' => 'D'],
                    ['q' => 'Dewi kebijaksanaan dan strategi perang dalam mitologi Yunani adalah...', 'a' => 'Aphrodite', 'b' => 'Athena', 'c' => 'Hera', 'd' => 'Artemis', 'correct' => 'B'],
                    ['q' => 'Senjata ikonik milik dewa Thor (mitologi Nordik) bernama...', 'a' => 'Gungnir', 'b' => 'Excalibur', 'c' => 'Mjolnir', 'd' => 'Trisula', 'correct' => 'C'],
                    ['q' => 'Pohon kehidupan dunia dalam mitologi Nordik disebut...', 'a' => 'Yggdrasil', 'b' => 'Bifrost', 'c' => 'Valhalla', 'd' => 'Asgard', 'correct' => 'A'],
                    ['q' => 'Monster laut berkepala banyak yang dilawan Hercules adalah...', 'a' => 'Medusa', 'b' => 'Cerberus', 'c' => 'Hydra', 'd' => 'Minotaur', 'correct' => 'C'],
                    ['q' => 'Dewa kelicikan dan penipuan (God of Mischief) di Asgard adalah...', 'a' => 'Odin', 'b' => 'Baldur', 'c' => 'Loki', 'd' => 'Heimdall', 'correct' => 'C'],
                    ['q' => 'Anjing berkepala tiga penjaga gerbang dunia bawah (Underworld) adalah...', 'a' => 'Fenrir', 'b' => 'Cerberus', 'c' => 'Orthrus', 'd' => 'Chimera', 'correct' => 'B'],
                    ['q' => 'Siapakah pahlawan Yunani yang memiliki kelemahan di tumitnya?', 'a' => 'Perseus', 'b' => 'Theseus', 'c' => 'Hercules', 'd' => 'Achilles', 'correct' => 'D'],
                    ['q' => 'Dewa penguasa dunia bawah dalam mitologi Yunani adalah...', 'a' => 'Ares', 'b' => 'Hades', 'c' => 'Apollo', 'd' => 'Hermes', 'correct' => 'B'],
                    ['q' => 'Pertarungan akhir para dewa di mitologi Nordik (Hari Kiamat) disebut...', 'a' => 'Ragnarok', 'b' => 'Titanomachy', 'c' => 'Armageddon', 'd' => 'Apocalypse', 'correct' => 'A'],
                ]
            ],
            [
                'title' => 'Ekonomi & Bisnis',
                'description' => 'Seberapa jauh wawasanmu tentang saham, uang, dan ekonomi dunia?',
                'category' => 'Umum',
                'questions' => [
                    ['q' => 'Istilah untuk kenaikan harga barang dan jasa secara umum dan terus menerus adalah...', 'a' => 'Deflasi', 'b' => 'Resesi', 'c' => 'Inflasi', 'd' => 'Devaluasi', 'correct' => 'C'],
                    ['q' => 'Pasar di mana hanya terdapat satu penjual yang menguasai disebut...', 'a' => 'Oligopoli', 'b' => 'Monopoli', 'c' => 'Monopsoni', 'd' => 'Pasar Bebas', 'correct' => 'B'],
                    ['q' => 'Mata uang yang digunakan oleh negara-negara di Uni Eropa adalah...', 'a' => 'Poundsterling', 'b' => 'Dolar', 'c' => 'Franc', 'd' => 'Euro', 'correct' => 'D'],
                    ['q' => 'Kegiatan membeli barang dari luar negeri ke dalam negeri disebut...', 'a' => 'Ekspor', 'b' => 'Impor', 'c' => 'Distribusi', 'd' => 'Produksi', 'correct' => 'B'],
                    ['q' => 'Bank Sentral Republik Indonesia adalah...', 'a' => 'Bank Mandiri', 'b' => 'Bank Rakyat Indonesia (BRI)', 'c' => 'Bank Indonesia (BI)', 'd' => 'BCA', 'correct' => 'C'],
                    ['q' => 'Orang yang menanamkan modal (uang) pada sebuah perusahaan disebut...', 'a' => 'Kreditor', 'b' => 'Debitor', 'c' => 'Investor', 'd' => 'Kolektor', 'correct' => 'C'],
                    ['q' => 'Bapak Ilmu Ekonomi yang menulis buku "The Wealth of Nations" adalah...', 'a' => 'Karl Marx', 'b' => 'Adam Smith', 'c' => 'John Maynard Keynes', 'd' => 'David Ricardo', 'correct' => 'B'],
                    ['q' => 'Keuntungan yang dibagikan oleh perusahaan kepada pemegang saham disebut...', 'a' => 'Capital Gain', 'b' => 'Bunga', 'c' => 'Pajak', 'd' => 'Dividen', 'correct' => 'D'],
                    ['q' => 'Surat utang yang diterbitkan oleh negara atau perusahaan disebut...', 'a' => 'Saham', 'b' => 'Obligasi', 'c' => 'Deposito', 'd' => 'Reksadana', 'correct' => 'B'],
                    ['q' => 'Singkatan dari PDB adalah...', 'a' => 'Produk Domestik Bruto', 'b' => 'Pendapatan Daerah Bersih', 'c' => 'Pajak Dasar Bangunan', 'd' => 'Penghasilan Domestik Bulanan', 'correct' => 'A'],
                ]
            ],
            [
                'title' => 'Flora & Fauna Endemik Indonesia',
                'description' => 'Mari kenali kekayaan alam hewani dan nabati asli dari Nusantara.',
                'category' => 'Sains (IPA)',
                'questions' => [
                    ['q' => 'Hewan endemik purba yang hanya ada di Nusa Tenggara Timur adalah...', 'a' => 'Harimau Sumatera', 'b' => 'Komodo', 'c' => 'Badak Bercula Satu', 'd' => 'Orangutan', 'correct' => 'B'],
                    ['q' => 'Burung Cendrawasih yang terkenal dengan julukan "Bird of Paradise" berasal dari...', 'a' => 'Kalimantan', 'b' => 'Sulawesi', 'c' => 'Maluku', 'd' => 'Papua', 'correct' => 'D'],
                    ['q' => 'Bunga bangkai raksasa endemik Sumatera memiliki nama latin...', 'a' => 'Rafflesia arnoldii', 'b' => 'Amorphophallus titanum', 'c' => 'Nepenthes', 'd' => 'Jasminum sambac', 'correct' => 'B'],
                    ['q' => 'Garis khayal yang memisahkan fauna tipe Asiatis dan tipe Peralihan di Indonesia disebut...', 'a' => 'Garis Weber', 'b' => 'Garis Wallace', 'c' => 'Garis Khatulistiwa', 'd' => 'Garis Lintang', 'correct' => 'B'],
                    ['q' => 'Hewan marsupial (mamalia berkantung) khas Papua adalah...', 'a' => 'Koala', 'b' => 'Kangguru Pohon', 'c' => 'Tarsius', 'd' => 'Anoa', 'correct' => 'B'],
                    ['q' => 'Badak bercula satu merupakan hewan endemik yang dilindungi di Taman Nasional...', 'a' => 'Ujung Kulon', 'b' => 'Way Kambas', 'c' => 'Baluran', 'd' => 'Tanjung Puting', 'correct' => 'A'],
                    ['q' => 'Bunga nasional Indonesia (Puspa Bangsa) adalah...', 'a' => 'Bunga Anggrek Bulan', 'b' => 'Bunga Melati Putih', 'c' => 'Bunga Rafflesia', 'd' => 'Bunga Mawar', 'correct' => 'B'],
                    ['q' => 'Kera terkecil di dunia yang banyak ditemukan di Sulawesi Utara adalah...', 'a' => 'Bekantan', 'b' => 'Orangutan', 'c' => 'Tarsius', 'd' => 'Owa Jawa', 'correct' => 'C'],
                    ['q' => 'Kayu cendana yang sangat harum dulunya sangat berlimpah di provinsi...', 'a' => 'Nusa Tenggara Timur (NTT)', 'b' => 'Papua', 'c' => 'Kalimantan Barat', 'd' => 'Sumatera Selatan', 'correct' => 'A'],
                    ['q' => 'Pohon lontar banyak tumbuh dan dimanfaatkan oleh masyarakat di daerah...', 'a' => 'Jawa Barat', 'b' => 'Sumatera Utara', 'c' => 'Nusa Tenggara Timur', 'd' => 'Kalimantan Timur', 'correct' => 'C'],
                ]
            ],
            [
                'title' => 'Tebak Lagu & Musik Indonesia',
                'description' => 'Uji pengetahuanmu tentang lirik, musisi, dan sejarah musik Indonesia!',
                'category' => 'Hiburan',
                'questions' => [
                    ['q' => 'Lagu "Bengawan Solo" diciptakan oleh maestro kroncong bernama...', 'a' => 'Gesang', 'b' => 'Ismail Marzuki', 'c' => 'Waljinah', 'd' => 'W.R. Supratman', 'correct' => 'A'],
                    ['q' => 'Grup band legendaris Indonesia yang merilis lagu "Bento" dan "Bongkar" adalah...', 'a' => 'Slank', 'b' => 'Dewa 19', 'c' => 'Iwan Fals (Swami)', 'd' => 'Gigi', 'correct' => 'C'],
                    ['q' => 'Penyanyi yang mendapat julukan "Bapak Campursari Indonesia" adalah...', 'a' => 'Didi Kempot', 'b' => 'Manthous', 'c' => 'Denny Caknan', 'd' => 'Waldjinah', 'correct' => 'B'],
                    ['q' => 'Vokalis pertama grup band Dewa 19 adalah...', 'a' => 'Once Mekel', 'b' => 'Ari Lasso', 'c' => 'Ahmad Dhani', 'd' => 'Virzha', 'correct' => 'B'],
                    ['q' => 'Lagu daerah "Yamko Rambe Yamko" berasal dari provinsi...', 'a' => 'Maluku', 'b' => 'Nusa Tenggara Timur', 'c' => 'Papua', 'd' => 'Sulawesi Utara', 'correct' => 'C'],
                    ['q' => 'Alat musik bambu tradisional Jawa Barat yang dimainkan dengan cara digoyangkan adalah...', 'a' => 'Saluang', 'b' => 'Angklung', 'c' => 'Kolintang', 'd' => 'Calung', 'correct' => 'B'],
                    ['q' => 'Penyanyi wanita Indonesia yang berhasil merintis karir internasional dengan lagu "Snow on the Sahara" adalah...', 'a' => 'Agnez Mo', 'b' => 'Anggun C. Sasmi', 'c' => 'NIKI', 'd' => 'Marion Jola', 'correct' => 'B'],
                    ['q' => 'Lirik lagu "... tak kan lekang oleh waktu ..." merupakan bagian dari lagu milik grup band...', 'a' => 'Noah (Peterpan)', 'b' => 'Sheila On 7', 'c' => 'Dewa 19', 'd' => 'Kerispatih', 'correct' => 'D'],
                    ['q' => 'Genre musik Dangdut merupakan perpaduan antara musik lokal dengan unsur musik...', 'a' => 'Hindustan (India) dan Arab', 'b' => 'Eropa dan Amerika', 'c' => 'Salsa dan Samba', 'd' => 'Reggae dan Ska', 'correct' => 'A'],
                    ['q' => 'Lagu anak-anak "Pelangi-Pelangi" diciptakan oleh...', 'a' => 'Pak Kasur', 'b' => 'Ibu Sud', 'c' => 'A.T. Mahmud', 'd' => 'Papa T. Bob', 'correct' => 'C'],
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

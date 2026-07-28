<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;

class FinalQuizzesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) return;

        $quizzes = [
            [
                'title' => 'Sejarah Kemerdekaan Indonesia',
                'description' => 'Uji pengetahuanmu tentang sejarah perjuangan bangsa Indonesia secara mendalam (20 Soal Eksklusif).',
                'category' => 'Sejarah',
                'questions' => [
                    ['q' => 'Teks Proklamasi Kemerdekaan RI dirumuskan di rumah...', 'a' => 'Soekarno', 'b' => 'Mohammad Hatta', 'c' => 'Laksamana Maeda', 'd' => 'Ahmad Soebardjo', 'correct' => 'C'],
                    ['q' => 'Kapan teks proklamasi dibacakan?', 'a' => '17 Agustus 1945, 08:00', 'b' => '17 Agustus 1945, 10:00', 'c' => '18 Agustus 1945, 10:00', 'd' => '16 Agustus 1945, 12:00', 'correct' => 'B'],
                    ['q' => 'Siapa penjahit bendera Sang Saka Merah Putih?', 'a' => 'Kartini', 'b' => 'Cut Nyak Dien', 'c' => 'Fatmawati', 'd' => 'Megawati', 'correct' => 'C'],
                    ['q' => 'Peristiwa penculikan Soekarno-Hatta ke Rengasdengklok terjadi pada tanggal...', 'a' => '14 Agustus 1945', 'b' => '15 Agustus 1945', 'c' => '16 Agustus 1945', 'd' => '17 Agustus 1945', 'correct' => 'C'],
                    ['q' => 'BPUPKI dibentuk pada tanggal...', 'a' => '1 Maret 1945', 'b' => '29 April 1945', 'c' => '1 Juni 1945', 'd' => '18 Agustus 1945', 'correct' => 'A'],
                    ['q' => 'Ketua BPUPKI adalah...', 'a' => 'Soekarno', 'b' => 'Moh. Hatta', 'c' => 'Radjiman Wedyodiningrat', 'd' => 'Sutan Syahrir', 'correct' => 'C'],
                    ['q' => 'Hari Lahir Pancasila diperingati setiap tanggal...', 'a' => '1 Juni', 'b' => '1 Oktober', 'c' => '10 November', 'd' => '17 Agustus', 'correct' => 'A'],
                    ['q' => 'Siapa tokoh yang mengetik teks proklamasi?', 'a' => 'Ahmad Soebardjo', 'b' => 'Sayuti Melik', 'c' => 'Sukarni', 'd' => 'B.M. Diah', 'correct' => 'B'],
                    ['q' => 'Organisasi pergerakan nasional pertama di Indonesia adalah...', 'a' => 'Sarekat Islam', 'b' => 'Budi Utomo', 'c' => 'Indische Partij', 'd' => 'Muhammadiyah', 'correct' => 'B'],
                    ['q' => 'Sumpah Pemuda dicetuskan pada tanggal...', 'a' => '28 Oktober 1928', 'b' => '20 Mei 1908', 'c' => '10 November 1945', 'd' => '17 Agustus 1945', 'correct' => 'A'],
                    ['q' => 'Siapa nama asli Kapitan Pattimura?', 'a' => 'Teuku Umar', 'b' => 'Tuanku Imam Bonjol', 'c' => 'Thomas Matulessy', 'd' => 'Pangeran Diponegoro', 'correct' => 'C'],
                    ['q' => 'Perang Puputan Margarana di Bali dipimpin oleh...', 'a' => 'I Gusti Ngurah Rai', 'b' => 'Pattimura', 'c' => 'Cut Nyak Meutia', 'd' => 'Hasanuddin', 'correct' => 'A'],
                    ['q' => 'Semboyan Bhinneka Tunggal Ika diambil dari kitab...', 'a' => 'Negarakertagama', 'b' => 'Sutasoma', 'c' => 'Pararaton', 'd' => 'Arjuna Wiwaha', 'correct' => 'B'],
                    ['q' => 'Siapa yang dikenal sebagai Bapak Pendidikan Nasional?', 'a' => 'Cipto Mangunkusumo', 'b' => 'Ki Hajar Dewantara', 'c' => 'Douwes Dekker', 'd' => 'Wahid Hasyim', 'correct' => 'B'],
                    ['q' => 'Jenderal Sudirman merupakan panglima besar pada masa...', 'a' => 'Revolusi Kemerdekaan', 'b' => 'Orde Lama', 'c' => 'Orde Baru', 'd' => 'Reformasi', 'correct' => 'A'],
                    ['q' => 'Tokoh yang mengibarkan bendera merah putih saat proklamasi adalah...', 'a' => 'Latief Hendraningrat & Suhud', 'b' => 'Sayuti Melik & Sukarni', 'c' => 'Soekarno & Hatta', 'd' => 'Ahmad Soebardjo & B.M. Diah', 'correct' => 'A'],
                    ['q' => 'Agresi Militer Belanda I terjadi pada tahun...', 'a' => '1945', 'b' => '1946', 'c' => '1947', 'd' => '1948', 'correct' => 'C'],
                    ['q' => 'Konferensi Meja Bundar (KMB) dilaksanakan di kota...', 'a' => 'Jakarta', 'b' => 'Yogyakarta', 'c' => 'Den Haag', 'd' => 'Amsterdam', 'correct' => 'C'],
                    ['q' => 'Hasil dari KMB adalah Belanda mengakui kedaulatan...', 'a' => 'Hindia Belanda', 'b' => 'Republik Indonesia Serikat (RIS)', 'c' => 'Republik Indonesia', 'd' => 'Nusantara', 'correct' => 'B'],
                    ['q' => 'Indonesia kembali menjadi Negara Kesatuan Republik Indonesia (NKRI) pada tahun...', 'a' => '1949', 'b' => '1950', 'c' => '1955', 'd' => '1965', 'correct' => 'B'],
                ]
            ],
            [
                'title' => 'Geografi Global Lanjutan',
                'description' => 'Jelajahi benua, negara, dan fenomena bumi (10 Soal).',
                'category' => 'Geografi',
                'questions' => [
                    ['q' => 'Gunung tertinggi di dunia adalah...', 'a' => 'Kilimanjaro', 'b' => 'Everest', 'c' => 'Fuji', 'd' => 'Elbrus', 'correct' => 'B'],
                    ['q' => 'Benua terkecil di dunia adalah...', 'a' => 'Eropa', 'b' => 'Antartika', 'c' => 'Australia', 'd' => 'Amerika Selatan', 'correct' => 'C'],
                    ['q' => 'Ibukota negara Jepang adalah...', 'a' => 'Kyoto', 'b' => 'Osaka', 'c' => 'Tokyo', 'd' => 'Seoul', 'correct' => 'C'],
                    ['q' => 'Sungai terpanjang di dunia adalah...', 'a' => 'Amazon', 'b' => 'Nil', 'c' => 'Kapuas', 'd' => 'Mississippi', 'correct' => 'B'],
                    ['q' => 'Gurun pasir terbesar di dunia adalah...', 'a' => 'Gobi', 'b' => 'Sahara', 'c' => 'Kalahari', 'd' => 'Atacama', 'correct' => 'B'],
                    ['q' => 'Negara terkecil di dunia adalah...', 'a' => 'Monako', 'b' => 'Singapura', 'c' => 'Vatikan', 'd' => 'Maladewa', 'correct' => 'C'],
                    ['q' => 'Samudra terluas di dunia adalah...', 'a' => 'Atlantik', 'b' => 'Hindia', 'c' => 'Pasifik', 'd' => 'Arktik', 'correct' => 'C'],
                    ['q' => 'Pegunungan Andes terletak di benua...', 'a' => 'Eropa', 'b' => 'Amerika Utara', 'c' => 'Amerika Selatan', 'd' => 'Asia', 'correct' => 'C'],
                    ['q' => 'Pulau terbesar di Indonesia adalah...', 'a' => 'Jawa', 'b' => 'Sumatera', 'c' => 'Sulawesi', 'd' => 'Kalimantan', 'correct' => 'D'],
                    ['q' => 'Danau terdalam di dunia adalah...', 'a' => 'Danau Toba', 'b' => 'Danau Victoria', 'c' => 'Danau Baikal', 'd' => 'Danau Superior', 'correct' => 'C'],
                ]
            ],
            [
                'title' => 'Olahraga Internasional',
                'description' => 'Seberapa tahukah kamu tentang dunia olahraga? (10 Soal)',
                'category' => 'Olahraga',
                'questions' => [
                    ['q' => 'Olimpiade Musim Panas 2024 diadakan di kota...', 'a' => 'London', 'b' => 'Rio de Janeiro', 'c' => 'Tokyo', 'd' => 'Paris', 'correct' => 'D'],
                    ['q' => 'Induk organisasi sepak bola dunia adalah...', 'a' => 'FIBA', 'b' => 'BWF', 'c' => 'FIFA', 'd' => 'IAAF', 'correct' => 'C'],
                    ['q' => 'Jumlah pemain satu tim bola basket adalah...', 'a' => '5', 'b' => '6', 'c' => '9', 'd' => '11', 'correct' => 'A'],
                    ['q' => 'Olahraga dengan *shuttlecock* adalah...', 'a' => 'Tenis', 'b' => 'Bulu Tangkis', 'c' => 'Squash', 'd' => 'Ping Pong', 'correct' => 'B'],
                    ['q' => 'Jarak lari maraton resmi adalah...', 'a' => '10 km', 'b' => '21.1 km', 'c' => '42.195 km', 'd' => '50 km', 'correct' => 'C'],
                    ['q' => 'Piala Dunia FIFA diadakan setiap...', 'a' => '2 tahun', 'b' => '3 tahun', 'c' => '4 tahun', 'd' => '5 tahun', 'correct' => 'C'],
                    ['q' => 'Senjata yang digunakan dalam olahraga anggar adalah...', 'a' => 'Pedang, tombak, panah', 'b' => 'Foil, epee, sabre', 'c' => 'Gada, tameng, pedang', 'd' => 'Pisau, belati, celurit', 'correct' => 'B'],
                    ['q' => 'Lionel Messi berasal dari negara...', 'a' => 'Portugal', 'b' => 'Brasil', 'c' => 'Spanyol', 'd' => 'Argentina', 'correct' => 'D'],
                    ['q' => 'Gaya renang tercepat adalah...', 'a' => 'Gaya dada', 'b' => 'Gaya punggung', 'c' => 'Gaya bebas', 'd' => 'Gaya kupu-kupu', 'correct' => 'C'],
                    ['q' => 'Waktu pertandingan sepak bola normal adalah...', 'a' => '2 x 45 menit', 'b' => '4 x 15 menit', 'c' => '2 x 30 menit', 'd' => '3 x 30 menit', 'correct' => 'A'],
                ]
            ],
            [
                'title' => 'Kuliner Nusantara Sejati',
                'description' => 'Kuis menggiurkan tentang makanan khas Indonesia (10 Soal).',
                'category' => 'Kuliner',
                'questions' => [
                    ['q' => 'Rendang berasal dari...', 'a' => 'Jawa Barat', 'b' => 'Sumatera Barat', 'c' => 'Sumatera Utara', 'd' => 'Bali', 'correct' => 'B'],
                    ['q' => 'Bahan dasar utama pembuatan tempe adalah...', 'a' => 'Kacang Hijau', 'b' => 'Kacang Merah', 'c' => 'Kacang Kedelai', 'd' => 'Kacang Tanah', 'correct' => 'C'],
                    ['q' => 'Gudeg adalah makanan khas dari...', 'a' => 'Solo', 'b' => 'Yogyakarta', 'c' => 'Semarang', 'd' => 'Surabaya', 'correct' => 'B'],
                    ['q' => 'Soto Betawi identik dengan kuah dari...', 'a' => 'Santan / Susu', 'b' => 'Kecap', 'c' => 'Kacang', 'd' => 'Asam', 'correct' => 'A'],
                    ['q' => 'Pempek adalah makanan khas...', 'a' => 'Medan', 'b' => 'Padang', 'c' => 'Palembang', 'd' => 'Bangka', 'correct' => 'C'],
                    ['q' => 'Rawon memiliki warna kuah hitam pekat yang berasal dari rempah bernama...', 'a' => 'Kemiri', 'b' => 'Kunyit', 'c' => 'Kluwek', 'd' => 'Lengkuas', 'correct' => 'C'],
                    ['q' => 'Bika Ambon adalah kue khas yang berasal dari kota...', 'a' => 'Ambon', 'b' => 'Makassar', 'c' => 'Manado', 'd' => 'Medan', 'correct' => 'D'],
                    ['q' => 'Ayam Taliwang terkenal dengan rasa pedasnya dan berasal dari...', 'a' => 'Lombok', 'b' => 'Bali', 'c' => 'Madura', 'd' => 'Banyuwangi', 'correct' => 'A'],
                    ['q' => 'Papeda, makanan pokok pengganti nasi dari Timur Indonesia terbuat dari...', 'a' => 'Singkong', 'b' => 'Jagung', 'c' => 'Sagu', 'd' => 'Ubi jalar', 'correct' => 'C'],
                    ['q' => 'Sambal Matah adalah sambal khas dari daerah...', 'a' => 'Jawa Timur', 'b' => 'Sunda', 'c' => 'Minahasa', 'd' => 'Bali', 'correct' => 'D'],
                ]
            ],
            [
                'title' => 'Film, Musik, & Hiburan',
                'description' => 'Tebak film, aktor, dan pop culture populer (10 Soal).',
                'category' => 'Hiburan',
                'questions' => [
                    ['q' => 'Aktor pemeran Iron Man di MCU adalah...', 'a' => 'Chris Evans', 'b' => 'Chris Hemsworth', 'c' => 'Robert Downey Jr.', 'd' => 'Tom Holland', 'correct' => 'C'],
                    ['q' => 'Film animasi tokoh ikan badut bernama...', 'a' => 'Shark Tale', 'b' => 'Finding Nemo', 'c' => 'The Little Mermaid', 'd' => 'Moana', 'correct' => 'B'],
                    ['q' => 'Sutradara "Avatar" dan "Titanic" adalah...', 'a' => 'Steven Spielberg', 'b' => 'Christopher Nolan', 'c' => 'James Cameron', 'd' => 'Quentin Tarantino', 'correct' => 'C'],
                    ['q' => 'Tokoh detektif ciptaan Arthur Conan Doyle...', 'a' => 'Hercule Poirot', 'b' => 'Sherlock Holmes', 'c' => 'James Bond', 'd' => 'Batman', 'correct' => 'B'],
                    ['q' => 'Asrama Harry Potter di Hogwarts adalah...', 'a' => 'Slytherin', 'b' => 'Hufflepuff', 'c' => 'Ravenclaw', 'd' => 'Gryffindor', 'correct' => 'D'],
                    ['q' => 'Band K-Pop yang memiliki basis penggemar "ARMY" adalah...', 'a' => 'EXO', 'b' => 'BLACKPINK', 'c' => 'BTS', 'd' => 'Seventeen', 'correct' => 'C'],
                    ['q' => 'Penghargaan tertinggi di industri film Hollywood adalah...', 'a' => 'Grammy', 'b' => 'Emmy', 'c' => 'Oscar (Academy Awards)', 'd' => 'Golden Globe', 'correct' => 'C'],
                    ['q' => 'Sistem sihir di dunia anime "Naruto" disebut...', 'a' => 'Ki', 'b' => 'Chakra', 'c' => 'Nen', 'd' => 'Mana', 'correct' => 'B'],
                    ['q' => 'Penyanyi lagu legendaris "Thriller" adalah...', 'a' => 'Elvis Presley', 'b' => 'Freddie Mercury', 'c' => 'Michael Jackson', 'd' => 'Prince', 'correct' => 'C'],
                    ['q' => 'Platform streaming film yang berlogo N merah adalah...', 'a' => 'Disney+', 'b' => 'Hulu', 'c' => 'Amazon Prime', 'd' => 'Netflix', 'correct' => 'D'],
                ]
            ],
            [
                'title' => 'Seni dan Budaya Dunia',
                'description' => 'Mengenal karya seni dan budaya dari seluruh dunia (10 Soal).',
                'category' => 'Seni',
                'questions' => [
                    ['q' => 'Lukisan "Monalisa" adalah karya...', 'a' => 'Vincent van Gogh', 'b' => 'Pablo Picasso', 'c' => 'Leonardo da Vinci', 'd' => 'Michelangelo', 'correct' => 'C'],
                    ['q' => 'Tari Kecak berasal dari...', 'a' => 'Jawa Timur', 'b' => 'Kalimantan', 'c' => 'Papua', 'd' => 'Bali', 'correct' => 'D'],
                    ['q' => 'Alat musik Sasando berasal dari...', 'a' => 'Jawa Barat', 'b' => 'Nusa Tenggara Timur', 'c' => 'Sulawesi Selatan', 'd' => 'Maluku', 'correct' => 'B'],
                    ['q' => 'Kain tradisional pembuatannya menggunakan lilin/malam...', 'a' => 'Ulos', 'b' => 'Songket', 'c' => 'Batik', 'd' => 'Tenun Ikat', 'correct' => 'C'],
                    ['q' => 'Pencipta "Indonesia Raya"...', 'a' => 'Ismail Marzuki', 'b' => 'W.R. Supratman', 'c' => 'Cornel Simanjuntak', 'd' => 'Ibu Sud', 'correct' => 'B'],
                    ['q' => 'Senjata tradisional dari Jawa Barat yang berbentuk melengkung adalah...', 'a' => 'Keris', 'b' => 'Kujang', 'c' => 'Mandau', 'd' => 'Badik', 'correct' => 'B'],
                    ['q' => 'Tari pendet biasa digunakan sebagai tarian...', 'a' => 'Penyambutan / Selamat Datang', 'b' => 'Perang', 'c' => 'Minta Hujan', 'd' => 'Panen', 'correct' => 'A'],
                    ['q' => 'Rumah adat suku Toraja yang atapnya menyerupai perahu disebut...', 'a' => 'Gadang', 'b' => 'Joglo', 'c' => 'Tongkonan', 'd' => 'Honai', 'correct' => 'C'],
                    ['q' => 'Lukisan "Starry Night" dilukis oleh...', 'a' => 'Leonardo da Vinci', 'b' => 'Claude Monet', 'c' => 'Vincent van Gogh', 'd' => 'Salvador Dali', 'correct' => 'C'],
                    ['q' => 'Seni melipat kertas dari Jepang disebut...', 'a' => 'Ikebana', 'b' => 'Origami', 'c' => 'Bonsai', 'd' => 'Haiku', 'correct' => 'B'],
                ]
            ],
            [
                'title' => 'Dunia Otomotif',
                'description' => 'Uji wawasanmu seputar mobil, motor, dan dunia mesin (10 Soal).',
                'category' => 'Otomotif',
                'questions' => [
                    ['q' => 'Ferrari berasal dari negara...', 'a' => 'Jerman', 'b' => 'Prancis', 'c' => 'Italia', 'd' => 'AS', 'correct' => 'C'],
                    ['q' => 'Singkatan RPM pada kendaraan...', 'a' => 'Revolutions Per Minute', 'b' => 'Rotations Per Meter', 'c' => 'Racing Power Mode', 'd' => 'Runs Per Mile', 'correct' => 'A'],
                    ['q' => 'Sistem rem mencegah roda terkunci...', 'a' => 'EBD', 'b' => 'ABS', 'c' => 'TCS', 'd' => 'ESP', 'correct' => 'B'],
                    ['q' => 'Merek motor identik warna hijau...', 'a' => 'Honda', 'b' => 'Yamaha', 'c' => 'Suzuki', 'd' => 'Kawasaki', 'correct' => 'D'],
                    ['q' => 'Bahan bakar diesel disebut...', 'a' => 'Pertalite', 'b' => 'Pertamax', 'c' => 'Solar', 'd' => 'Premium', 'correct' => 'C'],
                    ['q' => 'Ajang balap motor tertinggi di dunia adalah...', 'a' => 'Formula 1', 'b' => 'MotoGP', 'c' => 'WorldSBK', 'd' => 'NASCAR', 'correct' => 'B'],
                    ['q' => 'Komponen yang menghasilkan percikan api pada mesin bensin adalah...', 'a' => 'Koil', 'b' => 'Busi (Spark Plug)', 'c' => 'Piston', 'd' => 'Klep (Valve)', 'correct' => 'B'],
                    ['q' => 'Turbocharger pada mobil berfungsi untuk...', 'a' => 'Mendinginkan mesin', 'b' => 'Menghemat aki', 'c' => 'Memaksa udara masuk lebih banyak ke ruang bakar', 'd' => 'Memperbesar suara knalpot', 'correct' => 'C'],
                    ['q' => 'Mobil listrik yang sangat populer milik Elon Musk adalah merek...', 'a' => 'Rivian', 'b' => 'Lucid', 'c' => 'Tesla', 'd' => 'BYD', 'correct' => 'C'],
                    ['q' => 'SUV adalah singkatan dari...', 'a' => 'Super Utility Vehicle', 'b' => 'Sport Utility Vehicle', 'c' => 'Standard Urban Vehicle', 'd' => 'Sedan Utility Van', 'correct' => 'B'],
                ]
            ],
            [
                'title' => 'Bahasa & Kesusastraan',
                'description' => 'Berapa luas perbendaharaan kata dan sastranya? (10 Soal).',
                'category' => 'Bahasa',
                'questions' => [
                    ['q' => 'Kata ganti orang pertama tunggal Inggris...', 'a' => 'He', 'b' => 'You', 'c' => 'I', 'd' => 'They', 'correct' => 'C'],
                    ['q' => 'Antonim kata "Asli"...', 'a' => 'Tulen', 'b' => 'Palsu', 'c' => 'Ori', 'd' => 'Murni', 'correct' => 'B'],
                    ['q' => 'Puisi lama bersajak a-b-a-b...', 'a' => 'Gurindam', 'b' => 'Karmina', 'c' => 'Pantun', 'd' => 'Syair', 'correct' => 'C'],
                    ['q' => 'Cerita rakyat hewan...', 'a' => 'Fabel', 'b' => 'Legenda', 'c' => 'Mite', 'd' => 'Sage', 'correct' => 'A'],
                    ['q' => 'Penulis "Laskar Pelangi"...', 'a' => 'Raditya Dika', 'b' => 'Andrea Hirata', 'c' => 'Tere Liye', 'd' => 'Pramoedya A.T.', 'correct' => 'B'],
                    ['q' => 'Majas yang melebih-lebihkan suatu hal disebut...', 'a' => 'Metafora', 'b' => 'Hiperbola', 'c' => 'Personifikasi', 'd' => 'Litotes', 'correct' => 'B'],
                    ['q' => 'Sinonim dari kata "Cepat" adalah...', 'a' => 'Lambat', 'b' => 'Lama', 'c' => 'Lekas', 'd' => 'Ayun', 'correct' => 'C'],
                    ['q' => 'Bahasa resmi yang digunakan di negara Brazil adalah...', 'a' => 'Spanyol', 'b' => 'Portugis', 'c' => 'Inggris', 'd' => 'Prancis', 'correct' => 'B'],
                    ['q' => 'Buku "Bumi Manusia" adalah salah satu mahakarya dari...', 'a' => 'W.S. Rendra', 'b' => 'Chairil Anwar', 'c' => 'Pramoedya Ananta Toer', 'd' => 'Sapardi Djoko Damono', 'correct' => 'C'],
                    ['q' => 'Alfabet Yunani pertama dan terakhir adalah...', 'a' => 'Alpha & Omega', 'b' => 'A & Z', 'c' => 'Aleph & Taw', 'd' => 'Beta & Zeta', 'correct' => 'A'],
                ]
            ],
            [
                'title' => 'Anatomi & Kesehatan',
                'description' => 'Kenali lebih dalam tentang anatomi dan kesehatan tubuh (10 Soal).',
                'category' => 'Kesehatan',
                'questions' => [
                    ['q' => 'Organ pemompa darah...', 'a' => 'Paru', 'b' => 'Hati', 'c' => 'Jantung', 'd' => 'Ginjal', 'correct' => 'C'],
                    ['q' => 'Vitamin jeruk untuk daya tahan...', 'a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D', 'correct' => 'C'],
                    ['q' => 'Nyamuk DBD...', 'a' => 'Anopheles', 'b' => 'Culex', 'c' => 'Aedes aegypti', 'd' => 'Mansonia', 'correct' => 'C'],
                    ['q' => 'Tulang terpanjang manusia...', 'a' => 'Paha (femur)', 'b' => 'Kering', 'c' => 'Lengan', 'd' => 'Belakang', 'correct' => 'A'],
                    ['q' => 'Golongan darah universal pendonor...', 'a' => 'A', 'b' => 'B', 'c' => 'AB', 'd' => 'O', 'correct' => 'D'],
                    ['q' => 'Organ yang berfungsi memproduksi sel darah merah adalah...', 'a' => 'Jantung', 'b' => 'Sumsum tulang', 'c' => 'Hati', 'd' => 'Limpa', 'correct' => 'B'],
                    ['q' => 'Kekurangan vitamin A dapat menyebabkan penyakit...', 'a' => 'Sariawan', 'b' => 'Beri-beri', 'c' => 'Rabun Senja', 'd' => 'Rakitis', 'correct' => 'C'],
                    ['q' => 'Zat hijau daun yang membantu fotosintesis disebut...', 'a' => 'Klorofil', 'b' => 'Hemoglobin', 'c' => 'Melanin', 'd' => 'Keratin', 'correct' => 'A'],
                    ['q' => 'Alat pernapasan pada serangga adalah...', 'a' => 'Paru-paru', 'b' => 'Insang', 'c' => 'Trakea', 'd' => 'Kulit', 'correct' => 'C'],
                    ['q' => 'Bagian otak yang mengatur keseimbangan tubuh adalah...', 'a' => 'Otak Besar', 'b' => 'Otak Kecil', 'c' => 'Sumsum Lanjutan', 'd' => 'Saraf Tulang Belakang', 'correct' => 'B'],
                ]
            ],
            [
                'title' => 'Pengetahuan Umum Lanjutan',
                'description' => 'Kuis campuran wawasan luas (10 Soal).',
                'category' => 'Umum',
                'questions' => [
                    ['q' => 'Mata uang Jepang...', 'a' => 'Won', 'b' => 'Yen', 'c' => 'Yuan', 'd' => 'Ringgit', 'correct' => 'B'],
                    ['q' => 'Hewan mamalia terbesar...', 'a' => 'Gajah', 'b' => 'Paus Biru', 'c' => 'Hiu Paus', 'd' => 'Jerapah', 'correct' => 'B'],
                    ['q' => 'Pohon bambu keluarga...', 'a' => 'Kayu', 'b' => 'Rumput', 'c' => 'Semak', 'd' => 'Paku', 'correct' => 'B'],
                    ['q' => 'Letak Menara Eiffel...', 'a' => 'Roma', 'b' => 'Berlin', 'c' => 'London', 'd' => 'Paris', 'correct' => 'D'],
                    ['q' => 'Warna bendera PBB...', 'a' => 'Merah-Putih', 'b' => 'Biru-Putih', 'c' => 'Hijau-Kuning', 'd' => 'Hitam-Putih', 'correct' => 'B'],
                    ['q' => 'Siapa pendiri perusahaan Microsoft?', 'a' => 'Steve Jobs', 'b' => 'Bill Gates', 'c' => 'Mark Zuckerberg', 'd' => 'Jeff Bezos', 'correct' => 'B'],
                    ['q' => 'Planet yang dijuluki Planet Merah adalah...', 'a' => 'Venus', 'b' => 'Mars', 'c' => 'Jupiter', 'd' => 'Saturnus', 'correct' => 'B'],
                    ['q' => 'Arah jarum kompas selalu menunjuk ke arah...', 'a' => 'Utara dan Selatan', 'b' => 'Timur dan Barat', 'c' => 'Utara saja', 'd' => 'Kiblat', 'correct' => 'A'],
                    ['q' => 'Bahasa pemersatu bangsa Indonesia adalah...', 'a' => 'Bahasa Jawa', 'b' => 'Bahasa Melayu', 'c' => 'Bahasa Indonesia', 'd' => 'Bahasa Sanskerta', 'correct' => 'C'],
                    ['q' => 'Alat ukur untuk mengukur kekuatan gempa bumi disebut...', 'a' => 'Barometer', 'b' => 'Termometer', 'c' => 'Seismograf', 'd' => 'Anemometer', 'correct' => 'C'],
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

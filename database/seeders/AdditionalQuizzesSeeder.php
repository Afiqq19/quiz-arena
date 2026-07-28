<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;

class AdditionalQuizzesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::factory()->create(['role' => 'admin']);

        // Quiz 2: Matematika Dasar
        $quizMath = Quiz::create([
            'title' => 'Tantangan Matematika Dasar',
            'description' => 'Uji kecepatan berhitung dan logika matematikamu di kuis ini!',
            'category' => 'Matematika',
            'created_by' => $admin->id,
        ]);

        $mathQuestions = [
            ['q' => 'Berapakah hasil dari 25 + 15 x 2?', 'a' => '80', 'b' => '55', 'c' => '50', 'd' => '65', 'correct' => 'B'],
            ['q' => 'Jika x = 5 dan y = 3, berapakah nilai dari 2x + 3y?', 'a' => '16', 'b' => '19', 'c' => '21', 'd' => '25', 'correct' => 'B'],
            ['q' => 'Sebuah segitiga siku-siku memiliki alas 6cm dan tinggi 8cm. Berapakah panjang sisi miringnya?', 'a' => '9cm', 'b' => '10cm', 'c' => '11cm', 'd' => '12cm', 'correct' => 'B'],
            ['q' => 'Berapakah luas persegi yang memiliki keliling 24 cm?', 'a' => '36 cm²', 'b' => '24 cm²', 'c' => '16 cm²', 'd' => '48 cm²', 'correct' => 'A'],
            ['q' => 'Berapakah nilai dari 3 pangkat 4?', 'a' => '12', 'b' => '27', 'c' => '64', 'd' => '81', 'correct' => 'D'],
            ['q' => 'Akar kuadrat dari 144 adalah...', 'a' => '12', 'b' => '14', 'c' => '16', 'd' => '18', 'correct' => 'A'],
            ['q' => '1/2 + 1/4 = ...', 'a' => '1/6', 'b' => '2/6', 'c' => '3/4', 'd' => '1', 'correct' => 'C'],
            ['q' => 'Berapakah 20% dari 150?', 'a' => '20', 'b' => '30', 'c' => '40', 'd' => '50', 'correct' => 'B'],
            ['q' => 'Sudut yang besarnya 90 derajat disebut sudut...', 'a' => 'Lancip', 'b' => 'Tumpul', 'c' => 'Siku-siku', 'd' => 'Lurus', 'correct' => 'C'],
            ['q' => 'Bilangan prima pertama setelah 10 adalah...', 'a' => '11', 'b' => '12', 'c' => '13', 'd' => '15', 'correct' => 'A'],
        ];

        foreach ($mathQuestions as $q) {
            Question::create([
                'quiz_id' => $quizMath->id, 'question_text' => $q['q'],
                'option_a' => $q['a'], 'option_b' => $q['b'], 'option_c' => $q['c'], 'option_d' => $q['d'],
                'correct_option' => $q['correct'], 'timer_seconds' => 30,
            ]);
        }

        // Quiz 3: Ilmu Pengetahuan Alam
        $quizScience = Quiz::create([
            'title' => 'Eksplorasi Sains & Alam',
            'description' => 'Buktikan pengetahuanmu tentang fisika, biologi, dan keajaiban alam semesta.',
            'category' => 'Sains (IPA)',
            'created_by' => $admin->id,
        ]);

        $scienceQuestions = [
            ['q' => 'Pusat tata surya kita adalah...', 'a' => 'Bumi', 'b' => 'Bulan', 'c' => 'Matahari', 'd' => 'Jupiter', 'correct' => 'C'],
            ['q' => 'Proses tumbuhan membuat makanan sendiri dengan bantuan cahaya matahari disebut...', 'a' => 'Respirasi', 'b' => 'Kondensasi', 'c' => 'Evaporasi', 'd' => 'Fotosintesis', 'correct' => 'D'],
            ['q' => 'Rumus kimia untuk air adalah...', 'a' => 'CO2', 'b' => 'H2O', 'c' => 'O2', 'd' => 'NaCl', 'correct' => 'B'],
            ['q' => 'Hewan pemakan daging disebut...', 'a' => 'Herbivora', 'b' => 'Karnivora', 'c' => 'Omnivora', 'd' => 'Insektivora', 'correct' => 'B'],
            ['q' => 'Planet terbesar dalam tata surya adalah...', 'a' => 'Saturnus', 'b' => 'Bumi', 'c' => 'Jupiter', 'd' => 'Uranus', 'correct' => 'C'],
            ['q' => 'Gas yang paling banyak terdapat di atmosfer Bumi adalah...', 'a' => 'Oksigen', 'b' => 'Karbon Dioksida', 'c' => 'Nitrogen', 'd' => 'Hidrogen', 'correct' => 'C'],
            ['q' => 'Bunyi tidak dapat merambat melalui...', 'a' => 'Zat Padat', 'b' => 'Zat Cair', 'c' => 'Udara', 'd' => 'Ruang Hampa Udara', 'correct' => 'D'],
            ['q' => 'Bagian sel yang berfungsi sebagai pusat kendali adalah...', 'a' => 'Mitokondria', 'b' => 'Sitoplasma', 'c' => 'Inti Sel (Nukleus)', 'd' => 'Ribosom', 'correct' => 'C'],
            ['q' => 'Logam cair pada suhu ruang adalah...', 'a' => 'Besi', 'b' => 'Aluminium', 'c' => 'Raksa (Merkuri)', 'd' => 'Tembaga', 'correct' => 'C'],
            ['q' => 'Perubahan wujud dari padat langsung menjadi gas disebut...', 'a' => 'Mencair', 'b' => 'Membeku', 'c' => 'Menguap', 'd' => 'Menyublim', 'correct' => 'D'],
        ];

        foreach ($scienceQuestions as $q) {
            Question::create([
                'quiz_id' => $quizScience->id, 'question_text' => $q['q'],
                'option_a' => $q['a'], 'option_b' => $q['b'], 'option_c' => $q['c'], 'option_d' => $q['d'],
                'correct_option' => $q['correct'], 'timer_seconds' => 30,
            ]);
        }

        // Quiz 4: Teknologi & Komputer
        $quizTech = Quiz::create([
            'title' => 'Dunia Teknologi & IT',
            'description' => 'Seberapa jauh kamu memahami dunia digital, internet, dan komputer?',
            'category' => 'Teknologi',
            'created_by' => $admin->id,
        ]);

        $techQuestions = [
            ['q' => 'Singkatan dari HTML adalah...', 'a' => 'Hyper Text Markup Language', 'b' => 'High Tech Modern Language', 'c' => 'Hyperlink Text Module Language', 'd' => 'Home Tool Markup Language', 'correct' => 'A'],
            ['q' => 'Otak dari sebuah komputer disebut...', 'a' => 'RAM', 'b' => 'Motherboard', 'c' => 'CPU', 'd' => 'Hardisk', 'correct' => 'C'],
            ['q' => 'Perusahaan pembuat sistem operasi Windows adalah...', 'a' => 'Apple', 'b' => 'Google', 'c' => 'Microsoft', 'd' => 'IBM', 'correct' => 'C'],
            ['q' => 'Jaringan komputer global yang menghubungkan seluruh dunia disebut...', 'a' => 'Intranet', 'b' => 'Internet', 'c' => 'LAN', 'd' => 'WAN', 'correct' => 'B'],
            ['q' => 'Bahasa pemrograman yang sering digunakan untuk membuat halaman web menjadi interaktif adalah...', 'a' => 'Python', 'b' => 'C++', 'c' => 'JavaScript', 'd' => 'Java', 'correct' => 'C'],
            ['q' => '1 Gigabyte (GB) sama dengan...', 'a' => '1000 Megabyte (MB)', 'b' => '1024 Megabyte (MB)', 'c' => '1024 Kilobyte (KB)', 'd' => '1000 Terabyte (TB)', 'correct' => 'B'],
            ['q' => 'Perangkat lunak yang digunakan untuk menjelajahi internet disebut...', 'a' => 'Operating System', 'b' => 'Web Browser', 'c' => 'Antivirus', 'd' => 'Word Processor', 'correct' => 'B'],
            ['q' => 'Bapak ilmu komputer modern (Turing machine) adalah...', 'a' => 'Bill Gates', 'b' => 'Steve Jobs', 'c' => 'Alan Turing', 'd' => 'Charles Babbage', 'correct' => 'C'],
            ['q' => 'Format file standar untuk dokumen portabel adalah...', 'a' => 'DOCX', 'b' => 'JPG', 'c' => 'PDF', 'd' => 'MP3', 'correct' => 'C'],
            ['q' => 'URL singkatan dari...', 'a' => 'Universal Record Locator', 'b' => 'Uniform Resource Locator', 'c' => 'Universal Resource Link', 'd' => 'Uniform Record Link', 'correct' => 'B'],
        ];

        foreach ($techQuestions as $q) {
            Question::create([
                'quiz_id' => $quizTech->id, 'question_text' => $q['q'],
                'option_a' => $q['a'], 'option_b' => $q['b'], 'option_c' => $q['c'], 'option_d' => $q['d'],
                'correct_option' => $q['correct'], 'timer_seconds' => 30,
            ]);
        }

        // Quiz 5: Bahasa Inggris Dasar
        $quizEnglish = Quiz::create([
            'title' => 'Basic English Challenge',
            'description' => 'Test your English grammar, vocabulary, and daily conversations.',
            'category' => 'Bahasa',
            'created_by' => $admin->id,
        ]);

        $englishQuestions = [
            ['q' => 'What is the past tense of "Go"?', 'a' => 'Going', 'b' => 'Went', 'c' => 'Gone', 'd' => 'Goes', 'correct' => 'B'],
            ['q' => 'Translate to English: "Saya sedang membaca buku."', 'a' => 'I read a book.', 'b' => 'I am reading a book.', 'c' => 'I was reading a book.', 'd' => 'I have read a book.', 'correct' => 'B'],
            ['q' => 'The opposite of "Beautiful" is...', 'a' => 'Ugly', 'b' => 'Pretty', 'c' => 'Handsome', 'd' => 'Cute', 'correct' => 'A'],
            ['q' => 'A person who writes books is an...', 'a' => 'Actor', 'b' => 'Author', 'c' => 'Engineer', 'd' => 'Athlete', 'correct' => 'B'],
            ['q' => 'Choose the correct sentence:', 'a' => 'He don\'t like apples.', 'b' => 'He doesn\'t likes apples.', 'c' => 'He doesn\'t like apples.', 'd' => 'He isn\'t like apples.', 'correct' => 'C'],
            ['q' => 'Plural of "Child" is...', 'a' => 'Childs', 'b' => 'Children', 'c' => 'Childrens', 'd' => 'Childes', 'correct' => 'B'],
            ['q' => 'A place where you borrow books is a...', 'a' => 'Bookstore', 'b' => 'Museum', 'c' => 'Library', 'd' => 'School', 'correct' => 'C'],
            ['q' => 'The sun rises in the...', 'a' => 'West', 'b' => 'North', 'c' => 'South', 'd' => 'East', 'correct' => 'D'],
            ['q' => 'Which word is a noun?', 'a' => 'Run', 'b' => 'Quickly', 'c' => 'Happiness', 'd' => 'Beautiful', 'correct' => 'C'],
            ['q' => 'Synonym of "Happy" is...', 'a' => 'Sad', 'b' => 'Angry', 'c' => 'Glad', 'd' => 'Tired', 'correct' => 'C'],
        ];

        foreach ($englishQuestions as $q) {
            Question::create([
                'quiz_id' => $quizEnglish->id, 'question_text' => $q['q'],
                'option_a' => $q['a'], 'option_b' => $q['b'], 'option_c' => $q['c'], 'option_d' => $q['d'],
                'correct_option' => $q['correct'], 'timer_seconds' => 30,
            ]);
        }
    }
}

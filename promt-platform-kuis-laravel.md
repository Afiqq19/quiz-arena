# Promt: Platform Kuis & Skor (Laravel)

Gunakan promt di bawah ini untuk diberikan ke Claude Code, atau sebagai acuan kerja sendiri saat membangun project Laravel-nya.

---

## PROMT

Buatkan aplikasi web kuis interaktif menggunakan **Laravel** (versi terbaru, gunakan Laravel Breeze untuk autentikasi) dengan spesifikasi berikut:

### 1. Landing Page
- Halaman depan publik berisi: judul aplikasi, deskripsi singkat, tombol "Masuk" dan "Daftar"
- Tampilkan cuplikan Top 5 leaderboard di landing page (tanpa perlu login untuk melihatnya)
- Setelah klik "Masuk"/"Daftar", arahkan ke halaman login/register Breeze

### 2. Role & Autentikasi
Gunakan satu tabel `users` dengan kolom `role` (enum: `admin`, `user`). Gunakan middleware untuk membatasi akses:
- **Admin**: bisa CRUD soal kuis, lihat semua histori pengerjaan user, kelola daftar user
- **User** (pelanggan yang login): bisa mengerjakan kuis, melihat skor & histori miliknya sendiri, muncul di leaderboard
- **Publik (tanpa login)**: hanya bisa melihat landing page dan halaman leaderboard

Buat 1 akun admin default lewat seeder (email & password bisa di-set lewat `.env`).

### 3. Struktur Data (Migration)
- `quizzes`: id, title, description, category, created_by (admin), timestamps
- `questions`: id, quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option (A/B/C/D), timer_seconds (default 30)
- `attempts`: id, user_id, quiz_id, score, total_questions, started_at, finished_at
- `attempt_answers`: id, attempt_id, question_id, selected_option, is_correct, time_taken_seconds

### 4. Fitur Admin (panel `/admin`)
- CRUD kuis (judul, deskripsi, kategori)
- CRUD soal per kuis (pertanyaan, 4 opsi ABCD, kunci jawaban, durasi timer per soal)
- Tabel daftar user + jumlah kuis yang sudah dikerjakan
- Tabel semua attempt/histori pengerjaan semua user, bisa difilter per kuis/user

### 5. Fitur User (setelah login)
- Dashboard: daftar kuis yang tersedia (per kategori), tombol "Mulai"
- Halaman kerjakan kuis:
  - Tampilkan 1 soal per waktu, 4 pilihan ABCD sebagai tombol/radio
  - Timer countdown visual sesuai `timer_seconds` soal tersebut; kalau waktu habis, otomatis dianggap salah dan lanjut ke soal berikutnya
  - Progress bar (soal ke berapa dari total)
  - Setelah semua soal dijawab, simpan attempt + hitung skor (misal: benar = 10 poin, kecepatan menjawab bisa jadi bonus opsional)
- Halaman hasil: skor akhir, jumlah benar/salah, waktu total, opsi "Lihat pembahasan" (tampilkan jawaban benar vs jawaban user per soal)
- Halaman "Histori Saya": daftar semua attempt milik user sendiri beserta skor

### 6. Leaderboard Publik
- Halaman `/leaderboard`, bisa diakses tanpa login
- Ranking user berdasarkan total skor tertinggi (bisa difilter per kuis atau keseluruhan)
- Tampilkan: peringkat, nama user, skor tertinggi, jumlah kuis yang sudah diselesaikan
- Update otomatis tiap ada attempt baru yang selesai

### 7. Teknis
- Gunakan Laravel Breeze (Blade + Alpine.js) untuk auth, atau Blade biasa untuk kesederhanaan
- Timer per soal pakai Alpine.js/JavaScript sederhana (countdown di sisi client, validasi waktu tetap dicek di server saat submit)
- Gunakan Eloquent relationships: `User hasMany Attempts`, `Quiz hasMany Questions`, `Attempt hasMany AttemptAnswers`
- Styling pakai Tailwind CSS (bawaan Breeze)
- Sertakan seeder contoh: 1 admin, 2 kuis contoh (misal kategori "Umum" dan "Matematika"), masing-masing 5 soal

### 8. Struktur Folder yang Diharapkan
```
app/Models/ (User, Quiz, Question, Attempt, AttemptAnswer)
app/Http/Controllers/ (Admin/QuizController, Admin/QuestionController, QuizPlayController, LeaderboardController)
app/Http/Middleware/ (EnsureUserIsAdmin)
resources/views/ (landing, auth/*, dashboard, quiz/play, quiz/result, leaderboard, admin/*)
database/migrations/
database/seeders/
routes/web.php
```

Mohon buatkan step-by-step: mulai dari migration, model & relationship, seeder, middleware, controller, lalu view Blade-nya, dan pastikan route sudah dikelompokkan sesuai role (middleware `auth`, `admin`, dan publik).

---

## Catatan Tambahan Buat Kamu
- Ini murni platform kuis edukasi/hiburan skor, **tanpa unsur taruhan atau uang** — cocok untuk portofolio Laravel kamu.
- Kalau nanti mau dikembangkan, bisa ditambah: badge/achievement, kategori kuis lebih banyak, mode multiplayer real-time (pakai Laravel Echo/WebSocket), atau kuis harian.

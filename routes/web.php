<?php

// App\Http\Controllers\Admin\QuizController is removed
// App\Http\Controllers\Admin\QuestionController is removed
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizPlayController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'callback']);

// Verifikasi Sertifikat Publik
Route::get('/verify/certificate/{id}', [\App\Http\Controllers\CertificateController::class, 'verify'])->name('certificate.verify');

// Halaman Statis
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/', function () {
    // Show top 5 on landing page
    $leaderboard = \App\Models\Attempt::with('user')
        ->selectRaw('user_id, sum(score) as total_score, count(id) as quizzes_taken')
        ->where('is_practice', false)
        ->groupBy('user_id')
        ->orderByDesc('total_score')
        ->take(5)
        ->get();
    return view('landing', compact('leaderboard'));
})->name('landing');

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

// Room (Class Mode) Routes for Student / Guest
Route::get('/room/join', [\App\Http\Controllers\RoomController::class, 'joinForm'])->name('rooms.joinForm');
Route::get('/room/guest-name', [\App\Http\Controllers\RoomController::class, 'guestNameForm'])->name('rooms.guestName');
Route::post('/room/join', [\App\Http\Controllers\RoomController::class, 'join'])->name('rooms.join');
Route::get('/room/{room}/lobby', [\App\Http\Controllers\RoomController::class, 'lobby'])->name('rooms.lobby');
Route::get('/room/{room}/status', [\App\Http\Controllers\RoomController::class, 'checkStatus'])->name('rooms.status');
Route::get('/room/{room}/play', [\App\Http\Controllers\RoomController::class, 'play'])->name('rooms.play');
Route::post('/room/{room}/submit', [\App\Http\Controllers\RoomController::class, 'submit'])->name('rooms.submit');
Route::get('/room/{room}/result', [\App\Http\Controllers\RoomController::class, 'result'])->name('rooms.result');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // User dashboard / redirect based on role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/certificate/creator', [\App\Http\Controllers\CertificateController::class, 'creator'])->name('certificate.creator');

    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Quiz Play Routes
    Route::get('/quiz/{quiz}/play', [QuizPlayController::class, 'play'])->name('quiz.play');
    Route::post('/quiz/{quiz}/submit', [QuizPlayController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/attempt/{attempt}/result', [QuizPlayController::class, 'result'])->name('quiz.result');
    Route::get('/history', [QuizPlayController::class, 'history'])->name('quiz.history');

    // Room Management (Any user can host)
    Route::get('/rooms/create', [\App\Http\Controllers\RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [\App\Http\Controllers\RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}/monitor', [\App\Http\Controllers\RoomController::class, 'monitor'])->name('rooms.monitor');
    Route::post('/rooms/{room}/update-settings', [\App\Http\Controllers\RoomController::class, 'updateSettings'])->name('rooms.updateSettings');
    Route::post('/rooms/{room}/start', [\App\Http\Controllers\RoomController::class, 'startRoom'])->name('rooms.start');
    Route::post('/rooms/{room}/close', [\App\Http\Controllers\RoomController::class, 'closeRoom'])->name('rooms.close');
    Route::get('/rooms/{room}/data', [\App\Http\Controllers\RoomController::class, 'getMonitorData'])->name('rooms.data');
    Route::get('/rooms/{room}/export', [\App\Http\Controllers\RoomController::class, 'export'])->name('rooms.export');
    
    // Quiz & Question Management (Shared for Admin and Users)
    Route::resource('quizzes', QuizController::class);
    Route::resource('quizzes.questions', QuestionController::class)->except(['index', 'show']);
    
    // Quiz Export/Import
    Route::get('/quizzes-export', [\App\Http\Controllers\QuizExportImportController::class, 'export'])->name('quizzes.export');
    Route::post('/quizzes-import', [\App\Http\Controllers\QuizExportImportController::class, 'import'])->name('quizzes.import');

    // Admin/Teacher Routes
    Route::middleware([EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('dashboard');
        
        // Moderate Route
        Route::patch('/quizzes/{quiz}/moderate', [QuizController::class, 'moderate'])->name('quizzes.moderate');
        Route::patch('/quizzes/{quiz}/toggle-publish', [QuizController::class, 'togglePublish'])->name('quizzes.togglePublish');
        
        // Revision Moderation
        Route::patch('/revisions/{revision}/moderate', [\App\Http\Controllers\QuestionRevisionController::class, 'moderate'])->name('revisions.moderate');
        
        Route::get('/users', [QuizController::class, 'users'])->name('users.index');
        Route::get('/attempts', [QuizController::class, 'attempts'])->name('attempts.index');
        Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'adminIndex'])->name('leaderboard');
        
        // Backup Routes
        Route::get('/backup', [\App\Http\Controllers\Admin\BackupController::class, 'index'])->name('backup.index');
        Route::post('/backup/download', [\App\Http\Controllers\Admin\BackupController::class, 'download'])->name('backup.download');
        Route::post('/backup/restore', [\App\Http\Controllers\Admin\BackupController::class, 'restore'])->name('backup.restore');
    });
});

// ============================================================
// AUTO DEPLOY WEBHOOK (Tombol Ajaib Quiz Arena)
// ============================================================
Route::get('/update-rahasia-mss', function () {
    $gitPath = 'git';
    if (file_exists('D:\laragon\bin\git\cmd\git.exe')) {
        $gitPath = 'D:\laragon\bin\git\cmd\git.exe';
    } elseif (file_exists('C:\laragon\bin\git\cmd\git.exe')) {
        $gitPath = 'C:\laragon\bin\git\cmd\git.exe';
    }
    
    putenv('GIT_TERMINAL_PROMPT=0');
    putenv('GCM_INTERACTIVE=false');
    
    $repoDir = base_path(); // base_path for Laravel project
    
    // Perintah sakti untuk update, install, dan migrate
    $output0 = shell_exec("cd \"$repoDir\" && \"$gitPath\" config --local credential.helper manager-core 2>&1");
    $output1 = shell_exec("cd \"$repoDir\" && \"$gitPath\" fetch --all 2>&1");
    $output2 = shell_exec("cd \"$repoDir\" && \"$gitPath\" reset --hard origin/main 2>&1");
    $output3 = shell_exec("cd \"$repoDir\" && composer install 2>&1");
    $output4 = shell_exec("cd \"$repoDir\" && php artisan migrate --force 2>&1");
    
    return "<h1 style='color:green;'>Berhasil Menarik Kodingan Baru & Update Sistem oleh MSS!</h1>
            <h3>Laporan Log:</h3>
            <pre style='background:#333;color:#0f0;padding:20px;border-radius:10px;'>
[GIT CONFIG]
" . htmlspecialchars($output0) . "

[GIT FETCH & PULL]
" . htmlspecialchars($output1) . "
" . htmlspecialchars($output2) . "

[COMPOSER INSTALL]
" . htmlspecialchars($output3) . "

[DATABASE MIGRATE]
" . htmlspecialchars($output4) . "
            </pre>";
});

require __DIR__.'/auth.php';

<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$quizzes = App\Models\Quiz::whereHas('creator', function ($query) {
    $query->where('role', '!=', 'admin');
})->where('status', 'approved')->get();

foreach ($quizzes as $quiz) {
    $quiz->status = 'pending';
    $quiz->save();
}
echo 'Fixed ' . $quizzes->count() . ' quizzes.';

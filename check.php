<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = App\Models\User::all();
echo "Users:\n";
foreach($users as $user) {
    echo $user->id . " - " . $user->name . " - Role: " . $user->role . "\n";
}

$quizzes = App\Models\Quiz::all();
echo "\nQuizzes:\n";
foreach($quizzes as $quiz) {
    echo $quiz->id . " - " . $quiz->title . " - Created By: " . $quiz->created_by . " - Status: " . $quiz->status . "\n";
}

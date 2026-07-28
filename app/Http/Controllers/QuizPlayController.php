<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Attempt;
use App\Models\AttemptAnswer;

class QuizPlayController extends Controller
{
    public function play(Quiz $quiz)
    {
        $questions = $quiz->questions()->inRandomOrder()->get()->map(function($q) {
            if ($q->question_type === 'essay') {
                $q->shuffled_options = [];
            } else {
                $options = [
                    ['key' => 'A', 'text' => $q->option_a],
                    ['key' => 'B', 'text' => $q->option_b],
                    ['key' => 'C', 'text' => $q->option_c],
                    ['key' => 'D', 'text' => $q->option_d],
                ];
                shuffle($options);
                $q->shuffled_options = $options;
            }
            return $q;
        });
        $quiz->setRelation('questions', $questions);
        $isPractice = Attempt::where('user_id', auth()->id())
                             ->where('quiz_id', $quiz->id)
                             ->exists();
                             
        return view('quiz.play', compact('quiz', 'isPractice'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $quiz->load('questions');
        
        $answers = $request->input('answers', []);
        
        $score = 0;
        $totalQuestions = $quiz->questions->count();
        $attemptAnswersData = [];
        
        $isPractice = Attempt::where('user_id', auth()->id())
                             ->where('quiz_id', $quiz->id)
                             ->exists();

        $attempt = Attempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'started_at' => now(), // Assuming started when they loaded the page, could be improved
            'total_questions' => $totalQuestions,
            'is_practice' => $isPractice,
        ]);

        foreach ($quiz->questions as $question) {
            $selectedOption = $answers[$question->id] ?? null;
            
            if ($question->question_type === 'essay') {
                $isCorrect = $selectedOption !== null && strtolower(trim($selectedOption)) === strtolower(trim($question->essay_answer));
            } else {
                $isCorrect = $selectedOption === $question->correct_option;
            }
            
            if ($isCorrect) {
                $score += 10; // 10 points per correct answer
            }

            $attemptAnswersData[] = [
                'attempt_id' => $attempt->id,
                'question_id' => $question->id,
                'selected_option' => $selectedOption,
                'is_correct' => $isCorrect,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $attempt->update([
            'score' => $score,
            'finished_at' => now(),
        ]);

        AttemptAnswer::insert($attemptAnswersData);

        return response()->json([
            'redirect' => route('quiz.result', $attempt->id)
        ]);
    }

    public function result(Attempt $attempt)
    {
        if ($attempt->user_id != auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $attempt->load('quiz', 'answers.question');
        return view('quiz.result', compact('attempt'));
    }

    public function history()
    {
        $attempts = auth()->user()->attempts()->with('quiz')->orderByDesc('created_at')->get();
        
        $roomParticipants = \App\Models\RoomParticipant::with('room')
            ->where('user_id', auth()->id())
            ->whereNotNull('score')
            ->orderByDesc('created_at')
            ->get();
            
        $ownedRooms = \App\Models\Room::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
            
        return view('quiz.history', compact('attempts', 'roomParticipants', 'ownedRooms'));
    }
}

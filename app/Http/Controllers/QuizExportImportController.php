<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizExportImportController extends Controller
{
    public function export()
    {
        $user = auth()->user();
        
        // Ambil kuis berdasarkan role
        $query = Quiz::with('questions');
        if ($user->role !== 'admin') {
            $query->where('created_by', $user->id);
        }
        
        $quizzes = $query->get();

        // Bersihkan data sebelum di-export agar tidak membawa ID
        $exportData = $quizzes->map(function ($quiz) {
            return [
                'title' => $quiz->title,
                'description' => $quiz->description,
                'category' => $quiz->category,
                'status' => $quiz->status,
                'questions' => $quiz->questions->map(function ($q) {
                    return [
                        'question_text' => $q->question_text,
                        'question_type' => $q->question_type,
                        'option_a' => $q->option_a,
                        'option_b' => $q->option_b,
                        'option_c' => $q->option_c,
                        'option_d' => $q->option_d,
                        'correct_option' => $q->correct_option,
                        'essay_answer' => $q->essay_answer,
                        'timer_seconds' => $q->timer_seconds,
                    ];
                })->toArray()
            ];
        })->toArray();

        $filename = 'quiz_arena_quizzes_' . now()->format('Y_m_d_His') . '.json';
        
        return response()->json($exportData, 200, [
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'quiz_file' => 'required|file|mimetypes:application/json,text/plain|max:10240' // max 10MB
        ], [
            'quiz_file.required' => 'Pilih file JSON kuis terlebih dahulu.',
            'quiz_file.mimetypes' => 'File harus berformat JSON.',
        ]);

        try {
            $fileContent = file_get_contents($request->file('quiz_file')->getRealPath());
            $quizzesData = json_decode($fileContent, true);

            if (!is_array($quizzesData)) {
                throw new \Exception("Format JSON tidak valid atau rusak.");
            }

            DB::beginTransaction();

            $importedCount = 0;
            foreach ($quizzesData as $quizData) {
                // Buat kuis baru tanpa memperdulikan ID lama
                $newQuiz = Quiz::create([
                    'title' => $quizData['title'] ?? 'Kuis Tanpa Judul',
                    'description' => $quizData['description'] ?? null,
                    'category' => $quizData['category'] ?? 'Umum',
                    'status' => $quizData['status'] ?? 'approved',
                    'created_by' => auth()->id(), // Kuis ini akan menjadi milik user yang meng-import
                ]);

                // Buat pertanyaan-pertanyaannya
                if (isset($quizData['questions']) && is_array($quizData['questions'])) {
                    foreach ($quizData['questions'] as $qData) {
                        Question::create([
                            'quiz_id' => $newQuiz->id,
                            'question_text' => $qData['question_text'] ?? '',
                            'question_type' => $qData['question_type'] ?? 'multiple_choice',
                            'option_a' => $qData['option_a'] ?? null,
                            'option_b' => $qData['option_b'] ?? null,
                            'option_c' => $qData['option_c'] ?? null,
                            'option_d' => $qData['option_d'] ?? null,
                            'correct_option' => $qData['correct_option'] ?? null,
                            'essay_answer' => $qData['essay_answer'] ?? null,
                            'timer_seconds' => $qData['timer_seconds'] ?? 30,
                        ]);
                    }
                }
                
                $importedCount++;
            }

            DB::commit();

            return redirect()->back()->with('success', "Berhasil mengimpor $importedCount Kuis baru ke dalam sistem!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal melakukan impor kuis: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        if (auth()->user()->role !== 'admin' && $quiz->created_by !== auth()->id()) abort(403);
        $lastType = session('last_question_type', 'multiple_choice');
        return view('quizzes.questions.create', compact('quiz', 'lastType'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        if (auth()->user()->role !== 'admin' && $quiz->created_by !== auth()->id()) abort(403);
        if (auth()->user()->role !== 'admin' && $quiz->status === 'approved') {
            return redirect()->route('quizzes.edit', $quiz)->with('error', 'Kuis yang sudah disetujui tidak bisa ditambah/diedit soalnya. Hubungi Admin.');
        }
        
        $questionType = $request->input('question_type', 'multiple_choice');
        session(['last_question_type' => $questionType]);
        
        $rules = [
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,essay',
            'timer_seconds' => 'required|integer|min:5',
        ];
        
        if ($questionType === 'multiple_choice') {
            $rules['option_a'] = 'required|string';
            $rules['option_b'] = 'required|string';
            $rules['option_c'] = 'required|string';
            $rules['option_d'] = 'required|string';
            $rules['correct_option'] = 'required|in:A,B,C,D';
        } else {
            $rules['essay_answer'] = 'required|string|max:255';
        }

        $validated = $request->validate($rules);
        
        // Clear PG fields for essay, clear essay fields for PG
        if ($questionType === 'essay') {
            $validated['option_a'] = null;
            $validated['option_b'] = null;
            $validated['option_c'] = null;
            $validated['option_d'] = null;
            $validated['correct_option'] = null;
        } else {
            $validated['essay_answer'] = null;
        }

        $quiz->questions()->create($validated);
        
        if (auth()->user()->role !== 'admin') {
            $quiz->update(['status' => 'pending']);
        }

        return redirect()->route('quizzes.edit', $quiz)->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz, Question $question)
    {
        if (auth()->user()->role !== 'admin' && $quiz->created_by !== auth()->id()) abort(403);
        
        $activeRevision = $question->activeRevision;
        if ($activeRevision) {
            // Override the model fields in memory with the revision fields so the form shows the draft
            $question->question_text = $activeRevision->question_text;
            $question->question_type = $activeRevision->question_type;
            $question->option_a = $activeRevision->option_a;
            $question->option_b = $activeRevision->option_b;
            $question->option_c = $activeRevision->option_c;
            $question->option_d = $activeRevision->option_d;
            $question->correct_option = $activeRevision->correct_option;
            $question->essay_answer = $activeRevision->essay_answer;
            $question->timer_seconds = $activeRevision->timer_seconds;
        }
        
        return view('quizzes.questions.edit', compact('quiz', 'question', 'activeRevision'));
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        if (auth()->user()->role !== 'admin' && $quiz->created_by !== auth()->id()) abort(403);
        
        $questionType = $request->input('question_type', 'multiple_choice');
        
        $rules = [
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,essay',
            'timer_seconds' => 'required|integer|min:5',
        ];
        
        if ($questionType === 'multiple_choice') {
            $rules['option_a'] = 'required|string';
            $rules['option_b'] = 'required|string';
            $rules['option_c'] = 'required|string';
            $rules['option_d'] = 'required|string';
            $rules['correct_option'] = 'required|in:A,B,C,D';
        } else {
            $rules['essay_answer'] = 'required|string|max:255';
        }

        $validated = $request->validate($rules);
        
        if ($questionType === 'essay') {
            $validated['option_a'] = null;
            $validated['option_b'] = null;
            $validated['option_c'] = null;
            $validated['option_d'] = null;
            $validated['correct_option'] = null;
        } else {
            $validated['essay_answer'] = null;
        }

        if (auth()->user()->role !== 'admin' && $quiz->status === 'approved') {
            $activeRevision = $question->activeRevision;
            if ($activeRevision) {
                $activeRevision->update($validated);
            } else {
                $question->revisions()->create($validated);
            }
            return redirect()->route('quizzes.edit', $quiz)->with('success', 'Usulan perbaikan soal telah dikirim dan menunggu persetujuan Admin.');
        }

        $question->update($validated);
        
        if (auth()->user()->role !== 'admin') {
            $quiz->update(['status' => 'pending']);
        }

        return redirect()->route('quizzes.edit', $quiz)->with('success', 'Pertanyaan diperbarui.');
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        if (auth()->user()->role !== 'admin' && $quiz->created_by !== auth()->id()) abort(403);
        if (auth()->user()->role !== 'admin' && $quiz->status === 'approved') {
            return redirect()->route('quizzes.edit', $quiz)->with('error', 'Kuis yang sudah disetujui tidak bisa ditambah/diedit soalnya. Hubungi Admin.');
        }
        
        $question->delete();
        
        if (auth()->user()->role !== 'admin') {
            $quiz->update(['status' => 'pending']);
        }
        
        return redirect()->route('quizzes.edit', $quiz)->with('success', 'Pertanyaan dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionRevision;

class QuestionRevisionController extends Controller
{
    public function moderate(Request $request, QuestionRevision $revision)
    {
        $status = $request->input('status');
        
        if ($status === 'approved') {
            // Apply revision to original question
            $question = $revision->question;
            $question->update([
                'question_text' => $revision->question_text,
                'question_type' => $revision->question_type,
                'option_a' => $revision->option_a,
                'option_b' => $revision->option_b,
                'option_c' => $revision->option_c,
                'option_d' => $revision->option_d,
                'correct_option' => $revision->correct_option,
                'essay_answer' => $revision->essay_answer,
                'timer_seconds' => $revision->timer_seconds,
            ]);
            
            $revision->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Usulan perbaikan soal disetujui.');
        } else {
            $revision->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'Usulan perbaikan soal ditolak.');
        }
    }
}

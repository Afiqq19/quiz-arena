<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionRevision extends Model
{
    protected $fillable = [
        'question_id',
        'question_text',
        'question_type',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
        'essay_answer',
        'timer_seconds',
        'status',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

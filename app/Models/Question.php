<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
        'essay_answer',
        'timer_seconds',
    ];

    protected $hidden = [
        'essay_answer',
        'correct_option',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function attemptAnswers()
    {
        return $this->hasMany(AttemptAnswer::class);
    }

    public function revisions()
    {
        return $this->hasMany(QuestionRevision::class);
    }
    
    public function activeRevision()
    {
        return $this->hasOne(QuestionRevision::class)->where('status', 'pending')->latest();
    }
}

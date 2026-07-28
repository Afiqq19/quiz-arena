<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'title',
        'status',
        'timer_minutes',
        'timer_per_question',
        'total_questions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'room_quizzes');
    }

    public function participants()
    {
        return $this->hasMany(RoomParticipant::class);
    }

    public function roomQuestions()
    {
        return $this->hasMany(RoomQuestion::class)->orderBy('order_index');
    }
}

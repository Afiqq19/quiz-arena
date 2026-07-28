<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomParticipantAnswer extends Model
{
    protected $fillable = [
        'room_participant_id',
        'question_id',
        'selected_option',
        'is_correct'
    ];

    public function participant()
    {
        return $this->belongsTo(RoomParticipant::class, 'room_participant_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

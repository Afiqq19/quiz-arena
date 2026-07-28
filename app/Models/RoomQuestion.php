<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomQuestion extends Model
{
    protected $fillable = ['room_id', 'question_id', 'order_index'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

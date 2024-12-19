<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['user_id', 'question', 'checked'];

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'question_answer');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

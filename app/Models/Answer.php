<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['user_id'];

    protected $attributes = [
        'answer' => null,
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_answer');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $table = 'question_answer';
    public $timestamps = false; 
    protected $fillable = ['question_id', 'answer_id'];
    
}

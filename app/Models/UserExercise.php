<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExercise extends Model
{
    protected $table = 'user_exercise';

    public function exercise(){
        return $this->belongsTo(Exercise::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSupplement extends Model
{
    protected $table = 'user_supplements';

    public function food(){
        return $this->belongsTo(Food::class);
    }
}

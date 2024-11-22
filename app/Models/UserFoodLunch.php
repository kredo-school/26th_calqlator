<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFoodLunch extends Model
{
    protected $table = 'user_food_lunch';

    public function food(){
        return $this->belongsTo(Food::class);
    }
}

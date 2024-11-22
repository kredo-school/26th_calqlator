<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFoodBreakfast extends Model
{
    protected $table = 'user_food_breakfast';

    public function food(){
        return $this->belongsTo(Food::class);
    }
}

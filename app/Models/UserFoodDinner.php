<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFoodDinner extends Model
{
    protected $table = 'user_food_dinner';

    public function food(){
        return $this->belongsTo(Food::class);
    }
}

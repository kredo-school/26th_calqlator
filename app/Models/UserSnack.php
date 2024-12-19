<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSnack extends Model
{
    protected $table = 'user_snacks';

    public function food(){
        return $this->belongsTo(Food::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealDinner extends Model
{
    use HasFactory;

    protected $table = 'meals_dinner'; // テーブル名を明示的に指定

    protected $fillable = [
        'item',
        'calories',
        'amount',
        'time_eaten',
        'protein',
        'carbohydrate',
        'lipid',
    ];
}

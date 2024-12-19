<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealLunch extends Model
{
    use HasFactory;

    protected $table = 'meals_lunch'; // テーブル名を明示的に指定

    protected $fillable = [
        'item',
        'calories',
        'amount',
        'time_eaten',
        'protein',
        'carbohydrate',
        'lipid',
        'date',
    ];

    protected $casts = [ 'time_eaten' => 'datetime', ];
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Weight extends Model
{
    use HasFactory;
    protected $table = 'weights';
    

    public function user() {
        return $this->belongsTo(User::class);
    }
}

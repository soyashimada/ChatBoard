<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function board(){
        return $this->belongsTo(Board::class);
    }
}

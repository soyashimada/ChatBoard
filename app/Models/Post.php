<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = array('id');

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function board() {
        return $this->belongsTo('App\Models\Board');
    }
}

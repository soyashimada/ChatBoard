<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $appends = ['favorites_count', 'favorited_by_user'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function boardFavorites(){
        return $this->hasMany(BoardFavorite::class);
    }

    public function getFavoritesCountAttribute(){
        return $this->boardFavorites->count();
    }

    public function getFavoritedByUserAttribute(){
        return $this->boardFavorites->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }
}

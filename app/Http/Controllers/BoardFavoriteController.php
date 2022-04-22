<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BoardFavoriteController extends Controller
{
    public function favorite_board(Request $request){
        try{
            if(isset($request->board_id)){
                $user = Auth::user()
                $fav = New BoardFavorites;

                $fav->user_id = $user->id;
                $fav->board_id = $board->id;
                $fav->save();

            }

        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '更新が失敗しました');
        }
    }
}

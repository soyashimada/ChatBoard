<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Board;
use App\Models\BoardFavorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BoardFavoriteController extends Controller
{
    public function put_favorite(Request $request){
        try{
            if(isset($request->id)){
                $user = Auth::user();
                $not_exist = BoardFavorite::where([
                    ['board_id', $request->id],
                    ['user_id', $user->id]
                ])->doesntExist();

                if($not_exist){
                    $fav = new BoardFavorite;
                    Board::findOrFail($request->id);
    
                    $fav->user_id = $user->id;
                    $fav->board_id = $request->id;
                    $fav->save();
                }

                return;
            }

        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '更新が失敗しました');
        }
    }

    public function delete_favorite(Request $request){
        try{
            if(isset($request->id)){
                $user = Auth::user();
                $exist = BoardFavorite::where([
                    ['board_id', $request->id],
                    ['user_id', $user->id]
                ])->exists();

                if($exist){
                    BoardFavorite::where([
                        ['board_id', $request->id],
                        ['user_id', $user->id]
                    ])->delete();
                }

                return;
            }
        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '更新が失敗しました');
        }
    }
}

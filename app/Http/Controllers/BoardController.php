<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    //自分のボード一覧表示関数
    public function index(){
        //ログインユーザーの作成したボードを読込viewに渡して表示
        $user = Auth::user();
        $boards = Board::where('user_id',$user->id)->orderby('created_at','desc')->paginate(6);
        return view('board.list', ['boards' => $boards]);
    }

    //ボード作成ページ表示関数
    public function add() {
        return view('board.create_board');
    }

    //ボード作成関数
    public function create(Request $request) {
        //validation
        $validationdata = $request->validate([
            'title' => 'required|max:20|string',
            'description' => 'required|max:100|string'
        ]);

        $board = new Board;
        $user = Auth::user();
        $form = $request->all();
        unset($form['_token']);
        $form['user_id'] = $user->id;

        $board->fill($form)->save();
        return redirect('/');
    }

    //ボード検索関数
    public function search(Request $request) {
        if(isset($request->input)){
            //validation
            $validationdata = $request->validate([
                'input' => 'required|max:20|string',
            ]);

            $boards = Board::where('title','like','%'.$request->input.'%')->paginate(15);
            $boards->withQueryString();

            return view('board.search',['boards' => $boards, 'input' => $request->input]);
        }
        
        return view('board.search');
    }
}

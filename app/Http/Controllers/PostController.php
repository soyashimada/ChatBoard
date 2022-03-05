<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Board;
use App\Events\PostSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function read($id) {
        $items = Post::where('board_id',$id)->orderby('created_at', 'asc')->get();
        $board = Board::find($id);
        return view('board.read', ['items' => $items, 'board' => $board]);
    }

    //チャット投稿 
    public function post(Request $request) {
        //validation
        $validationdata = $request->validate([
            'message' => 'required|max:100|string'
        ]);

        $user = Auth::user();
        $board = Board::find($request->id);
        $post = new Post;

        $form = $request->all();
        unset($form['_token']);
        $form['board_id'] = $board->id;
        $form['user_id'] = $user->id;
        $post->fill($form)->save();

        event(new PostSent($post));
        
        return;
    }

    //ajax用メッセージデータ送信
    public function get_posts(Request $request) {
        $loginuser = Auth::user();
        $posts = Post::with('user')->where('board_id',$request->id)->orderby('created_at', 'asc')->get();

        return ['posts' => $posts, 'loginuser' => $loginuser];
    }

}

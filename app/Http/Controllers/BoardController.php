<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('board.list', ['user' => $user]);
    }

    public function add() {
        return view('board.create_board');
    }

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

    public function search() {
        return view('board.find',['input' => ""]);
    }

    public function find(Request $request) {
        //validation
        $validationdata = $request->validate([
            'input' => 'required|max:20|string',
        ]);

        $data = Board::where('title','like','%'.$request->input.'%');
        $items = $data->simplePaginate(10);

        return view('board/find', ['items' => $items, 'input' => $request->input, 'click' => true]);
    }
}

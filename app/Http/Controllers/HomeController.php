<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //トップページ表示関数
    public function index()
    {
        //最近作成されたボードを読込、viewに渡して表示
        $boards = Board::with('user')->orderby('created_at','desc')->take(6)->get();
        return view('home',['boards' => $boards]);
    }
}

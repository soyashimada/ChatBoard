<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $boards = Board::orderby('created_at','desc')->take(10)->get();
        return view('home',['boards' => $boards]);
    }
}

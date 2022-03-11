<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(User $user){
        $boards = Board::where('user_id',$user->id)->orderby('created_at','desc')->take(6)->get();
        return view('userPage', ['profiledUser' => $user, 'boards' => $boards]);
    }

    public function select_setting_profile(){
        return view('settings.profile');
    }

    public function setting_profile_name(){
        return view('settings.name');
    }
    
    public function setting_profile_status_message(){
        return view('settings.statusMessage');
    }

    public function setting_profile_user_image(){
        return view('settings.userImage');
    }

    public function setting_profile_user_link(){
        return view('settings.userLink');
    }

    public function store(Request $request){
        //validation
        $validationData = $request->validate([
            'name' => 'required_with:name|max:10|string',
            'status_message' => 'required_with:status_message|max:100|string',
            'user_link' => 'required_with:user_link|string'
        ]);

        //ログインユーザー
        $user = Auth::user();

        $form = $request->all();
        $user->fill($form)->save();

        return redirect(route('profile',['user' => $user->id]));
    }

    public function store_image(Request $request){
        //validation
        $validationData = $request->validate([
            'user_image' => 'required|image|dimensions:ratio=1/1',
        ]);

        //初期画像のパス
        $defaultImagePass = \Storage::url('img/defaultImage.png');

        //ログインユーザー
        $user = Auth::user();

        //既に保存されている画像があれば削除
        if($user->user_image != $defaultImagePass){
            \Storage::delete(\Storage::files('public/img/'.$user->id));
        }
        //画像の登録
        $form = $request->all();
        $image = $request->user_image;
        $form['user_image'] =  \Storage::url($image->store('public/img/'.$user->id));

        $user->fill($form)->save();

        return redirect(route('profile',['user' => $user->id]));
    }
}

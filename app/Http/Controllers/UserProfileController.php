<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(User $user){
        return view('userPage', ['profiledUser' => $user]);
    }

    public function select_setting_profile(){
        return view('settings.profile');
    }

    public function setting_profile($pass){
        if($pass == "name"){
            return view('settings.name');
        }else if($pass == "statusMessage"){
            return view('settings.statusMessage');
        }else if($pass == "userImage"){
            return view('settings.userImage');
        }else if($pass == "userLink"){
            return view('settings.userLink');
        }

        //01-29 本当はパラメータをバリデートするべきか 
        abort(404);
    }

    public function store(Request $request,$pass){
        //初期画像のパス
        $defaultImagePass = \Storage::url('img/defaultImage.png');

        //validatoin
        $validationData = $request->validate([
            'name' => 'required_with:name|max:10|string',
            'status_message' => 'required_with:status_message|max:100|string',
            'user_image' => 'required_with:user_image|image|dimensions:ratio=1/1',
            'user_link' => 'required_with:user_link|string'
        ]);

        //ログインユーザー
        $user = Auth::user();

        //画像があればストレージへ保存
        if($pass == "userImage"){
            //既に保存されている画像があれば削除
            if($user->user_image != $defaultImagePass){
                \Storage::delete(\Storage::files('public/img/'.$user->id));
            }
            //画像の登録
            $form = $request->all();
            $image = $request->user_image;
            $form['user_image'] =  \Storage::url($image->store('public/img/'.$user->id));

            $user->fill($form)->save();
        }else{
            $form = $request->all();
            $user->fill($form)->save();
        }

        return redirect(route('profile',['id' => $user->id]));
    }
}

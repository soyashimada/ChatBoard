<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('userPage', ['user' => $user]);
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
        $validationData = $request->validate([
            'name' => 'required_with:name',
            'status_message' => 'required_with:status_message',
            'user_image' => 'required_with:user_image|image|dimensions:ratio=1/1',
            'user_link' => 'required_with:user_link'
        ]);
        $user = Auth::user();

        //画像があればストレージへ保存
        //01-16 本当は既にある画像はストレージから削除したい
        if($pass == "userImage"){
            $form = $request->all();
            $image = $request->user_image;
            $form['user_image'] = $image->store('public/img/'.$user->id);

            $user->fill($form)->save();
        }else{
            $form = $request->all();
            $user->fill($form)->save();
        }

        return;
    }
}

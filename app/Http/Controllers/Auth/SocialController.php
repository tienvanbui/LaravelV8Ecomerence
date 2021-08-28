<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class SocialController extends Controller
{
    public function redrectFacebook(){
        //redrect to facebook login page
        return Socialite::driver('facebook')->redirect();
    }
    public function processFacebookLogin(){
        //get user infor from facebook 
         $facebookUser = Socialite::driver('facebook')->user();
         if(!$facebookUser){
              echo "Khong ton tai user";
         }
         $sysUser = User::firstOrNew([
             ['facebook_id'=> $facebookUser->id],
             [
                'name' => $facebookUser->name,
                'username'=> 'facebook_'.$facebookUser->id,
                'email'=>$facebookUser->email,
             ]
             ]);
        Auth::loginUsingId($sysUser->id);
        return redirect('/home');
    }
}

<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;


class LoginController extends Controller
{
    //
    public function login(){
        return view('home.login');
    }
    public function dologin(LoginRequest $req){  
        $user = User::where('uname',$req->uname)
                        ->orwhere('mobile',$req->uname)
                        ->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                session([
                    'id'=>$user->id,
                    'uname'=>$user->uname,
                ]);
                return redirect()->route('home_index');
            }
            return back()->withInput()->withErrors(['password'=>['密码不正确']]);
        }
        else
        {
            return back()->withInput()->withErrors(['mobile'=>['手机号码不存在']]);
        }
        
    }
}

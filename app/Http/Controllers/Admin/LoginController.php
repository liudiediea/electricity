<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use DB;
use Hash;

class LoginController extends Controller
{
    //
    public function login(){
        return view('admin.login.login');
    }

    public function dologin(LoginRequest $req){  
        $admin = Admin::where('username',$req->uname)->first();
                        
        if($admin){
            if(Hash::check($req->password,$admin->password)){
                session([
                    'id'=>$admin->id,
                    'uname'=>$admin->username,
                ]); 
                
                $adminid = session('id');
                $c = DB::table('admin_role')
                        ->where('admin_id','=',$adminid)
                        ->where('role_id','=','1')
                        ->count();
          
                if($c>0){
                    session(['root'=>true]);
                }
                else{
                    $url_path = Admin::getUrl($adminid);
                    session(['url_path'=>$url_path]);
                }
                  
                return redirect()->route('index');
            }
            return back()->withInput()->withErrors(['password'=>['密码不正确']]);
        }
        else
        {
            return back()->withInput()->withErrors(['mobile'=>['用户名不存在']]);
        }
        
    }
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }
}

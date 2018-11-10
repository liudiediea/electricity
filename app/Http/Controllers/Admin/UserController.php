<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Hash;

class UserController extends Controller
{
    //
    public function list(){
        $data = DB::table('users')->get()->toArray();
        return view('admin.user.user_list',[
            'data'=>$data
        ]);
    }
    public function insert(UserRequest $req){
     
       $user = new User;
       $user->fill($req->all());
       $user->password = Hash::make($req->password);
       $user->save();
        return redirect()->route('list');
    }
    public function delete($id){
        User::destroy($id);
        return redirect()->route('list');
    }
    public function grade(){
        return view('admin.user.user_grade');
    }
    public function record(){
        return view('admin.user.user_record');
    }
}

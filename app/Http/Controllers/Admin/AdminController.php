<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use DB;
use Hash;

class AdminController extends Controller
{
    //
    public function admin_list(){
        $admin = DB::table('admin')
                     ->leftjoin('admin_role','admin.id','=','admin_role.admin_id')
                     ->leftjoin('role','admin_role.role_id','=','role.id')
                     ->select('admin.*','role.role_name')
                     ->paginate(3);
         $role = DB::table('role')->get();
        return view('admin.administrators.admin_list',[
            'admin' => $admin,
            'role' => $role
        ]);
        
    }
   
    public function admin_info(){
        $id = session('id');
        // dd($id);die;
        $admin = DB::table('admin')
                    ->leftjoin('admin_role','admin.id','=','admin_role.admin_id')
                    ->leftjoin('role','admin_role.role_id','=','role.id')
                    ->where('admin.id','=',$id)
                    ->select('admin.*','role.role_name')
                    ->get();
        
        return view('admin.administrators.admin_info',[
            'admin'=>$admin,
        ]);
    }

    public function update_info(Request $req){
        $id = session('id');
        $admin = Admin::find($id);
        $admin->fill($req->all());
        $admin->save();
        
        return redirect()->route('admin_info');
    }
    
    public function insertadmin(Request $req){

        $data = $req->all();
        $admin = new Admin;
        $admin->fill($data);
        $admin->password = Hash::make($admin->password);
        $admin->save(); 
 
        if($req->role_name){
            $admin->role()->attach($req->role_name);
        }
        
         return redirect()->route('admin_list');
     }

    public function edit($id){
        $data = Admin::find($id);
        $role = DB::table('role')->get();
        $role_id = DB::table('admin_role')->where('admin_id','=',$id)->first();
    
        return view('admin.administrators.admin_edit',[
            'data'=>$data,
            'role'=>$role,
            'role_id'=>$role_id
        ]);
    }

    public function update(Request $req,$id){
        $admin = Admin::find($id);
        $admin->fill($req->all())->save();
        $admin->role()->detach();  
        // dd($req->role_id);die;
        if($req->role_id){
            $admin->role()->attach($req->role_id);
        }
      return redirect()->route('admin_list');
    }
    public function delete($id){
        $admin = Admin::find($id);
        $admin->role()->detach();
        $admin->destroy($id);
        return redirect()->route('admin_list');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Privilege;
use App\Models\Role;


class RoleController extends Controller
{
    //
    public function index(){  
        $data = DB::table('role')
        ->leftjoin('role_privilege','role_privilege.role_id','=','role.id')
        ->leftjoin('privilege','privilege.id','=','role_privilege.pri_id')
        ->groupBy('role.id')
        ->select('role.*',DB::raw('group_concat(mall_privilege.pri_name) as pri_list'))
        ->get();

        return view('admin.administrators.role',[
                    'data'=>$data,

                    ]);
    }

    
    public function add(){
        
        $data = new Privilege;
        $pri = Privilege::getPrivilege();
        return view('admin.administrators.role_add',[
            'pri'=>$pri
        ]);
    }
    public function insert(Request $req){

        $role = new Role;
        $role->fill($req->all())->save();
     
        if($req->pri_id){
            $role->privilege()->attach($req->pri_id);
        }
        return redirect()->route('role');
      
    }
    public function delete($id){
        $role = Role::find($id);
        $role->privilege()->detach();
        $role->destroy($id);
        return redirect()->route('role');
    }

    public function edit($id){
   
        $data = new Privilege;
        $pri = Privilege::getPrivilege();
        $role_name = Role::find($id);

        $pri_id = DB::table('role_privilege')->where('role_id','=',$id)->pluck('pri_id')->toArray();
        // dd($pri_id);die;
        return view('admin.administrators.role_edit',[
            'pri' => $pri,
            'role_name'=>$role_name,
            'pri_id'=>$pri_id
        ]);
    }
    public function update(Request $req,$id){
    
        $role = Role::find($id);
        $role->fill($req->all())->save();
        $role->privilege()->detach();
        if($req->pri_id){
       
            $role->privilege()->attach($req->pri_id);
        }
        return redirect()->route('role');
    }
}

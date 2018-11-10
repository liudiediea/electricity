<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;
class CategoryController extends Controller
{
    
    public function category(){
        $sort = new Category();
        $data = Category::getCategory();
   
        return view('admin.goods.sort',[
            'data'=>$data
        ]);
    }
    public function addFirst(Request $req){
  
        $fName=$req->cat_name;
        DB::table('category')->insert([
            ['parent_id' => '0', 'cat_name' => $fName],
        
        ]);
        return redirect()->route('category');
    }
    public function addSecond(Request $req){
        // dd($req->all());
        $id = $req->id;
        $sName=$req->cat_name;
        DB::table('category')->insert([
            ['parent_id' => $id, 'cat_name' => $sName],
        
        ]);
        return redirect()->route('category');
    }
    public function delete(Request $req){
        
        $id = $req->id;
        // dd($id);die;
        // DB::table('category')->where('id', '=', $id)->delete();
        $sort = new Category();
        $sort->deletecat($id);
        return redirect()->route('category');
    }

    public function update(Request $req){
        $id = $req->id;
        $name = $req->cat_name;
        // dd($id,$name);
        DB::table('category')
             ->where('id', $id)
                 ->update(['cat_name' => $name]);
        return redirect()->route('category');
    }
    
    
}

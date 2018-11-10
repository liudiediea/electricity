<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\ImageRequest;
use Storage;



class BrandController extends Controller
{
    //
    public function brand(){
        $data = Brand::get();
        return view('admin.goods.brand',[
            'data'=>$data
        ]);
    }
    public function add(){
        $category = new Category;
        $topCat = Category::getCat();
        return view('admin.goods.brand_add',[
            'topCat'=>$topCat
        ]);
    }
    public function insert(Request $req){

        $brand = new Brand;
        $brand ->fill($req->all());
        $brand->logo = Brand::getImg($req);
        $brand->save();
  
       return redirect()->route('brand');
        
    }
    public function delete($id){
        $path = Brand::find($id);
        Storage::delete($path->logo);
        Brand::destroy($id);
        return redirect()->route('brand');

    }
    public function edit($id){
        
        $brand = Brand::find($id);
        return view('admin.goods.brand_edit',[
            'brand'=>$brand,
        ]);
    }
    public function update(Request $req,$id){

       $brand = Brand::find($id);
       $brand->fill($req->all());
       if($req->hasFile('logo')){
           $logo = Brand::getImg($req);
           $brand->logo = $logo;
       }
       $brand->save();
       return redirect()->route('brand');

    }
}

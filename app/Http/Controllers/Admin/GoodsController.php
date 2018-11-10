<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Images;
use App\Models\Attr;
use DB;

class GoodsController extends Controller
{
    //
    public function goods(){
        $goods =  new Good;
        $goods = Good::showlist();

        return view('admin.goods.goods',[
            'goods'=>$goods
        ]);
    }
    //显示添加表单
    public function add(){
        $category = new Category;
        $topCat = Category::getCat();
        $brand = new Brand;
        $brand = Brand::get();
        $good = new Good;
       
        // $attr_val = Good::getattrVal();
        // foreach($attr_val as $v){
        //    $list[] =  explode(',',$v->list);
           
        // }
        // dd($list);
    
        return view('admin.goods.goods_add',[
            'topCat'=>$topCat,
            'brand'=>$brand,
        ]);
    }
    //获取子分类
    public function ajax_get_cat(){
        $id = (int)$_GET['id'];
        $data = Category::where('parent_id','=',$id)->get();
        echo json_encode($data);
    }
    //处理添加表单
    public function insert(Request $req){
    
        $goods = new Good;
        $goods ->fill($req->all());
        $goods->logo = Good::insert_logo($req);

        $goods->save();
        $id = $goods->id;
        $attr = $req->attr;
        $price = $req->price;
        $count = $req->count;

        Images::uploadGoodsImg($req,$id);
        Attr::addAttr($req,$id);
        Good::insert_sku($attr,$price,$count,$id);
        
        

        return redirect()->route('goods');
        

    }
    public function edit($id){
        $goods = Good::find($id);
        // dd($goods);
        $category = new Category;
        $topCat = Category::getCat();
        $brand = new Brand;
        $brand = Brand::get();
        return view('admin.goods.goods_edit',[
            'goods'=>$goods,
            'topCat'=>$topCat,
            'brand'=>$brand
        ]);
    }
    public function update(){

    }
}

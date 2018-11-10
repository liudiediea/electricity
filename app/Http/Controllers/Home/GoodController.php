<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\Images;
use App\Models\Attr;
use DB;

class GoodController extends Controller
{
    //商品列表页
    public function goods_list(Request $req){
        $goods = new Good;
        $goods = Good::getGoods();
       
        return view('home.goods.goods_list',[
            'goods'=>$goods,
            'req'=>$req,
        ]);
    }

    //商品详情页
    public function item(){
        $id = $_GET['id'];
        
        $good = new Good;
        $good = Good::getitem();

        $img = new Images;
        $img = Images::getImage($id);
       
        $attr = Attr::getAttr();
        //  dd($attr);
        return view('home.goods.good_item',[
            'good'=>$good,
            'img'=>$img,
            'attr'=>$attr
      
        ]);
    }
    public function getGoodsSku(Request $req){
        $id = $_GET['id'];
        $sku =$_GET['sku'];
        $price = DB::table('goods_sku')->where('goods_id',$id)->where('sku_attr',$sku)->first();
        return json_encode($price);
    }

    public function success_cart(){
        return view('home.goods.shopping-cart');
    }
    public function cart(){
        return view('home.goods.cart');
    }
}

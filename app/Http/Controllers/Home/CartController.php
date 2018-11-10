<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Alert;
use DB;

class CartController extends Controller
{
    //显示购物车
    public function index(Request $req){
        $user_id = session('id');

        $good_cart = Cart::where('user_id',$user_id)->get();
        

        return view('home.goods.cart',[
            'good_cart'=>$good_cart
        ]);
    }
    //加入购物车
    public function add(Request $req){
          
        $attr = $req->all();

        $attrs = explode(',',$attr['sku']);
        
        
        $user_id = session('id');
        $good_sku = $attrs[0];
        $good_id = $attrs[1];
        $data = Cart::getGoodName($good_id);
        $goods_name = $data->goods_name;
        $logo = $data->logo;
        $sku_id = $attrs[2];
        $sku_price = $attrs[3];
        $good_num = $attr['num'];
        $count = floatval($good_num);
        $price = floatval($sku_price);
        $money = $price*$count;
         
        $set = Cart::where('good_id',$good_id)->where('good_sku',$good_sku)->first();
    
        if($set){
            Cart::where('id',$set['id'])->increment('good_num',$req->num);
        }else{
            Cart::insert([
                'user_id'=>$user_id,
                'good_id'=>$good_id,
                'sku_id'=>$sku_id,
                'good_name'=>$goods_name,
                'good_sku'=>$good_sku,
                'good_num' => $good_num,
                'sku_price'=>$sku_price,
                'money'=>$money,
                'logo'=>$logo
            ]);
    
        }
       

        Alert::success("加入购物车成功！");
        return back();
        
    }
    //购物车数量修改
    public function good_cart_ajax(Request $req){
        $id = $req->id;
        $type = $req->type;
        $cart = Cart::where('id',$id)->frist();
        dd($cart);

        if($type == "add"){
            $data = Cart::where('id',$id)
                        ->update([
                            'good_num'=>$cart['good_num']*1+1,
                            'money'=>$cart['money'] +$money,
                        ]);
            echo $data;
        }
        if($type == "reduce"){
            $data = Cart::where('id',$id)
                        ->update([
                            'good_num'=>$cart['good_num']*1-1,
                            'money'=>$cart['money'] - $money,
                        ]);
            echo $data;
        }
        if($type == "any")
        {
            $data = Cart::where('id',$id)
                            ->update([
                                'good_num' => $req->num,
                                'money' => $money,
                            ]);
            echo $data;   
        }
    }
    public function good_cart_add(){
        Cart::where('id',$_GET['id'])->increment('good_num');
    }
    public function good_cart_reduce(){
        Cart::where('id',$_GET['id'])->decrement('good_num');
    }

    //删除商品
    public function delete(Request $req){
        $id = $req->cart_id;
        Cart::where('id',$id)->delete();
        Alert::success('删除成功,已从购物车中移除！');
        return back();
    }

}
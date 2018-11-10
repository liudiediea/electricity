<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use Image;

class Images extends Model
{
    //
    protected $table = 'goods_image';
    public $timestamps = false;
    protected $fillable = ['goods_id','small','big'];
      // 上传商品图片 以及缩略图
      public static function uploadGoodsImg($req,$id){
        foreach($req->image as $k=>$v){
            if($req->has('image')&&$req->image[$k]->isValid()){
                $date = date('Y-m-d');
                $url = $req->file('image')[$k]->store("/goods/bigImg/".$date);
                $path = $req->image[$k]->path();
                Image::configure(array('driver'=>'gd'));
                $img  = Image::make($path);
                // 上传大图 等比列
                $img->resize(800,null,function($c){
                    $c->aspectRatio();
                });
                @mkdir(public_path("/goods/bigImg/".$date),0777,true);
                $img->save(public_path($url));
                // 上传小图 等比列
                $img->resize(400,null,function($c){
                    $c->aspectRatio();
                });
                $smImg = str_replace("goods/bigImg/","goods/smImg/",$url);
                // dd($url,$smImg);
                @mkdir(public_path("uploads/goods/smImg/".$date),0777,true);
            
                $img->save(public_path('uploads/'.$smImg));

                DB::table('goods_image')->insert(['goods_id'=>$id,'small'=>$smImg,'big'=>$url]);
            }
        }
    }
    public static function getImage($id){
         return Images::where('goods_id',$id)->get();
    }
}

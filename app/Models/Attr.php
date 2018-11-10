<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    //
    protected $table = "goods_attr";
    public $timestamps = false;
    protected $fillable  = ['attr','goods_id'];
   
    // 增加商品属性以及属性值
    public static function addAttr($req,$id){
         $data = array_unique($req->attr);
            $color = [];
            $size = [];
            foreach($data as $v){
                if(strstr($v,"颜色")){
                    $color[]= $v;
                }else{
                    $size[] = $v;
                }
            }
        $colorId = Attr::insertGetId(['attr'=>'颜色','pid'=>0,'goods_id'=>$id]);
        $sizeId = Attr::insertGetId(['attr'=>'尺寸','pid'=>0,'goods_id'=>$id]);
        foreach($color as $v){
            Attr::insert(['attr'=>$v,'pid'=>$colorId,'goods_id'=>$id]);
        }
        foreach($size as $v){
            Attr::insert(['attr'=>$v,'pid'=>$sizeId,'goods_id'=>$id]);
        }
    }
  
      //取出商品属性
      public function level(){
        return $this->hasMany('App\Models\Attr','pid','id');
    }
    public static function getAttr(){ 
        $id = $_GET['id'];
        return Attr::with('level')->where('pid','0')->where('goods_id',$id)->get(['id','attr'])->toArray();
    }
   
    
}
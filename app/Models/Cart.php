<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cart extends Model
{
    //
    protected $table = 'shopping_cart';
    public  $fillable = ['user_id','sku_id','good_id','good_name','good_sku','good_num','money','logo'];

    public static function getGoodName($id){
         return DB::table('goods')->where('id',$id)->select('goods_name','logo')->first();
        //  return json_encode($data);

     }
  
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Storage;


class Good extends Model
{
    protected $table = 'goods';
    public $timestamps = false;
    protected $fillable = ['goods_name','logo','description','cat1_id','cat2_id','cat3_id','brand_id','price'];
    
    //显示商品列表页
    public static function showlist(){
       return DB::table('goods')
        ->leftjoin('brand','brand.id','=','goods.brand_id')
        ->select('goods.*','brand.name')
        ->get();
    }
    //上传LOGO
    public static function insert_logo(Request $req){
        //上传LOGO
        if($req->has('logo') && $req->logo->isValid()){
            $date = date('Ymd');
            $logo = $req->logo->store("goods/". $date );
            return $logo;
        }
    }
    //插入数据到SKU表
    public static function insert_sku($attr,$price,$count,$id){
        
        for($i = 0;$i<count($attr);$i++){
            if($i%2!=0)
            {
                $sku_attr[$i]=$attr[$i-1].$attr[$i];
            }
        }
        sort($sku_attr);
        
        for($i=0;$i<count($sku_attr);$i++){
            DB::table('goods_sku')->insert(
                ['goods_id' => $id, 'sku_attr' => $sku_attr[$i],'sku_price' => $price[$i], 'sku_num' => $count[$i] ]);
        }    
    }

    //获取商品列表页
    public static function getGoods(){

        if(isset($_GET['cat1_id']))
        {
           return  Good::where('cat1_id',$_GET['cat1_id'])->paginate(5);
        }else if(isset($_GET['cat2_id']))
        {
            return Good::where('cat2_id',$_GET['cat2_id'])->paginate(5);
        }else{
            return  Good::where('cat3_id',$_GET['cat3_id'])->paginate(5);
        }
        
    }

    //取出商品信息
    public static function getitem(){
        $id = $_GET['id'];
        return Good::where('id',$id)->first();
            
    } 

    









    public static function getattrVal(){
        return DB::select('SELECT an.attr_name,GROUP_CONCAT(av.attr_val) as list
                             from mall_goods_attr_name an
                             LEFT JOIN mall_goods_attr_val av on av.attr_id = an.id
                             GROUP BY an.id ');
       
    }


    
      
    
}

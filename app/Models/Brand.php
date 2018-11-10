<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Storage;
class Brand extends Model
{
    //
    protected $table = 'brand';

    public $timestamps = false;
    public $fillable = ['id','name','logo','address','describe','static','cat1_id','cat2_id','cat3_id'];

    public static function getImg(Request $req){
        if($req->has('logo') && $req->logo->isValid()){
            $date = date('Ymd');
            $logo = $req->logo->store("brand/". $date );
            return $logo;
        }
    }
   

}

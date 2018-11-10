<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public $timestamps = false;
    public $fillable = ['id','cat_name'];
    //      三级分类
    public function level3(){
        return $this->hasMany('App\Models\Category','parent_id','id');
    }

//        二级分类
    public function level2(){
        return $this->hasMany('App\Models\Category','parent_id','id')->with('level3');
    }

//         取分类数据
    public static function getCategory(){
        return Category::with('level2')->where('parent_id','0')->get(['id','cat_name'])->toArray();
    }

    public function deletecat($id){
        $category = CateGory::where('id',$id)->first();
            $seconds = Category::where('parent_id',$category->id)->get();
            $category->delete();
            for($i=0;$i<count($seconds);$i++){
                $third = Category::where('parent_id',$seconds[$i]->id)->get();
                $seconds[$i]->delete();
                for($j=0;$j<count($third);$j++){
                    $third[$j]->delete();
                }
            }
    }   
    public static function getCat($parent_id = 0){
    
        return Category::where('parent_id','=',$parent_id)->get();
    }

}

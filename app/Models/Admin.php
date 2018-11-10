<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Admin extends Model{
    protected $table = 'admin';
    public $timestamps = false;
    protected $fillable = ['username','password','sex','mobile','email','age','QQ'];

    public function Role(){
        return $this->belongsToMany('App\Models\Admin','admin_role','admin_id','role_id');
    }
    public static function getUrl($adminid){
    
        $data = DB::select("SELECT c.url_path
                            FROM mall_admin_role as a  
                            LEFT JOIN mall_role_privilege as  b ON a.role_id=b.role_id
                            LEFT JOIN mall_privilege as c ON b.pri_id=c.id
                            WHERE a.admin_id={$adminid} AND c.url_path!=''");
            
        $ret = [];
     
        foreach($data as $v){
            // 判断是否有多个URL（包含,）
            if(FALSE === strpos($v->url_path,",")){
                //如果没有就直接拿过来
                $ret[] = $v->url_path;
                
            }
            else{
                //如果有 就转成数组
                $tt = explode(',',$v->url_path);
                $ret = array_merge($ret,$tt);
            }
        }
    
        return $ret;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
     protected $table = 'privilege';
     public $timestamps = false;

     protected $fillable = ['id','pri_name'];
    
     public  function level2(){
    
        return $this->hasMany('App\Models\Privilege','parent_id','id');  
      
     }
     public static function getPrivilege(){
         return Privilege::with('level2')->where('parent_id','0')->get(['id','pri_name'])->toArray();
 
     }

     public function role(){
        return $this->belongsToMany('App\Models\Role','role_privilege','role_id','pri_id');
     }
}

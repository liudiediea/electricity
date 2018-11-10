<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    public $timestamps = false;
    protected $fillable = ['role_name'];

    public function privilege(){
        return $this->belongsToMany('App\Models\Role','role_privilege','role_id','pri_id');

    } 
    public function admin(){
        return $this->belongsToMany('App\Models\Role','admin_role','role_id','admin_id');

    } 
   
}

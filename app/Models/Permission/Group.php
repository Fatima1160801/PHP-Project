<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $fillable = ['id', 'group_name','created_by','updated_by'];
    public $timestamps = true;

    public function groups_users(){
        return $this->hasMany('App\Models\Permission\GroupUser','group_id','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\Permission\User','created_by');
    }

}

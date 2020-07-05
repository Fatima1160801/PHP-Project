<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'modules';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'module_name_na','module_name_fo'];
    public $timestamps = false;


    public function screens(){
        return $this->hasMany('App\Models\Permission\Screen','module_id','id');
    }

}

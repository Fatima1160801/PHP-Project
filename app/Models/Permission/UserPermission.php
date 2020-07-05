<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserPermission extends Model
{
    protected $table = 'user_perms';
    protected $primaryKey = ['user_id', 'screen_id', 'command_id', 'command_type_id'];
    protected $fillable = ['user_id', 'screen_id', 'command_id', 'command_type_id',
        'created_by', 'updated_by'];
    public $incrementing = false;

    public $timestamps = true;


    public static function checkUserPermission($screen_id,$command_id,$command_type_id,$user_id=null){
       if(!$user_id){
           $user_id = Auth::id();
       }
        $user_permission = UserPermission:: where('user_id',$user_id)
            ->where('screen_id',$screen_id)
            ->where('command_id',$command_id)
            ->where('command_type_id',$command_type_id)
            ->first();
        if($user_permission){
            return true;
        }else{
            return false;

        }


    }




}

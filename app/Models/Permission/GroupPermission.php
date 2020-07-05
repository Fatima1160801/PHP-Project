<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    protected $table = 'group_perms';
    protected $primaryKey = ['group_id','screen_id','command_id','command_type_id'];
    protected $fillable = ['group_id', 'screen_id','command_id','command_type_id'
        ,'created_by','updated_by'];
    public $timestamps = true;
    public $incrementing = false;



    public static function checkPermissionInGroup($group_id, $screen_id,$command_id,$command_type_id){
        $group_permission = GroupPermission::
              where('group_id',$group_id)
            ->where('screen_id',$screen_id)
            ->where('command_id',$command_id)
            ->where('command_type_id',$command_type_id)
            ->first();
        if($group_permission){
            return true;
        }else{
        return false;
        }

    }

}

<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'group_users';
    protected $primaryKey = ['user_id','group_id'];
    protected $fillable = ['user_id', 'group_id','created_by','updated_by'];
    public $timestamps = true;
    public $incrementing = false;

    public function group()
    {
        return $this->belongsTo('App\Models\Permission\Group','group_id');
    }

   public static function checkUserGroup($user_id,$group_id){
       $group_user = GroupUser::where('user_id',$user_id)
       ->where('group_id',$group_id)
       ->first();
       if($group_user){
           return 'checked';
       }else{
           return ' ';
       }

   }
}

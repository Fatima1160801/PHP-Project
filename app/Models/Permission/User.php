<?php

namespace App\Models\Permission;

use App\Models\Staff\Staff;
use App\Notifications\UserResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'password','user_name','user_full_name',
        'job_title','notes','user_photo','staff_id','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group_user(){
        return $this->hasMany('App\Models\Permission\GroupUser','user_id','id');
    }

    public static function userName($id){
        return  User::find($id)->user_full_name;
    }

    public function staff(){
        return $this->belongsTo(Staff::class,'staff_id','id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

}

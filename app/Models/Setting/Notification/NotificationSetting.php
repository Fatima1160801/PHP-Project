<?php


namespace App\Models\Setting\Notification;


use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    protected $table = 'notification_setting';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'screen_id', 'user_id','controller_name','action_name','to_supervisor',
                           'is_all_supervisors','notification_text','user_name_status'
    ];
    public $timestamps = false;

    public function anotherUsers()
    {
        return $this->hasMany('App\Models\Setting\Notification\NotificationSettingUser','not_setting_id','id');
    }

}
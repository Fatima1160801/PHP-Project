<?php


namespace App\Models\Setting\Notification;

use Illuminate\Database\Eloquent\Model;

class NotificationSettingUser extends Model
{
    protected $table = 'notification_setting_users';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'not_setting_id', 'user_id'];

    public $timestamps = false;

    public function notificationSetting()
    {
        return $this->belongsTo('App\Models\Setting\Notification\NotificationSetting','not_setting_id','id');
    }

}
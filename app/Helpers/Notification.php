<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 10/21/2018
 * Time: 1:03 PM
 */

namespace App\Helpers;

use App\Models\Notification\Notification;
use App\Models\Notification\NotificationUser;

class Notifications
{

    public static function add($notification_data = [])
    {
        $notification = new Notification();
        $notification->notification_user_id = $notification_data['notification_user_id'];
        $notification->notification_desc = $notification_data['notification_desc'];
        $notification->notification_url = $notification_data['notification_url'];
        $notification->created_on = date('Y-m-d H:i:s');
        $notification->save();

        if(is_array($notification_data['to_users']) && count($notification_data['to_users']) > 0)
        {
            foreach($notification_data['to_users'] as $to_user)
            {
                $notification_user = new NotificationUser();
                $notification_user->notification_id = $notification->id;
                $notification_user->to_user_id = $to_user;
                $notification_user->notification_status = 0;
                $notification_user->save();
            }
        }
    }

}
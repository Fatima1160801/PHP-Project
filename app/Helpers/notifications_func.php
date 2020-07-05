<?php


if (!function_exists('notifications')) {
    function notifications($controller_name,$action_name,$noti_url){

        $users_to_send = [];

        $notification_setting_record = \App\Models\Setting\Notification\NotificationSetting::where('user_id',Auth::id())
                                            ->where('controller_name',$controller_name)
                                            ->where('action_name',$action_name)
                                            ->first();

        if($notification_setting_record != null
            && $notification_setting_record->notification_text != null
            && $notification_setting_record->notification_text != ''
            && $notification_setting_record->notification_text != ' ')
        {
            if($notification_setting_record->to_supervisor == 1)
            {
                $main_supervisor = \App\Models\Staff\Staff::where('id',Auth::id())->value('supervisor_id');

                array_push($users_to_send,$main_supervisor);
            }

            if($notification_setting_record->is_all_supervisors == 1)
            {
                $supervisors = getSupervisores(Auth::id(),$users_to_send);
                $users_to_send = array_merge($users_to_send,$supervisors);
            }

            $notification_setting_users = \App\Models\Setting\Notification\NotificationSettingUser::where('not_setting_id',$notification_setting_record->id)->get();

            if($notification_setting_users != null){
                foreach($notification_setting_users as $u){
                    array_push($users_to_send,$u->user_id);
                }
            }

            App\Helpers\Notifications::add([
                'notification_user_id' => Auth::id(),
                'notification_desc' => getNotificationTextWithUsername($notification_setting_record->notification_text,Auth::user()->user_full_name,$notification_setting_record->user_name_status),
                'notification_url' => $noti_url,
                'to_users' => array_unique($users_to_send)
            ]);
        }
    }
}

if (!function_exists('getNotificationTextWithUsername')) {
    function getNotificationTextWithUsername($ntext,$username,$text_username_location){

        $final_notification_text = '';

        switch($text_username_location){
            case 0:
                $final_notification_text = $ntext;
                break;
            case 1:
                $final_notification_text = $username . ' ' . $ntext;
                break;
            case 2:
                $final_notification_text =  $ntext . ' ' . $username;
                break;
        }

        return $final_notification_text;
    }
}


if (!function_exists('getClassName')) {
  function getClassName($class_name){
     return substr(strrchr($class_name, "\\"), 1);
  }
}


    function getSupervisores($supervisor_id,$users_to_send){

        $supervisor = \App\Models\Staff\Staff::where('id',$supervisor_id)->value('supervisor_id');

        if($supervisor == null or $supervisor == 'null' or $supervisor == '') {
            return $users_to_send;
        } else {
            array_push($users_to_send,$supervisor);
            return getSupervisores($supervisor,$users_to_send);
        }

    }



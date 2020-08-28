<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 10/22/2018
 * Time: 2:47 PM
 */

namespace App\Http\Controllers\Setting;


use App\Http\Controllers\Controller;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification\Notification;
use App\Models\Notification\NotificationUser;
use App\Models\Setting\Notification\NotificationSetting;
use App\Models\Setting\Notification\NotificationSettingUser;
use App\Models\Permission\ScreenCommand;
use App\Models\Permission\Modules;
use App\Models\Permission\User;
use App\Models\Staff\Staff;

use DB;


class NotificationSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
         is_permitted(51, getClassName(__CLASS__),__FUNCTION__, 119, 7);

        $modules = Modules::get();
        $users = User::all();
        $staffs = Staff::all();
        $labels = inputButton(Auth::user()->lang_id ,0);
        $saved_notifications_settings = NotificationSetting::all();
        $saved_settings_users = $saved_notifications_settings->pluck('user_id')->unique()->toArray();
        $userPermissions = getUserPermission();

//        ,'screen_commands'
        return view('setting.notification.notification_settings',compact('staffs','saved_notifications_settings','saved_settings_users','users','labels','modules','userPermissions'));
    }


    public function saveNotiSettings(Request $request)
    {
        $input = $request->all();
        //var_dump($input);
        if(!empty($input['selected_users']) && is_array($input['selected_users']) && count($input['selected_users']) > 0)
        {
            foreach($input['selected_users'] as $selected_user)
            {
                $userSettingsRecord = NotificationSetting::where('user_id',$selected_user)
                                                            ->where('controller_name',$input['command_controller'])
                                                            ->where('action_name',$input['command_action'])
                                                            ->first();
                if($userSettingsRecord == null) {

                    $notificationSetting = new NotificationSetting();
                    $notificationSetting->screen_id = $input['screen_id'];
                    $notificationSetting->user_id = $selected_user;
                    $notificationSetting->controller_name = $input['command_controller'];
                    $notificationSetting->action_name = $input['command_action'];
                    $notificationSetting->to_supervisor = $input['to_main_sup'] == 'yes' ? 1 : 0;
                    $notificationSetting->is_all_supervisors = $input['to_all_sup'] == 'yes' ? 1 : 0;
                    $notificationSetting->notification_text = $input['notification_text'];
                    $notificationSetting->user_name_status = $input['username_location'];
                    $notificationSetting->save();

                    if(isset($input['to_another_users']) && is_array($input['to_another_users']) && count($input['to_another_users']) > 0){
                        foreach($input['to_another_users'] as $to_another_user){
                            $nsu = new NotificationSettingUser();
                            $nsu->not_setting_id = $notificationSetting->id;
                            $nsu->user_id = $to_another_user;
                            $nsu->save();
                        }
                    }

                } else if($userSettingsRecord != null) {

                    $userSettingsRecord->screen_id = $input['screen_id'];
                    $userSettingsRecord->user_id = $selected_user;
                    $userSettingsRecord->controller_name = $input['command_controller'];
                    $userSettingsRecord->action_name = $input['command_action'];
                    $userSettingsRecord->to_supervisor = $input['to_main_sup'] == 'yes' ? 1 : 0;
                    $userSettingsRecord->is_all_supervisors = $input['to_all_sup'] == 'yes' ? 1 : 0;
                    $userSettingsRecord->notification_text = $input['notification_text'];
                    $userSettingsRecord->user_name_status = $input['username_location'];
                    $userSettingsRecord->save();

                    if(isset($input['to_another_users']) && is_array($input['to_another_users']) && count($input['to_another_users']) > 0){
                        NotificationSettingUser::where('not_setting_id',$userSettingsRecord->id)->delete();
                        foreach($input['to_another_users'] as $to_another_user){
                            $nsu = new NotificationSettingUser();
                            $nsu->not_setting_id = $userSettingsRecord->id;
                            $nsu->user_id = $to_another_user;
                            $nsu->save();
                        }
                    }
                }

            }
        }
    }

}
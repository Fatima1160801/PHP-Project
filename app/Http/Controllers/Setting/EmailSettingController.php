<?php

namespace App\Http\Controllers\Setting;

use App\Helpers\Log;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\Controller;

use App\Models\Screens\EmailNotificationSettings;
use App\Models\Screens\ScreenCommand;
use App\Models\Setting\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class EmailSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        is_permitted(124, getClassName(__CLASS__), __FUNCTION__, 294, 7);
        $screen_id = 0;
        $option = [
            'screen_id' => ['attr' => ' data-live-search="true" '],
            'language_type' => ['html_type' => 13],
        ];
        // dd($_GET);
        if (isset($_POST['button_clicked']) && $_POST['button_clicked'] == 'save') {
            foreach ($request->command_id as $key => $command) {
                $command_id = $command;
                if (!empty($request["email_flag_" . $command])) {
                    $email_flag = 1;
                } else {
                    $email_flag = 0;
                }
                if (!empty($request["notit_flag_" . $command])) {
                    $notit_flag = 1;
                } else {
                    $notit_flag = 0;
                }
                if (!empty($request["command_type_" . $command])) {
                    $type = $request["command_type_" . $command];
                } else {
                    $type = 0;
                }
                // var_dump($request->screen_id,$command_id,$type);
                $found = EmailNotificationSettings::where('screen_id', $request->screen_id)->where('command_id', $command_id)->where("screen_command_type_id", $type)->first();
                // dd($found);
                if (empty($found)) {
                    $setting = new EmailNotificationSettings();
                    $setting->screen_id = $request->screen_id ?? 0;
                    $setting->command_id = $command_id;
                    $setting->screen_command_type_id = $type;
                    $setting->apply_notification_flag = $notit_flag;
                    $setting->apply_email_message_flag = $email_flag;
//                        $setting->notification_text=1;
//                        $setting->email_subject=1;
                    //$setting->email_text=1;
                    $setting->is_hidden = 0;
                    $setting->save();
//                        $setting->created_at=1;
                    $setting->created_by = Auth::user()->id ?? 0;;
//                        $setting->updated_at=1;
//                        $setting->updated_by=1;
//                        $setting->deleted_at=1;
//                        $setting->deleted_by =1;
                } else {
                    // dd($found->screen_id);
                    EmailNotificationSettings::where('screen_id', $request->screen_id)->where('command_id', $command_id)->where("screen_command_type_id", $type)->update(
                        [
                            'apply_notification_flag' => $notit_flag,
                            'apply_email_message_flag' => $email_flag,
                            'updated_by' => Auth::user()->id ?? 0,
                            'updated_at' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', \Carbon\Carbon::now()),
                        ]
                    );
                }

                // var_dump($request["check_".$command]);
                //                if(substr($key,0, 11) == 'email_flag_')
//                    {
//                        echo $command;echo"<br>";
//                        echo substr($key,0, 11);echo"<br>";
//                    }

//                echo $command;echo"<br>";
//                echo $request->email_flag_.$command;echo"<br>";

            }
            //dd("done");
            // exit;
            // dd($_POST);
//            foreach ($_POST as $key => $value)
//            {
//                if($value != '')
//                {
//                    var_dump($value);
////                    // dump(substr($key,0, 13));
////                    if(substr($key,0, 9) == 'labelNew_')
////                    {
////                        DB::table('labels')->where('id', substr($key, 9))->update(['label' => $value]);
////                    }
////                    if(substr($key,0, 13) == 'labelHintNew_')
////                    {
////                        // dump($value);
////                        DB::table('labels')->where('id', substr($key, 13))->update(['label_hint' => $value]);
////                    }
//                }
//            }
            // dd("************");
        }
        $labels = new Label();
        $userPermissions = getUserPermission();
        $generator = generator(123, $option, [
            'screen_id' => $_POST['screen_id'] ?? -1,
        ]);
        $html = $generator[0];
        $labels = $generator[1];

        $results = [];
        $apply_notification_flag = [];
        $apply_email_message_flag = [];
        if (isset($_POST['screen_id'])) {
            $screen_id = $_POST['screen_id'];
            $results = ScreenCommand::where('screen_id', $_POST['screen_id'])->with(["commandType"])->get();
            $apply_notification_flag = EmailNotificationSettings::where('screen_id', $_POST['screen_id'])->where("apply_notification_flag", 1)->pluck("command_id")->toArray();
            $apply_email_message_flag = EmailNotificationSettings::where('screen_id', $_POST['screen_id'])->where("apply_email_message_flag", 1)->pluck("command_id")->toArray();
            // dd($apply_notification_flag,$apply_email_message_flag);
        }
        //dd($results->commandType->command_na);
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('setting.email.email_render', compact('screen_id', 'apply_email_message_flag', 'apply_notification_flag', 'labels', 'html', 'userPermissions', 'results', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('setting.email.index', compact('screen_id', 'apply_email_message_flag', 'apply_notification_flag', 'labels', 'html', 'userPermissions', 'results','id'));
        }
    }
}
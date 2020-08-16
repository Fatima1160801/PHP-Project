<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 10/21/2018
 * Time: 1:35 PM
 */

namespace App\Http\Controllers\Setting;


use App\Http\Controllers\Controller;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification\Notification;
use App\Models\Notification\NotificationUser;
use DB;


class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUserNoti()
    {
        $notifications = NotificationUser::where('to_user_id',Auth::id())->orderBy('id','desc')->get();

        $not_viewed_noti = $notifications->where('notification_status',0)->count();

        $notifications_html = view('setting.notification.list',compact('notifications'))->render();

        return response(['noti_html' => $notifications_html,'not_viewed_noti' => $not_viewed_noti]);
    }


    public function setViewed()
    {
        $ns = NotificationUser::where('to_user_id',Auth::id())->get();
        foreach($ns as $n)
        {
            if($n->notification_status == 0){
                NotificationUser::where('to_user_id',Auth::id())
                                  ->where('id',$n->id)
                                  ->update(['notification_status' => 1]);
            }
        }
    }

    public function setRead($nid)
    {
        NotificationUser::where('id',$nid)->update(['notification_status' => 2]);
    }

}
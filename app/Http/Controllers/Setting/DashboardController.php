<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 11/26/2018
 * Time: 10:33 AM
 */

namespace App\Http\Controllers\Setting;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\UserDashboardBlocksSetting;
use App\Models\Setting\DashboardBlock;
use DB;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function saveDashboardSettings(Request $request)
    {
        $input = $request->all();

        $dashboardBlocks = DashboardBlock::all();

        UserDashboardBlocksSetting::where('user_id',Auth::id())->delete();

        foreach($dashboardBlocks as $block){
            if(!empty($input['block_'.$block->id]) && $input['block_'.$block->id] == 'on'){
                $userDashboardBlocksSetting = new UserDashboardBlocksSetting();
                $userDashboardBlocksSetting->user_id = Auth::id();
                $userDashboardBlocksSetting->block_id = $block->id;
                $userDashboardBlocksSetting->save();
            }
        }

        return response(['success' => true]);
    }


    public function filterLogs(Request $request)
    {
        $input = $request->all();

        $logs = DB::table('log_transactions_vw')->orderBy('trans_date' ,'desc');

        if(!empty($input['user_id']))
        {
            $logs = $logs->where('user_id',$input['user_id']);
        }

        if(!empty($input['trans_type']) && is_array($input['trans_type']))
        {
            $logs = $logs->whereIn('trans_type',$input['trans_type']);
        }

        if(!empty($input['logs_from_date']) && empty($input['logs_to_date']))
        {
            $logs = $logs->where('trans_date','>=',dateFormatDataBase($input['logs_from_date']));
        }

        if(empty($input['logs_from_date']) && !empty($input['logs_to_date']))
        {
            $logs = $logs->where('trans_date','<=',dateFormatDataBase($input['logs_to_date']));
        }

        if(!empty($input['logs_from_date']) && !empty($input['logs_to_date']))
        {
            $logs_from_date = dateFormatDataBase_($input['logs_from_date']);
            $logs_to_date = dateFormatDataBase_($input['logs_to_date']);
            $logs = $logs->whereRaw("trans_date BETWEEN '$logs_from_date' AND '$logs_to_date'");
        }

        $logs = $logs->get();
        $userPermissions = getUserPermission();

        return view('setting.dashboard.trans_logs',compact('logs','userPermissions'));

    }

}
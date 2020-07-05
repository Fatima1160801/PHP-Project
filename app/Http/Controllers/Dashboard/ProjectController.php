<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Report\IndicatorsAndResultsBasedOnProjectReportExportExcel;
use App\Http\Controllers\Report\ProjectReportExportExcel;
use App\Http\Controllers\Report\ReportController;
use App\Models\Activity\ActivityLocationView;
use App\Models\Activity\ActivityStaff;
use App\Models\Beneficiary\BeneficiaryType;
use App\Models\Donor\Donor;
use App\Models\Permission\UserDataPermission;
use App\Models\Permission\UserDataPermissionModule;
use App\Models\Programs\Program;
use App\Models\Project\Currencies;
use App\Models\Project\IndicatorResultChainVM;
use App\Models\Project\Project;
use App\Models\Project\ProjectAchievementIndicatorVW;
use App\Models\Project\ProjectCities;
use App\Models\Project\ProjectHistory;
use App\Models\Project\ProjectDonors;
use App\Models\Project\ProjectOverallObjective;
use App\Models\Project\ProjectResultObjective;
use App\Models\Project\ProjectSpecificObjective;
use App\Models\Project\ProjectStaffs;
use App\Models\Project\ProjectStrategics;
use App\Models\Project\ProjectTargetedBeneficiaries;
use App\Models\Project\TargetedBeneficiaries;
use App\Models\Report\IndicatorsAndResultsBasedProjectVW;
use App\Models\Report\Project\ReportActivities;
use App\Models\Report\Project\ReportProject;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use App\Models\Setting\C\City;
use App\Models\Staff\Staff;
use App\Models\Activity\Activity;
use App\Models\Strategic\StrategicPlan;
use App\Models\RealTimeRecording\RealTimeRecording;
use App\Models\Task\Task;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Validator;

use App\Helpers\Log;
use function GuzzleHttp\Promise\task;


//class ProjectController extends Controller
class ProjectController extends ReportController

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

    public function index($project_id)
    {
        //dd($project_id);
        is_permitted(8, getClassName(__CLASS__), __FUNCTION__, 102, 7);

    //    $pro=Project::findOrfail($project_id);
//        $strategics = StrategicPlan::orderBy('id', 'desc')->get();
//
//        if (!isset($strategic_id)) {
//            $strategic_id = $strategics->max('id');
//        }
//
//
//        //$projects = Project::where('strategic_id', $strategic_id)->orderBy('id', 'desc');
//
//        $projects = Project::getProject($strategic_id);
//        $messageDeleteProject = getMessage('2.23');
        $labels = inputButton(Auth::user()->lang_id, 39);
        $userPermissions = getUserPermission();
        $activities = Activity::getAllActivity($project_id);
        $in=[];
        $lists=new ActivityLocationView();
        if(!empty($activities->where("parent_id",0))){
            foreach ($activities->where("parent_id",0) as $item){
                $in[]=$item->id;
            }
        }
        if(sizeof($in) > 0){
            $lists=ActivityLocationView::whereIn('activity_id',$in)->get();
        }
//
//        if (Auth::user()->lang_id == 2) {
//            foreach ($strategics as $strategic) {
//                $strategic->strategic_name_na = $strategic->strategic_name_fo;
//            }
//            foreach ($projects as $project) {
//                $project->project_name_na = $project->project_name_fo;
//            }
//        }
        return view('dashboard.project.index', compact('lists','project_id','userPermissions','labels','activities','pro'));
        //return view('dashboard.project.index', compact('projects', 'messageDeleteProject', 'labels', 'strategic_id', 'strategics', 'userPermissions'));
    }

    function getTaskByActivity($p_id,$act_id,$type){
        if($type==0){
            $task_list= Task::where('is_hidden',0)->where('project_id',$p_id)->where('activity_id',$act_id)->orderBy("task_order","asc")->get();
        }else{
            $task_list= Task::where('is_hidden',0)->where('project_id',$p_id)->where('sub_activity_id',$act_id)->orderBy("task_order","asc")->get();
        }
         if(sizeof($task_list) > 0){
             $view= view('dashboard.project.task_components', compact('task_list'))->render();
             return response()->json(['status' => true,'html'=>$view,'message' => getMessage('2.320')]);
         }else{
             return response()->json(['status' => false,'html'=>'','message' => getMessage('2.320')]);
         }
    }

    function zohoTaskOrder(Request $request){
        $type=$request->order_type ?? 1;
//        if($type==1){
//
//        }elseif($type==2){
//
//        }else{
//
//        }
        $itemIds=$request->idList;
        $orderIds=$request->orderList;

        if(!empty($itemIds) && !empty($orderIds)){
            for($i=0;$i < sizeof($itemIds);$i++){
                $found = task::where('id',$itemIds[$i])->first(['id']);
                if(!empty($found)){
                    task::where('id',$itemIds[$i])
                        ->update(['task_order' =>$orderIds[$i],"task_status_id"=>$type]);
                }else{

                }
            }
            return response()->json(['status' => true, 'msg' => '']);
        }else{
            return response()->json(['status' => false, 'msg' => '']);
        }
    }

    public function filterDashboard(Request $request)
    {
       // dd($request->page);
        $page=$request->page;
        if(empty($page)){
            $request->page=1;
        }

        $input = $request->all();
        switch (Auth::user()->user_type) {
            case 1:
                $query = Project::where('id',"!=",9999999999);
                break;
            case 2:
                break;
            case 3:
                $projects_ids = ProjectStaffs::where('staff_id', !empty(Auth::user()->staff()->id) ? Auth::user()->staff()->id : Auth::id())
                    ->pluck('project_id')
                    ->toArray()
                    ->unique();
                $query = Project::whereIn('id', $projects_ids);//->paginate(3)
                break;
        }

        if (!empty($input['program_id'])) {
            $query = $query->where('program_id', $input['program_id']);
        }

        if (!empty($input['by_date'])) {
            switch ($input['by_date']) {
                case 'l3m':
                    $query = $query->where('plan_start_date', ">=", date('Y-m-d H:i:s', strtotime('-3 months')));
                    break;
                case 'l6m':
                    $query = $query->where('plan_start_date', ">=", date('Y-m-d H:i:s', strtotime('-6 months')));
                    break;
                case 'ly':
                    $query = $query->where('plan_start_date', ">=", date('Y-m-d H:i:s', strtotime('-1 year')));
                    break;
            }
        }

        if (!empty($input['status_open']) && !empty($input['status_closed'])) {
            $query = $query->whereIn('is_hidden', [0, 1]);
        }

        if (!empty($input['status_open']) && empty($input['status_closed'])) {
            $query = $query->where('is_hidden', 0);
        }

        if (empty($input['status_open']) && !empty($input['status_closed'])) {
            $query = $query->where('is_hidden', 1);
        }
        //dd($query->paginate(3));
        $projects = $query->paginate(4);
        $opp_data_list =  $query->paginate(4);
        if (sizeof($opp_data_list) > 0) {
            $view = view('dash_widget.project_component', compact('opp_data_list'))->render();
            return response()->json(['status' => true, 'html' => $view]);
        } else {
            return response()->json(['status' => false]);
        }

        //dd($projects);
        // return view('dash_widget.project_component', compact('opp_data_list'));
        //return view('dashboard.filtered_projects', compact('projects'));
    }

    public function filterDashboardActivity(Request $request)
    {
        $input = $request->all();
        switch (Auth::user()->user_type) {
            case 1:
                $query = Activity::where("id","!=",999999);
                break;
            case 2:

                break;
            case 3:
                $activities_ids = ActivityStaff::where('staff_id', !empty(Auth::user()->staff()->id) ? Auth::user()->staff()->id : Auth::id())
                    ->pluck('activity_id')->unique()->toArray();
                $query = Activity::whereIn('id', $activities_ids);
                break;
        }
        if (!empty($input['project_id'])) {
            $query = $query->where('project_id', $input['project_id']);
        }
        if (!empty($input['by_date'])) {
            switch ($input['by_date']) {
                case 'l3m':
                    $query = $query->where('planed_start_date', ">=", date('Y-m-d H:i:s', strtotime('-3 months')));
                    break;
                case 'l6m':
                    $query = $query->where('planed_start_date', ">=", date('Y-m-d H:i:s', strtotime('-6 months')));
                    break;
                case 'ly':
                    $query = $query->where('planed_start_date', ">=", date('Y-m-d H:i:s', strtotime('-1 year')));
                    break;
            }
        }

        if (!empty($input['status_open']) && !empty($input['status_closed'])) {
            $query = $query;
        }
        if (!empty($input['status_open']) && empty($input['status_closed'])) {
            $query = $query->where('completion_percent', "<", 100);
        }
        if (empty($input['status_open']) && !empty($input['status_closed'])) {
            $query = $query->where('completion_percent', 100);
        }
        //$activities = $query;
        $opp_data_list = $query->paginate(4);
        if(sizeof($opp_data_list) > 0){
            $view= view('dash_widget.activity_component',compact('opp_data_list'))->render();
            return response()->json(['status' => true, 'html' => $view]);
        }else{
            return response()->json(['status' => false]);
        }
        // dd($activities);
        // return view('dashboard.filtered_activities', compact('activities'));

        //return view('dash_widget.activity_component', compact('opp_data_list'));
    }
}
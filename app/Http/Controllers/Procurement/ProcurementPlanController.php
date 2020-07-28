<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\plan;
use App\Models\Procurement\Service;
use App\Models\Vendor\JobTitle;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Vendor_Report_Vw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class ProcurementPlanController extends Controller
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

    public function index()
    {
        is_permitted(150, getClassName(__CLASS__), __FUNCTION__, 330, 7);
       $project_list=plan\Project::get();
       $activity_list=plan\Activity::get();
       $id=Auth::user()->lang_id;

        $option = [
            //  'service_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            // 'service_name_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
          //  'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'budget' => ['inputClass' => 'check-is-number'],
'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            //'project_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
           // 'activity_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'service_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
           ' item_groups_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'purchase_way'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'start_date'=> ['inputType' => 'Date'],
        ];
        //$serviceObj= new Service();
        $vendor=new Vendor();
        $generator = generator(150, $option,$vendor);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.plan.index', compact('labels', 'html', 'userPermissions','activity_list','project_list','id'));
    }
public function projectplan(){
        return View('procurement.plan.project');
}
    public function search( $id)
    {
        $query = plan\Project::query();
        $data_list= $query->where('project_name_na','like', '%' . $id . '%')->orWhere('project_name_fo','like', '%' . $id . '%')->get();
        if(!empty($data_list)){
            return response(['status' => true, 'project' => $data_list,'id'=>Auth::user()->lang_id]);
        }else{
            return response(['status' => false, 'project' => []]);
        }

    }

    public function searchAct( $id)
    {
        $query = plan\Activity::query();
        $data_list= $query->where('activity_name_na','like', '%' . $id . '%')->orWhere('activity_name_fo','like', '%' . $id . '%')->get();
        if(!empty($data_list)){
            return response(['status' => true, 'activity' => $data_list,'id'=>Auth::user()->lang_id]);
        }else{
            return response(['status' => false, 'activity' => []]);
        }

    }

}
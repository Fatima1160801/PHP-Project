<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\plan;
use App\Models\Procurement\Service;
use App\Models\Vendor\JobTitle;
use App\Models\Vendor\Vendor;
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
        return view('procurement.plan.index', compact('labels', 'html', 'userPermissions','activity_list','project_list'));
    }
public function projectplan(){
        return View('procurement.plan.project');
}

}
<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Models\Procurement\Activity;
use App\Models\Procurement\ActivityLocationView;
use App\Models\Procurement\Currencies;
use App\Models\Procurement\Plan;
use App\Models\Procurement\Plan_Items;
use App\Models\Project;

use App\Models\Procurement\Service;
use App\Models\Vendor\ContactPersons;
use App\Models\Vendor\JobTitle;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Vendor_Report_Vw;
use App\Models\Vendor\Vendor_Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

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

    public function index($type=1,$project_id=null,$activity_id=null)
    {
        is_permitted(150, getClassName(__CLASS__), __FUNCTION__, 335, 7);
       $project_list=\App\Models\Procurement\Project::get();
       $activity_list=Activity::get();
       $id=Auth::user()->lang_id;
        $messageDeleteType = getMessage('2.417');

        $option = [

            'budget' => ['inputClass' => 'check-is-number'],
'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
           'currency_id'=>["attr"=>"disabled"],
            'service_type_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
           'item_group_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'purchase_method_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'start_date'=> ['inputType' => 'Date'],
        ];
        $vendor=new Plan();
        $vendor=new Plan();

        $generator = generator(150, $option,$vendor);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $activityProjectName=[];
        $currencyName=[];
        $city=[];
        $projectName=[];
        $projectValue = \App\Models\Procurement\Project::find($project_id);
        if (($type==2 ||$type==3 )&& empty($projectValue)) {
            return response(['status' => false, 'message' => getMessage('2.425')]);
        }
        $activityValue=Activity::find($activity_id);
        if ($type==3 &&empty($activityValue)) {
            return response(['status' => false, 'message' => getMessage('2.426')]);
        }
        if($project_id !=null && $activity_id!=null ){
            $activityProjectName=Activity::where('id',$activity_id)->with("project")->first();
          //  $currencyName=\App\Models\Procurement\Project::where('id',$activityProjectName->project_id)->with("currency")->first();
            $currencyName=\App\Models\Procurement\Project::where('id',$project_id)->with("currency")->first();
            $city=Activity::find($activity_id)->cities()->get();
           // $project_id=$activityProjectName->project_id;
        }
        else if($project_id !=null){
            $projectName=\App\Models\Procurement\Project::where('id',$project_id)->with("currency")->first();
        }
        return view('procurement.plan.index', compact('labels', 'html', 'userPermissions','activity_list','project_list','id','messageDeleteType','type','activityProjectName','currencyName','city','projectName','project_id','activity_id'));
    }
    public function search( $id)
    {

        $query = \App\Models\Procurement\Project::query();
        $data_list= $query->where('project_name_na','like', '%' . $id . '%')->orWhere('project_name_fo','like', '%' . $id . '%')->with(["currency"])->take(10)->get();
        if(!empty($data_list)){
            return response(['status' => true, 'project' => $data_list,'id'=>Auth::user()->lang_id]);
        }else{
            return response(['status' => false, 'project' => []]);
        }
    }



    public function searchAct($id,$project)
    {
       // $query = Activity::query();
//        if(Auth::user()->lang_id==1)
        $data_list= Activity::where('project_id',$project)
            ->where(function ($query) use ($id) {
                $query->where('activity_name_na','like', '%' . $id . '%')
                    ->orWhere('activity_name_fo','like', '%' . $id . '%');
            })->take(10)->get();

//       -> where('activity_name_na','like', '%' . $id . '%')->take(10)->get();
//       else
//           $data_list= Activity::where('project_id',$project)->where('activity_name_fo','like', '%' . $id . '%')->take(10)->get();

        if(!empty($data_list)){
            return response(['status' => true, 'activity' => $data_list,'id'=>Auth::user()->lang_id]);
        }else{
            return response(['status' => false, 'activity' => []]);
        }

    }
    public function store(Request $request,$project_id,$activity_id){
        is_permitted(150, getClassName(__CLASS__), __FUNCTION__, 336, 1);


        try {

           DB::beginTransaction();
            $planObject=new Plan_Items();
            $planObject->item=$request->item;
            $planObject->sector_id=$request->sector_id;
            $planObject->service_type_id=$request->service_type_id;
            $planObject->budget=$request->budget;
            $planObject->currency_id=$request->selectedcurrency;
            $planObject->purchase_method_id=$request->purchase_method_id;
            $planObject->item_group_id=$request->item_group_id;

            $planObject->start_date=dateFormatDataBase($request->start_date);
            $planObject->delivery_date=dateFormatDataBase($request->delivery_date);
            $projectBudget = \App\Models\Procurement\Project::where('id', $project_id)->first();
            if (!empty($project_id)&& $project_id!=0) {
            if($planObject->start_date < $planObject->delivery_date ||$planObject->start_date == $planObject->delivery_date) {
//                if (!empty($project_id)&& $project_id!=0) {
                    $query = Plan::where('project_id', $project_id)->first();
                    if (!empty($query)) {
                        $project = Plan::where('project_id', $project_id)->pluck("id")->toArray();
                        $budgetSum = Plan_Items:: whereIn('plan_id', $project)
                            ->sum('budget');

                        if (($budgetSum + $request->budget) <= $projectBudget->plan_budget) {


                            if (!empty($activity_id) && $activity_id!=0) {

                                $activitydate = Activity::where('id', $activity_id)->first();
                                if ((empty($activitydate->act_end_date) && empty($activitydate->act_start_date)) || (($planObject->delivery_date < dateFormatDataBase($activitydate->act_end_date) || $planObject->delivery_date == dateFormatDataBase($activitydate->act_end_date)) && ($planObject->delivery_date > dateFormatDataBase($activitydate->act_start_date) || $planObject->delivery_date == dateFormatDataBase($activitydate->act_start_date)))) {
                                    $query1 = $query->where('activity_id', $activity_id)->first();
                                    if (!empty($query1)) {

                                        $planObject->plan_id = $query1->id;
                                        $planObject->created_by = Auth::user()->id;
                                        $planObject->save();

                                    } else {
                                        $newPlanObj = new Plan();
                                        $newPlanObj->project_id = $project_id;
                                        $newPlanObj->activity_id = $activity_id;
                                        $newPlanObj->created_by = Auth::user()->id;
                                        $newPlanObj->save();
                                        $planObject->plan_id = $newPlanObj->id;
                                        $planObject->created_by = Auth::user()->id;
                                        $planObject->save();
                                    }
                                } else {
                                    return response(['status' => false, 'message' => getMessage('2.418')]);
                                }
                            } else {
                                $query2 = Plan::where('project_id', $project_id)->whereNull('activity_id')->first();
                                if (!empty($query2)) {
                                    $planObject->plan_id = $query2->id;

                                    $planObject->created_by = Auth::user()->id;
                                    $planObject->save();

                                } else {
                                    $newPlanObj = new Plan();
                                    $newPlanObj->project_id = $project_id;
                                    $newPlanObj->activity_id = null;
                                    $newPlanObj->created_by = Auth::user()->id;
                                    $newPlanObj->save();
                                    $planObject->plan_id = $newPlanObj->id;
                                    $planObject->created_by = Auth::user()->id;
                                    $planObject->save();
                                }
                            }


                        } else {
                            return response(['status' => false, 'message' => getMessage('2.421')]);
                        }
                    } else {
                        if ($request->budget <= $projectBudget->plan_budget) {
                            if (!empty($activity_id)) {
                                $activitydate = Activity::where('id', $activity_id)->first();
                                if ((empty($activitydate->act_end_date) && empty($activitydate->act_start_date)) || (($planObject->delivery_date < dateFormatDataBase($activitydate->act_end_date) || $planObject->delivery_date == dateFormatDataBase($activitydate->act_end_date)) && ($planObject->delivery_date > dateFormatDataBase($activitydate->act_start_date) || $planObject->delivery_date == dateFormatDataBase($activitydate->act_start_date)))) {
                                $newPlanObj = new Plan();
                                $newPlanObj->project_id = $project_id;
                                $newPlanObj->activity_id = $activity_id;
                                $newPlanObj->created_by = Auth::user()->id;
                                $newPlanObj->save();
                                $planObject->plan_id = $newPlanObj->id;
                                $planObject->created_by = Auth::user()->id;
                                $planObject->save();
                            } else {
                                return response(['status' => false, 'message' => getMessage('2.418')]);
                            }
                            } else {
                                $newPlanObj = new Plan();
                                $newPlanObj->project_id = $project_id;
                                $newPlanObj->activity_id = null;
                                $newPlanObj->created_by = Auth::user()->id;
                                $newPlanObj->save();
                                //$planObject->fill($field);
                                $planObject->plan_id = $newPlanObj->id;
                                $planObject->created_by = Auth::user()->id;
                                $planObject->save();
                            }
                        } else {
                            return response(['status' => false, 'message' => getMessage('2.421')]);
                        }
                    }


                } //           }
                else {
                    return response(['status' => false, 'message' => getMessage('2.423')]);
                }


                $obj = Plan_Items::where('id', $planObject->id)->with(["service", "sector", "itemgroup", "purchase"])->first();

            }
            else
                return response(['status' => false, 'message' => getMessage('2.419')]);

        }catch (\Throwable $exception) {
            DB::rollBack();
            $message =  (is_numeric($exception->getMessage()) ? getMessage(2.246) : getMessage(2.245));
//            dd($exception->getMessage());
            return response()->json([
                'status'=>false,
                'message' => $message,
                'code'=>$exception->getCode(),
                'result'=>[],
            ]);
        } finally {
            DB::commit();
        }

        return response(['status' => true, 'message' => getMessage('2.1'),'list'=>$obj,'lang'=>Auth::user()->lang_id]);

   }
public function getProjectPlan($id){

        $list=\App\Models\Procurement\Plan::where('project_id',$id)->pluck("id")->toArray();
    if (!empty($list)) {
        $query = Plan_Items::whereIn('plan_id', $list)->with(["service","sector","itemgroup","purchase"])->get();
        if (!empty($query)) {
            return response(['status' => true, 'plan' => $query,'lang'=>Auth::user()->lang_id]);
        } else {
            return response(['status' => false, 'plan' => []]);
        }
    }
    else
        return response(['status' => false, 'plan' => []]);
}
    public function getProjectActivityPlan($project,$activity){
if($activity!=0){

    $city=Activity::find($activity)->cities()->get();
    //dd($citystate);
   // $city=ActivityLocationView::where('activity_id',$activity)->get();

        $list=\App\Models\Procurement\Plan::where('project_id',$project)->where('activity_id',$activity)->pluck("id")->toArray();
        if (!empty($list)) {
            $query = Plan_Items::where('plan_id', $list)->with(["service","sector","itemgroup","purchase"])->get();

            if (!empty($query)) {

                return response(['status' => true,'state'=>$city, 'plan' => $query,'lang'=>Auth::user()->lang_id]);
            } else {
                return response(['status' => false, 'plan' => [],'state'=>$city]);
            }
        }
        else
            return response(['status' => false, 'plan' => [],'state'=>$city]);
    }
else{
    $list=\App\Models\Procurement\Plan::where('project_id',$project)->whereNull('activity_id')->pluck("id")->toArray();
    if (!empty($list)) {
        $query = Plan_Items::where('plan_id', $list)->with(["service","sector","itemgroup","purchase"])->get();

        if (!empty($query)) {
            return response(['status' => true, 'plan' => $query,'lang'=>Auth::user()->lang_id]);
        } else {
            return response(['status' => false, 'plan' => []]);
        }
    }
    else
        return response(['status' => false, 'plan' => []]);
}
}
    public function update(Request $request,$project_id,$activity_id)
    {
        is_permitted(150, getClassName(__CLASS__), __FUNCTION__, 337, 2);

        $planObject = Plan_Items::find($request->id);
        if (empty($planObject)) {
            return response(['status' => false, 'message' => getMessage('2.422')]);
        }
        $planObject1 = Plan_Items::where('id',$request->id)->first();
       $oldBudget=$planObject1->budget;
        $planObject->item = $request->item;
        $planObject->sector_id = $request->sector_id;
        $planObject->service_type_id = $request->service_type_id;
        $planObject->budget = $request->budget;
        $planObject->currency_id = $request->selectedcurrency;
        $planObject->purchase_method_id = $request->purchase_method_id;
        $planObject->item_group_id = $request->item_group_id;

        $projectBudget = \App\Models\Procurement\Project::where('id', $project_id)->first();
        $planObject->start_date = dateFormatDataBase($request->start_date);
        $planObject->delivery_date = dateFormatDataBase($request->delivery_date);
        $project = Plan::where('project_id', $project_id)->pluck("id")->toArray();
        $budgetSum = Plan_Items:: whereIn('plan_id', $project)
            ->sum('budget');
        if($planObject->start_date < $planObject->delivery_date ||$planObject->start_date == $planObject->delivery_date) {

            if ($oldBudget == $request->budget || (($budgetSum + $request->budget-$oldBudget) <= $projectBudget->plan_budget)) {


                if (!empty($activity_id) && $activity_id != 0) {
                    if (($request->actStartDate == null && $request->actEndDate == null) || (($planObject->delivery_date < dateFormatDataBase($request->actEndDate) || $planObject->delivery_date == dateFormatDataBase($request->actEndDate) )&& ($planObject->delivery_date > dateFormatDataBase($request->actStartDate) || $planObject->delivery_date == dateFormatDataBase($request->actStartDate)))) {
                        $planObject->updated_by = Auth::user()->id;
                        $planObject->save();
                        $obj = Plan_Items::where('id', $request->id)->with(["service", "sector", "itemgroup", "purchase"])->first();


                        return response(['status' => true, 'message' => getMessage('2.2'), 'list' => $obj, 'lang' => Auth::user()->lang_id]);
                    } else {
                        return response(['status' => false, 'message' => getMessage('2.418')]);

                    }

                } else if ($activity_id == 0) {
                    if (($request->actStartDate == null && $request->actEndDate == null) || (($planObject->delivery_date < dateFormatDataBase($request->actEndDate) || $planObject->delivery_date == dateFormatDataBase($request->actEndDate)) && ($planObject->delivery_date > dateFormatDataBase($request->actStartDate) || $planObject->delivery_date == dateFormatDataBase($request->actStartDate)))) {
                        $planObject->updated_by = Auth::user()->id;
                        $planObject->save();
                        $obj = Plan_Items::where('id', $request->id)->with(["service", "sector", "itemgroup", "purchase"])->first();


                        return response(['status' => true, 'message' => getMessage('2.2'), 'list' => $obj, 'lang' => Auth::user()->lang_id]);

                    } else {
                        return response(['status' => false, 'message' => getMessage('2.418')]);
                    }
                }

            } else {
                return response(['status' => false, 'message' => getMessage('2.421')]);

            }
        }
        else
            return response(['status' => false, 'message' => getMessage('2.423')]);
    }


    public function delete($id)
    {
        is_permitted(150, getClassName(__CLASS__), __FUNCTION__, 338, 4);
        try {
            $planItemObj = Plan_Items::find($id);
            if (empty($planItemObj)) {
                return response(['status' => false, 'message' => getMessage('2.420')]);
            }

            $planItemObj->delete();
            if ($planItemObj) {
                $planItemObj->update(["deleted_by" => Auth::user()->id]);
            }


            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.424');
            return response(['status' => false, 'message' => $message]);
        }

    }
   public function export($export_id,$projectId,$activityId,$act,$screentype){
       is_permitted(150, getClassName(__CLASS__), __FUNCTION__, 335, 7);
       $option=[];
       $vendor=new Plan();
       $id=Auth::user()->lang_id;
       $generator = generator(150,$option,$vendor);
       $html = $generator[0];
       $labels = $generator[1];
       $userPermissions = getUserPermission();
       if($projectId==0){
            $arr=[];
            $city=[];
            $project='';
            $activity='';
            $currency='';
           $projectfo='';
           $activityfo='';
           $currencyfo='';

   }
        else{
            $projectt=\App\Models\Procurement\Project::where('id',$projectId)->with(["currency"])->first();
            $project=$projectt->project_name_na;
            $currency=$projectt->currency->currency_name_na;
            $projectfo=$projectt->project_name_fo;
            $currencyfo=$projectt->currency->currency_name_fo;
            if($activityId==0 && $act==0){
                $list=\App\Models\Procurement\Plan::where('project_id',$projectId)->pluck("id")->toArray();
            if (!empty($list)) {
                $query = Plan_Items::whereIn('plan_id', $list)->with(["service","sector","itemgroup","purchase"])->get();
                if (!empty($query)) {
                    $arr=$query;
                } else {
                    $arr=[];
                }
            }
            $city=[];
            $activity='';
                $activityfo='';
        }
            else if($activityId==0 && $act==1){
                $list=\App\Models\Procurement\Plan::where('project_id',$projectId)->whereNull('activity_id')->pluck("id")->toArray();
                if (!empty($list)) {
                    $query = Plan_Items::where('plan_id', $list)->with(["service","sector","itemgroup","purchase"])->get();

                    if (!empty($query)) {
                        $arr=$query;
                    } else {
                        $arr=[];
                    }
                }
                else
                    $arr=[];
                $city=[];
                $activity='';
                $activityfo='';
            }
            else{
                $activityn=Activity::where('id',$activityId)->first();
                $activity=$activityn->activity_name_na;
                $activityfo=$activityn->activity_name_fo;
                $city=Activity::find($activityId)->cities()->get();
                $list=\App\Models\Procurement\Plan::where('project_id',$projectId)->where('activity_id',$activityId)->pluck("id")->toArray();
                if (!empty($list)) {
                    $query = Plan_Items::where('plan_id', $list)->with(["service","sector","itemgroup","purchase"])->get();

                    if (!empty($query)) {

                        $arr=$query;
                    } else {
                        $arr=[];
                    }
                }
                else
                    $arr=[];
            }
            }

       if($export_id ==1){
           $pdf = PDF::loadView('procurement.plan.pdf',
               [
                   'arr' => $arr,
                   'city' => $city,
                   'project' => $project,
                   'activity' => $activity,
                   'currency' => $currency,
                   'projectfo'=>$projectfo,
                   'currencyfo'=>$currencyfo,
                   'activityfo'=>$activityfo,

               ], [],
               [
                   'format' => 'A4-L',
                   'mode' => 'utf-8',
                   'margin_top' =>10,
                   'margin_left' => 0,
                   'margin_button' => 10,
                   'margin_right' => 0,
               ]
           );
           return $pdf->download('plan.pdf');
       }else{
           return view('procurement.plan.export',compact('arr','city','project','activity','currency','projectfo','activityfo','currencyfo','screentype','id'));
       }
   }
    function getServiceBySector($id){
        if(Auth::user()->lang_id==1)
        $arr= \App\Models\Procurement\Service::where('sector_id',$id)->pluck("service_name_na","id")->toArray();
        else
            $arr= \App\Models\Procurement\Service::where('sector_id',$id)->pluck("service_name_fo","id")->toArray();

        if(!empty($arr)){
            return response(['status' => true, 'list' => $arr]);
        }else{
            return response(['status' => false, 'list' => []]);
        }

    }
    function getItemGroupBySector($id){
        if(Auth::user()->lang_id==1)
            $arr= \App\Models\Procurement\ItemGroups::where('sector_id',$id)->pluck("item_group_name_na","id")->toArray();
        else
            $arr= \App\Models\Procurement\ItemGroups::where('sector_id',$id)->pluck("item_group_name_fo","id")->toArray();

        if(!empty($arr)){
            return response(['status' => true, 'list' => $arr]);
        }else{

            return response(['status' => false, 'list' => []]);
        }

    }
    function searchModal($id){
        $activity=Activity::where('project_id',$id)->take(10)->get();
        if(!empty($activity)){
            return response(['status' => true, 'activity' => $activity,'id'=>Auth::user()->lang_id]);
        }else{
            return response(['status' => false, 'activity' => []]);
        }

    }
    function tabs(){
        $p="edit";
        $c=2;
        return view('procurement.tabs',compact('c','p'));
    }
    function layout(){
        return view('procurement.layout');
    }
    function sidebar(){
        return view('procurement.sidebar');
    }
    function tabs2(){
        $p="edit";
        $c=2;
        return view('procurement.tabs2',compact('c','p'));
    }
}
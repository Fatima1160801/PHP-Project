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

    public function index()
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

        $generator = generator(150, $option,$vendor);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.plan.index', compact('labels', 'html', 'userPermissions','activity_list','project_list','id','messageDeleteType'));
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



    public function searchAct( $id)
    {
        $query = Activity::query();
        $data_list= $query->where('activity_name_na','like', '%' . $id . '%')->orWhere('activity_name_fo','like', '%' . $id . '%')->take(10)->get();
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
            if($planObject->start_date < $planObject->delivery_date ||$planObject->start_date == $planObject->delivery_date) {
                if (!empty($project_id)) {
                    $query = Plan::where('project_id', $project_id)->first();
                    if (!empty($query)) {
                        $project = Plan::where('project_id', $project_id)->pluck("id")->toArray();
                        $budgetSum = Plan_Items:: whereIn('plan_id', $project)
                            ->sum('budget');

                        if (($budgetSum + $request->budget) <= $projectBudget->plan_budget) {


                            if (!empty($activity_id)) {

                                $activitydate = Activity::where('id', $activity_id)->first();
                                if ((empty($activitydate->act_end_date) && empty($activitydate->act_start_date)) || (($planObject->delivery_date < $activitydate->act_end_date || $planObject->delivery_date == $activitydate->act_end_date) && ($planObject->delivery_date > $activitydate->act_start_date || $planObject->delivery_date == $activitydate->act_start_date))) {
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
                                $query2 = $query->whereNull('activity_id')->first();
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
                                $newPlanObj = new Plan();
                                $newPlanObj->project_id = $project_id;
                                $newPlanObj->activity_id = $activity_id;
                                $newPlanObj->created_by = Auth::user()->id;
                                $newPlanObj->save();
                                $planObject->plan_id = $newPlanObj->id;
                                $planObject->created_by = Auth::user()->id;
                                $planObject->save();
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
                    return response(['status' => false, 'message' => getMessage('2.419')]);
                }


                $obj = Plan_Items::where('id', $planObject->id)->with(["service", "sector", "itemgroup", "purchase"])->first();

            }
            else
                return response(['status' => false, 'message' => getMessage('2.423')]);

        }catch (\Throwable $exception) {
            DB::rollBack();
            $message =  (is_numeric($exception->getMessage()) ? getMessage(2.246) : getMessage(2.245));
            dd($exception->getMessage());
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
          // dd($query);
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

            if ($oldBudget == $request->budget || (($budgetSum + $request->budget) <= $projectBudget->plan_budget)) {


                if (!empty($activity_id) && $activity_id != 0) {
                    if (($request->actStartDate == null && $request->actEndDate == null) || (($planObject->delivery_date < $request->actEndDate || $planObject->delivery_date == $request->actEndDate )&& ($planObject->delivery_date > $request->actStartDate || $planObject->delivery_date > $request->actStartDate))) {
                        //   dd([$request->actStartDate,$request->actEndDate]);
                        $planObject->updated_by = Auth::user()->id;
                        $planObject->save();
                        $obj = Plan_Items::where('id', $request->id)->with(["service", "sector", "itemgroup", "purchase"])->first();


                        return response(['status' => true, 'message' => getMessage('2.2'), 'list' => $obj, 'lang' => Auth::user()->lang_id]);
                    } else {
                        return response(['status' => false, 'message' => getMessage('2.418')]);

                    }

                } else if ($activity_id == 0) {
                    if (($request->actStartDate == null && $request->actEndDate == null) || (($planObject->delivery_date < $request->actEndDate || $planObject->delivery_date == $request->actEndDate) && ($planObject->delivery_date > $request->actStartDate || $planObject->delivery_date == $request->actStartDate))) {
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
   public function export($export_id,$projectId,$activityId,$act){
       is_permitted(150, getClassName(__CLASS__), __FUNCTION__, 335, 7);
       $option=[];
       $vendor=new Plan();
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
   }
        else{
            $projectt=\App\Models\Procurement\Project::where('id',$projectId)->with(["currency"])->first();
            $project=$projectt->project_name_na;
            $currency=$projectt->currency->currency_name_na;
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
            }
            else{
                $Activityn=Activity::where('id',$activityId)->first();
                $activity=$Activityn->activity_name_na;
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
           return view('procurement.plan.export',compact('arr','city','project','activity','currency'));
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
}
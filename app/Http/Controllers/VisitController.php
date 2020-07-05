<?php

namespace App\Http\Controllers;

use App\Helpers\Log;
use App\Http\Controllers\Permission\PermissionController;

use App\Models\Activity\Activity;
use App\Models\Activity\BeneficiariesAllVw;
use App\Models\Activity\Location;
use App\Models\Project\Project;
use App\Models\Project\ProjectCities;
use App\Models\Setting\C\District;
use App\Models\Strategic\StrategicPlan;
use App\Models\Visit;
use App\Models\VisitBeneficiary;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class VisitController extends Controller
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
    is_permitted(87, getClassName(__CLASS__), __FUNCTION__, 152, 7);

    $visits = Visit::where('created_by', Auth::id())->orderby('id', 'desc')->get();
    $messageDeleteType = getMessage('2.167');
    $labels = inputButton(Auth::user()->lang_id, 87);
    $userPermissions = getUserPermission();

    return view('visit.index', compact('labels', 'visits', 'messageDeleteType', 'userPermissions'));
  }

  public function create($type = null, $id = null)
  {
    is_permitted(87, getClassName(__CLASS__), __FUNCTION__, 153, 1);
//
//        $city_id = ['relatedWhere' => 'deleted_at is null'];
//
//        if ($type == 'project') {
//            if ($id) {
//
//                $projectCity = ProjectCities::where('project_id', $id)->pluck('city_id');
//                $in = array();
//                foreach ($projectCity as $city) {
//                    $in[] = $city;
//                }
//
//                $in = '(' . implode(',', $in) . ')';
//              if($in != "()"){
//                $city_id = ['relatedWhere' => 'deleted_at is null and id in '.$in];
//              }else{
//                  $selectArray=[];
//                  $city_id = ['selectArray' =>$selectArray ,'is_related' => '0'];
//              }
//            }
//        } elseif ($type == 'activity') {
//            if ($id) {
//                $activity = Activity::find($id);
//
//                 $activityCity = Location::where('activity_id',$activity->id)->pluck('city_id');
//
//                $in = array();
//                foreach ($activityCity as $city) {
//                    $in[] = $city;
//                }
//                $in = '(' . implode(',', $in) . ')';
//                if($in != "()"){
//                    $city_id = ['relatedWhere' => 'deleted_at is null and id in '.$in];
//                }else{
//                    $selectArray=[];
//                    $city_id = ['selectArray' =>$selectArray ,'is_related' => '0'];
//                }
//            }
//        }
    $strategics = StrategicPlan::orderBy('id', 'desc')->get();
    if (!isset($strategic_id)) {
      $strategic_id = $strategics->max('id');
    }
    $name = 'project_name_' . lang_character();
    $selectArray_project = Project::getProject($strategic_id);
    $selectArray_project = $selectArray_project->pluck($name, 'id')->toArray();

    $name_ben = 'ben_name_' . lang_character() . '_id';
    $selectArray_beneficiaries = BeneficiariesAllVw::orderby($name_ben, 'desc')
        ->take(10)
        ->pluck($name_ben, 'id_type');


    $option = [
        'description' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        'city_id' => ['relatedWhere' => 'deleted_at is null  and is_hidden = 0  '],
        'date_visits' => ['attr' => 'autocomplete="off"'],
        'beneficiary_id' => ['attr' => ' data-live-search="true" ', 'selectArray' => $selectArray_beneficiaries],
        'issues_type' => ['relatedWhere' => 'deleted_at is null  and  is_hidden = 0 '],
        'project_id' => ['attr' => ' data-live-search="true" ', 'selectArray' => $selectArray_project],
        'visit_type_id' => ['relatedWhere' => 'deleted_at is null  and  is_hidden = 0 '],
        'main_activity_id' => ['attr' => ' data-live-search="true" '],
        'sub_activity_id' => ['attr' => ' data-live-search="true" '],
    ];
    $visits = new Visit();

    $generator = generator(87, $option, $visits);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();
    return view('visit.create', compact('labels', 'html', 'userPermissions'));
  }

  public function getDistanceByCityId($city_id)
  {
    if (Auth::user()->lang_id == 1) {
      $name = 'district_name_no';
    } else {
      $name = 'district_name_fo';
    }
    $distance = District::where('city_id', $city_id)
        ->whereNull('deleted_at')
        ->where('is_hidden', '0')
        ->pluck($name, 'id');
    return response($distance);
  }


  public function getBeneficiaryByCityAndDistance($city_id, $distance_id)
  {
    $name_ben = 'ben_name_' . lang_character() . '_id';
    $beneficiaries = BeneficiariesAllVw::where('ben_city', $city_id)
        ->where('district_id', $distance_id)
        ->orderby($name_ben, 'desc')
        ->take(10)
        ->pluck($name_ben, 'id_type');
    return response($beneficiaries);
    // 'selectArray' => $beneficiaries,
  }

  public function store(Request $request)
  {
    is_permitted(87, getClassName(__CLASS__), __FUNCTION__, 153, 1);

    $input = $request->all();
    $data = fieldInDatabase(87, $input);
    $field = $data['field'];
    $optionValidator = [
        'file' => [
            'required' => 'false',
            'max' => 'max:10000',
            'mimes' => 'mimes:jpg,jpeg,png,PNG,JPG,pdf,PDF,JPG,docx,doc,csv,xls,xlsx,txt,ppt,zip,rar'
        ],
        'date_visits' => [
            'date' => 'false',
            'date_format' => 'date_format:"d/m/Y"'
        ],
    ];
    inputValidator($data, $optionValidator);

    $visit = new Visit();
    $visit->fill($field);
//        $id_type = $field['beneficiary_id'];
//        $length = strlen($id_type);
//        $beneficiary_type = substr($id_type, -1, 1);
//        $beneficiary_id = substr($id_type, 0, $length - 1);
//        $visit->beneficiary_type = $beneficiary_type;
//        $visit->beneficiary_id = $beneficiary_id;
    $visit->date_visits = dateFormatDataBase($field['date_visits']);

    $visit->created_by = Auth::id();


    $path = public_path('images/visit');
    if ($request->has('file')) {
      $imageName = time() . '.' . $request->file('file')->getClientOriginalExtension();
      $request->file('file')->move($path, $imageName);
      $visit->file = $imageName;
    }

    $visit->save();

    if (isset($field['beneficiary_id']) && !empty($field['beneficiary_id'])) {
      $beneficiary_ids = $field['beneficiary_id'];
      foreach ($beneficiary_ids as $beneficiary_id) {
        $visit_beneficiary = new VisitBeneficiary();
        $visit_beneficiary->visit_id = $visit->id;
        $visit_beneficiary->beneficiary_id = $beneficiary_id;
        $visit_beneficiary->save();
      }
    }

    Log::instance()->record('2.210', null, 87, null, null, null, null);
    Log::instance()->save();

    notifications(getClassName(__CLASS__), __FUNCTION__, route('visits.edit', $visit->id));
    return response(['status' => 'true', 'message' => getMessage('2.1')]);


  }

  public function edit($visit_id)
  {
    is_permitted(87, getClassName(__CLASS__), __FUNCTION__, 154, 2);


    $visit = Visit::find($visit_id);
    $visit_beneficiary = VisitBeneficiary::Where('visit_id', $visit_id)
        ->pluck('beneficiary_id')
        ->toArray();
    $visit->beneficiary_id = $visit_beneficiary;

    // get last 10 beneficiaries added
    $name_ben = 'ben_name_' . lang_character() . '_id';
    $last_10_beneficiaries = BeneficiariesAllVw::
    orderby($name_ben, 'desc')
        ->take(10)
        ->pluck($name_ben, 'id_type')->toArray();
    // get beneficiaries selected in this visit
    $beneficiaries_selected = BeneficiariesAllVw::
    whereIn('id_type', $visit_beneficiary)
        ->pluck($name_ben, 'id_type')->toArray();

    // array_merge $beneficiaries
    foreach ($beneficiaries_selected as $key => $ben) {

      if (array_key_exists($key, $last_10_beneficiaries) !== true) {
        $last_10_beneficiaries[$key] = $ben;
      }
    }
    // get District
    $name_district = 'district_name_' . lang_character1();
    $districts = District::where('city_id', $visit->city_id)
        ->whereNull('deleted_at')
        ->where('is_hidden', 0)
        ->pluck($name_district, 'id');


    $strategics = StrategicPlan::orderBy('id', 'desc')->get();
    if (!isset($strategic_id)) {
      $strategic_id = $strategics->max('id');
    }

    // get project
    $name_project = 'project_name_' . lang_character();
    $selectArray_project = [];
    $projects = Project::getProject($strategic_id);
    if (sizeof($projects) > 0) {
      $selectArray_project = $projects->pluck($name_project, 'id')->toArray();
    }
    // check is project selected in this visit exist

    if (array_key_exists($visit->project_id, $selectArray_project) !== true) {
      $project_not_exists = Project::find($visit->project_id);
      $selectArray_project[$visit->project_id] = $project_not_exists->{$name_project};
    }
    $main_activity_id = [];
    $sub_activity_id = [];
    if ($visit->main_activity_id != null) {
      // get main activity
      $activity_name = 'activity_name_' . lang_character();
      $selectArray_activities_main = [];
      $activities_main = Activity::getActivity($visit->project_id);
      if (sizeof($activities_main) > 0) {
        $selectArray_activities_main = $activities_main->pluck($activity_name, 'id')->toArray();
      }

      // check is main activity selected in this visit exist

      if (array_key_exists($visit->main_activity_id, $selectArray_activities_main) !== true) {

        $main_activity_not_exists = Project::find($visit->main_activity_id);
        $selectArray_activities_main[$visit->main_activity_id] = $main_activity_not_exists->{$activity_name};
      }
      $main_activity_id = $selectArray_activities_main;
    }

    if ($visit->sub_activity_id != null) {
      // get sub activity
      $selectArray_activities_sub = [];
      $activities_sub = Activity::getActivitySub($visit->project_id, $visit->main_activity_id);
      if (sizeof($activities_sub) > 0) {
        $selectArray_activities_sub = $activities_sub->pluck($activity_name, 'id')->toArray();
      }

      // check is main activity selected in this visit exist
      if (array_key_exists($visit->sub_activity_id, $selectArray_activities_sub) !== true) {
        $sub_activity_not_exists = Project::find($visit->sub_activity_id);
        $selectArray_activities_sub[$visit->sub_activity_id] = $sub_activity_not_exists->{$activity_name};
      }
      $sub_activity_id = $selectArray_activities_sub;

    }


    $option = [
        'description' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        'city_id' => ['relatedWhere' => 'deleted_at is null  and is_hidden = 0  '],
        'destrict_id' => ['selectArray' => $districts],
        'date_visits' => ['attr' => 'autocomplete="off"'],
        'file' => ['html_type' => '14'],
        'beneficiary_id' => ['selectArray' => $last_10_beneficiaries, 'attr' => ' data-live-search="true" '],
        'issues_type' => ['relatedWhere' => 'deleted_at is null  and  is_hidden = 0 '],
        'project_id' => ['attr' => ' data-live-search="true" ', 'selectArray' => $selectArray_project],
        'main_activity_id' => ['attr' => ' data-live-search="true" ', 'selectArray' => $main_activity_id],
        'sub_activity_id' => ['attr' => ' data-live-search="true" ', 'selectArray' => $sub_activity_id],
        'visit_type_id' => ['relatedWhere' => 'deleted_at is null  and  is_hidden = 0 '],
    ];
    $generator = generator(87, $option, $visit);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();
    $main_activity_selected = $visit->main_activity_id;
    $sub_activity_selected = $visit->sub_activity_id;
    $destrict_id_selected = $visit->destrict_id;
    return view('visit.edit', compact('labels', 'html', 'userPermissions', 'visit', 'main_activity_selected', 'sub_activity_selected', 'destrict_id_selected'));
  }

  public function update(Request $request)
  {
    is_permitted(87, getClassName(__CLASS__), __FUNCTION__, 153, 2);

    $input = $request->all();
    $data = fieldInDatabase(87, $input);
    $field = $data['field'];
    $id = $field['id'];
    $optionValidator = [
        'file' => [
            'required' => 'false',
            'max' => 'max:10000',
            'mimes' => 'mimes:jpg,jpeg,png,PNG,JPG,pdf,PDF,JPG,docx,doc,csv,xls,xlsx,txt,ppt,zip,rar'
        ], 'date_visits' => [
            'date' => 'false',
            'date_format' => 'date_format:"d/m/Y"'
        ],
    ];
    inputValidator($data, $optionValidator);

    $visit = Visit::find($id);
    $old_visit = $visit;
    $visit->fill($field);
    //        $id_type = $field['beneficiary_id'];
//        $length = strlen($id_type);
//        $beneficiary_type = substr($id_type, -1, 1);
//        $beneficiary_id = substr($id_type, 0, $length - 1);
//        $visit->beneficiary_type = $beneficiary_type;
//        $visit->beneficiary_id = $beneficiary_id;
    $visit->date_visits = dateFormatDataBase($field['date_visits']);
    $visit->updated_by = Auth::id();
    $path = public_path('images/visit');
    if ($request->has('file')) {
      $visit->file_name = $request->file('file')->getClientOriginalName();
      $imageName = time() . '.' . $request->file('file')->getClientOriginalExtension();
      $request->file('file')->move($path, $imageName);
      $visit->file = $imageName;
    }
    Log::instance()->record('2.211', $visit->id, 87, null, null, $visit, $old_visit);
    $visit->save();
    if (isset($field['beneficiary_id']) && !empty($field['beneficiary_id'])) {
      $beneficiary_ids = $field['beneficiary_id'];
      VisitBeneficiary::where('visit_id', $visit->id)->delete();
      foreach ($beneficiary_ids as $beneficiary_id) {
        $visit_beneficiary = new VisitBeneficiary();
        $visit_beneficiary->visit_id = $visit->id;
        $visit_beneficiary->beneficiary_id = $beneficiary_id;
        $visit_beneficiary->save();
      }
    }

    Log::instance()->save();

    notifications(getClassName(__CLASS__), __FUNCTION__, route('visits.edit', $visit->id));
    return response(['status' => 'true', 'message' => getMessage('2.2')]);


  }

  public function delete($id)
  {
    is_permitted(87, getClassName(__CLASS__), __FUNCTION__, 155, 4);
    try {
      $visit = Visit::find($id);
      $visit->deleted_by = Auth::id();
      $visit->delete();
      $message = getMessage('2.3');
      Log::instance()->record('2.212', $id, 87, null, null, null, null);
      Log::instance()->save();
      notifications(getClassName(__CLASS__), __FUNCTION__, '');
      return response(['status' => 'true', 'message' => $message]);
    } catch (\Illuminate\Database\QueryException $e) {
      $message = getMessage('2.3');
      return response(['status' => 'false', 'message' => $message]);
    }
  }


  public function getVisitByName(Request $request)
  {
    $name = $request->get('name');
    $visit = Visit::where('name', 'like', '%' . $name . '%')->take(10)->pluck('name', 'id');
    return response($visit);
  }

  public function getBeneficiaryByName(Request $request)
  {

    $name = $request->get('name');
    // $city_id = $request->get('city_id');
    // $district_id = $request->get('destrict_id');


    $name_ben = 'ben_name_' . lang_character() . '_id';
    $beneficiaries = BeneficiariesAllVw::
    //\where('ben_city', $city_id)
    //     ->where('district_id', $district_id)
    where($name_ben, 'like', '%' . $name . '%')
        ->orderby($name_ben, 'desc')
        ->take(10)
        ->pluck($name_ben, 'id_type');
    return response($beneficiaries);
  }

  public function getProjectByName(Request $request)
  {
    $name = $request->get('name');
    // get project
    $name_project = 'project_name_' . lang_character();
    $projects = Project::getProject();


    if (sizeof($projects) > 0) {
      //$projects = $projects->where($name_project, 'Protection of the right')
      $projects = $projects->filter(function ($item) use ($name_project, $name) {
        // replace stristr with your choice of matching function
        return false !== stristr($item->{$name_project}, $name);
      })->take(10)
          ->pluck($name_project, 'id')
          ->toArray();
     } else {
      $projects = [];
    }

    return response($projects);
  }

  public function getActivityMainByName(Request $request)
  {
    $name = $request->get('name');
    $project_id = $request->get('project_id');

    $activity_name = 'activity_name_' . lang_character();
    $activities_main = Activity::getActivity($project_id);
    if (sizeof($activities_main) > 0) {
      $activities_main = $activities_main->
          filter(function ($item) use ($activity_name, $name) {
             return false !== stristr($item->{$activity_name}, $name);
          })->take(10) ->pluck($activity_name, 'id')->toArray();
 //      ->take(10)
//          ->pluck($activity_name, 'id')
//          ->toArray();
    }

    return response($activities_main);
  }

  public function getActivitySubByName(Request $request)
  {
    $name = $request->get('name');
    $project_id = $request->get('project_id');
    $main_activity_id = $request->get('main_activity_id');

    $activity_name = 'activity_name_' . lang_character();
    $activities_sub = Activity::getActivitySub($project_id, $main_activity_id);
    if (sizeof($activities_sub) > 0) {
      $activities_sub = $activities_sub->
          filter(function ($item) use ($activity_name, $name) {
            // replace stristr with your choice of matching function
            return false !== stristr($item->{$activity_name}, $name);
          })
           ->take(10)
          ->pluck($activity_name, 'id')
          ->toArray();
    }
    return response($activities_sub);
  }

}
<?php


namespace App\Http\Controllers\Setting;


use App\Http\Controllers\Controller;
use App\Models\Activity\ActivityAchievementBeneficiaries;
use App\Models\Activity\ActivityAchievementBeneficiariesDTS;
use App\Models\Goals\IndicatorsMeasureUnit;
use App\Models\Setting\AchievementTypes;
use App\Models\Setting\AchievementTypesMetrics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Helpers\Log;

class AchievementTypesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
      is_permitted(125, getClassName(__CLASS__), __FUNCTION__, 295, 7);

      $achievements = AchievementTypes::get();
      $messageDeleteAchievement = getMessage('2.199');
      $messageDeleteAchievementMetric = getMessage('2.400');
      $labels = inputButton(Auth::user()->lang_id, 125);
      $userPermissions = getUserPermission();
      $id = 1;
      if ($request->ajax()) {
          $id = 2;
          $html = view('setting.achievement.rende_table', compact('labels', 'achievements',
              'messageDeleteAchievement',
              'messageDeleteAchievementMetric',
              'userPermissions', 'id'))->render();
          return response(['status' => true, 'html' => $html]);
      } else {
          return view('setting.achievement.index', compact('labels', 'achievements',
              'messageDeleteAchievement',
              'messageDeleteAchievementMetric',
              'userPermissions','id'));
      }
  }


  public function create(Request $request)
  {
    is_permitted(125, getClassName(__CLASS__), 'store', 296, 1);

    $option = [
        'achivement_type_no' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
        'achivement_type_fo' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
        'is_hidden' => ['html_type' => '13', 'col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'selectArray' => ['0' => 'Active', '1' => 'Inactive']],
    ];

    $achievementType = new AchievementTypes();

    /*
     *      metric_no
        metric_fo
        unit
    */
    $unit_name = 'unit_name_' . lang_character1();
    $measureUnit = IndicatorsMeasureUnit::whereNull('deleted_at')->where('is_hidden', 0)
        ->pluck($unit_name, 'id')->toArray();

    $generator = generator(125, $option, $achievementType);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();
      $id=1;
      if($request->ajax()){
          $id=2;

          $html =view('setting.achievement.create_render', compact('labels', 'html', 'userPermissions','measureUnit','id'))->render();
          return response(['status' => true, 'html' =>$html,'measureUnit'=>$measureUnit]);

      }
    return view('setting.achievement.create', compact('labels', 'html', 'userPermissions', 'measureUnit','id'));
  }


  public function store(Request $request,$id)
  {
    is_permitted(125, getClassName(__CLASS__), 'store', 296, 1);

    $input = $request->all();
    $data = fieldInDatabase(125, $input);

    $optionValidator = [

    ];
    inputValidator($data, $optionValidator);

    $field = $data['field'];
    $idObject=$field['id'];
    $data = DB::transaction(function () use ($request, $field) {
        $achievementType = new AchievementTypes();
      $achievementType->fill($field);
      $achievementType->created_by = Auth::id();
      $achievementType->is_hidden = 0;
      $achievementType->save();

      if ($request->has('metric_no')) {

        $metric_no = $request->get('metric_no');
        $metric_fo = $request->get('metric_fo');
        $units = $request->get('unit');
        foreach ($metric_no as $index => $metric_no) {
          //  dd($index , $metric ,$units[$index]);
          $AchievementTypesMetrics = new AchievementTypesMetrics();
          $AchievementTypesMetrics->c_achivement_type_id = $achievementType->id;
          $AchievementTypesMetrics->ach_type_metric_no = $metric_no;
          $AchievementTypesMetrics->ach_type_metric_fo = $metric_fo[$index];
          $AchievementTypesMetrics->measure_unit_id = $units[$index];
          $AchievementTypesMetrics->is_hidden = 0;
          $achievementType->created_by = Auth::id();

          $AchievementTypesMetrics->save();
        }
      }
      Log::instance()->record('2.213', null, 125, null, null, null, null);
      Log::instance()->save();
      notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.achievement.type.edit', $achievementType->id));
      return $achievementType;
    });
    if($id==1)
    return redirect()->route('settings.achievement.type.edit', $data->id)->with('message', getMessage('2.2'));
else
    return response(['status'=>true,'message'=>getMessage('2.1'),'id'=>$idObject]);
    //  return response(['status' => 'true', 'message' => getMessage('2.1')]);
  }

  public function edit(Request $request,$id)
  {
    is_permitted(125, getClassName(__CLASS__), 'update', 297, 2);

    $option = [
        'achivement_type_no' => ['col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
        'achivement_type_fo' => ['col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],
        'id' => ['value' => $id],
        'is_hidden' => ['col_all_Class' => 'col-md-4', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'selectArray' => ['0' => 'Active', '1' => 'Inactive']],
    ];
    $unit_name = 'unit_name_' . lang_character1();
    $measureUnit = IndicatorsMeasureUnit::whereNull('deleted_at')->where('is_hidden', 0)
        ->pluck($unit_name, 'id')->toArray();

    $achievementType = AchievementTypes::find($id);
    $achievementTypesMetrics = AchievementTypesMetrics::where('c_achivement_type_id', $id)
        ->get();
    $generator = generator(125, $option, $achievementType);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();
    $messageDeleteAchievementMetric = getMessage('2.400');
      $id1=1;
      if($request->ajax()){
          $id1=2;
          $html =view('setting.achievement.update_render', compact('messageDeleteAchievementMetric', 'labels', 'html', 'userPermissions', 'measureUnit', 'achievementTypesMetrics', 'id','id1'))->render();
          return response(['status' => true, 'html' =>$html,'measureUnit'=>$measureUnit]);

      }
      else

    return view('setting.achievement.edit', compact(
        'messageDeleteAchievementMetric', 'labels', 'html', 'userPermissions', 'measureUnit', 'achievementTypesMetrics', 'id','id1'));
  }

  public function update($id, Request $request,$id1)
  {
    is_permitted(125, getClassName(__CLASS__), 'update', 297, 2);

    $input = $request->all();
    $data = fieldInDatabase(125, $input);
    $optionValidator = [

    ];
    inputValidator($data, $optionValidator);

    $field = $data['field'];
    $field['id'] = $id;
    $idObject=$request->$id;
    DB::transaction(function () use ($request, $field) {

      /*
       * array:11 [
"_token" => "OzJMDf4nXorVKM6vlHFYfnfpjcp2yCn0RvbYWBj5"
"id" => "1"
"achivement_type_no" => "well"
"achivement_type_fo" => "well"
"is_hidden" => "0"
"metric_no_edit" => array:2 [
30 => "size"
31 => "Completed"
]
"metric_fo_edit" => array:2 [
30 => "size"
31 => "Completed"
]
"unit_edit" => array:2 [
30 => "15"
31 => "14"
]
"metric_no" => array:1 [
3 => "number"
]
"metric_fo" => array:1 [
3 => "number"
]
"unit" => array:1 [
3 => "13"
]
]
      */
      $achievementType = AchievementTypes::find($field['id']);

      $achievementType->fill($field);
      $achievementType->updated_by = Auth::id();
      $achievementType->save();
      if ($request->has('metric_no_edit')) {

        if (count($request->get('metric_no_edit')) > 0) {
          $ids_ = array_keys($request->get('metric_no_edit'));

          AchievementTypesMetrics::where('c_achivement_type_id', $achievementType->id)
              ->whereNotIn('id', $ids_)
              ->delete();
        }

      } else {
        AchievementTypesMetrics::where('c_achivement_type_id', $achievementType->id)->delete();
      }
      if ($request->has('metric_no_edit')) {
        $metrics_no_edit = $request->get('metric_no_edit');
        $metrics_fo_edit = $request->get('metric_fo_edit');
        $unitss_edit = $request->get('unit_edit');


        foreach ($metrics_no_edit as $index => $metric_no_edit) {
          //  dd($index , $metric ,$units[$index]);
          $AchievementTypesMetrics = AchievementTypesMetrics::find($index);
          if ($AchievementTypesMetrics != null) {
            $AchievementTypesMetrics->c_achivement_type_id = $achievementType->id;
            $AchievementTypesMetrics->ach_type_metric_no = $metric_no_edit;
            $AchievementTypesMetrics->ach_type_metric_fo = $metrics_fo_edit[$index];
            $AchievementTypesMetrics->measure_unit_id = $unitss_edit[$index];
            $AchievementTypesMetrics->is_hidden = 0;
            $AchievementTypesMetrics->updated_by = Auth::id();
            $AchievementTypesMetrics->save();
          }
        }
      }


      if ($request->has('metric_no')) {
        $metrics_no = $request->get('metric_no');
        $metrics_fo = $request->get('metric_fo');
        $units = $request->get('unit');
        foreach ($metrics_no as $index => $metric_no) {
          $AchievementTypesMetrics = new AchievementTypesMetrics();
          $AchievementTypesMetrics->c_achivement_type_id = $achievementType->id;
          $AchievementTypesMetrics->ach_type_metric_no = $metric_no;
          $AchievementTypesMetrics->ach_type_metric_fo = $metrics_fo[$index];
          $AchievementTypesMetrics->measure_unit_id = $units[$index];
          $AchievementTypesMetrics->is_hidden = 0;
          $AchievementTypesMetrics->created_by = Auth::id();
          $AchievementTypesMetrics->save();
        }
      }

      Log::instance()->record('2.214', $achievementType->id, 125, null, null, $field, $achievementType);
      Log::instance()->save();
      notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.achievement.type.edit', $achievementType->id));

    });
      if($id1==1)
          return redirect()->back()->with('message', getMessage('2.2'));
      else
          return response(['status'=>true,'message'=>getMessage('2.2'),'id'=>$idObject]);
    // return response(['status' => true, 'message' => getMessage('2.2')]);
  }


  public function delete($id)
  {
    is_permitted(125, getClassName(__CLASS__), __FUNCTION__, 298, 4);

    $status = DB::transaction(function () use ($id) {
      try {

        $ActivityAchievementBeneficiaries = ActivityAchievementBeneficiaries::where('c_achivement_type_id', $id)->count();
        if ($ActivityAchievementBeneficiaries > 0) {
          return false;
        }

        $ActivityAchievementBeneficiariesDTS = ActivityAchievementBeneficiariesDTS::where('c_achivement_type_id', $id)->count();
        if ($ActivityAchievementBeneficiariesDTS > 0) {
          return false;
        }

        AchievementTypesMetrics::where('c_achivement_type_id', $id)->delete();
        AchievementTypes::where('id', $id)->delete();

        Log::instance()->record('2.215', $id, 125, null, null, null, null);
        Log::instance()->save();
        notifications(getClassName(__CLASS__), __FUNCTION__, '');
        return true;

      } catch (\Illuminate\Database\QueryException $e) {
        return false;
      }
    });
    if ($status == true) {
      $message = getMessage('2.3');
      return response(['status' => 'true', 'message' => $message]);

    } else {
      $message = getMessage('2.14');
      return response(['status' => 'false', 'message' => $message]);
    }

  }

  public function deleteAchievement($id)
  {

    $status = DB::transaction(function () use ($id) {
      try {

        $ActivityAchievementBeneficiariesDTS = ActivityAchievementBeneficiariesDTS::where('c_achivement_type_metric_id', $id)->count();
        if ($ActivityAchievementBeneficiariesDTS > 0) {
          return false;
        }

        $AchievementTypesMetrics = AchievementTypesMetrics::where('id', $id)->delete();

        return true;
      } catch (\Illuminate\Database\QueryException $e) {
        return false;
      }
    });
    if ($status == true) {
      $message = getMessage('2.3');
      return response(['status' => 'true', 'message' => $message]);

    } else {
      $message = getMessage('2.14');
      return response(['status' => 'false', 'message' => $message]);
    }

  }


}
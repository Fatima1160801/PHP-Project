<?php

namespace App\Http\Controllers\Goals;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Setting\AchievementTypesController;
use App\Models\Goals\Indicator;
use App\Models\Goals\IndicatorsMeasureUnit;
use App\Models\Goals\Results;
use App\Models\Project\ProjectIndicators;
use App\Models\Project\ProjectResults;
use App\Models\Setting\AchievementTypesMetrics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobTitle\JobTitle;

use App\Helpers\Log;

class IndicatorsMeasureUnitController extends Controller
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

  public function index(Request $request)
  {
      is_permitted(22, getClassName(__CLASS__), __FUNCTION__, 90, 7);

      $imus = IndicatorsMeasureUnit::get();
      // $screenName = screenName(22);
      $messageDeleteMeasureUnit = getMessage('2.27');
      $labels = inputButton(Auth::user()->lang_id, 22);
      $userPermissions = getUserPermission();
      $id = 1;
      if ($request->ajax()) {
          $id = 2;
          $html = view('goals.indicators.measureUnit.table_render', compact('labels', 'imus', 'userPermissions', 'id'))->render();
          return response(['status' => true, 'html' => $html]);
      } else {
          return view('goals.indicators.measureUnit.index', compact('labels', 'imus', 'messageDeleteMeasureUnit', 'userPermissions','id'));
      }
  }
  public function create(Request $request)
  {
    is_permitted(22, getClassName(__CLASS__), 'store', 91, 1);

    $imu = new IndicatorsMeasureUnit();
    $unit_name_no = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
    $unit_name_fo = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7'];
    $is_hidden = ['html_type' => '13'];
    $option = [
        'unit_name_fo' => $unit_name_fo,
        'unit_name_no' => $unit_name_no,
        'is_hidden' => $is_hidden,
    ];
    $generator = generator(22, $option, $imu);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();
      $save=1;
      $id=1;
      if($request->ajax()){
          $id=2;
          $html =view('goals.indicators.measureUnit.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();

          return response(['status' => true, 'html' =>$html]);

      }
      else
    return view('goals.indicators.measureUnit.create', compact('labels', 'html', 'userPermissions','save','id'));
  }

  public function store(Request $request,$id)
  {
    is_permitted(22, getClassName(__CLASS__), __FUNCTION__, 91, 1);

    $input = $request->all();
    $data = fieldInDatabase(22, $input);
    $optionValidator = [
        'unit_name_no' => [
            'unique' => 'unique:c_measure_units,unit_name_no'
        ],
        'unit_name_fo' => [
            'unique' => 'unique:c_measure_units,unit_name_fo'
        ],
    ];

    inputValidator($data, $optionValidator);
    $field = $data['field'];
    $imu = new IndicatorsMeasureUnit();
    $imu->fill($field);
    $imu->created_by = Auth::id();
    $imu->save();

    Log::instance()->record('2.75', null, 22, null, null, null, null);
    Log::instance()->save();

    notifications(getClassName(__CLASS__), __FUNCTION__, route('goals.indicators.measure.unit.edit', $imu->id));

    $array = ['message' => 'Data Added successfully'];
    session(['array' => $array]);
      $message=getMessage('2.1');
      if($id==1)
          return redirect()->route('goals.indicators.measure.unit.index');
      else{

          return response(['status' => true, 'city' =>$imu,'message'=>$message]);
  }
  }

  public function edit(Request $request,$id)
  {
    is_permitted(22, getClassName(__CLASS__), 'update', 92, 2);

    $imu = IndicatorsMeasureUnit::find($id);
    $unit_name_no = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
    $unit_name_fo = ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'];
    $is_hidden = ['html_type' => '5', 'selectArray' => ['0' => 'Active', '1' => 'Inactive'], 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-3', 'col_input_Class' => 'col-md-8'];
    $id_html = ['html_type' => '10'];
    $option = [
        'unit_name_no' => $unit_name_no,
        'unit_name_fo' => $unit_name_fo,
        'is_hidden' => $is_hidden,
        'id' => $id_html
    ];
    $generator = generator(22, $option, $imu);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();
      $save=2;
      $id=1;
      if($request->ajax()){
          $id=2;
          $html =view('goals.indicators.measureUnit.create_render', compact('labels', 'html','userPermissions','save','id'))->render();
          return response(['status' => true, 'html' =>$html]);

      }
      else
    return view('goals.indicators.measureUnit.edit', compact('labels', 'html', 'userPermissions','save','id'));
  }


  public function update(Request $request,$id)
  {
    is_permitted(22, getClassName(__CLASS__), __FUNCTION__, 92, 2);
    $input = $request->all();
    $data = fieldInDatabase(4, $input);
    $field = $data['field'];

    $optionValidator = [
        'unit_name_no' => [
            'unique' => 'unique:c_measure_units,unit_name_no,' . $field['id']
        ],
        'unit_name_fo' => [
            'unique' => 'unique:c_measure_units,unit_name_fo,' . $field['id']
        ],
    ];
    inputValidator($data, $optionValidator);

    $field['updated_by'] = Auth::id();


//        $imu = IndicatorsMeasureUnit::where('id', $field['id'])
//            ->update($field);
    $imu = IndicatorsMeasureUnit::where('id', $field['id'])->first();
    Log::instance()->record('2.76', null, 22, null, null, $field, $imu);
    $imu->fill($field);
    $imu->save();
    Log::instance()->save();
    notifications(getClassName(__CLASS__), __FUNCTION__, route('goals.indicators.measure.unit.edit', $imu->id));
      $message=getMessage('2.2');
    $array = ['message' => 'Data Updated successfully'];
    session(['array' => $array]);
      if($id==1) {
          dd("ff");
          return redirect()->route('goals.indicators.measure.unit.index');
      }
      else{

          return response(['status' => true, 'city' =>$imu,'message'=>$message]);

  }
  }

  public function destroy($id)
  {
    is_permitted(22, getClassName(__CLASS__), __FUNCTION__, 93, 4);

    try {
      $indicatorCount = 0;
      $indicatorCount = Indicator::where('indic_unit', $id)->get()->count();
      if ($indicatorCount > 0) {
        $message = getMessage('2.28');
        return response(['status' => 'false', 'message' => $message]);
      }
      $resultCount = 0;
      $resultCount = Results::where('result_unit', $id)->get()->count();
      if ($resultCount > 0) {
        $message = getMessage('2.28');
        return response(['status' => 'false', 'message' => $message]);
      }

      $AchievementTypesMetrics = AchievementTypesMetrics::where('measure_unit_id', $id)->get()->count();

      if ($AchievementTypesMetrics > 0) {
        $message = getMessage('2.28');
        return response(['status' => 'false', 'message' => $message]);
      }
      $imu = IndicatorsMeasureUnit::find($id);
      $imu->delete();

      Log::instance()->record('2.77', $id, 22, null, null, null, null);
      Log::instance()->save();
      notifications(getClassName(__CLASS__), __FUNCTION__, '');

      $message = getMessage('2.3');
      return response(['status' => 'true', 'message' => $message]);
    } catch (\Illuminate\Database\QueryException $e) {

      $message = getMessage('2.28');
      return response(['status' => 'false', 'message' => $message]);
    }
  }

}

<?php


namespace App\Http\Controllers\Setting;


use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Helpers\FileUploader;


class SettingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    is_permitted(81, 'SettingController', 'update', 233, 2);

    $setting = Setting::first();

    if ($setting == null) {
      $setting = new Setting();
    }

    $project_objective_based_on_array = [
        1 => ['0' => 'Stratigic Plan objective', '1' => 'Program objective'],
        2 => ['0' => 'الخطة الاستراتيجية', '1' => 'البرنامج'],
    ];
    $project_objective_based_on = ['selectArray' => $project_objective_based_on_array[Auth::user()->lang_id]];


    $option = [
        'organization_mobile' => ["inputClass" => "check-is-number"],
        'organization_tel' => ["inputClass" => "check-is-number"],
        'organization_fax' => ["inputClass" => "check-is-number"],
        'run_time_recording' => ["attr" => " min='5' "],
        'project_objective_based_on' => $project_objective_based_on,
    ];

    $generator = generator(81, $option, $setting);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();

    return view('setting.setting.index', compact('labels', 'html', 'userPermissions'));
  }


  public function update_(Request $request)
  {
    is_permitted(81, 'SettingController', 'update', 233, '2');

    $input = $request->all();
    $data = fieldInDatabase(81, $input);

    $optionValidator = [

    ];

    inputValidator($data, $optionValidator);

    $field = $data['field'];
    $setting = Setting::first();
    $setting_old = $setting;
    $setting->fill($field);
    $setting->id = 1;
    $setting->updated_by = Auth::id();

    $path = public_path('images/user/photo/');
    if ($request->has('organization_logo')) {
      $imageName = time() . '.' . $request->file('organization_logo')->getClientOriginalExtension();
      $request->file('organization_logo')->move($path, $imageName);
      $setting->organization_logo = $imageName;
    }


    if ($request->has('header_portrait')) {
      $imageName = time() . '.' . $request->file('header_portrait')->getClientOriginalExtension();
      $request->file('header_portrait')->move($path, $imageName);
      $setting->header_portrait = $imageName;
    }

    if ($request->has('header_landscape')) {
      $imageName = time() . '.' . $request->file('header_landscape')->getClientOriginalExtension();
      $request->file('header_landscape')->move($path, $imageName);
      $setting->header_landscape = $imageName;
    }

    $setting->save();

    Log::instance()->record('2.206', $setting->id, 81, null, null, $setting_old, $setting);
    Log::instance()->save();
    notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.store', $setting->id));

    return response(['success' => true, 'message' => getMessage('2.158')]);
  }

}
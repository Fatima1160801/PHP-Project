<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\VisitType;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\C\ActivityType;

use App\Helpers\Log;

class VisitTypeController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
     //is_permitted(126, getClassName(__CLASS__),__FUNCTION__, 128, 7);

    $visitTypes = VisitType::all();
    $messageDeleteVisitTypes = getMessage('2.95');
    $labels = inputButton(Auth::user()->lang_id, '126');
    $userPermissions = getUserPermission();

    return view('setting.visitType.index', compact('labels', 'visitTypes', 'messageDeleteVisitTypes', 'userPermissions'));
  }


  public function getCreate()
  {
    // is_permitted(126, getClassName(__CLASS__),'store', 129, 1);


    $option = [];

    $visitTypes = new VisitType();
    $generator = generator(126, $option, $visitTypes);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();

    return view('setting.visitType.create', compact('labels', 'html', 'userPermissions'));
  }


  public function store(Request $request)
  {
    // is_permitted(126, getClassName(__CLASS__),__FUNCTION__, 129, 1);


    $input = $request->all();
    $data = fieldInDatabase(126, $input);

    $optionValidator = [

    ];
    inputValidator($data, $optionValidator);

    $field = $data['field'];

    $visitType = new VisitType();
    $visitType->fill($field);
    $visitType->is_hidden = 0;
    $visitType->created_by = Auth::id();
    $visitType->save();

//        Log::instance()->record('2.21',null,126,null,null,null,null);
//        Log::instance()->save();

//        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.activity_types.edit',$activityType->id));

    return response(['success' => true, 'message' => getMessage('2.1')]);
  }


  public function getEdit($id)
  {
    // is_permitted(50, getClassName(__CLASS__),'update', 130, 2);

    $option = [
        'is_hidden' => ['html_type' => '5', 'col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'selectArray' => ['0' => 'Active', '1' => 'Inactive']],
    ];
    $visitType = VisitType::find($id);
    $generator = generator(126, $option, $visitType);
    $html = $generator[0];
    $labels = $generator[1];
    $userPermissions = getUserPermission();

    return view('setting.visitType.update', compact('labels', 'html', 'userPermissions'));
  }


  public function update(Request $request)
  {
    //  is_permitted(126, getClassName(__CLASS__),__FUNCTION__, 130, 2);

    $input = $request->all();
    $data = fieldInDatabase(126, $input);

    $optionValidator = [

    ];
    inputValidator($data, $optionValidator);

    $field = $data['field'];

    $visitType = VisitType::find($field['id']);
    $visitType->fill($field);
     $visitType->updated_by = Auth::id();
    // Log::instance()->record('2.22', $field['id'], 50, null, null, $field, $activityType);
    //Log::instance()->save();
    $visitType->save();

    //  notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.activity_types.edit', $activityType->id));

    return response(['success' => true, 'message' => getMessage('2.2')]);
  }


  public function delete($id)
  {
    //  is_permitted(50, getClassName(__CLASS__),__FUNCTION__, 131, 4);

    try {
      $visit_count = Visit::where('visit_type_id', $id)->Count();
      if ($visit_count > 0) {
        $message = getMessage('2.339');
        return response(['status' => 'false', 'message' => $message]);
      } else {
        VisitType::where('id', $id)->delete();
        $message = getMessage('2.2');
        //    Log::instance()->record('2.23', $id, 50, null, null, null, null);
        //   Log::instance()->save();
        //   notifications(getClassName(__CLASS__), __FUNCTION__, '');
        return response(['status' => 'true', 'message' => $message]);
      }
    } catch (\Illuminate\Database\QueryException $e) {
      $message = getMessage('2.339');
      return response(['status' => 'false', 'message' => $message]);
    }
  }

}
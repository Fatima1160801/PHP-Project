<?php

namespace App\Http\Controllers\Setting\C;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\C\ActivityType;

use App\Helpers\Log;

class ActivityTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        is_permitted(50, getClassName(__CLASS__),__FUNCTION__, 128, 7);

        $activityTypes = ActivityType::all();
        $messageDeleteActivityTypes = getMessage('2.95');
        $labels = inputButton(Auth::user()->lang_id,'50');
        $userPermissions = getUserPermission();

        return view('setting.c.activity_type.index',compact('labels','activityTypes','messageDeleteActivityTypes','userPermissions'));
    }


    public function getCreate()
    {
        is_permitted(50, getClassName(__CLASS__),'store', 129, 1);


        $option = [];

        $activityType = new ActivityType();

        $generator = generator(50, $option, $activityType);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        return view('setting.c.activity_type.create', compact('labels','html','userPermissions'));
    }


    public function store(Request $request)
    {
        is_permitted(50, getClassName(__CLASS__),__FUNCTION__, 129, 1);


        $input = $request->all();
        $data = fieldInDatabase(50, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $activityType = new ActivityType();
        $activityType->fill($field);
        $activityType->save();

        Log::instance()->record('2.21',null,50,null,null,null,null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.activity_types.edit',$activityType->id));

        return response(['success' => true, 'message' => getMessage('2.1')]);
    }


    public function getEdit($id)
    {
        is_permitted(50, getClassName(__CLASS__),'update', 130, 2);

        $option = [
            'is_hidden' => ['html_type'=>'5','col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8', 'selectArray' => ['0' => 'Active', '1' => 'Inactive']],
        ];

        $activityType = ActivityType::find($id);

        $generator = generator(50, $option, $activityType);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        return view('setting.c.activity_type.update', compact('labels','html','userPermissions'));
    }


    public function update(Request $request)
    {
        is_permitted(50, getClassName(__CLASS__),__FUNCTION__, 130, 2);

        $input = $request->all();
        $data = fieldInDatabase(50, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $activityType = ActivityType::find($field['id']);
        $activityType->fill($field);
        Log::instance()->record('2.22',$field['id'],50,null,null,$field,$activityType);
        Log::instance()->save();
        $activityType->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.activity_types.edit',$activityType->id));

        return response(['success' => true,'message' => getMessage('2.2')]);
    }


    public function delete($id)
    {
        is_permitted(50, getClassName(__CLASS__),__FUNCTION__, 131, 4);

        try {
            ActivityType::where('id', $id)->delete();
            $message = getMessage('2.98');
            Log::instance()->record('2.23',$id,50,null,null,null,null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__),__FUNCTION__,'');
            return response(['status' => 'true', 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.24');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

}
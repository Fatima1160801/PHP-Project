<?php


namespace App\Http\Controllers\Setting\C;



use App\Http\Controllers\Controller;
use App\Models\Setting\C\TaskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\C\City;

use App\Helpers\Log;

class TaskTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        is_permitted(86, getClassName(__CLASS__), __FUNCTION__, 148, 7);

        $taskType = TaskType::all();
        $messageDeleteType = getMessage('2.164');
        $labels = inputButton(Auth::user()->lang_id, 86);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('setting.c.taskType.table_render', compact('labels', 'taskType', 'messageDeleteType', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('setting.c.taskType.index', compact('labels', 'taskType', 'messageDeleteType', 'userPermissions','id'));
        }
    }

    public function create(Request $request)
    {
        is_permitted(86, getClassName(__CLASS__),'store', 149, 1);

        $option = [];

        $taskType = new TaskType();

        $generator = generator(86, $option, $taskType);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id1=1;
        if($request->ajax()){
            $id1=2;
            $html =view('setting.c.taskType.create_render', compact('labels', 'html', 'userPermissions','save','id1'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.taskType.create', compact('labels','html','userPermissions','save','id1'));
    }


    public function store(Request $request)
    {
        is_permitted(86, getClassName(__CLASS__),'store', 149, 1);

        $input = $request->all();
        $data = fieldInDatabase(86, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];


        $taskType = new TaskType();
        $taskType->fill($field);
        $taskType->created_by = Auth::id();
        $taskType->save();

        Log::instance()->record('2.207',null,86,null,null,null,null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.taskType.edit',$taskType->id));

        return response(['status' => true, 'message' => getMessage('2.1'),'city'=>$taskType,'statusObj'=>activeLabel($taskType->is_hidden)]);
    }


    public function edit(Request $request,$id)
    {
        is_permitted(86, getClassName(__CLASS__),'update', 150, 2);

         if(Auth::user()->lang_id == 1 ){
             $is_hidden = ['selectArray' => ['0' => 'Active', '1' => 'unActive'], 'html_type' => '5'];
         }else{
             $is_hidden = ['selectArray' => ['0' => '????????', '1' => '?????? ????????'], 'html_type' => '5'];
         }
        $option = [
            'is_hidden'=>$is_hidden,
            'id'=>['html_type'=>'10']
        ];

        $taskType = TaskType::find($id);

        $generator = generator(86, $option, $taskType);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id1=1;
        if($request->ajax()){
            $id1=2;
            $html =view('setting.c.taskType.create_render', compact('labels', 'html', 'userPermissions','save','id1'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.taskType.edit', compact('labels','html','userPermissions','save','id1'));
    }


    public function update(Request $request)
    {
        is_permitted(86, getClassName(__CLASS__),'update', 150, 2);

        $input = $request->all();
        $data = fieldInDatabase(86, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $taskType =  TaskType::find($field['id']);
        $taskType->fill($field);
        $taskType->updated_by = Auth::id();
        Log::instance()->record('2.208',$field['id'],86,null,null,$field,$taskType);
        Log::instance()->save();
        $taskType->save();

        notifications(getClassName(__CLASS__),__FUNCTION__,route('settings.taskType.edit',$taskType->id));

        return response(['status' => true,'message' => getMessage('2.2'),'city'=>$taskType,'statusObj'=>activeLabel($taskType->is_hidden)]);
    }


    public function delete($id)
    {
        is_permitted(86, getClassName(__CLASS__),__FUNCTION__, 151, 4);

        try {
            TaskType::where('id', $id)->delete();
            $message = getMessage('2.3');
            Log::instance()->record('2.209',$id,86,null,null,null,null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__),__FUNCTION__,'');
            return response(['status' => 'true', 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => 'false', 'message' => $message]);
        }
    }


}
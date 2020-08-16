<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Lessons;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity\LessonsType;

use App\Helpers\Log;

class LessonsTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        is_permitted(109, getClassName(__CLASS__), 'index', 217, 7);

        $lessons_type = LessonsType::all();
        $messageDeleteLessonsTypes = getMessage('2.185');
        $labels = inputButton(Auth::user()->lang_id, '109');
        $userPermissions = getUserPermission();

        return view('activity.lessons.type.index', compact('labels', 'lessons_type', 'messageDeleteLessonsTypes', 'userPermissions'));
    }


    public function getCreate()
    {
        is_permitted(109, getClassName(__CLASS__), 'store', 218, 1);


        $option = [];
        $lessons_type = new LessonsType();

        $generator = generator(109, $option, $lessons_type);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        return view('activity.lessons.type.create', compact('labels', 'html', 'userPermissions'));
    }


    public function store(Request $request)
    {
        is_permitted(109, getClassName(__CLASS__), 'store', 218, 1);


        $input = $request->all();
        $data = fieldInDatabase(109, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $lessons_type = new LessonsType();
        $lessons_type->fill($field);
        $lessons_type->save();

        Log::instance()->record('2.21', null, 109, null, null, null, null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('activity.lessons.type.edit', $lessons_type->id));

        return response(['success' => true, 'message' => getMessage('2.1')]);
    }


    public function getEdit($id)
    {
        is_permitted(109, getClassName(__CLASS__), 'store', 219, 2);


        $lessons_type = LessonsType::find($id);

        $generator = generator(109, [], $lessons_type);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        return view('activity.lessons.type.update', compact('labels', 'html', 'userPermissions'));
    }


    public function update(Request $request)
    {
        is_permitted(109, getClassName(__CLASS__), 'store', 219, 2);

        $input = $request->all();
        $data = fieldInDatabase(109, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $lessons_type = LessonsType::find($field['id']);
        $lessons_type->fill($field);
        Log::instance()->record('2.22', $field['id'], 109, null, null, $field, $lessons_type);
        Log::instance()->save();
        $lessons_type->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('activity.lessons.type.edit', $lessons_type->id));

        return response(['success' => true, 'message' => getMessage('2.2')]);
    }


    public function delete($id)
    {
        is_permitted(109, getClassName(__CLASS__), 'delete', 220, 4);

        try {
            $Lessons = Lessons::where('lessons_type_id', $id)->whereNull('deleted_at')->get()->count();
            $visist = Visit::where('issues_type', $id)->whereNull('deleted_at')->get()->count();
            if ($Lessons > 0 || $visist>0) {
                $message = getMessage('2.195');
                return response(['status' => 'false', 'message' => $message]);
            } else {
                LessonsType::where('id', $id)->delete();
                $message = getMessage('2.98');
                Log::instance()->record('2.23', $id, 109, null, null, null, null);
                Log::instance()->save();
                notifications(getClassName(__CLASS__), __FUNCTION__, '');
                return response(['status' => 'true', 'message' => $message]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.195');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

}
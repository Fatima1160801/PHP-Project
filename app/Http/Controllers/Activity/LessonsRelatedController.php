<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity\Lessons;
use App\Models\Project\ProjectDonors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity\LessonsRelated;

use App\Helpers\Log;

class LessonsRelatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        is_permitted(97, getClassName(__CLASS__), 'index', 175, 7);

        $lessons_related = LessonsRelated::all();
        $messageDeleteLessonsRelateds = getMessage('2.178');
        $labels = inputButton(Auth::user()->lang_id, '97');
        $userPermissions = getUserPermission();

        return view('activity.lessons.related.index', compact('labels', 'lessons_related', 'messageDeleteLessonsRelateds', 'userPermissions'));
    }


    public function getCreate()
    {
        is_permitted(97, getClassName(__CLASS__), 'store', 176, 1);


        $option = [];
        $lessons_related = new LessonsRelated();

        $generator = generator(97, $option, $lessons_related);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        return view('activity.lessons.related.create', compact('labels', 'html', 'userPermissions'));
    }


    public function store(Request $request)
    {
        is_permitted(97, getClassName(__CLASS__), 'store', 176, 1);


        $input = $request->all();
        $data = fieldInDatabase(97, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $lessons_related = new LessonsRelated();
        $lessons_related->fill($field);
        $lessons_related->save();

        Log::instance()->record('2.21', null, 97, null, null, null, null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('activity.lessons.related.edit', $lessons_related->id));

        return response(['success' => true, 'message' => getMessage('2.1')]);
    }


    public function getEdit($id)
    {
        is_permitted(97, getClassName(__CLASS__), 'store', 177, 2);


        $lessons_related = LessonsRelated::find($id);

        $generator = generator(97, [], $lessons_related);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();

        return view('activity.lessons.related.update', compact('labels', 'html', 'userPermissions'));
    }


    public function update(Request $request)
    {
        is_permitted(97, getClassName(__CLASS__), 'store', 177, 2);

        $input = $request->all();
        $data = fieldInDatabase(97, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $lessons_related = LessonsRelated::find($field['id']);
        $lessons_related->fill($field);
        Log::instance()->record('2.22', $field['id'], 97, null, null, $field, $lessons_related);
        Log::instance()->save();
        $lessons_related->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('activity.lessons.related.edit', $lessons_related->id));

        return response(['success' => true, 'message' => getMessage('2.2')]);
    }


    public function delete($id)
    {
        is_permitted(97, getClassName(__CLASS__), 'delete', 178, 4);

        try {

            $Lessons= Lessons::where('related_to_id', $id)->whereNull('deleted_at')->get()->count();
            if ($Lessons > 0) {
                $message = getMessage('2.194');
                return response(['status' => 'false', 'message' => $message]);
            } else {
                LessonsRelated::where('id', $id)->delete();
                $message = getMessage('2.98');
                Log::instance()->record('2.23', $id, 97, null, null, null, null);
                Log::instance()->save();
                notifications(getClassName(__CLASS__), __FUNCTION__, '');
                return response(['status' => 'true', 'message' => $message]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.194');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

}
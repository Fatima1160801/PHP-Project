<?php


namespace App\Http\Controllers\Setting\C;


use App\Http\Controllers\Controller;
use App\Models\Setting\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting\C\AttachmentTypes;

use App\Helpers\Log;

class AttachmentTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        is_permitted(108, getClassName(__CLASS__), 'index', 156, 7);

        $types = AttachmentTypes::all();
        $messageDeleteCity = getMessage('2.180');
        $labels = inputButton(Auth::user()->lang_id, 108);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('setting.c.attachmentTypes.table_render', compact('labels', 'types', 'messageDeleteCity', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('setting.c.attachmentTypes.index', compact('labels', 'types', 'messageDeleteCity', 'userPermissions','id'));
        }

    }
    public function getCreate(Request $request)
    {
        is_permitted(108, getClassName(__CLASS__), 'store', 157, 1);
        $option = [];
        $attachment_types = new AttachmentTypes();
        $generator = generator(108, $option, $attachment_types);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.c.attachmentTypes.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.attachmentTypes.create', compact('labels', 'html', 'userPermissions','save','id'));
    }


    public function store(Request $request)
    {
        is_permitted(108, getClassName(__CLASS__), 'store', 157, 1);

        $input = $request->all();
        $data = fieldInDatabase(108, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $attachment_types = new AttachmentTypes();
        $attachment_types->fill($field);
        $attachment_types->created_by = Auth::id();
        $attachment_types->save();

        Log::instance()->record('2.24', null, 108, null, null, null, null);
        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.cities.edit', $attachment_types->id));

        return response(['status' => 'true', 'message' => getMessage('2.1'),'city'=>$attachment_types]);
    }


    public function getEdit(Request $request,$id)
    {
        is_permitted(108, getClassName(__CLASS__), 'update', 158, 2);

        $option = [];

        $attachment_types = AttachmentTypes::find($id);

        $generator = generator(108, $option, $attachment_types);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('setting.c.attachmentTypes.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('setting.c.attachmentTypes.update', compact('labels', 'html', 'userPermissions','save','id'));
    }


    public function update(Request $request)
    {
        is_permitted(108, getClassName(__CLASS__), 'update', 158, 2);

        $input = $request->all();
        $data = fieldInDatabase(108, $input);

        $optionValidator = [

        ];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $attachment_types = AttachmentTypes::find($field['id']);
        $attachment_types->fill($field);
        $attachment_types->updated_by = Auth::id();
        Log::instance()->record('2.25', $field['id'], 108, null, null, $field, $attachment_types);
        Log::instance()->save();
        $attachment_types->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('settings.cities.edit', $attachment_types->id));

        return response(['success' => true, 'message' => getMessage('2.2'),'city'=>$attachment_types]);
    }


    public function delete($id)
    {
        is_permitted(108, getClassName(__CLASS__), 'delete', 159, 4);

        try {
            $Attachment = Attachment::where('attachment_type_id',$id)->get()->count();

            if ($Attachment > 0) {
                $message = getMessage('2.197');
                return response(['status' => 'false', 'message' => $message]);
            } else {
                AttachmentTypes::where('id', $id)->delete();
                $message = getMessage('2.3');
                Log::instance()->record('2.26', $id, 108, null, null, null, null);
                Log::instance()->save();
                notifications(getClassName(__CLASS__), __FUNCTION__, '');
                return response(['status' => 'true', 'message' => $message]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.197');
            return response(['status' => 'false', 'message' => $message]);
        }
    }


}
<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Procurement\Unit;
use App\Models\Setting\OppStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class UnitsController extends Controller
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

        is_permitted(141, getClassName(__CLASS__), __FUNCTION__, 304, 7);
        $list = Unit::orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.347');
        $labels = inputButton(Auth::user()->lang_id, 141);
        $userPermissions = getUserPermission();
        return view('procurement.unit.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(141, getClassName(__CLASS__), __FUNCTION__, 305, 1);


        $option = [
            'unit_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'unit_name_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];
        $unitObj= new Unit();
        $generator = generator(141, $option, $unitObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.unit.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(141, getClassName(__CLASS__), __FUNCTION__, 305, 1);

        $input = $request->all();

        $data = fieldInDatabase(141, $input);
        $field = $data['field'];

        $optionValidator=[];
        inputValidator($data, $optionValidator);

        $unitObj = new Unit();
        $unitObj->fill($field);
        // dd($field);
        $unitObj->created_by=Auth::user()->id;
        $unitObj->save();

        return response(['status' => true, 'message' => getMessage('2.1')]);


    }

    public function edit($id)
    {
        is_permitted(141, getClassName(__CLASS__), __FUNCTION__, 307, 2);


        $option = [
            'unit_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'unit_name_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];

        $unitObj = Unit::findOrfail($id);
        $generator = generator(141, $option, $unitObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.unit.edit', compact('labels', 'html', 'userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted(141, getClassName(__CLASS__), __FUNCTION__, 307, 2);

        $input = $request->all();
        $data  = fieldInDatabase(141, $input);
        $field = $data['field'];

        $id = $field['id'];


        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $unitObject = Unit::find($id);
        if(empty($unitObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }
        $unitObject->fill($field);
        $unitObject->updated_by=Auth::user()->id;
        $unitObject->save();

        return response(['status' => true, 'message' => getMessage('2.2')]);
    }

    public function delete($id)
    {
        is_permitted(141, getClassName(__CLASS__), __FUNCTION__, 308, 4);
        try {
            $unitObject = Unit::find($id);
            if(empty($unitObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            $arr=[\App\Models\Procurement\ItemGroups::class,\App\Models\Procurement\Item::class];
            $check=checkBeforeDelete($arr,"unit_id",$id);
            if($check) {
            $unitObject->delete();
            if($unitObject){
                $unitObject->update(["deleted_by"=>Auth::user()->id ]);
            }
            }else{
                return response(['status' => false, 'message' => getMessage('2.356')]);
            }
            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }




}
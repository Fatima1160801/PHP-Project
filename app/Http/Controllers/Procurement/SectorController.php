<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Procurement\Sector;
use App\Models\Setting\OppStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class SectorController extends Controller
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

        is_permitted(140, getClassName(__CLASS__), __FUNCTION__, 299, 7);
        $list = Sector::orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.205');
        $labels = inputButton(Auth::user()->lang_id, 140);
        $userPermissions = getUserPermission();
        return view('procurement.sector.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 247, 1);


        $option = [
            'sector_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'sector_name_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];
        $sectorObj= new Sector();
        $generator = generator(140, $option, $sectorObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.sector.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 247, 1);

        $input = $request->all();

        $data = fieldInDatabase(140, $input);
        $field = $data['field'];

        $optionValidator=[];
        inputValidator($data, $optionValidator);

        $sectorObj = new Sector();
        $sectorObj->fill($field);
        // dd($field);
        $sectorObj->save();

        return response(['status' => 'true', 'message' => getMessage('2.1')]);


    }

    public function edit($id)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 248, 2);


        $option = [
            'sector_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'sector_name_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];

        $sectorObj = Sector::findOrfail($id);
        $generator = generator(140, $option, $sectorObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.sector.edit', compact('labels', 'html', 'userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 248, 2);

        $input = $request->all();
        $data  = fieldInDatabase(140, $input);
        $field = $data['field'];
        $id = 1;
        //$id = $field['id'];


        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $sectorObject = Sector::find($id);
        if(empty($sectorObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }
        $sectorObject->fill($field);
        $sectorObject->save();

        return response(['status' => true, 'message' => getMessage('2.2')]);
    }

    public function delete($id)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 249, 4);
        try {
            $sectorObject = Sector::find($id);
            if(empty($sectorObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            $sectorObject->delete();
            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }




}
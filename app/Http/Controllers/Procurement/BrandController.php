<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Models\Procurement\Brand;
use App\Models\Setting\OppStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class BrandController extends Controller
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

        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 309, 7);
        $list = Brand::orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.348');
        $labels = inputButton(Auth::user()->lang_id, 142);
        $userPermissions = getUserPermission();
        return view('procurement.brand.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 310, 1);


        $option = [
            'brand_name' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],

        ];
        $brandObj= new Brand();
        $generator = generator(142, $option, $brandObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.brand.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 310, 1);

        $input = $request->all();

        $data = fieldInDatabase(142, $input);
        $field = $data['field'];
        $optionValidator=[];
        inputValidator($data, $optionValidator);

        $brandObj = new Brand();
        $brandObj->fill($field);
        $brandObj->created_by=Auth::user()->id;
        // dd($field);
        $brandObj->save();

        return response(['status' => 'true', 'message' => getMessage('2.1')]);


    }

    public function edit($id)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 312, 2);


        $option = [
            'brand_name' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],

        ];

        $brandObj = Brand::findOrfail($id);
        $generator = generator(142, $option, $brandObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.brand.edit', compact('labels', 'html', 'userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 312, 2);

        $input = $request->all();

        $data  = fieldInDatabase(142, $input);
        $field = $data['field'];
        // $id = 1;
        $id = $field['id'];



        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $brandObject = Brand::find($id);
        if(empty($brandObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }

        $brandObject->fill($field);
        $brandObject->updated_by=Auth::user()->id;
        $brandObject->save();

        return response(['status' => true, 'message' => getMessage('2.2')]);
    }

    public function delete($id)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 313, 4);
        try {
            $brandObject = Brand::find($id);
            if(empty($brandObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            $brandObject->delete();
            if($brandObject){
                $brandObject->update(["deleted_by"=>Auth::user()->id ]);
            }


            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }




}
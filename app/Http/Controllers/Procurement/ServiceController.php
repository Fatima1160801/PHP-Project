<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Procurement\Service;
//use App\Models\Setting\OppStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class ServiceController extends Controller
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

        is_permitted(145, getClassName(__CLASS__), __FUNCTION__, 322, 7);
        $list = Service::orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.351');
        $labels = inputButton(Auth::user()->lang_id, 145);
        $userPermissions = getUserPermission();
        return view('procurement.service.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(145, getClassName(__CLASS__), __FUNCTION__, 323, 1);


        $option = [
          //  'service_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
           // 'service_name_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

        ];
        $serviceObj= new Service();
        $generator = generator(145, $option, $serviceObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.service.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(145, getClassName(__CLASS__), __FUNCTION__, 323, 1);

        $input = $request->all();

        $data = fieldInDatabase(145, $input);
        $field = $data['field'];
        $optionValidator=[];
        inputValidator($data, $optionValidator);

        $serviceObj = new Service();
        $serviceObj->fill($field);
        $serviceObj->created_by=Auth::user()->id;
        // dd($field);
        $serviceObj->save();

        return response(['status' => true, 'message' => getMessage('2.1'),'id'=>$serviceObj->id]);


    }

    public function edit($id)
    {
        is_permitted(145, getClassName(__CLASS__), __FUNCTION__, 324, 2);


        $option = [
           // 'service_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            //'service_name_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
        ];

        $serviceObj = Service::findOrfail($id);
        $generator = generator(145, $option, $serviceObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('procurement.service.edit', compact('labels', 'html', 'userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted(145, getClassName(__CLASS__), __FUNCTION__, 324, 2);

        $input = $request->all();

        $data  = fieldInDatabase(145, $input);
        $field = $data['field'];
        // $id = 1;
        $id = $field['id'];



        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $serviceObj = Service::find($id);
        if(empty($serviceObj)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }

        $serviceObj->fill($field);
        $serviceObj->updated_by=Auth::user()->id;
        $serviceObj->save();

        return response(['status' => true, 'message' => getMessage('2.2'),'id'=>$serviceObj->id]);
    }

    public function delete($id)
    {
        is_permitted(145, getClassName(__CLASS__), __FUNCTION__, 325, 4);
        try {
            $serviceObj = Service::find($id);
            if(empty($serviceObj)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            $arr=[\App\Models\Procurement\Plan_Items::class];
            $check=checkBeforeDelete($arr,"service_type_id",$id);
            if($check) {
            $serviceObj->delete();
            if($serviceObj){
                $serviceObj->update(["deleted_by"=>Auth::user()->id ]);
            }
            }else{
                return response(['status' => false, 'message' => getMessage('2.355')]);
            }


            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }




}
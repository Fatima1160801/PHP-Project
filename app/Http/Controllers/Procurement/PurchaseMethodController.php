<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Procurement\Purchase;
use App\Models\Setting\OppStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class PurchaseMethodController extends Controller
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

    public function index(Request $request)
    {

        is_permitted(144, getClassName(__CLASS__), __FUNCTION__, 318, 7);
        $list = Purchase::get();
        $messageDeleteType = getMessage('2.349');
        $labels = inputButton(Auth::user()->lang_id, 144);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('procurement.purchasemethods.table_render', compact('labels', 'list', 'messageDeleteType', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('procurement.purchasemethods.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions','id'));
        }
    }
    public function create(Request $request,$type = null, $id = null)
    {
        is_permitted(144, getClassName(__CLASS__), __FUNCTION__, 319, 1);


        $option = [
           // 'method_name_na' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-8'],
            //'method_name_fo' => ['col_all_Class' => 'col-md-6', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-8'],
        ];
        $purchaseObj= new Purchase();
        $generator = generator(144, $option, $purchaseObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('procurement.purchasemethods.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('procurement.purchasemethods.create', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function store(Request $request)
    {
        is_permitted(144, getClassName(__CLASS__), __FUNCTION__, 319, 1);

        $input = $request->all();

        $data = fieldInDatabase(144, $input);
        $field = $data['field'];
        $optionValidator=[];
        inputValidator($data, $optionValidator);

        $purchaseObj = new Purchase();
        $purchaseObj->fill($field);
        $purchaseObj->created_by=Auth::user()->id;
        // dd($field);
        $purchaseObj->save();

        return response(['status' => true, 'message' => getMessage('2.1'),'id'=>$purchaseObj->id,'city'=>$purchaseObj]);


    }

    public function edit(Request $request,$id)
    {
        is_permitted(144, getClassName(__CLASS__), __FUNCTION__, 320, 2);


        $option = [
          //  'method_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
           // 'method_name_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];

        $purchaseObj = Purchase::findOrfail($id);
        $generator = generator(144, $option, $purchaseObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('procurement.purchasemethods.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('procurement.purchasemethods.edit', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function update(Request $request)
    {
        is_permitted(144, getClassName(__CLASS__), __FUNCTION__, 320, 2);

        $input = $request->all();

        $data  = fieldInDatabase(144, $input);
        $field = $data['field'];
        // $id = 1;
        $id = $field['id'];



        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $purchaseObject = Purchase::find($id);
        if(empty($purchaseObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }

        $purchaseObject->fill($field);
        $purchaseObject->updated_by=Auth::user()->id;
        $purchaseObject->save();

        return response(['status' => true, 'message' => getMessage('2.2'),'id'=>$purchaseObject->id,'city'=>$purchaseObject]);
    }

    public function delete($id)
    {
        is_permitted(144, getClassName(__CLASS__), __FUNCTION__, 321, 4);
        try {
            $purchaseObject = Purchase::find($id);
            if(empty($purchaseObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            $arr=[\App\Models\Procurement\Plan_Items::class];
            $check=checkBeforeDelete($arr,"purchase_method_id",$id);
            if($check) {
            $purchaseObject->delete();
            if($purchaseObject){
                $purchaseObject->update(["deleted_by"=>Auth::user()->id ]);
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
<?php

namespace App\Http\Controllers\Setting\Opportunity;

use App\Helpers\Log;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\Controller;

use App\Models\Setting\OppStatus;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class OppStatusController extends Controller
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

        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 246, 7);
        $optstatuses = OppStatus::orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.205');
        $labels = inputButton(Auth::user()->lang_id, 116);
        $userPermissions = getUserPermission();
        return view('setting.opportunity.opp_status.index', compact('labels', 'optstatuses', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 247, 1);


        $option = [
             'opportunity_status_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
              'opportunity_status_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];
        $optstatuses = new OppStatus();
        // $selectArray = [0=>'No',1=>'Yes'];

        // $option = [ 
        //             'is_hidden'=>['selectArray'=>$selectArray,'html_type'=>'5'],
        //         ];
        $generator = generator(116, $option, $optstatuses);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('setting.opportunity.opp_status.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 247, 1);

        $input = $request->all();

       $data = fieldInDatabase(116, $input);
       $field = $data['field'];

       $optionValidator=[];
       inputValidator($data, $optionValidator);

        $oppStatus = new OppStatus();
        $oppStatus->fill($field);
        // $oppStatus->created_by = Auth::id();


        
        // dd($field);
        $oppStatus->save();

        Log::instance()->record('2.210', null, 116, null, null, null, null);
        Log::instance()->save();

        // notifications(getClassName(__CLASS__), __FUNCTION__, route('optstatuses.edit', $oppStatus->id));
       
        return response(['status' => 'true', 'message' => getMessage('2.1')]);


    }

    public function edit($oppStatus)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 248, 2);


        $option = [
             'opportunity_status_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
              'opportunity_status_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];
        
        $oppStatus = OppStatus::find($oppStatus);
        $generator = generator(116, $option, $oppStatus);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
         return view('setting.opportunity.opp_status.edit', compact('labels', 'html', 'userPermissions', 'oppStatus'));
    }

    public function update(Request $request)
    {
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 248, 2);

        $input = $request->all();
        $data  = fieldInDatabase(116, $input);
        $field = $data['field'];

        $id    = $field['id'];
       

        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $oppStatus = OppStatus::find($id);
        $old_oppStatus = $oppStatus;
        $oppStatus->fill($field);

        // $oppStatus->updated_by = Auth::id();
        // dd($field['is_hidden']);
        $oppStatus->save();

        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('optstatuses.edit', $oppStatus->id));
        return response(['status' => 'true', 'message' => getMessage('2.2')]);


    }

    public function delete($id)
    {
        // dd(20);
        is_permitted(116, getClassName(__CLASS__), __FUNCTION__, 249, 4);
        try {
            $oppStatus = OppStatus::find($id);
            $oppStatus->deleted_by = Auth::id();
            $oppStatus->delete();
            $message = getMessage('2.3');
            Log::instance()->record('2.212', $id, 116, null, null, null, null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__), __FUNCTION__, '');
            return response(['status' => 'true', 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => 'false', 'message' => $message]);
        }
    }



}
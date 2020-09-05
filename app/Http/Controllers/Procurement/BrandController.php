<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Models\Procurement\Brand;
use App\Models\Proposal;
use App\Models\Setting\C\City;
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

    public function index(Request $request)
    {

        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 309, 7);
        $list = Brand::get();
        $messageDeleteType = getMessage('2.348');
//        $labels = inputButton(Auth::user()->lang_id, 142);
        $userPermissions = getUserPermission();
        $brandObj = new Brand();
        $option = [
            'brand_name' => ['col_all_Class' => 'col-md-8', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-8'],

        ];
        $generator = generator(142, $option, $brandObj);
        $html = $generator[0];
        $labels = $generator[1];
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('procurement.brand.table_render', compact('labels', 'list', 'messageDeleteType', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('procurement.brand.index', compact('labels', 'html', 'list', 'messageDeleteType', 'userPermissions','id'));
        }
    }

    public function create($type = null, $id = null,Request $request)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 310, 1);


        $option = [
            'brand_name' => ['col_all_Class' => 'col-md-9', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7'],

        ];
        $brandObj= new Brand();
        $generator = generator(142, $option, $brandObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('procurement.brand.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('procurement.brand.create', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function store(Request $request)
    {

        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 310, 1);

        $input = $request->all();

        $data = fieldInDatabase(142, $input);
        $field = $data['field'];
        $optionValidator=[];
        inputValidator($data, $optionValidator);
        $count=Brand::all()->count();
        $brandObj = new Brand();
        $brandObj->fill($field);
        $brandObj->created_by=Auth::user()->id;
        $brandObj->save();
        return response(['status' => true, 'message' => getMessage('2.1'),'id'=>$brandObj->id,'city'=>$brandObj,'count'=>$count]);


    }

    public function edit(Request $request,$id)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 312, 2);


        $option = [
            'brand_name' => ['col_all_Class' => 'col-md-9', 'col_label_Class' => 'col-md-5', 'col_input_Class' => 'col-md-7'],

        ];

        $brandObj = Brand::findOrfail($id);
        $generator = generator(142, $option, $brandObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('procurement.brand.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('procurement.brand.edit', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function update(Request $request)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 312, 2);

        $input = $request->all();

        $data  = fieldInDatabase(142, $input);
        $field = $data['field'];
        $id = $field['id'];
//$id=$request->editId;


        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $brandObject = Brand::find($id);
        if(empty($brandObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }

        $brandObject->fill($field);
//        $brandObject->brand_name=$request->editName;
        $brandObject->updated_by=Auth::user()->id;
        $brandObject->save();
        return response(['status' => true, 'message' => getMessage('2.2'),'id'=>$brandObject->id,'city'=>$brandObject]);
    }

    public function delete($id)
    {
        is_permitted(142, getClassName(__CLASS__), __FUNCTION__, 313, 4);
        try {
            $brandObject = Brand::find($id);
            if(empty($brandObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            $arr=[\App\Models\Procurement\Item::class];
            $check=checkBeforeDelete($arr,"brand_id",$id);
            if($check){
            $brandObject->delete();
            if($brandObject){
                $brandObject->update(["deleted_by"=>Auth::user()->id ]);
            }
            }else{
                return response(['status' => false, 'message' => getMessage('2.354')]);
            }
            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }
    public function searchProposalRequest(Request $request)
    {
        $input = $request->all();
            $query = Proposal::query();
            if ($request->has('subject_na') && $request->get('subject_na') != null) {
              $query->where('subject_na','like', '%' . $input['subject_na'] . '%');
            }
            if ($request->has(['deadline_from','deadline_to']) && $request->get(['deadline_from','deadline_to']) != null) {
                $query->whereBetween('deadline',array(dateFormatDataBase($input['deadline_from']),dateFormatDataBase($input['deadline_from'])));
            }else if ($request->has(['deadline_from','deadline_to']) && $request->get('deadline_from') != null && $request->get('deadline_to') == null)
                $query->where('deadline','>=',dateFormatDataBase($input['deadline from']));
            if ($request->has(['budget_from','budget_to']) && $request->get(['budget_from','budget_to']) != null) {
                $query->whereBetween('budget_value',array($input['budget_from'],$input['budget_to']));
            }else if($input['budget_from']!="null"  && $input['budget_to'] == "null")
                $query->where('budget_value','>=',$input['budget_from']);
            if ($request->has('status_id') && $request->get('status_id') != null) {
                $query->where('proposal_status_id',$input['status_id']);
            }

            $data = $query->get();
         return response(['status' => true, 'message' => getMessage('2.1'),'data'=>$data]);



    }
    public function searchProposal($subject_na,$deadlinefrom,$deadlineto,$budgetfrom,$budgetto,$status)
    {

        $query = Proposal::query();
        if ($subject_na != "null") {
           $query->where('subject_na','like', '%' . $subject_na . '%');
        }
        if ($deadlinefrom!="null" && $deadlineto!="null") {
            $query->whereBetween('deadline',array(dateFormatDataBase($deadlinefrom),dateFormatDataBase($deadlineto)));

        }else if($deadlinefrom!="null" && $deadlineto=="null")
            $query->where('deadline','>=',dateFormatDataBase($deadlinefrom));

        if ($budgetfrom!="null"  && $budgetto != "null") {
            $query->whereBetween('budget_value',array($budgetfrom,$budgetto));

        }else if($budgetfrom!="null"  && $budgetto == "null")
            $query->where('budget_value','>=',$budgetfrom);
        if ($status!= "null") {
            $query->where('proposal_status_id',$status);
        }

        $data = $query->get();
dd($data);


        $userPermissions = getUserPermission();

        return response(['status' => true, 'message' => getMessage('2.1'),'data'=>$data]);



    }
    public function searchConcept($subject_na,$deadlinefrom,$deadlineto,$budgetfrom,$budgetto,$status)
    {

        $query = Concept::query();
        if ($subject_na != "null") {
            $query->where('subject_na','like', '%' . $subject_na . '%');
        }
        if ($deadlinefrom!="null" && $deadlineto!="null") {
            $query->whereBetween('deadline',array(dateFormatDataBase($deadlinefrom),dateFormatDataBase($deadlineto)));

        }else if($deadlinefrom!="null" && $deadlineto=="null")
            $query->where('deadline','>=',dateFormatDataBase($deadlinefrom));

        if ($budgetfrom!="null"  && $budgetto != "null") {
            $query->whereBetween('budget_value',array($budgetfrom,$budgetto));

        }else if($budgetfrom!="null"  && $budgetto == "null")
            $query->where('budget_value','>=',$budgetfrom);
        if ($status!= "null") {
            $query->where('status_id',$status);
        }

        $data = $query->get();
        dd($data);


        $userPermissions = getUserPermission();

        return response(['status' => true, 'message' => getMessage('2.1'),'data'=>$data]);



    }
    public function searchConceptRequest(Request $request)
    {
        $input = $request->all();
        $query = Concept::query();
        if ($request->has('subject_na') && $request->get('subject_na') != null) {
            $query->where('subject_na','like', '%' . $input['subject_na'] . '%');
        }
        if ($request->has(['deadline_from','deadline_to']) && $request->get(['deadline_from','deadline_to']) != null) {
            $query->whereBetween('deadline',array(dateFormatDataBase($input['deadline_from']),dateFormatDataBase($input['deadline_from'])));
        }else if ($request->has(['deadline_from','deadline_to']) && $request->get('deadline_from') != null && $request->get('deadline_to') == null)
            $query->where('deadline','>=',dateFormatDataBase($input['deadline from']));
        if ($request->has(['budget_from','budget_to']) && $request->get(['budget_from','budget_to']) != null) {
            $query->whereBetween('budget_value',array($input['budget_from'],$input['budget_to']));
        }else if($input['budget_from']!="null"  && $input['budget_to'] == "null")
            $query->where('budget_value','>=',$input['budget_from']);
        if ($request->has('status_id') && $request->get('status_id') != null) {
            $query->where('status_id',$input['status_id']);
        }

        $data = $query->get();
        return response(['status' => true, 'message' => getMessage('2.1'),'data'=>$data]);



    }






}
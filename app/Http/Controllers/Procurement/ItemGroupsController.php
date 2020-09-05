<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Procurement\item_groups;
use App\Models\Procurement\ItemGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class ItemGroupsController extends Controller
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

        is_permitted(143, getClassName(__CLASS__), __FUNCTION__, 314, 7);
        $list = ItemGroups::get();
        $messageDeleteType = getMessage('2.350');
        $labels = inputButton(Auth::user()->lang_id, 143);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('procurement.item_groups.table_render', compact('labels', 'list', 'messageDeleteType', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('procurement.item_groups.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions', 'id'));
        }
    }
    public function create(Request $request,$type = null, $id = null)
    {
        is_permitted(143, getClassName(__CLASS__), __FUNCTION__, 315, 1);


        $option = [
            //'item_groups_name' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'item_groups_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'item_groups_name_fa' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

            'unit_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

        ];
        $itemObj= new ItemGroups();
        $generator = generator(143, $option, $itemObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('procurement.item_groups.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        return view('procurement.item_groups.create', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function store(Request $request)
    {
        is_permitted(143, getClassName(__CLASS__), __FUNCTION__, 316, 1);

        $input = $request->all();

        $data = fieldInDatabase(143, $input);
        $field = $data['field'];
        $optionValidator=[];
        inputValidator($data, $optionValidator);
        $request->validate([
            'image_icon' => 'mimes:jpg,jpeg,png,PNG,JPG',
        ]);
        $item_groupsObj = new ItemGroups();
        $item_groupsObj->fill($field);
        $path = public_path('images/itemGroups');
        if ($request->hasFile('image_icon')) {
            $fileG = time() . '.' . $request->file('image_icon')->getClientOriginalExtension();
            $filename = $request->file('image_icon')->getClientOriginalName();
            $item_groupsObj->image_icon = 'images/itemGroups/'.$fileG;
           // $item_groupsObj->image_icon = $filename;
            $request->file('image_icon')->move($path, $fileG);
        }

        $item_groupsObj->created_by=Auth::user()->id;
        // dd($field);
        $item_groupsObj->save();

        return response(['status' => true, 'message' => getMessage('2.1'),'id'=>$item_groupsObj->id]);


    }

    public function edit(Request $request,$id)
    {
        is_permitted(143, getClassName(__CLASS__), __FUNCTION__, 316, 2);


        $option = [
            'item_groups_name_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'item_groups_name_fa' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

            'unit_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

        ];

        $item_groupsObj = ItemGroups::findOrfail($id);
        $generator = generator(143, $option, $item_groupsObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('procurement.item_groups.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('procurement.item_groups.edit', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function update(Request $request)
    {
        is_permitted(143, getClassName(__CLASS__), __FUNCTION__, 316, 2);

        $input = $request->all();
        $data  = fieldInDatabase(143, $input);
        $field = $data['field'];

        $id = $field['id'];

        $request->validate([
            'file' => 'mimes:jpg,jpeg,png,PNG,JPG',
        ]);

        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $item_groupsObject = ItemGroups::find($id);
        if(empty($item_groupsObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }
        $item_groupsObject->fill($field);

        $filename_old = $item_groupsObject->image_icon;
       // $fileG_old = $item_groupsObject->file;

        $path = public_path('images/itemGroups');
        if ($request->hasFile('image_icon')) {
            $fileG = time() . '.' . $request->file('image_icon')->getClientOriginalExtension();
            $filename_new = $request->file('image_icon')->getClientOriginalName();
            if ($filename_old != $filename_new) {
               // $item_groupsObject->file = $fileG;
                $item_groupsObject->image_icon = 'images/itemGroups/'.$fileG;
                $request->file('image_icon')->move($path, $fileG);
            }else{
                $item_groupsObject->image_icon=  $filename_old;
                //$item_groupsObject->file=   $fileG_old ;
            }
        }
        $item_groupsObject->updated_by=Auth::user()->id;
        $item_groupsObject->save();

        return response(['status' => true, 'message' => getMessage('2.2'),'id'=>$item_groupsObject->id]);
    }

    public function delete($id)
    {
        is_permitted(143, getClassName(__CLASS__), __FUNCTION__, 317, 4);
        try {
            $item_groupsObject = ItemGroups::find($id);
            if(empty($item_groupsObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            $arr=[\App\Models\Procurement\Item::class,\App\Models\Procurement\Plan_Items::class];
            $check=checkBeforeDelete($arr,"item_group_id",$id);
            if($check){
            $item_groupsObject->delete();
            if($item_groupsObject){
                $item_groupsObject->update(["deleted_by"=>Auth::user()->id ]);
            }
            }else{
                return response(['status' => false, 'message' => getMessage('2.357')]);
            }

            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }




}
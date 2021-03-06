<?php

namespace App\Http\Controllers\Procurement;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Procurement\Item;
use App\Models\Setting\OppStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class ItemController extends Controller
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

        is_permitted(146, getClassName(__CLASS__), __FUNCTION__, 326, 7);
        $list = Item::get();
        $messageDeleteType = getMessage('2.352');
        $labels = inputButton(Auth::user()->lang_id, 146);
        $userPermissions = getUserPermission();
        $id = 1;
        if ($request->ajax()) {
            $id = 2;
            $html = view('procurement.item.table_render', compact('labels', 'list', 'messageDeleteType', 'userPermissions', 'id'))->render();
            return response(['status' => true, 'html' => $html]);
        } else {
            return view('procurement.item.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions','id'));
        }
    }
    public function screensetting(){
        $labels = inputButton(Auth::user()->lang_id, 0);
        $userPermissions = getUserPermission();
        $lang=Auth::user()->lang_id;
        return view('procurement.screen', compact('labels','userPermissions','lang'));
    }
    public function create(Request $request,$type = null, $id = null)
    {
        is_permitted(146, getClassName(__CLASS__), __FUNCTION__, 327, 1);


        $status = [
            1 => ['0' => 'Active', '1' => 'Inactive'],
            2 => ['0' => 'فعال', '1' => 'غيرفعال']
        ];

        $option = [
            'ean' => ['inputClass' => 'check-is-number'],
            'status'=>['html_type' => '5', 'selectArray' => $status[Auth::user()->lang_id]],
            'isbn' => ['inputClass' => 'check-is-number'],
            'upc' => ['inputClass' => 'check-is-number'],
            'brand_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

            'unit_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'item_group_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

        ];
        $itemObject = new Item();
        $generator = generator(146, $option, $itemObject);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=1;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('procurement.item.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        return view('procurement.item.create', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function store(Request $request)
    {
        is_permitted(146, getClassName(__CLASS__), __FUNCTION__, 327, 1);

        $input = $request->all();

        $data = fieldInDatabase(146, $input);
        $field = $data['field'];
        $optionValidator = [];
        inputValidator($data, $optionValidator);
        $request->validate([
            'icon' => 'mimes:jpg,jpeg,png,PNG,JPG',
            'thumb' => 'mimes:jpg,jpeg,png,PNG,JPG',
            'photo' => 'mimes:jpg,jpeg,png,PNG,JPG',
        ]);
        $itemObject = new Item();
        $itemObject->fill($field);
        $path_icon = public_path('images/item/icon');
        $path_thumb = public_path('images/item/thumb');
        $path_photo = public_path('images/item/photo');


        if ($request->hasFile('icon')) {
            $fileG = time() . '.' . $request->file('icon')->getClientOriginalExtension();
            $filename = $request->file('icon')->getClientOriginalName();
            $itemObject->icon = 'images/item/icon/'.$fileG;
            // $itemObject->image_icon = $filename;
            $request->file('icon')->move($path_icon, $fileG);
        }
        if ($request->hasFile('thumb')) {
            $fileG = time() . '.' . $request->file('thumb')->getClientOriginalExtension();
            $filename = $request->file('thumb')->getClientOriginalName();
            $itemObject->thumb = 'images/item/thumb/'.$fileG;
            // $itemObject->image_icon = $filename;
            $request->file('thumb')->move($path_thumb, $fileG);
        }
        if ($request->hasFile('photo')) {
            $fileG = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $filename = $request->file('photo')->getClientOriginalName();
            $itemObject->photo = 'images/item/photo/'.$fileG;
            // $itemObject->image_icon = $filename;
            $request->file('photo')->move($path_photo, $fileG);
        }

        
        $itemObject->created_by = Auth::user()->id;
        // dd($field);
        $itemObject->save();

        return response(['status' => true, 'message' => getMessage('2.1'),'id'=>$itemObject->id]);


    }

    public function edit(Request $request,$id)
    {
        is_permitted(146, getClassName(__CLASS__), __FUNCTION__, 328, 2);

        $status = [
            1 => ['0' => 'Active', '1' => 'Inactive'],
            2 => ['0' => 'فعال', '1' => 'غيرفعال']
        ];

        $option = [
            'ean' => ['inputClass' => 'check-is-number'],
            'status'=>['html_type' => '5', 'selectArray' => $status[Auth::user()->lang_id]],
            'isbn' => ['inputClass' => 'check-is-number'],
            'upc' => ['inputClass' => 'check-is-number'],
            'brand_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

            'unit_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'item_group_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],

            /* 'sku' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],*/
        ];
        $itemObject = Item::findOrfail($id);
        $generator = generator(146, $option, $itemObject);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        $save=2;
        $id=1;
        if($request->ajax()){
            $id=2;
            $html =view('procurement.item.create_render', compact('labels', 'html', 'userPermissions','save','id'))->render();
            return response(['status' => true, 'html' =>$html]);

        }
        else
        return view('procurement.item.edit', compact('labels', 'html', 'userPermissions','save','id'));
    }

    public function update(Request $request)
    {
        is_permitted(146, getClassName(__CLASS__), __FUNCTION__, 328, 2);

        $input = $request->all();

        $data = fieldInDatabase(146, $input);
        $field = $data['field'];
        // $id = 1;
        $id = $field['id'];


        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $itemObject = Item::find($id);
        if (empty($itemObject)) {
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }
        $itemObject->fill($field);
        $filename_old = $itemObject->icon;
        $filename_old1 = $itemObject->thumb;
        $filename_old2 = $itemObject->photo;
        $path_icon = public_path('images/item/icon');
        $path_thumb = public_path('images/item/thumb');
        $path_photo = public_path('images/item/photo');


        if ($request->hasFile('icon')) {
            $fileG = time() . '.' . $request->file('icon')->getClientOriginalExtension();
            $filename_new = $request->file('icon')->getClientOriginalName();
            if ($filename_old != $filename_new) {
                // $itemObject->file = $fileG;
                $itemObject->icon = 'images/item/icon/'.$fileG;
                $request->file('icon')->move($path_icon, $fileG);
            }else{
                $itemObject->icon=  $filename_old;
                //$itemObject->file=   $fileG_old ;
            }
        }
        if ($request->hasFile('thumb')) {
            $fileG2 = time() . '.' . $request->file('thumb')->getClientOriginalExtension();
            $filename_new = $request->file('thumb')->getClientOriginalName();
            if ($filename_old1 != $filename_new) {
                // $itemObject->file = $fileG;
                $itemObject->thumb = 'images/item/thumb/'.$fileG2;
                $request->file('thumb')->move($path_thumb, $fileG2);
            }else{
                $itemObject->thumb=  $filename_old1;
                //$itemObject->file=   $fileG_old ;
            }
        }
        if ($request->hasFile('photo')) {
            $fileG3 = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $filename_new = $request->file('photo')->getClientOriginalName();
            if ($filename_old2 != $filename_new) {
                // $itemObject->file = $fileG;
                $itemObject->photo = 'images/item/photo/'.$fileG3;
                $request->file('photo')->move($path_photo, $fileG3);
            }else{
                $itemObject->photo=  $filename_old2;
                //$itemObject->file=   $fileG_old ;
            }
        }
        
        $itemObject->updated_by = Auth::user()->id;
        $itemObject->save();

        return response(['status' => true, 'message' => getMessage('2.2'),'id'=>$itemObject->id]);
    }

    public function delete($id)
    {
        is_permitted(146, getClassName(__CLASS__), __FUNCTION__, 329, 4);
        try {
            $itemObject = Item::find($id);
            if (empty($itemObject)) {
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            $itemObject->delete();
            if ($itemObject) {
                $itemObject->update(["deleted_by" => Auth::user()->id]);
            }


            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }


}
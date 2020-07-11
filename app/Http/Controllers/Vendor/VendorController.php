<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class VendorController extends Controller
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

        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 330, 7);
        $list = Vendor::orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.358');
        $labels = inputButton(Auth::user()->lang_id, 147);
        $userPermissions = getUserPermission();
        return view('vendorss.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 331, 1);


        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
        ];
        $vendorObj= new Vendor();
        $generator = generator(147, $option, $vendorObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('vendorss.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 331, 1);

        $input = $request->all();

        $data = fieldInDatabase(147, $input);
        $field = $data['field'];
        $optionValidator=[];
        inputValidator($data, $optionValidator);

        $vendorObj = new Vendor();
        $vendorObj->fill($field);
        $vendorObj->created_by=Auth::user()->id;
        // dd($field);
        $vendorObj->save();
        $venderId=$vendorObj->id;
        dd($venderId);
        $sectorVendor = $request->input('sector_id');
        foreach($sectorVendor as $item) {
            $secvend = new vendor_sector_();

            $secvend->save();
        }
        return response(['status' => true, 'message' => getMessage('2.1')]);


    }

    public function edit($id)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 332, 2);


        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
        ];

        $vendorObj = Vendor::findOrfail($id);
        $generator = generator(147, $option, $vendorObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('vendorss.edit', compact('labels', 'html', 'userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 332, 2);

        $input = $request->all();

        $data  = fieldInDatabase(147, $input);
        $field = $data['field'];
        // $id = 1;
        $id = $field['id'];



        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $vendorObject = Vendor::find($id);
        if(empty($vendorObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }

        $vendorObject->fill($field);
        $vendorObject->updated_by=Auth::user()->id;
        $vendorObject->save();

        return response(['status' => true, 'message' => getMessage('2.2')]);
    }

    public function delete($id)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 333, 4);
        try {
            $vendorObject = Vendor::find($id);
            if(empty($vendorObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            //$arr=[\App\Models\Procurement\ItemGroups::class,\App\Models\Procurement\Service::class];
            //$check=checkBeforeDelete($arr,"sector_id",$id);
            //if($check) {
                $vendorObject->delete();
              //  if ($vendorObject) {
                    $vendorObject->update(["deleted_by" => Auth::user()->id]);
                //}
            //}else{
              //  return response(['status' => false, 'message' => getMessage('2.355')]);
            //}


            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }




}
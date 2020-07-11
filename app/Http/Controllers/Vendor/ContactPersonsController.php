<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Vendor\Vendor;
use App\Models\Vendor\ContactPersons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class ContactPersonsController extends Controller
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

        is_permitted(148, getClassName(__CLASS__), __FUNCTION__, 330, 7);
        $list = ContactPersons::orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.358');
        $labels = inputButton(Auth::user()->lang_id, 148);
        $userPermissions = getUserPermission();
        return view('vendorss.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(148, getClassName(__CLASS__), __FUNCTION__, 331, 1);



        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
            //'country_id'=>['html_type' => '5', 'selectArray' => $country[Auth::user()->lang_id]],
        ];
        $contactObj= new Vendor();
        $generator = generator(148, $option, $contactObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('vendorss.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(148, getClassName(__CLASS__), __FUNCTION__, 331, 1);

        $input = $request->all();

        $data = fieldInDatabase(148, $input);
        $field = $data['field'];
        $optionValidator=[];
        inputValidator($data, $optionValidator);

        $contactObj = new Vendor();
        $contactObj->fill($field);
        $contactObj->created_by=Auth::user()->id;
        // dd($field);
        $contactObj->save();
        $venderId=$contactObj->id;
        dd($venderId);
        $sectorVendor = $request->input('sector_id');
        foreach($sectorVendor as $item) {
            $secvend = new Vendor_Sector();

            $secvend->save();
        }
        return response(['status' => true, 'message' => getMessage('2.1')]);


    }

    public function edit($id)
    {
        is_permitted(148, getClassName(__CLASS__), __FUNCTION__, 332, 2);

        
        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
           
        ];

        $contactObj = ContactPersons::findOrfail($id);
        $generator = generator(148, $option, $contactObj);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('vendorss.vendor1.edit', compact('labels', 'html', 'userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted(148, getClassName(__CLASS__), __FUNCTION__, 332, 2);

        $input = $request->all();

        $data  = fieldInDatabase(148, $input);
        $field = $data['field'];
        // $id = 1;
        $id = $field['id'];



        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $contactObject = ContactPersons::find($id);
        if(empty($contactObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }

        $contactObject->fill($field);
        $contactObject->updated_by=Auth::user()->id;
        $contactObject->save();

        return response(['status' => true, 'message' => getMessage('2.2')]);
    }

    public function delete($id)
    {
        is_permitted(148, getClassName(__CLASS__), __FUNCTION__, 333, 4);
        try {
            $contactObject = ContactPersons::find($id);
            if(empty($contactObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
            //$arr=[\App\Models\Procurement\ItemGroups::class,\App\Models\Procurement\Service::class];
            //$check=checkBeforeDelete($arr,"sector_id",$id);
            //if($check) {
            $contactObject->delete();
            //  if ($contactObject) {
            $contactObject->update(["deleted_by" => Auth::user()->id]);
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
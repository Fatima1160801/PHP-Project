<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Log;
use App\Http\Controllers\Controller;

use App\Models\Procurement\Brand;
use App\Models\Vendor\City;
use App\Models\Vendor\ContactPersons;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Vendor_Sector;
use App\Models\Vendor\JobTitle;
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
        return view('vendorss.vendor1.index', compact('labels', 'list', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 331, 1);
        $country = [
            1 => ['1' => 'Palestine'],
            2 => ['1' => 'فلسطين']
        ];


        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
            'country_id'=>['html_type' => '5', 'selectArray' => $country[Auth::user()->lang_id]],
        ];
        $vendorObj= new Vendor();
        $generator = generator(147, $option, $vendorObj);
        $html = $generator[0];
        $labels = $generator[1];
        $job_list =JobTitle::get();
        $userPermissions = getUserPermission();
        return view('vendorss.vendor1.create', compact('labels', 'html','job_list','userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 331, 1);

        $input = $request->all();
        $data = fieldInDatabase(147, $input);
        $field = $data['field'];
        $optionValidator=[];
        inputValidator($data, $optionValidator);
        try {

            DB::beginTransaction();

        $vendorObj = new Vendor();
        $vendorObj->fill($field);
        $vendorObj->created_by=Auth::user()->id;
        // dd($field);
        $vendorObj->save();
        if(!empty($vendorObj)){
            ///// add sectors

            if(!empty($request->sector_id)){
                foreach($request->sector_id as $sector){
                    $vendor_sectorObj=new Vendor_Sector();
                    $vendor_sectorObj->vendor_id=$vendorObj->id;
                    $vendor_sectorObj->sector_id=$sector;
                    $vendor_sectorObj->save();
                }
            }

            if(!empty($request->job_title_id) || !empty($request->fullname) || !empty($request->tel) || !empty($request->contact_email)){
               if(!empty($request->serial)){
                   foreach ($request->serial as $index=>$item){
                       $contactObj=new ContactPersons();
                       $contactObj->vendor_id=$vendorObj->id;
                       $contactObj->full_name=$request->fullname[$index];
                       $contactObj->job_title_id=$request->job_title_id[$index];
                       $contactObj->tel_number=$request->tel[$index];
                       $contactObj->email=$request->contact_email[$index];
                       $contactObj->created_by=Auth::user()->id;
                       $contactObj->save();
                   }
               }
            }
        }
        }catch (\Throwable $exception) {
            DB::rollBack();
            $message =  (is_numeric($exception->getMessage()) ? getMessage(2.246) : getMessage(2.245));
            return response()->json([
                'status'=>false,
                'message' => $message,
                'code'=>$exception->getCode(),
                'result'=>[],
            ]);
        } finally {
            DB::commit();
        }
       /*$venderId=$vendorObj->id;
        dd($venderId);
        $sectorVendor = $request->input('sector_id');
        foreach($sectorVendor as $item) {
            $secvend = new Vendor_Sector();

            $secvend->save();
        }*/
        return response(['status' => true, 'message' => getMessage('2.1')]);


    }

    public function edit($id)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 332, 2);
        $messageDeleteType = getMessage('2.360');
        $country = [
            1 => ['1' => 'Palestine'],
            2 => ['1' => 'فلسطين']
        ];
        $ref_sector_selected = [];
        $ref_sector_selected =Vendor_Sector::where('vendor_id', $id)->pluck('sector_id')->toArray();
        //dd($ref_sector_selected);
//        if(!empty($sector_Selected)) {
//            foreach ($sector_Selected as $index => $item) {
//                $ref_sector_selected[$index] = $item;
//            }
//        }


        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
            'country_id'=>['html_type' => '5', 'selectArray' => $country[Auth::user()->lang_id]],
            'sector_id'=> ['relatedWhere' => 'deleted_at is null', 'SelectedArray' => $ref_sector_selected],

            ];

        $vendorObj = Vendor::findOrfail($id);
        $generator = generator(147, $option, $vendorObj);
        $html = $generator[0];
        $labels = $generator[1];
        $contact = ContactPersons::where('vendor_id', '=', $id)->get();

        $job_list =JobTitle::get();

            $userPermissions = getUserPermission();
            return view('vendorss.vendor1.edit', compact('vendorObj','labels', 'html','contact','job_list','messageDeleteType', 'userPermissions'));


      //  return view('vendorss.vendor1.edit', compact('labels', 'html', 'userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 332, 2);

        $input = $request->all();

        $data  = fieldInDatabase(147, $input);
        $field = $data['field'];

        $id = $field['id'];



        $optionValidator = [
        ];
        inputValidator($data, $optionValidator);
        $vendorObject = Vendor::find($id);

        if(empty($vendorObject)){
            return response(['status' => false, 'message' => getMessage('2.2')]);
        }
        try {

            DB::beginTransaction();


            $vendorObject->fill($field);
            $vendorObject->updated_by=Auth::user()->id;
            $vendorObject->save();
           /* $contactObj = ContactPersons::where('vendor_id', $id)->update(["deleted_by"=>Auth::user()->id ]);
            $contactObj->where('vendor_id', $id)->delete();*/
            if(!empty($vendorObject)){
                $contactObj=ContactPersons::where('vendor_id', $id)->get();
                if(count($contactObj)>0){
                    foreach ($contactObj as $item){
                        $item->delete();
                    $item->update(["deleted_by"=>Auth::user()->id ]);
                }
            }
                $vendor_sector=Vendor_Sector::where('vendor_id',$id)->delete();

                if(!empty($request->sector_id)){
                    foreach($request->sector_id as $sector){
                        $vendor_sectorObj=new Vendor_Sector();
                        $vendor_sectorObj->vendor_id=$vendorObject->id;
                        $vendor_sectorObj->sector_id=$sector;
                        $vendor_sectorObj->save();
                    }
                }



//                 $vendorObject->sectors()->sync($request->sector_id, true);//dont delete old entries = false
//                dd(122);

               /* if(!empty($contactObj)){
                    $contactObj->delete();
                    $contactObj->update(["deleted_by"=>Auth::user()->id ]);

                }*/
                ///// add sectors

               // $vendorObject->sectors()->sync($request->sector_id, true);//dont delete old entries = false
                // dd($vendorObject);

              //  foreach ($request->serial1 as $index=>$item){
                   // $id1=$request->serial1[$index];
                   // dd($id1);
                   /* $contactObject = ContactPersons::find();
                    if(empty($contactObject)){
                        return response(['status' => false, 'message' => getMessage('2.2')]);
                    }
                    $contactObject->fill($field);
                    $contactObject->updated_by=Auth::user()->id;
                    $contactObject->save();*/
              //  }
              /*  if(!empty($request->job_title_id1) || !empty($request->fullname1) || !empty($request->tel1) || !empty($request->contact_email1)){

                    if(!empty($request->serial1)){
                        foreach ($request->serial1 as $index=>$item){
                            $contactObject=new ContactPersons();
                            $contactObject->vendor_id=$vendorObject->id;
                            $contactObject->full_name=$request->fullname1[$index];
                            $contactObject->job_title_id=$request->job_title_id1[$index];
                            $contactObject->tel_number=$request->tel1[$index];
                            $contactObject->email=$request->contact_email1[$index];
                            $contactObject->created_by=Auth::user()->id;
                            $contactObject->save();

                        }
                    }
                }*/

                if(!empty($request->job_title_id) || !empty($request->fullname) || !empty($request->tel) || !empty($request->contact_email)){

                    if(!empty($request->serial)){
                        foreach ($request->serial as $index=>$item){
                            $contactObj=new ContactPersons();
                            $contactObj->vendor_id=$vendorObject->id;
                            $contactObj->full_name=$request->fullname[$index];
                            $contactObj->job_title_id=$request->job_title_id[$index];
                            $contactObj->tel_number=$request->tel[$index];
                            $contactObj->email=$request->contact_email[$index];
                            $contactObj->created_by=Auth::user()->id;
                            $contactObj->save();
                            
                        }
                    }
                }
            }
        }catch (\Throwable $exception) {
            DB::rollBack();
            $message =  (is_numeric($exception->getMessage()) ? getMessage(2.246) : getMessage(2.245));
            return response()->json([
                'status'=>false,
                'message' => $message,
                'code'=>$exception->getCode(),
                'result'=>[],
            ]);
        } finally {
            DB::commit();
        }




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

    function getCity($id){
        if(Auth::user()->lang==1){
            $name="district_name_no"  ;
        }else{
            $name="district_name_fo"   ;
        }

       $arr= City::where('city_id',$id)->pluck($name,"id")->toArray();
       if(!empty($arr)){
           return response(['status' => true, 'city' => $arr]);
       }else{
           return response(['status' => false, 'city' => []]);
       }

    }


    public function deleteContact($id){

        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 313, 4);
        try {
            $contactObj = ContactPersons::find($id);
            if(empty($contactObj)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }


                $contactObj->delete();



            if($contactObj){
                    $contactObj->update(["deleted_by"=>Auth::user()->id ]);
            }

            $message = getMessage('2.3');
            return response(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => false, 'message' => $message]);
        }
    }

}
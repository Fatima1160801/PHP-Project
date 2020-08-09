<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use Validator;
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
       if(Auth::user()->lang_id==1){
           $country_lang=2;
       }else{
           $country_lang=1;
       }
      $country= \App\Models\Procurement\Country::where("language_id",$country_lang)->pluck("country_name","id");
//       dd($country);
//        $country = [
//            1 => ['1' => 'Palestine'],
//            2 => ['1' => 'فلسطين']
//        ];
        $messageDeleteType = getMessage('2.360');

        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
            'country_id'=>['html_type' => '5', 'selectArray' => $country],
            'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'telephone'=> ['inputClass' => 'check-is-number'],
            'fax'=> ['inputClass' => 'check-is-number'],
        ];
        $vendorObj= new Vendor();
       // $vendorObj->country_id=1;
        $generator = generator(147, $option, $vendorObj);
        $abortAdd=getMessage("2.362");
        $abortWeb=getMessage("2.416");
        $html = $generator[0];
        $labels = $generator[1];
        $job_list =JobTitle::get();
        $abortSave=getMessage("2.361");
        $userPermissions = getUserPermission();
        return view('vendorss.vendor1.create', compact('abortWeb','abortSave','abortAdd','messageDeleteType','labels', 'html','job_list','userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 331, 1);

        $input = $request->all();
        $data = fieldInDatabase(147, $input);
        $field = $data['field'];
        $rulesVendor = [

            'vendor_name_na'=> 'required',

            'vendor_name_fo'=> 'required',

            'vat_number'=> 'required',
            'country_id'=> 'required',
            'state_id'=> 'required',
        ];

        $customMessagesVendor = [
            'vendor_name_na.required'=> getMessage("2.411")["text"] ?? "",
            'vendor_name_fo.required' => getMessage("2.412")["text"] ?? "",
            'vat_number.required'=> getMessage("2.413")["text"] ?? "",
            'country_id.required'=>getMessage("2.414")["text"] ?? "",
            'state_id.required'=>getMessage("2.415")["text"] ?? "",


        ];
        $validatorVendor = Validator::make($request->all(), $rulesVendor,$customMessagesVendor);

        if ($validatorVendor->fails()) {
            $error_listVendor=[];
            if($validatorVendor->errors()->has('vendor_name_na')){
                $error_listVendor[]=$validatorVendor->errors()->first('vendor_name_na');
            }
           if($validatorVendor->errors()->has('vat_number')){
                $error_listVendor[]=$validatorVendor->errors()->first('vat_number');
            }
            if($validatorVendor->errors()->has('vendor_name_fo')){
                $error_listVendor[]=$validatorVendor->errors()->first('vendor_name_fo');
            }
            if($validatorVendor->errors()->has('country_id')){
                $error_listVendor[]=$validatorVendor->errors()->first('country_id'); }
                if($validatorVendor->errors()->has('state_id')){
                    $error_listVendor[]=$validatorVendor->errors()->first('state_id');

            }
            //  dd(implode(",",array($validator->errors())));
            return response()->json([
                'status'=>false,
                'message'=>implode(", ",$error_listVendor),
                'code'=>404,
                'result'=>"",
            ]);
        }
        if(!empty($request->job_title_id) || !empty($request->fullname) || !empty($request->tel) || !empty($request->contact_email)) {
            $rules = [

                'job_title_id' => 'required',
                'job_title_id.*' => 'required',
                'fullname' => 'required',
                'fullname.*' => 'required',
                'tel' => 'required',
                'tel.*' => 'required',
                'contact_email' => 'required',
                'contact_email.*' => 'required|email',


            ];

            $customMessages = [
                'job_title_id.required' => getMessage("2.402")["text"] ?? "",
                'job_title_id.*.required' => getMessage("2.401")["text"] ?? "",
                'fullname.required' => getMessage("2.404")["text"] ?? "",
                'fullname.*.required' => getMessage("2.403")["text"] ?? "",
                'tel.required' => getMessage("2.406")["text"] ?? "",
                'tel.*.required' => getMessage("2.405")["text"] ?? "",
                'contact_email.required' => getMessage("2.408")["text"] ?? "",
                'contact_email.*.required' => getMessage("2.407")["text"] ?? "",
                'contact_email.email' => getMessage("2.410")["text"] ?? "",
                'contact_email.*.email' => getMessage("2.409")["text"] ?? ""

            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                $error_list = [];
                if ($validator->errors()->has('contact_email.*')) {
                    $error_list[] = $validator->errors()->first('contact_email.*');
                }
                if ($validator->errors()->has('tel.*')) {
                    $error_list[] = $validator->errors()->first('tel.*');
                }
                if ($validator->errors()->has('fullname.*')) {
                    $error_list[] = $validator->errors()->first('fullname.*');
                }
                if ($validator->errors()->has('job_title_id.*')) {
                    $error_list[] = $validator->errors()->first('job_title_id.*');
                }
                //  dd(implode(",",array($validator->errors())));
                return response()->json([
                    'status' => false,
                    'message' => implode(", ", $error_list),
                    'code' => 404,
                    'result' => "",
                ]);
            }
        }
        $optionValidator=[];
        //inputValidator($data, $optionValidator);
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

         //   if(!empty($request->job_title_id) || !empty($request->fullname) || !empty($request->tel) || !empty($request->contact_email)){


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
           // }
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
        return response(['status' => true, 'message' => getMessage('2.1'),'id'=>$vendorObj->id]);


    }

    public function edit($id)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 332, 2);
        $messageDeleteType = getMessage('2.360');
       /* $country = [
            1 => ['1' => 'Palestine'],
            2 => ['1' => 'فلسطين']
        ];*/
        if(Auth::user()->lang_id==1){
            $country_lang=2;
        }else{
            $country_lang=1;
        }
        $country= \App\Models\Procurement\Country::where("language_id",$country_lang)->pluck("country_name","id");
        $ref_sector_selected = [];
        $ref_sector_selected =Vendor_Sector::where('vendor_id', $id)->pluck('sector_id')->toArray();
        //dd($ref_sector_selected);
//        if(!empty($sector_Selected)) {
//            foreach ($sector_Selected as $index => $item) {
//                $ref_sector_selected[$index] = $item;
//            }
//        }
        $abortSave=getMessage("2.361");
        $abortAdd=getMessage("2.362");
        $abortWeb=getMessage("2.416");
        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
            'country_id'=>['html_type' => '5', 'selectArray' => $country],
            'sector_id'=> ['relatedWhere' => 'deleted_at is null', 'SelectedArray' => $ref_sector_selected],
            'telephone'=> ['inputClass' => 'check-is-number'],
            'fax'=> ['inputClass' => 'check-is-number'],

            ];

        $vendorObj = Vendor::findOrfail($id);
        $generator = generator(147, $option, $vendorObj);
        $html = $generator[0];
        $labels = $generator[1];
        $contact = ContactPersons::where('vendor_id', '=', $id)->get();

        $job_list =JobTitle::get();

            $userPermissions = getUserPermission();
            return view('vendorss.vendor1.edit', compact('abortWeb','vendorObj','abortSave','abortAdd','labels', 'html','contact','job_list','messageDeleteType', 'userPermissions'));


      //  return view('vendorss.vendor1.edit', compact('labels', 'html', 'userPermissions'));
    }

    public function update(Request $request)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 332, 2);

        $input = $request->all();

        $data  = fieldInDatabase(147, $input);
        $field = $data['field'];

        $id = $field['id'];
        $rulesVendor = [

            'vendor_name_na'=> 'required',

            'vendor_name_fo'=> 'required',

            'vat_number'=> 'required',
            'country_id'=> 'required',
            'state_id'=> 'required',
        ];

        $customMessagesVendor = [
            'vendor_name_na.required'=> getMessage("2.411")["text"] ?? "",
            'vendor_name_fo.required' => getMessage("2.412")["text"] ?? "",
            'vat_number.required'=> getMessage("2.413")["text"] ?? "",
            'country_id.required'=>getMessage("2.414")["text"] ?? "",
            'state_id.required'=>getMessage("2.415")["text"] ?? "",


        ];
        $validatorVendor = Validator::make($request->all(), $rulesVendor,$customMessagesVendor);

        if ($validatorVendor->fails()) {
            $error_listVendor=[];
            if($validatorVendor->errors()->has('vendor_name_na')){
                $error_listVendor[]=$validatorVendor->errors()->first('vendor_name_na');
            }
            if($validatorVendor->errors()->has('vat_number')){
                $error_listVendor[]=$validatorVendor->errors()->first('vat_number');
            }
            if($validatorVendor->errors()->has('vendor_name_fo')){
                $error_listVendor[]=$validatorVendor->errors()->first('vendor_name_fo');
            }
            if($validatorVendor->errors()->has('country_id')){
                $error_listVendor[]=$validatorVendor->errors()->first('country_id');}
                if($validatorVendor->errors()->has('state_id')){
                    $error_listVendor[]=$validatorVendor->errors()->first('state_id');

            }
            //  dd(implode(",",array($validator->errors())));
            return response()->json([
                'status'=>false,
                'message'=>implode(", ",$error_listVendor),
                'code'=>404,
                'result'=>"",
            ]);
        }
        if(!empty($request->job_title_id) || !empty($request->fullname) || !empty($request->tel) || !empty($request->contact_email)) {
            $rules = [

                'job_title_id' => 'required',
                'job_title_id.*' => 'required',
                'fullname' => 'required',
                'fullname.*' => 'required',
                'tel' => 'required',
                'tel.*' => 'required',
                'contact_email' => 'required',
                'contact_email.*' => 'required|email',


            ];

            $customMessages = [
                'job_title_id.required' => getMessage("2.402")["text"] ?? "",
                'job_title_id.*.required' => getMessage("2.401")["text"] ?? "",
                'fullname.required' => getMessage("2.404")["text"] ?? "",
                'fullname.*.required' => getMessage("2.403")["text"] ?? "",
                'tel.required' => getMessage("2.406")["text"] ?? "",
                'tel.*.required' => getMessage("2.405")["text"] ?? "",
                'contact_email.required' => getMessage("2.408")["text"] ?? "",
                'contact_email.*.required' => getMessage("2.407")["text"] ?? "",
                'contact_email.email' => getMessage("2.410")["text"] ?? "",
                'contact_email.*.email' => getMessage("2.409")["text"] ?? ""

            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                $error_list = [];
                if ($validator->errors()->has('contact_email.*')) {
                    $error_list[] = $validator->errors()->first('contact_email.*');
                }
                if ($validator->errors()->has('tel.*')) {
                    $error_list[] = $validator->errors()->first('tel.*');
                }
                if ($validator->errors()->has('fullname.*')) {
                    $error_list[] = $validator->errors()->first('fullname.*');
                }
                if ($validator->errors()->has('job_title_id.*')) {
                    $error_list[] = $validator->errors()->first('job_title_id.*');
                }
                //  dd(implode(",",array($validator->errors())));
                return response()->json([
                    'status' => false,
                    'message' => implode(", ", $error_list),
                    'code' => 404,
                    'result' => "",
                ]);
            }
        }


        $optionValidator = [
        ];
      //  inputValidator($data, $optionValidator);
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





             //   if(!empty($request->job_title_id) || !empty($request->fullname) || !empty($request->tel) || !empty($request->contact_email)){



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
               // }
            }
        }catch (\Throwable $exception) {
            DB::rollBack();
            dd($exception->getMessage());
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




        return response(['status' => true, 'message' => getMessage('2.2'),'id'=>$vendorObject->id]);
    }

    public function delete($id)
    {
        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 333, 4);

            $vendorObject = Vendor::find($id);
            if(empty($vendorObject)){
                return response(['status' => false, 'message' => getMessage('2.2')]);
            }
        try {

            DB::beginTransaction();
            $contactObj=ContactPersons::where('vendor_id', $id)->get();
            if(count($contactObj)>0){
                foreach ($contactObj as $item){
                    $item->delete();
                    $item->update(["deleted_by"=>Auth::user()->id ]);
                }
            }
            $vendor_sector=Vendor_Sector::where('vendor_id',$id)->delete();


            $vendorObject->delete();

            $vendorObject->update(["deleted_by" => Auth::user()->id]);



            $message = getMessage('2.3');

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
        return response(['status' => true, 'message' => $message]);
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


//    public function deleteContact($id){
//
//        is_permitted(147, getClassName(__CLASS__), __FUNCTION__, 333, 4);
//        try {
//            $contactObj = ContactPersons::find($id);
//            if(empty($contactObj)){
//                return response(['status' => false, 'message' => getMessage('2.2')]);
//            }
//
//
//                $contactObj->delete();
//
//
//
//            if($contactObj){
//                    $contactObj->update(["deleted_by"=>Auth::user()->id ]);
//            }
//
//            $message = getMessage('2.3');
//            return response(['status' => true, 'message' => $message]);
//        } catch (\Illuminate\Database\QueryException $e) {
//            $message = getMessage('2.3');
//            return response(['status' => false, 'message' => $message]);
//        }
//    }


    function getCityByState($id){
        if(Auth::user()->lang_id==1){
            $city_language=2;
        }else{
            $city_language=1;
        }
      //  dd(Auth::user()->lang);
        $arr= \App\Models\Procurement\City::where('state_id',$id)->where('language_id',$city_language)->pluck("city_name","id")->toArray();
        if(!empty($arr)){
            return response(['status' => true, 'list' => $arr]);
        }else{
            return response(['status' => false, 'list' => []]);
        }

    }

    function getStateByCountry($id){
        if(Auth::user()->lang_id==1){
            $state_language=2;
        }else{
            $state_language=1;
        }
        $arr= \App\Models\Procurement\State::where('country_id',$id)->where('language_id',$state_language)->pluck("state_name","id")->toArray();
        if(!empty($arr)){
            return response(['status' => true, 'list' => $arr]);
        }else{
            return response(['status' => false, 'list' => []]);
        }

    }
}
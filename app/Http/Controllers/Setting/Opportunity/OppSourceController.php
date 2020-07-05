<?php

namespace App\Http\Controllers\Setting\Opportunity;

use App\Helpers\Log;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\Controller;

use App\Models\Setting\OppSource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;

class OppSourceController extends Controller
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

        is_permitted(113, getClassName(__CLASS__), __FUNCTION__, 234, 7);
        $oppsources = OppSource::where('created_by', Auth::id())->orderby('id', 'desc')->get();
        $messageDeleteType = getMessage('2.202');
        $labels = inputButton(Auth::user()->lang_id, 113);
        $userPermissions = getUserPermission();
        return view('setting.opportunity.opportunity_source.index', compact('labels', 'oppsources', 'messageDeleteType', 'userPermissions'));
    }

    public function create($type = null, $id = null)
    {
        is_permitted(113, getClassName(__CLASS__), __FUNCTION__, 235, 1);
        //  $option = [
        //     'description' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        //     'city_id' => ['relatedWhere' => 'deleted_at is null  and is_hidden = 0  '],
        //     'date_visits' => ['attr' => 'autocomplete="off"'],
        //     'beneficiary_id' => ['attr' => ' data-live-search="true" '],
        //      'issues_type' => ['relatedWhere' => 'deleted_at is null  and  is_hidden = 0 '],
        // ];

        $option = [
             'opportunity_source_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
              'opportunity_source_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];
        $oppsources = new OppSource();

        $generator = generator(113, $option, $oppsources);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
        return view('setting.opportunity.opportunity_source.create', compact('labels', 'html', 'userPermissions'));
    }

    public function store(Request $request)
    {
        is_permitted(113, getClassName(__CLASS__), __FUNCTION__, 235, 1);

        $input = $request->all();

       $data = fieldInDatabase(113, $input);
       $field = $data['field'];

        // $optionValidator = [
        //     'file' => [
        //         'required' => 'false',
        //         'max' => 'max:10000',
        //         'mimes' => 'mimes:jpg,jpeg,png,PNG,JPG,pdf,PDF,JPG,docx,doc,csv,xls,xlsx,txt,ppt,zip,rar'
        //     ],
        //     'date_visits' => [
        //         'date' => 'false',
        //         'date_format' => 'date_format:"d/m/Y"'
        //     ],
        // ];

       $optionValidator=[];
       inputValidator($data, $optionValidator);

        $oppsource = new OppSource();
        $oppsource->fill($field);
        $oppsource->created_by = Auth::id();


        // $path = public_path('images/visit');
        // if ($request->has('file')) {
        //     $imageName = time() . '.' . $request->file('file')->getClientOriginalExtension();
        //     $request->file('file')->move($path, $imageName);
        //     $visit->file = $imageName;
        // }
        $oppsource->save();

        Log::instance()->record('2.210', null, 113, null, null, null, null);
        Log::instance()->save();

        // notifications(getClassName(__CLASS__), __FUNCTION__, route('oppsources.edit', $oppsource->id));
        return response(['status' => 'true', 'message' => getMessage('2.1')]);


    }

    public function edit($oppsource_id)
    {
        is_permitted(113, getClassName(__CLASS__), __FUNCTION__, 236, 2);


        $oppsource = OppSource::find($oppsource_id);
        // $visit_beneficiary = VisitBeneficiary::Where('visit_id', $visit_id)
        //     ->pluck('beneficiary_id')
        //     ->toArray();
        // $visit->beneficiary_id = $visit_beneficiary;

        // $name_ben = 'ben_name_' . lang_character() . '_id';
        // $beneficiaries = BeneficiariesAllVw::where('ben_city', $visit->city_id)
        //     ->where('district_id', $visit->destrict_id)
        //     ->orderby($name_ben, 'desc')
        //     ->take(10)
        //     ->pluck($name_ben, 'id_type');


        // if (Auth::user()->lang_id == 1) {
        //     $name_district = 'district_name_no';
        // } else {
        //     $name_district = 'district_name_fo';
        // }
        // $districts = District::where('city_id', $visit->city_id)
        //     ->whereNull('deleted_at')
        //     ->where('is_hidden',0)
        //     ->pluck($name_district, 'id');
        // $option = [
        //     'description' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        //     'city_id' => ['relatedWhere' => 'deleted_at is null  and is_hidden = 0  '],
        //     'destrict_id' => ['selectArray' => $districts],
        //     'date_visits' => ['attr' => 'autocomplete="off"'],
        //     'file' => ['html_type' => '14'],
        //     'beneficiary_id' => ['selectArray' => $beneficiaries, 'attr' => ' data-live-search="true" '],
        //     'issues_type' => ['relatedWhere' => 'deleted_at is null  and  is_hidden = 0 '],
        //     ];
        if (Auth::user()->lang_id == 1) 
            $selectArray=[0=>'active',1=>'inactive'];
        else 
            $selectArray=[0=>'فعال',1=>'غير فعال'];
        


        $option = [
            'is_hidden'=>['selectArray'=>$selectArray,'html_type'=>'5'],
             'opportunity_source_na' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
              'opportunity_source_fo' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
        ];
        $generator = generator(113, $option, $oppsource);
        $html = $generator[0];
        $labels = $generator[1];
        $userPermissions = getUserPermission();
         return view('setting.opportunity.opportunity_source.edit', compact('labels', 'html', 'userPermissions', 'oppsource'));
    }

    public function update(Request $request)
    {
        is_permitted(113, getClassName(__CLASS__), __FUNCTION__, 236, 2);

        $input = $request->all();
        $data = fieldInDatabase(113, $input);
        $field = $data['field'];
        $id = $field['id'];
        // $optionValidator = [
        //     'file' => [
        //         'required' => 'false',
        //         'max' => 'max:10000',
        //         'mimes' => 'mimes:jpg,jpeg,png,PNG,JPG,pdf,PDF,JPG,docx,doc,csv,xls,xlsx,txt,ppt,zip,rar'
        //     ], 'date_visits' => [
        //         'date' => 'false',
        //         'date_format' => 'date_format:"d/m/Y"'
        //     ],
        // ];

        $optionValidator = [
        ];
       inputValidator($data, $optionValidator);
        $oppsource = OppSource::find($id);
        $old_oppsource = $oppsource;
        $oppsource->fill($field);

        // $visit->date_visits = dateFormatDataBase($field['date_visits']);
        $oppsource->updated_by = Auth::id();
        
        $oppsource->save();

        Log::instance()->save();

        notifications(getClassName(__CLASS__), __FUNCTION__, route('oppsources.edit', $oppsource->id));
        return response(['status' => 'true', 'message' => getMessage('2.2')]);


    }

    public function delete($id)
    {
        // dd(20);
        is_permitted(113, getClassName(__CLASS__), __FUNCTION__, 237, 4);
        try {
            $oppsource = OppSource::find($id);
            $oppsource->deleted_by = Auth::id();
            $oppsource->delete();
            $message = getMessage('2.3');
            Log::instance()->record('2.212', $id, 113, null, null, null, null);
            Log::instance()->save();
            notifications(getClassName(__CLASS__), __FUNCTION__, '');
            return response(['status' => 'true', 'message' => $message]);
        } catch (\Illuminate\Database\QueryException $e) {
            $message = getMessage('2.3');
            return response(['status' => 'false', 'message' => $message]);
        }
    }



}
<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Models\Vendor\Vendor_Report_Vw;
use Validator;
use App\Models\Procurement\Brand;
use App\Models\Vendor\City;
use App\Models\Vendor\ContactPersons;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\Vendor_Sector;
use App\Models\Vendor\JobTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Report\VendorReportExportExcel;
use App\Models\Donor\Donor;
use App\Models\Project\Project;

use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


use DB;

class VendorQueryController extends Controller
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

//    public function index()
//    {
//
//        is_permitted(149, getClassName(__CLASS__), __FUNCTION__, 330, 7);
//        if(Auth::user()->lang_id==1){
//            $country_lang=2;
//        }else{
//            $country_lang=1;
//        }
//        $country= \App\Models\Procurement\Country::where("language_id",$country_lang)->pluck("country_name","id");
//
//        $sort_by = [
//            1 => ['0'=>'' ,'1' => 'Name', '2' => 'Sector','3'=>'Governorate','4'=>'Location'],
//            2 => ['0'=>'','1' => 'الأسم', '2' => 'القطاع','3'=>'المحافظة','4'=>'المدينة'],
//        ];
//        $sort_then = [
//            1 => ['0'=>'','1' => 'Name', '2' => 'Sector','3'=>'Governorate','4'=>'Location'],
//            2 => ['0'=>'','1' => 'الأسم', '2' => 'القطاع','3'=>'المحافظة','4'=>'المدينة'],
//        ];
//        $option = [
//            'vat_number' => ['inputClass' => 'check-is-number'],
//            'country_id'=>['html_type' => '5', 'selectArray' => $country],
//            'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
//            'tel_number'=> ['inputClass' => 'check-is-number'],
//            'sort_by'=>['html_type' => '5', 'selectArray' => $sort_by[Auth::user()->lang_id]],
//            'sort_then'=>['html_type' => '5', 'selectArray' => $sort_then[Auth::user()->lang_id]],
//        ];
//        $vendorObj= new Vendor();
//        $vendorObj->sortList=0;
//        $generator = generator(149, $option, $vendorObj);
//        $html = $generator[0];
//        $labels = $generator[1];
//        $userPermissions = getUserPermission();
//        return view('vendorss.vendor1.vendorquery', compact('labels', 'html', 'userPermissions'));
//    }

    /////////////////vendor report section ///////////////////////////

    public function reportVendors()
    {
        is_permitted(149, getClassName(__CLASS__), __FUNCTION__, 334, 7);
       /* $donors = Donor::pluck('donor_name_'.lang_character(), 'id')->toArray();
        $project = new Project();

        $project->act_budget_min = null;*/
        $vendor=new Vendor();
        if(Auth::user()->lang_id==1){
            $country_lang=2;
        }else{
            $country_lang=1;
        }
        $country= \App\Models\Procurement\Country::where("language_id",$country_lang)->pluck("country_name","id");

        $sort_by = [
            1 => ['0'=>'' ,'1' => 'Name', '2' => 'Sector','3'=>'Governorate','4'=>'Location'],
            2 => ['0'=>'','1' => 'الأسم', '2' => 'القطاع','3'=>'المحافظة','4'=>'المدينة'],
        ];
        $sort_then = [
            1 => ['0'=>'','1' => 'Name', '2' => 'Sector','3'=>'Governorate','4'=>'Location'],
            2 => ['0'=>'','1' => 'الأسم', '2' => 'القطاع','3'=>'المحافظة','4'=>'المدينة'],
        ];
        $option = [
            'vat_number' => ['inputClass' => 'check-is-number'],
            'country_id'=>['html_type' => '5', 'selectArray' => $country],
            'sector_id'=>['attr' => ' data-live-search="true" ', 'relatedWhere' => 'deleted_at is null'],
            'tel_number'=> ['inputClass' => 'check-is-number'],
            'sort_by'=>['html_type' => '5', 'selectArray' => $sort_by[Auth::user()->lang_id]],
            'sort_then'=>['html_type' => '5', 'selectArray' => $sort_then[Auth::user()->lang_id]],
        ];
        //$program_id = ['attr' => ' data-live-search="true" ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        // $is_hidden = ['selectArray' => ['0' => 'Active', '1' => 'UnActive']];
        //$donor_id = ['selectArray' => $donors, 'attr' => ' data-live-search="true" ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];

        //  $manager_id = ['attr' => ' data-live-search="true" '];
        //  $coordinator_id = ['attr' => ' data-live-search="true" ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        //  $category_id = ['attr' => ' data-live-search="true" ', 'col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'];
        //   $act_budget_min = ['col_all_Class' => 'col-md-3', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-5'];
        //   $act_budget_max = ['col_all_Class' => 'col-md-3', 'col_label_Class' => 'col-md-4', 'col_input_Class' => 'col-md-5'];

//        $act_budget_min = ['html_type' => '13'];
//        $act_budget_max = ['html_type' => '13'];
//        $plan_start_date = ['html_type' => '13'];
//        $plan_end_date = ['html_type' => '13'];
//        $program_id = ['html_type' => '13'];
//        $manager_id = ['html_type' => '13'];
//        $coordinator_id = ['html_type' => '13'];
//        $project_name_na = ['html_type' => '13'];
//        $project_name_fo = ['html_type' => '13'];
//        $is_hidden = ['html_type' => '13'];
//        $category_id = ['html_type' => '13'];

        /* $option = [
            *'program_id' => $program_id,
             'is_hidden' => $is_hidden,
             'manager_id' => $manager_id,
             'coordinator_id' => $coordinator_id,
             'donor_id' => $donor_id,
             'act_budget_min' => $act_budget_min,
             'act_budget_max' => $act_budget_max,
             'project_name_na' => $project_name_na,
             'project_name_fo' => $project_name_fo,
             'plan_start_date' => $plan_start_date,
             'plan_end_date' => $plan_end_date,
             'category_id' => $category_id,
        ];*/
        $generator = generator(149, $option, $vendor);
        $html = $generator[0];
        // dd($html);
        $labels = $generator[1];
        $id = 'reports_project_by_Donate';
        $userPermissions = getUserPermission();

        return view('vendorss.report.reportVendor', compact('id', 'html', 'labels','userPermissions'));
    }

    public function search(Request $request)
    {

        $input = $request->all();
        $rep_master_id = 23;
        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
        $reportMasterUser = ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', Auth::id())
            ->first();

        $reportDetailColumnsNames = DB::table('global_report_detail_users')
            ->join('global_report_details', 'global_report_details.rep_detail_id', '=', 'global_report_detail_users.rep_detail_id')
            ->where(['global_report_detail_users.rep_master_id' => $rep_master_id, 'global_report_detail_users.user_id' => Auth::id()])
            ->orderBy('global_report_detail_users.column_order', 'asc')
            ->pluck('global_report_details.column_name');

        $reportDetailUser = DB::table('global_report_detail_users')
            ->select('global_report_details.column_name', 'global_report_details.column_data_type', 'global_report_detail_users.rep_detail_id', 'global_report_detail_users.rep_master_id',
                'global_report_detail_users.user_id', 'global_report_detail_users.column_label', 'global_report_detail_users.column_order', 'global_report_detail_users.column_width',
                'global_report_detail_users.column_aggregation', 'global_report_detail_users.column_alignment')
            ->join('global_report_details', 'global_report_details.rep_detail_id', '=', 'global_report_detail_users.rep_detail_id')
            ->where(['global_report_detail_users.rep_master_id' => $rep_master_id, 'global_report_detail_users.user_id' => Auth::id()])
            ->orderBy('global_report_detail_users.column_order', 'asc')
            ->get();

        $reportDetailColumnsNames = array_values((array)$reportDetailColumnsNames)[0];

        if ($reportDetailColumnsNames) {
            foreach ($reportDetailUser as $x) {
                $y = DB::table($report_master->rep_source)->pluck($x->column_name);
                $x->values = array_values((array)$y)[0];
            }
            $query = Vendor_Report_Vw::query();
            $query->select($reportDetailColumnsNames);
            if ($request->has('vendor_name_na') && $request->get('vendor_name_na') != null) {
                $query->where('vendor_name_na','like', '%' . $input['vendor_name_na'] . '%');
            }
            if ($request->has('vendor_name_fo') && $request->get('vendor_name_fo') != null) {
                $query->where('vendor_name_fo','like', '%' . $input['vendor_name_fo'] . '%');
            }
            if ($request->has('vat_number') && $request->get('vat_number') != null) {
                $query->where('vat_number','like', '%' . $input['vat_number'] . '%');
            }
            if ($request->has('country_id') && $request->get('country_id') != null) {
                $query->where('country_id',$input['country_id']);
            }
            if ($request->has('state_id') && $request->get('state_id') != null) {
                $query->where('state_id',$input['state_id']);
            }
            if ($request->has('city_id') && $request->get('city_id') != null) {
                $query->where('city_id',$input['city_id']);
            }
            if ($request->has('address') && $request->get('address') != null) {
                $query->where('address','like', '%' . $input['address'] . '%');
            }
            if ($request->has('sector_id') && $request->get('sector_id') != null) {

               foreach ($request->sector_id as $sector) {
                  $list=  Vendor_Sector::where('sector_id',$sector)->get();
                  if(!empty($list)) {
                      foreach ($list as $index => $item)
                          $query->where('id', $item->vendor_id);

                  }
                }
            }
            $sort_by=$request->get('sort_by');
            $sort_then=$request->get('sort_then');
            $report_data = $query->get();
            if($sort_by!=0 && $sort_then!=0){
                $report_data = $query->orderBy($this->getSortName($sort_by), 'ASC')
                    ->orderBy($this->getSortName($sort_then), 'ASC')->get();
            }
            else if($sort_by!=0){
                $report_data = $query->orderBy($this->getSortName($sort_by), 'ASC')->get();
            }



            $userPermissions = getUserPermission();
            return view('report.modal.report_table', compact('report_master', 'reportMasterUser', 'reportDetailUser', 'reportDetailColumnsNames', 'report_data','userPermissions'));
        } else {
            $message = getMessage('2.82');
            return response(['status' => 'false', 'message' => $message]);
        }


    }

    public function reportExportExcel(Request $request)
    {
        $rep_master_id = 23;
        $reportMasterUser = ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', Auth::id())
            ->first();
        return \Maatwebsite\Excel\Facades\Excel::download(new VendorReportExportExcel($rep_master_id, $request), $reportMasterUser->rep_label . '.xlsx');
    }

    public function reportExportPDF(Request $request)
    {
        // return pdfDataExport($rep_master_id);
        $rep_master_id = 23;
        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
        $reportMasterUser = ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', Auth::id())
            ->first();
        //dd($reportMasterUser);
        $rep_orientation = rep_orientation($reportMasterUser)[1];
        $dir = rep_orientation($reportMasterUser)[0];
        // dd($page_width ,$rep_orientation);
        $reportDetailUser = DB::table('global_report_detail_users')
            ->select('global_report_details.column_name',
                'global_report_details.column_data_type',
                'global_report_detail_users.rep_detail_id',
                'global_report_detail_users.rep_master_id',
                'global_report_detail_users.user_id',
                'global_report_detail_users.column_label',
                'global_report_detail_users.column_order',
                'global_report_detail_users.column_width',
                'global_report_detail_users.column_aggregation',
                'global_report_detail_users.column_alignment')
            ->join('global_report_details', 'global_report_details.rep_detail_id', '=', 'global_report_detail_users.rep_detail_id')
            ->where(['global_report_detail_users.rep_master_id' => $rep_master_id, 'global_report_detail_users.user_id' => Auth::id()])
            ->where('global_report_detail_users.column_width', '!=', '0')
            ->orderBy('global_report_detail_users.column_order', 'asc')
            ->get();

        if ($reportDetailUser->count() <= 0) {
            $message = getMessage('2.81');
            return $message['text'];
        }

        $reportDetailColumnsAlign = column_alignment($reportDetailUser);
        $reportDetailColumnsWidth = $reportDetailUser->pluck('column_width', 'column_name')->toArray();

        $reportDetailColumnsNames = $reportDetailUser->pluck('column_name')->toArray();
        $reportDetailColumnsLabels = $reportDetailUser->pluck('column_label')->toArray();
        //dd($reportDetailColumnsNames);
        $reportDetailColumnsAggregationSum = $reportDetailUser->where('column_aggregation', '0')
            ->pluck('column_name')
            ->toArray();
        $reportDetailColumnsAggregationCount = $reportDetailUser->where('column_aggregation', '1')
            ->pluck('column_name')
            ->toArray();
        // dd($reportDetailColumnsAggregation);

        $query = Vendor_Report_Vw::query();
        $query->select($reportDetailColumnsNames);
//        dd($request->get('is_hidden'));

        if ($request->has('vendor_name_na') && $request->get('vendor_name_na') != null) {
            $query->where('vendor_name_na', 'like', '%' . $request->get('vendor_name_na') . '%');
        }
        if ($request->has('vendor_name_fo') && $request->get('vendor_name_fo') != null) {
            $query->where('vendor_name_fo','like', '%' . $request->get('vendor_name_fo') . '%');
        }
        if ($request->has('vat_number') && $request->get('vat_number') != null) {
            $query->where('vat_number','like', '%' . $request->get('vat_number') . '%');
        }
        if ($request->has('country_id') && $request->get('country_id') != null) {
            $query->where('country_id',$request->get('country_id'));
        }
        if ($request->has('state_id') && $request->get('state_id') != null) {
            $query->where('state_id',$request->get('state_id'));
        }
        if ($request->has('city_id') && $request->get('city_id') != null) {
            $query->where('city_id',$request->get('city_id'));
        }
        if ($request->has('address') && $request->get('address') != null) {
            $query->where('address','like', '%' . $request->get('address') . '%');
        }
        if ($request->has('sector_id') && $request->get('sector_id') != null) {
            foreach ($request->sector_id as $sector) {
                $list=  Vendor_Sector::where('sector_id',$sector)->get();
                if(!empty($list)){
                    foreach($list  as $index => $item)
                        $query->where('id',$item->vendor_id );
                }

            }
        }

        $sort_by=$request->get('sort_by');
        $sort_then=$request->get('sort_then');
        $report_data = $query->get();
        if($sort_by!=0 && $sort_then!=0){
            $report_data = $query->orderBy($this->getSortName($sort_by), 'ASC')
                ->orderBy($this->getSortName($sort_then), 'ASC')->get();
        }
        else if($sort_by!=0){
            $report_data = $query->orderBy($this->getSortName($sort_by), 'ASC')->get();
        }

        $pdf = Pdf::loadView('report.pdfDataExport',
            [
                'reportDetailColumnsAlign' => $reportDetailColumnsAlign,
                'reportDetailColumnsWidth' => $reportDetailColumnsWidth,
                'reportDetailColumnsLabels' => $reportDetailColumnsLabels,
                'reportDetailColumnsNames' => $reportDetailColumnsNames,
                'report_data' => $report_data,
                'reportMasterUser' => $reportMasterUser,
                'reportDetailColumnsAggregationSum' => $reportDetailColumnsAggregationSum,
                'reportDetailColumnsAggregationCount' => $reportDetailColumnsAggregationCount,
                'dir' => $dir,
            ], [],
            [
                'format' => $rep_orientation,
                'mode' => 'utf-8',
                'margin_top' => $reportMasterUser->margin_top,
                'margin_left' => $reportMasterUser->margin_left,
                'margin_button' => $reportMasterUser->margin_top,
                'margin_right' => $reportMasterUser->margin_left,
            ]
        );
        //return $pdf->download('document.pdf');

        return $pdf->stream($reportMasterUser->rep_label . '.pdf');


    }
    public function getSortName($value){
        if($value==1)
            return "vendor_name_na";
        else if($value==2)
            return "sectors_name_na";
        else if($value==3)
            return "state_name_na";
        else
            return "city_name_na";
    }

    /////////////////////end vendor report section /////////////

}
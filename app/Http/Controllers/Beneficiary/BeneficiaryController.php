<?php


namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;

use App\Helpers\Log;

use App\Http\Controllers\Report\BeneficiaryReportExportExcel;
use App\Http\Controllers\Report\IndicatorsAndResultsBasedOnBeneficiaryReportExportExcel;
use App\Models\Activity\Activity;
use App\Models\Activity\ActivityBeneficiaries;
use App\Models\Activity\ActivityBeneficiariesValue;
use App\Models\Activity\ActivityIndictorOrgIndictor;
use App\Models\Activity\ActivityOrgResultVm;
use App\Models\Activity\BeneficiariesAllVw;
use App\Models\Beneficiary\Beneficiary;
use App\Models\Beneficiary\BeneficiaryValueVw;
use App\Models\Project\Project;
use App\Models\Report\Activity\ReportProjectActivityResultBeneficiaryVw;
use App\Models\Report\Beneficiary\ProjectActivityBenrficiaryVw;
use App\Models\Report\Beneficiary\ReportActivityBeneficiary;
use App\Models\Report\Beneficiary\ReportBeneficiary;
use App\Models\Report\Beneficiary\ReportProjectBeneficiary;
use App\Models\Report\IndicatorsAndResultsBasedBeneficiaryVW;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Beneficiary\BeneficiaryFamily;
use DB;
use Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class BeneficiaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        is_permitted(54, getClassName(__CLASS__), __FUNCTION__, 177, 9);

        $projects = Project::getProject();
        $labels = inputButton(Auth::user()->lang_id, 56);
        $userPermissions = getUserPermission();
        return view('beneficiary.report.index', compact('projects', 'html', 'labels','userPermissions'));
    }

    public function activity($project_id)
    {
        $activities = Activity::getActivity($project_id)
            ->where('temp', 0);
        return response(['activities' => $activities]);
    }
    public function activitySub($project_id,$activity_id)
    {
        $activities = Activity::getActivitySub($project_id,$activity_id)
            ->where('temp', 0);
        return response(['activities' => $activities]);
    }
    public function indicator($project_id, $activity_id)
    {
        $activityIndicatorOrgIndicator = ActivityIndictorOrgIndictor::where('activity_id', $activity_id)
            ->where('project_id', $project_id)
            ->get();
        return response(['indicators' => $activityIndicatorOrgIndicator]);
    }
    public function result($project_id, $activity_id, $indicator_id)
    {
        $activityOrgResultVm = ActivityOrgResultVm::where('activity_id', $activity_id)
            ->where('org_indic_id', $indicator_id)
            ->where('project_id', $project_id)
            ->get();
        return response(['results' => $activityOrgResultVm]);
    }
    public function search(Request $request)
    {

        $input = $request->all();
        $rep_master_id = 7;
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
        if ($reportDetailUser->count() <= 0) {
            $message = getMessage('2.81');
            return $message['text'];
        }
        $reportDetailColumnsNames = array_values((array)$reportDetailColumnsNames)[0];

        if ($reportDetailColumnsNames) {
            foreach ($reportDetailUser as $x) {
                $y = DB::table($report_master->rep_source)->pluck($x->column_name);
                $x->values = array_values((array)$y)[0];
            }

            $query = ProjectActivityBenrficiaryVw::query();
            $query->select($reportDetailColumnsNames);



            if ($request->has('project_id') && $request->get('project_id') != null) {
                $query->where('project_id', $request->get('project_id'));
            }

            if ($request->has('activity_sub_id') && $request->get('activity_sub_id') != null) {
                $query->where('activity_id', $request->get('activity_sub_id'));
            } else {
                if ($request->has('activity_id') && $request->get('activity_id') != null) {
                    $query->where('activity_id', '=', $request->get('activity_id'));
                }

            }

            if ($request->has('indicator_id') && $request->get('indicator_id') != null) {
                $query->where('indic_id', '=', $request->get('indicator_id'));
            }
            if ($request->has('result_id') && $request->get('result_id') != null) {
                $query->where('result_id', '=', $request->get('result_id'));
            }
            if ($request->has('name') && $request->get('name') != null) {
                $query->where('ben_name_na', 'like', '%' . $request->get('name') . '%');
            }
            $report_data = $query->get();
            $userPermissions = getUserPermission();
            return view('report.modal.report_table', compact('report_master', 'reportMasterUser', 'reportDetailUser', 'reportDetailColumnsNames', 'report_data','userPermissions'));
        } else {
            $message = getMessage('2.82');
            return response(['status' => 'false', 'message' => $message]);
        }


    }
    public function reportExportExcel(Request $request)
    {

        $reportMasterUser = ReportMasterUser::where('rep_master_id', 7)
            ->where('user_id', Auth::id())
            ->first();
        $reportDetailUser = DB::table('global_report_detail_users')
            ->where(['global_report_detail_users.rep_master_id' => 7,
                'global_report_detail_users.user_id' => Auth::id()])
            ->get();
        if ($reportDetailUser->count() <= 0) {
            $message = getMessage('2.81');
            return redirect()->back()->with('message', $message);
            //  return $message['text'];
        }

        return \Maatwebsite\Excel\Facades\Excel::download(new BeneficiaryReportExportExcel(7, $request), $reportMasterUser->rep_label . '.xlsx');
    }
    public function reportExportPDF(Request $request)
    {
        // return pdfDataExport($rep_master_id);
        $rep_master_id = 7;
        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
        //dd($report_master);
        $input = $request->all();
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

//        dd($request->get('project_id'));

        $query = ProjectActivityBenrficiaryVw::query();
        $query->select($reportDetailColumnsNames);
        if ($request->has('project_id') && $request->get('project_id') != null) {
            $query->where('project_id', $request->get('project_id'));
        }

        if ($request->has('activity_sub_id') && $request->get('activity_sub_id') != null) {
            $query->where('activity_id', $request->get('activity_sub_id'));
        } else {
            if ($request->has('activity_id') && $request->get('activity_id') != null) {
                $query->where('activity_id', '=', $request->get('activity_id'));
            }

        }
        if ($request->has('indicator_id') && $request->get('indicator_id') != null) {
            $query->where('indic_id', '=', $request->get('indicator_id'));
        }
        if ($request->has('result_id') && $request->get('result_id') != null) {
            $query->where('result_id', '=', $request->get('result_id'));
        }
        if ($request->has('name') && $request->get('name') != null) {
            $query->where('ben_name_na', 'like', '%' . $request->get('name') . '%');
        }

        $report_data = $query->get();
        //dd($report_data);

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
    public function beneficiaryForm($id, $type)
    {

        $beneficiary = BeneficiariesAllVw::where('id', $id)
            ->where('type', $type)
            ->first();
//        $reportProjectBeneficiary = ReportProjectBeneficiary::where('id', $id)
//            ->where('type', $type)
//            ->get();
//        $projects =$reportProjectBeneficiary->unique('project_id');
//
//        $reportActivityBeneficiary = ReportActivityBeneficiary::where('id',$id)
//            ->where('type',$type)
//            ->get();
//        $activities =$reportActivityBeneficiary->unique('activity_id');
//
//        $resultBeneficiary = ReportProjectActivityResultBeneficiaryVw::where('ben_id',$id)
//            ->where('activity_beneficiaries_ben_type_id',$type)
//            ->get();

        $beneficiaryValue = BeneficiaryValueVw::where('ben_id',$id)
            ->where('ben_type_id',$type)
            ->get();
        $userPermissions = getUserPermission();

        return view('beneficiary.report.beneficiaryForm.index', compact('beneficiary','beneficiaryValue','userPermissions'));

    }
    public function reportIndicatorsAndResultsBasedOnBeneficiary()
    {
        //is_permitted(54, getClassName(__CLASS__), __FUNCTION__, 182, 9);

        $name = 'ben_name_fo_id';
        if (Auth::user()->lang_id == 1 ){
            $name = 'ben_name_na_id';
        }
        $beneficiaries = BeneficiariesAllVw::pluck($name,'id_type');
        $userPermissions = getUserPermission();
        $labels = inputButton(Auth::user()->lang_id, 0);
        return view('beneficiary.report.reportIndicatorsAndResultsBasedOnBeneficiary', compact('labels', 'beneficiaries', 'userPermissions'));
    }
    public function searchIndicatorsAndResultsBasedOnBeneficiary(Request $request)
    {
        $input = $request->all();
        $rep_master_id = 16;
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
            $query = IndicatorsAndResultsBasedBeneficiaryVW::query();
            $query->select($reportDetailColumnsNames);

            if ($request->has('beneficiary_id') && $request->get('beneficiary_id') != null) {
                $query->where('beneficieris_id_type', $input['beneficiary_id']);
            }
            $report_data = $query->get();
            $userPermissions = getUserPermission();

            return view('report.modal.report_table', compact('report_master', 'reportMasterUser', 'reportDetailUser', 'reportDetailColumnsNames', 'report_data', 'userPermissions'));
        } else {
            $message = getMessage('2.82');

            return response(['status' => 'false', 'message' => $message]);
        }
    }
    public function reportExportExcelIndicatorsAndResultsBasedOnBeneficiary(Request $request)
    {

        $reportMasterUser = ReportMasterUser::where('rep_master_id', 14)
            ->where('user_id', Auth::id())
            ->first();
        return \Maatwebsite\Excel\Facades\Excel::download(new IndicatorsAndResultsBasedOnBeneficiaryReportExportExcel(16, $request), $reportMasterUser->rep_label . '.xlsx');
    }
    public function reportExportPDFIndicatorsAndResultsBasedOnBeneficiary(Request $request)
    {
        // return pdfDataExport($rep_master_id);
        $input = $request->all();
        $rep_master_id = 16;
        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
        //dd($report_master);


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

        $query = IndicatorsAndResultsBasedBeneficiaryVW::query();
        $query->select($reportDetailColumnsNames);
        if ($request->has('beneficiary_id') && $request->get('beneficiary_id') != null) {
            $query->where('beneficieris_id_type', $input['beneficiary_id']);
        }
        $report_data = $query->get();
        $pdf = PDF::loadView('report.pdfDataExport',
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
        //$pdf->SetWatermarkImage(public_path('images/mg.png'));
        // $pdf->showWatermarkImage = true;
        return $pdf->stream($reportMasterUser->rep_label . '.pdf');

    }






}
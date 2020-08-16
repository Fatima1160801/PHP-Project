<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;


use App\Http\Controllers\Report\RegionReportReportExportExcel;

use App\Http\Controllers\Report\StaffReportReportExportExcel;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;

use App\Models\Setting\StaffReportVW;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
 use Illuminate\Support\Facades\Auth;
use DB;
class StaffReportController extends Controller
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


    public function index()
    {
        is_permitted(110, getClassName(__CLASS__), 'report', 230, 10);

        $name ='staff_name_'.lang_character();
        $staffs=  Staff::whereNull('deleted_at')
            ->pluck('id',$name);
         $labels = inputButton(Auth::user()->lang_id, 112);

        $userPermissions = getUserPermission();

        return view('setting.StaffReport.index', compact('labels', 'staffs', 'userPermissions'));
    }


    public function search(Request $request)
    {
        is_permitted(110, getClassName(__CLASS__), 'report', 230, 10);

        $input = $request->all();
        $rep_master_id = 22;
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
            ->orderBy('global_report_detail_users.column_order', 'asc')->pluck('global_report_details.column_name');
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

            $query = StaffReportVW::query();
            $query->select($reportDetailColumnsNames);
            if ($request->has('staff_id') && $request->get('staff_id') != null) {
                $query->where('staff_id', $input['staff_id']);
            }

            $report_data = $query->get();
            return view('report.modal.report_table', compact('report_master', 'reportMasterUser', 'reportDetailUser', 'reportDetailColumnsNames', 'report_data'));
        } else {
            $message = getMessage('2.82');
            return response(['status' => 'false', 'message' => $message]);
        }
    }

    public function excel(Request $request)
    {
        is_permitted(110, getClassName(__CLASS__), 'report', 230, 10);

        $reportMasterUser = ReportMasterUser::where('rep_master_id', 22)
            ->where('user_id', Auth::id())
            ->first();
        return \Maatwebsite\Excel\Facades\Excel::download(new StaffReportReportExportExcel(22, $request), $reportMasterUser->rep_label . '.xlsx');
    }

    public function pdf(Request $request)
    {
        is_permitted(110, getClassName(__CLASS__), 'report', 230, 10);

        $rep_master_id = 22;
        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
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

        $query = StaffReportVW::query();
        $query->select($reportDetailColumnsNames);

        if ($request->has('staff_id') && $request->get('staff_id') != null) {
            $query->where('staff_id', $input['staff_id']);
        }


        $report_data = $query->get();

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
}

<?php


namespace App\Http\Controllers\Report;

use App\Exports\DataExport;
use App\Http\Controllers\Controller;

use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use App\Models\Report\ReportDetail;
use App\Models\Report\ReportDetailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report\Report;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

use App\Helpers\Excel_XML;

class ReportController extends Controller
{

    public function prepare($rep_master_id)
    {

        is_permitted(31, getClassName(__CLASS__), __FUNCTION__, 114, 3);

        $report_master = ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }


        $reportMasterUser = ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', Auth::id())
            ->first();
        if ($reportMasterUser != null) {
            $report_master->rep_label = $reportMasterUser->rep_label;
            $report_master->rep_orientation = $reportMasterUser->rep_orientation;
            $report_master->rep_ltr = $reportMasterUser->rep_ltr;
            $report_master->margin_top = $reportMasterUser->margin_top;
            $report_master->margin_left = $reportMasterUser->margin_left;
        }

        /*$reportDetailUser = ReportDetailUser::where('rep_master_id',$rep_master_id)
                                          ->where('user_id',Auth::id())->get();*/
        $reportDetailUser = DB::table('global_report_detail_users')
            ->select('global_report_details.column_data_type', 'global_report_detail_users.rep_detail_id', 'global_report_detail_users.rep_master_id',
                'global_report_detail_users.user_id', 'global_report_detail_users.column_label', 'global_report_detail_users.column_order', 'global_report_detail_users.column_width',
                'global_report_detail_users.column_aggregation', 'global_report_detail_users.column_alignment')
            ->join('global_report_details', 'global_report_details.rep_detail_id', '=', 'global_report_detail_users.rep_detail_id')
            ->where(['global_report_detail_users.rep_master_id' => $rep_master_id, 'global_report_detail_users.user_id' => Auth::id()])
            ->orderBy('global_report_detail_users.column_order', 'asc')
            ->get();

        $reportDetail = ReportDetail::where('rep_master_id', $rep_master_id)->where('is_deleted', 0)->get();

        $arr_d_ids = [];
        $arr_du_ids = [];
        foreach ($reportDetail as $r) {
            array_push($arr_d_ids, $r->rep_detail_id);
        }
        if ($reportDetailUser != null) {
            foreach ($reportDetailUser as $rdu) {
                array_push($arr_du_ids, $rdu->rep_detail_id);
            }
        }

        $option = [
            'rep_label' => ['col_all_Class' => 'col-md-12', 'col_label_Class' => 'col-md-2', 'col_input_Class' => 'col-md-10'],
            'rep_orientation' => ['html_type' => '5', 'selectArray' => ['0' => 'portrait', '1' => 'landscape']],
            'rep_ltr' => ['html_type' => '5', 'selectArray' => ['0' => 'Right to Left', '1' => 'Left to Right']]
        ];

        $generator = generator(31, $option, $report_master);

        $html = $generator[0];
        $labels = $generator[1];
        $screenName = "Generate Report";
        $repName = $report_master->rep_name;
        $userPermissions = getUserPermission();

        $view = view('report.modal.master_prepare', compact('labels', 'html', 'screenName', 'reportDetail', 'reportDetailUser', 'rep_master_id', 'arr_d_ids', 'arr_du_ids', 'repName','userPermissions'))->render();
        return response($view);
    }


    public function updateMasterUser(Request $request)
    {

        $input = $request->all();
         $data = fieldInDatabase(31, $input);

        $optionValidator = [];
        inputValidator($data, $optionValidator);

        $field = $data['field'];

        $reportMasterUser = ReportMasterUser::where('rep_master_id', $field['id'])
            ->where('user_id', Auth::id())
            ->first();
        if ($reportMasterUser == null) {
            $reportMasterUser = new ReportMasterUser();
            $reportMasterUser->fill($field);
            $reportMasterUser->user_id = Auth::id();
            $reportMasterUser->rep_master_id = $field['id'];
            $reportMasterUser->save();
        } else {
            DB::table('global_report_master_users')
                ->where('rep_master_id', $field['id'])
                ->where('user_id', Auth::id())
                ->limit(1)
                ->update([
                    'rep_master_id' => $field['id'],
                    'user_id' => Auth::id(),
                    'rep_label' => $field['rep_label'],
                    'rep_orientation' => $field['rep_orientation'],
                    'rep_ltr' => $field['rep_ltr'],
                    'margin_top' => $field['margin_top'],
                    'margin_left' => $field['margin_left']
                ]);
        }

    }


    public function updateDetailUser(Request $request)
    {
        $input = $request->all();
        $reportMasterUser = ReportMasterUser::where('user_id', Auth::id())
            ->where('rep_master_id', $input['rep_master_id'])
            ->first();

        $column_width = 0;
        $reportDetail = ReportDetail::where('rep_master_id', $input['rep_master_id'])
            ->where('is_deleted', 0)
            ->pluck('rep_detail_id');

        foreach ($reportDetail as $rep_detail_id) {
            if(isset($input['column_width_' . $rep_detail_id])){
                $column_width += $input['column_width_' . $rep_detail_id];
            }
        }
        $row_width = $column_width + $reportMasterUser->margin_left + $reportMasterUser->margin_left;
        if ($reportMasterUser->rep_orientation == '0') {
            if ($row_width > 700) {
                $message = getMessage('2.118');
                return response(['status' => 'false', 'message' => $message]);
            }
        } else if ($reportMasterUser->rep_orientation == '1') {
            if ($row_width > 1100) {
                $message = getMessage('2.107');
                return response(['status' => 'false', 'message' => $message]);
            }
        }

        DB::table('global_report_detail_users')
            ->where('rep_master_id', $input['rep_master_id'])
            ->where('user_id', Auth::id())
            ->delete();
        //sum column_width


        foreach ($reportDetail as $rep_detail_id) {
            if (isset($input['column_label_' . $rep_detail_id])) {
                $column_aggregation = (isset($input['options_' . $rep_detail_id]) && $input['options_' . $rep_detail_id] != 'null') ? $input['options_' . $rep_detail_id] : null;
                DB::table('global_report_detail_users')
                    ->insert([
                        'user_id' => Auth::id(),
                        'rep_master_id' => $input['rep_master_id'],
                        'rep_detail_id' => $rep_detail_id,
                        'column_label' => $input['column_label_' . $rep_detail_id],
                        'column_order' => $input['column_order_' . $rep_detail_id],
                        'column_width' => $input['column_width_' . $rep_detail_id],
                        'column_aggregation' => $column_aggregation,
                        'column_alignment' => $input['alignment_' . $rep_detail_id]
                    ]);
            }
        }

        return response(['status' => 'true']);
    }


    public function getReportData($rep_master_id, $where = null)
    {
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


            $report_data = DB::table($report_master->rep_source)
                ->get($reportDetailColumnsNames);
            $userPermissions = getUserPermission();

            return view('report.modal.report_table', compact('report_master', 'reportMasterUser', 'reportDetailUser', 'reportDetailColumnsNames', 'report_data','userPermissions'));
        } else {
            $message = getMessage('2.82');
            return response(['status' => 'false', 'message' => $message]);
        }
    }


    public function reportExport($rep_master_id, $to_type)
    {

        $reportMasterUser = ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', Auth::id())
            ->first();
        if ($to_type == 'excel') {
            return Excel::download(new DataExport($rep_master_id), $reportMasterUser->rep_label . '.xlsx');
        } else {
            return pdfDataExport($rep_master_id);
        }


    }

}
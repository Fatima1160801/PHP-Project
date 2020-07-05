<?php

namespace App\Exports;


use App\Models\Project\Project;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class DataExport implements FromView
{
    use Exportable;

    protected $rep_master_id;

    public function __construct($rep_master_id)
    {
        $this->rep_master_id = $rep_master_id;
    }


    public function view(): View
    {
        $report_master = ReportMaster::find($this->rep_master_id);
        // dd($report_master);

        if ($report_master == null) {
            return redirect()->route('home');
        }

        $reportMasterUser = ReportMasterUser::where('rep_master_id', $this->rep_master_id)
            ->where('user_id', Auth::id())
            ->first();
       // dd($reportMasterUser);


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
            ->where(['global_report_detail_users.rep_master_id' => $this->rep_master_id, 'global_report_detail_users.user_id' => Auth::id()])
            ->orderBy('global_report_detail_users.column_order', 'asc')
            ->get();


       //dd($reportDetailUser);

        $reportDetailColumnsNames = $reportDetailUser->pluck('column_name')->toArray();
        $reportDetailColumnsLabels = $reportDetailUser->pluck('column_label')->toArray();
        //dd($reportDetailColumnsNames);
        $reportDetailColumnsAggregationSum = $reportDetailUser->where('column_aggregation','0')
            ->pluck('column_name')
            ->toArray();
        $reportDetailColumnsAggregationCount = $reportDetailUser->where('column_aggregation','1')
            ->pluck('column_name')
            ->toArray();
       // dd($reportDetailColumnsAggregation);

        $report_data = DB::table($report_master->rep_source)
            ->get($reportDetailColumnsNames);
  //dd($report_data);

        return view('report.dataExport', [
            'reportDetailColumnsLabels' => $reportDetailColumnsLabels,
            'reportDetailColumnsNames' => $reportDetailColumnsNames,
            'report_data' => $report_data,
            'reportMasterUser' => $reportMasterUser,
            'reportDetailColumnsAggregationSum' => $reportDetailColumnsAggregationSum,
            'reportDetailColumnsAggregationCount' => $reportDetailColumnsAggregationCount,
        ]);
// Excel::download($report_html, '1.xlsx');

    }
}

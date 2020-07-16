<?php

namespace App\Http\Controllers\Report;


use App\Models\Project\Project;
use App\Models\Report\Project\ReportActivities;
use App\Models\Report\Project\ReportProject;
use App\Models\Report\Project\ReportProjectDonor;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class ProjectDonorReportExportExcel implements FromView
{
    use Exportable;

    protected $rep_master_id;
    protected $request;

    public function __construct($rep_master_id ,$request)
    {
        $this->rep_master_id = $rep_master_id;
        $this->request = $request;
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
//
//        $report_data = DB::table($report_master->rep_source)
//            ->get($reportDetailColumnsNames);

        $query = ReportProjectDonor::query();
        $query->select($reportDetailColumnsNames);

        if ($this->request->has('program_id') && $this->request->get('program_id') != null) {
            $query->whereIn('program_id',$this->request->get('program_id'));
        }
        if ($this->request->has('is_hidden') && $this->request->get('is_hidden') != null) {
            $query->where('is_hidden', '=', $this->request->get('is_hidden'));
        }
        if ($this->request->has('project_name_na') && $this->request->get('project_name_na') != null) {
            $query->where('project_name_na', 'like', '%' . $this->request->get('project_name_na') . '%');
        }
        if ($this->request->has('project_name_fo') && $this->request->get('project_name_fo') != null) {
            $query->where('project_name_fo', 'like', '%' . $this->request->get('project_name_fo') . '%');
        }
        if ($this->request->has('plan_start_date') && $this->request->get('plan_start_date') != null) {
            $query->whereDate('plan_start_date', '>=', dateFormatDataBase($this->request->get('plan_start_date')));
        }
        if ($this->request->has('plan_end_date') && $this->request->get('plan_end_date') != null) {
            $query->whereDate('plan_end_date', '>=', dateFormatDataBase($this->request->get('plan_end_date')));
        }
        if ($this->request->has('manager_id') && $this->request->get('manager_id') != null) {
            $query->where('manager_id', $this->request->get('manager_id'));
        }  if ($this->request->has('category_id') && $this->request->get('category_id') != null) {
            $query->where('category_id', $this->request->get('category_id'));
        }
        if ($this->request->has('coordinator_id') && $this->request->get('coordinator_id') != null) {
            $query->where('coordinator_id', $this->request->get('coordinator_id'));
        }
        if ($this->request->has('donor_id') && $this->request->get('donor_id') != null) {
            $query->where('donor_id', $this->request->get('donor_id'));
        }

        if ($this->request->has('act_budget_min') && $this->request->get('act_budget_min') != null
            && $this->request->has('act_budget_max') && $this->request->get('act_budget_max') != null) {
            $query->whereBetween('act_budget', [$this->request->get('act_budget_min'), $this->request->get('act_budget_max')]);
        } elseif ($this->request->has('act_budget_min') && $this->request->get('act_budget_min') != null) {
            $query->where('act_budget', '>=', $this->request->get('act_budget_min'));
        } elseif ($this->request->has('act_budget_max') && $this->request->get('act_budget_max') != null) {
            $query->where('act_budget', '<=', $this->request->get('act_budget_max'));
        }
        $report_data = $query->get();

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

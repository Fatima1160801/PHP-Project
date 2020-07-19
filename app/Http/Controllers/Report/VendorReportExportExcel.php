<?php

namespace App\Http\Controllers\Report;


use App\Models\Project\Project;
use App\Models\Report\Project\ReportActivities;
use App\Models\Report\Project\ReportProject;
use App\Models\Report\Project\ReportProjectDonor;
use App\Models\Report\ReportMaster;
use App\Models\Report\ReportMasterUser;
use App\Models\Vendor\Vendor_Report_Vw;
use App\Models\Vendor\Vendor_Sector;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class VendorReportExportExcel implements FromView
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

        $query = Vendor_Report_Vw::query();
        $query->select($reportDetailColumnsNames);

        if ($this->request->has('vendor_name_na') && $this->request->get('vendor_name_na') != null) {
            $query->where('vendor_name_na', 'like', '%' . $this->request->get('vendor_name_na') . '%');
        }
        if ($this->request->has('vendor_name_fo') && $this->request->get('vendor_name_fo') != null) {
            $query->where('vendor_name_fo','like', '%' . $this->request->get('vendor_name_fo') . '%');
        }
        if ($this->request->has('vat_number') && $this->request->get('vat_number') != null) {
            $query->where('vat_number','like', '%' . $this->request->get('vat_number') . '%');
        }
        if ($this->request->has('country_id') && $this->request->get('country_id') != null) {
            $query->where('country_id',$this->request->get('country_id'));
        }
        if ($this->request->has('state_id') && $this->request->get('state_id') != null) {
            $query->where('state_id',$this->request->get('state_id'));
        }
        if ($this->request->has('city_id') && $this->request->get('city_id') != null) {
            $query->where('city_id',$this->request->get('city_id'));
        }
        if ($this->request->has('address') && $this->request->get('address') != null) {
            $query->where('address','like', '%' . $this->request->get('address') . '%');
        }
        if ($this->request->has('sector_id') && $this->request->get('sector_id') != null) {

            $find = Vendor_Sector::whereIn('sector_id', $this->request->get('sector_id'))->pluck("vendor_id")->toArray();
            if (!empty($find)) {
                $query->whereIn('id', $find);
            }
        }
        $sort_by=$this->request->get('sort_by');
        $sort_then=$this->request->get('sort_then');
        $report_data = $query->get();
        if($sort_by!=0 && $sort_then!=0){
            $report_data = $query->orderBy($this->getSortName($sort_by), 'ASC')
                ->orderBy($this->getSortName($sort_then), 'ASC')->get();
        }
        else if($sort_by!=0){
            $report_data = $query->orderBy($this->getSortName($sort_by), 'ASC')->get();
        }

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
    public function getSortName($value){
        if($value==1)
            return "vendor_name_".lang_character();
        else if($value==2)
            return "sectors_name_".lang_character();
        else if($value==3)
            return "state_name_".lang_character();
        else
            return "city_name_".lang_character();
    }
}

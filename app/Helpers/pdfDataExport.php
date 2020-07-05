<?php

if (!function_exists('pdfDataExport')) {
    function pdfDataExport($rep_master_id)
    {
        $report_master = \App\Models\Report\ReportMaster::find($rep_master_id);
        if ($report_master == null) {
            return redirect()->route('home');
        }
        //dd($report_master);


        $reportMasterUser = \App\Models\Report\ReportMasterUser::where('rep_master_id', $rep_master_id)
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->first();
        //dd($reportMasterUser);
        $rep_orientation = rep_orientation($reportMasterUser)[1];
        $dir = rep_orientation($reportMasterUser)[0];
        // dd($page_width ,$rep_orientation);
        $reportDetailUser = \Illuminate\Support\Facades\DB::table('global_report_detail_users')
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

        if($reportDetailUser->count() <=0){
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

        $report_data = \Illuminate\Support\Facades\DB::table($report_master->rep_source)
            ->get($reportDetailColumnsNames);
        //dd($report_data);

        $pdf = \niklasravnsborg\LaravelPdf\Facades\Pdf::loadView('report.pdfDataExport',
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

        return $pdf->stream('document.pdf');
    }
}

if (!function_exists('rep_orientation')) {
    function rep_orientation($reportMasterUser)
    {
        $rep_orientation = $reportMasterUser->rep_orientation;
        $rep_ltr = $reportMasterUser->rep_ltr;
        if ($rep_orientation == 0) {
            $width = 595;
            $orientation = 'A4-P';
        } elseif ($rep_orientation == 1) {
            $width = 840;
            $orientation = 'A4-L';
        }
        if($rep_ltr == 0){
            $dir ='rtl' ;
        }elseif($rep_ltr == 1){
            $dir ='ltr' ;
        }
        $x = [$dir, $orientation];
        return $x;

    }
}
if (!function_exists('column_alignment')) {
    function column_alignment($reportDetailUser)
    {
        $reportDetailColumnsAlign = [];
        foreach ($reportDetailUser as $report) {
            if ($report->column_alignment == 1) {
                $align = 'right';
            } elseif ($report->column_alignment == 2) {
                $align = 'center';
            } elseif ($report->column_alignment == 3) {
                $align = 'left';
            }
            $reportDetailColumnsAlign[$report->column_name] = $align;
        }
        return $reportDetailColumnsAlign;
    }
}
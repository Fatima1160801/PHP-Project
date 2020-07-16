
<a href="{{route('reports.export',['id' => $report_master->id,'to' => 'pdf'])}}"
   class="btn btn-sm btn-primary"  data-toggle="tooltip" data-placement="top" title=" ">
    <i class="material-icons">print</i> PDF
</a>
<a href="{{route('reports.export',['id' => $report_master->id,'to' => 'excel'])}}"
   class="btn btn-sm btn-info"
   data-toggle="tooltip" data-placement="top" title=" ">
    <i class="material-icons">print</i> Excel
</a>
<br><br>
<?php

foreach ($report_data as $r) {
    $report_data_[] = array_values((array)$r);
}

?>
<div class="material-datatables">
    <div class="table-responsive">
        <table class="table" id="table">
            <thead>
            <tr>
                @foreach($reportDetailUser as $rdu)
                    <th width="{{$rdu->column_width}}" class="text-center">{{$rdu->column_label}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody id="report-data-list">
            <?php
            $length = count($report_data_);
            for($i = 0;$i < $length;$i++){ ?>
            <tr>
                <?php for($a = 0;$a < count($report_data_[$i]);$a++){ ?>
                <td class="text-center">{{$report_data_[$i][$a]}}</td>
                <?php } ?>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

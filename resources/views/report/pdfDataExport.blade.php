<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style>

        body {
            font-family: Arial, Helvetica, sans-serif, sans-serif;
        }
/*/*/

        body {
            font-family: 'Roboto','Cairo', sans-serif;
            font-size: 13px;
        }
        table {
            border-collapse: collapse;
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid black;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>
<body dir="{{$dir}}">
{{--<htmlpageheader name="page-header">--}}
    {{--<div  align="center">--}}
        {{--<p align="center">{{$reportMasterUser->rep_label}}</p>--}}
    {{--</div>--}}
    {{--<div class="" align="right">--}}
        {{--{DATE j-m-Y}--}}
    {{--</div>--}}
{{--</htmlpageheader>--}}
<htmlpageheader name="page-header">
    @if($reportMasterUser->rep_orientation == 0 )
        <img src="{{asset('images/user/photo/').'/'. \App\Models\Setting\Setting::headerPortrait()}}">
    @elseif($reportMasterUser->rep_orientation == 1)
        <img src="{{asset('images/user/photo/').'/'. \App\Models\Setting\Setting::headerLandscape()}}">
    @endif

</htmlpageheader>
{{--<hr style="height: 2px ;color: #000000">--}}
<htmlpagefooter name="page-footer">
    <div class=""align="right">
        {PAGENO}
    </div>

</htmlpagefooter>


<table >
    <thead>
    <tr>
        <th>#</th>
        @foreach($reportDetailColumnsLabels as $label)
            <th>{{$label}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($report_data as $index=>$data)



        @if ($data->plan_start_date)
         @php $data->plan_start_date = dateFormatSite($data->plan_start_date);

         @endphp
        @endif
        @if ( $data->plan_end_date)
        @php $data->plan_end_date = dateFormatSite($data->plan_end_date);
          @endphp
        @endif
        <tr >
            <td width="30" align="center">{{$index+1}}</td>
            @foreach($reportDetailColumnsNames as $columnsNames)
                 @if($columnsNames == 'planed_start_date' or $columnsNames == 'planed_end_date'
                or $columnsNames =='plan_end_date'  or $columnsNames =='act_start_date' or $columnsNames =='act_end_date' )
                     <td align="{{$reportDetailColumnsAlign[$columnsNames]}}" width="{{$reportDetailColumnsWidth[$columnsNames]}}" >{{ dateFormatSite($data->$columnsNames) }}</td>
                @elseif($columnsNames =='planed_budget' or $columnsNames =='act_budget')
                    <td align="{{$reportDetailColumnsAlign[$columnsNames]}}" width="{{$reportDetailColumnsWidth[$columnsNames]}}">{{ round($data->$columnsNames,2) }}</td>
                @else
                    <td  align="{{$reportDetailColumnsAlign[$columnsNames]}}" width="{{$reportDetailColumnsWidth[$columnsNames]}}">{{$data->$columnsNames}}</td>
                @endif
            @endforeach
        </tr>
    @endforeach
    <tr>
        @foreach($reportDetailColumnsNames as $columnsNames)
            @if(in_array($columnsNames ,$reportDetailColumnsAggregationSum))
                <td>
                    {{$report_data->sum($columnsNames)}}
                </td>
            @elseif(in_array($columnsNames ,$reportDetailColumnsAggregationCount))
                <td>
                    {{$report_data->count($columnsNames)}}
                </td>
            @else
                <td></td>
            @endif
        @endforeach
    </tr>
    </tbody>
</table>
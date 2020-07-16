<table>
    <thead>
    <tr>
        <th colspan="{{ count($reportDetailColumnsLabels)}}">{{$reportMasterUser->rep_label}}</th>
    </tr>
    <tr>
        @foreach($reportDetailColumnsLabels as $label)
            <th>{{$label}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($report_data as $data)
        <tr>
            @foreach($reportDetailColumnsNames as $columnsNames)
                @if($columnsNames == 'planed_start_date' or $columnsNames == 'planed_end_date'
                or $columnsNames =='plan_end_date' or $columnsNames =='act_start_date' or $columnsNames =='act_end_date'or $columnsNames =='date' )
                    <td class="text-center">{{ dateFormatSite($data->$columnsNames) }}</td>
                @elseif($columnsNames =='planed_budget' or $columnsNames =='act_budget')
                    <td class="text-center">{{ round($data->$columnsNames,2) }}</td>
                @else
                    <td class="text-center">{{ $data->$columnsNames }}</td>
                @endif

                {{--<td>{{$data->$columnsNames}}</td>--}}
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
    //
    </tbody>
</table>
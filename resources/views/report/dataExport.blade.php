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


                    <td class="text-center">{{ $data->$columnsNames }}</td>


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
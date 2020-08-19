<div class="material-datatables">
    <div class="table-responsive">
        <table class="table  table-sm table-bordered table-responsive" id="table">
            <thead class="thead-light">
            <tr>
                @foreach($reportDetailUser as $rdu)
                    {{--width="{{$rdu->column_width}}"--}}
                    <th class="text-center " style="width:200px !important;">{{$rdu->column_label}}</th>
                @endforeach
                <th class="text-center " style="width:200px !important;">Sum Actual value</th>

            </tr>
            </thead>
            <tbody id="report-data-list">
            @foreach($report_data as $data)

                <tr>
                    @foreach($reportDetailUser as $rdu)
                        @php $name=$rdu->column_name @endphp
                        @if($name == 'planed_start_date' or $name == 'planed_end_date' or $name =='plan_end_date')
                            <td class="text-center">{{ dateFormatSite($data->$name) }}</td>
                        @elseif($name =='planed_budget' or $name =='act_budget')
                            <td class="text-center">{{ round($data->$name,2) }}</td>
                        @else
                            <td class="text-center">{{ $data->$name }}</td>
                        @endif

                    @endforeach
                        <td class="text-center">{{round($data->bant_value_sum,2)}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

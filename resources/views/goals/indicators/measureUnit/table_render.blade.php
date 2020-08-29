<table class="table dataTable no-footer table-bordered" id="table" style="margin-left: 7% !important;">
    <thead>
    <tr>
        <th colspan="2">#</th>

        <th>
            {{$labels['unit_name']?? 'unit_name'}}

        </th>
        <th>                        {{$labels['actions']?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>

    @if($imus != null)

        @foreach($imus  as $index=>$imu)
            <tr data-id="{{ $imu->id }}">

                <td colspan="2">{{$index+1}}</td>
                <td>{{ $imu->unit_name_no }}</td>
                <td>
                    @if($id==1)
                    <a href="{{route('goals.indicators.measure.unit.edit',$imu->id)}}" rel="tooltip"
                       class="mytooltip btn-setting-nav "
                       rel="tooltip" data-original-title="" title=""
                       data-placement="top" id="">
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                    @else
                        <a href="#" data-id="{{$imu->id}}"
                           class="mytooltip btn-setting-nav editAcType"  data-toggle="tooltip" data-placement="top"
                           title=" "
                        >
                            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                        </a>
                        @endif
                    <a href="{{route('goals.indicators.measure.unit.delete',$imu->id)}}"
                       class="mytooltip btn-setting-nav deleteAcType "
                       rel="tooltip" data-original-title="" title=""
                       data-placement="top" id="deleteUnit" >
                        <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete']?? 'delete'}}</span>
                    </a>

                </td>

            </tr>

        @endforeach

    @endif

    </tbody>

</table>
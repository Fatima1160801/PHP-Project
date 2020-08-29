<table class="table dataTable no-footer table-bordered " id="table" style="margin-left: 9% !important">
    <thead>
    <tr >
        <th>#</th>
        <th>

            {{$labels['visit_name_na']??'visit_name_na'}}
        </th>
        <th>

            {{$labels['visit_name_fo']??'visit_name_fo'}}

        </th>
        <th>
            {{$labels['status']??'status'}}

        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($visitTypes  as $index => $visitType)

        <tr data-id="{{$visitType->id}}">
            <td>{{$index+1}}</td>
            <td>{{$visitType->visit_name_na}}</td>
            <td>{{$visitType->visit_name_fo}}</td>
            <td>
                {!! activeLabel($visitType->is_hidden ) !!}
            </td>

            <td>
                @if($id==1)
                <a href="{{route('settings.visit.type.edit',$visitType->id)}}"
                   class="mytooltip btn-setting-nav editVisit"  data-toggle="tooltip" data-placement="top"
                   title=" ">
                    <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                </a>
                @else
                    <a href="#" data-id="{{$visitType->id}}"
                       class="mytooltip btn-setting-nav editVisit"  data-toggle="tooltip" data-placement="top"
                       title=" "
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                @endif
                <a href="{{ route('settings.visit.type.delete',$visitType->id )}}"
                        rel="tooltip" class="mytooltip btn-setting-nav  btnVisitTypeDelete"
                        data-placement="top"  title=" ">
                    <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                </a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>
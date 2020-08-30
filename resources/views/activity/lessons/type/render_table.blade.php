<table class="table dataTable no-footer table-bordered" id="table" style="margin-left: 7% !important;margin-top: -10% !important; ">
    <thead>
    <tr>
        <th>#</th>
        <th>

            {{$labels["activity_lessons_type_name_na"]??"activity_lessons_type_name_na"}}
        </th>
        <th>

            {{$labels["activity_lessons_type_name_fo"]??"activity_lessons_type_name_fo"}}

        </th>

        <th>
            {{$labels["actions"] ?? "actions"}}
        </th>
    </tr>
    </thead>
    <tbody>
    @if($lessons_type)
        @foreach($lessons_type  as $index => $type)

            <tr data-id="{{$type->id}}">
                <td>{{$index+1}}</td>
                <td>{{$type->activity_lessons_type_name_na}}</td>
                <td>{{$type->activity_lessons_type_name_fo}}</td>
                <td>
                    @if($id==1)
                    <a href="{{route('activity.lessons.type.edit',$type->id)}}"
                       class="mytooltip btn-setting-nav " data-toggle="tooltip"
                       data-placement="top"
                       title="">
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                    @else
                        <a href="#" data-id="{{$type->id}}"
                           class="mytooltip btn-setting-nav editIssue"  data-toggle="tooltip" data-placement="top"
                           title=" "
                        >
                            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                        </a>
                    @endif
                    <a  href="{{ route('activity.lessons.type.delete',$type->id )}}"
                            rel="tooltip" class="mytooltip btn-setting-nav  btnIssueDelete"
                            data-placement="top" title=" ">
                        <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                    </a>
                </td>
            </tr>

        @endforeach
    @endif
    </tbody>
</table>
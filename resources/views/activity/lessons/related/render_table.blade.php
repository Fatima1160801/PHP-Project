<table class="table dataTable no-footer table-bordered" id="table" style="margin-left: 7% !important;margin-top: -10% !important; ">
    <thead>
    <tr>
        <th>#</th>
        <th>

            {{$labels['activity_lessons_related_name_na']??'activity_lessons_related_name_na'}}
        </th>
        <th>

            {{$labels['activity_lessons_related_name_fo']??'activity_lessons_related_name_fo'}}

        </th>

        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($lessons_related  as $index => $related)

        <tr data-id="{{$related->id}}">
            <td>{{$index+1}}</td>
            <td>{{$related->activity_lessons_related_name_na}}</td>
            <td>{{$related->activity_lessons_related_name_fo}}</td>

            <td>
                @if($id==1)
                <a href="{{route('activity.lessons.related.edit',$related->id)}}"
                   class="mytooltip btn-setting-nav "  data-toggle="tooltip" data-placement="top"
                   title="">
                    <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                </a>
                @else
                    <a href="#" data-id="{{$related->id}}"
                       class="mytooltip btn-setting-nav editRelatedIssue"  data-toggle="tooltip" data-placement="top"
                       title=" "
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                @endif
                <a href="{{ route('activity.lessons.related.delete',$related->id )}}"
                        rel="tooltip" class="mytooltip btn-setting-nav  btnRelatedtDelete"
                        data-placement="top"  title=" ">
                    <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                </a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>
<table class="table dataTable no-footer table-bordered" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['taskTypeNameNa'] ?? 'taskTypeNameNa'}}
        </th>
        <th>
            {{$labels['taskTypeNamefo'] ?? 'taskTypeNamefo'}}
        </th>
        <th>
            {{$labels['is_hidden'] ?? 'is_hidden'}}
        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($taskType  as $index => $type)

        <tr data-id="{{$type->id}}">
            <td>{{$index+1}}</td>
            <td>{{$type->task_type_name_na}}</td>
            <td>{{$type->task_type_name_fo}}</td>
            <td>{!!  activeLabel($type->is_hidden) !!}</td>
            <td>
                @if($id==1)
                <a href="{{route('settings.taskType.edit',$type->id)}}"
                   class="mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"
                   title=" "
                >
                    <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                </a>
                @else
                    <a href="#" data-id="{{$type->id}}"
                       class="mytooltip btn-setting-nav editTask"  data-toggle="tooltip" data-placement="top"
                       title=" "
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                @endif
                <a href="{{ route('settings.taskType.delete',$type->id )}}"
                        rel="tooltip" class="mytooltip btn-setting-nav btnTaskDelete"
                        data-placement="top"  title="  ">
                    <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                </a>

            </td>
        </tr>

    @endforeach
    </tbody>
</table>
<table class="table dataTable no-footer table-bordered" id="table"s>
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['achivement_type_no']??'achivement_type_no'}}
        </th>
        <th>
            {{$labels['achivement_type_fo']??'achivement_type_fo'}}
        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($achievements  as $index => $achievement)

        <tr data-id="{{$achievement->id}}">
            <td>{{$index+1}}</td>
            <td>{{$achievement->achivement_type_no}}</td>
            <td>{{$achievement->achivement_type_fo}}</td>
            <td>
                @if($id==1)
                <a href="{{route('settings.achievement.type.edit',$achievement->id)}}"
                   class="mytooltip btn-setting-nav "  data-toggle="tooltip" data-placement="top"
                   title="{{$labels['edit'] ?? 'edit'}} "
                >
                    <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                </a>

                @else
                    <a href="#"  data-id="{{$achievement->id}}"
                       class=" editAchievement  mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"

                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                    @endif
                <a href="{{ route('settings.achievement.type.delete',$achievement->id )}}"
                        rel="tooltip" class="mytooltip btn-setting-nav  btnAchievementDelete"
                        data-placement="top"  title="  ">
                    <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                </a>

            </td>
        </tr>

    @endforeach
    </tbody>
</table>
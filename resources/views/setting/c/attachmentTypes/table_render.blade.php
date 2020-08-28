<table class="table dataTable no-footer table-bordered" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th>

            {{$labels['attachment_types_name_na'] ?? 'attachment_types_name_na'}}
        </th>
        <th>

            {{$labels['attachment_types_name_fo'] ?? 'attachment_types_name_fo'}}
        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($types  as $index => $attachment_types)

        <tr data-id="{{$attachment_types->id}}">
            <td>{{$index+1}}</td>
            <td>{{$attachment_types->attachment_type_na}}</td>
            <td>{{$attachment_types->attachment_type_fo}}</td>
            <td>
                @if($id==1)
                <a href="{{route('settings.attachment_types.edit',$attachment_types->id)}}"
                   class="mytooltip btn-setting-nav editDocType"  data-toggle="tooltip" data-placement="top"
                >
                    <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                </a>
                @else
                    <a href="#" type="button" data-id="{{$attachment_types->id}}"
                            class="btn-sm editDocType  mytooltip btn-setting-nav" style="border: white;"  data-toggle="tooltip" data-placement="top"

                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                @endif

                <a  href="{{ route('settings.attachment_types.delete',$attachment_types->id )}}"
                        rel="tooltip" style="border: white;" class=" btn-fab  btn-sm btnCityDelete  mytooltip btn-setting-nav"
                        data-placement="top">
                    <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}} </span>
                </a>

            </td>
        </tr>

    @endforeach
    </tbody>
</table>
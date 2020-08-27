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
                   class="btn btn-sm btn-success btn-round btn-fab  btn-sm"  data-toggle="tooltip" data-placement="top"
                   title="{{$labels['edit'] ?? 'edit'}} "
                >
                    <i class="material-icons">edit</i>
                </a>
                @else
                    <button type="button" data-id="{{$attachment_types->id}}"
                            class="btn btn-sm btn-success btn-round btn-fab editDocType"  data-toggle="tooltip" data-placement="top"
                            title="{{$labels['edit'] ?? 'edit'}} "
                    >
                        <i class="material-icons">edit</i>
                    </button>
                @endif

                <button type="button" href="{{ route('settings.attachment_types.delete',$attachment_types->id )}}"
                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab  btn-sm btnCityDelete"
                        data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                    <i class="material-icons">delete</i>
                </button>

            </td>
        </tr>

    @endforeach
    </tbody>
</table>
<table class="table dataTable no-footer table-bordered" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{ $labels['interface_type_id'] ?? 'interface' }}
        </th>
        <th>
            {{ $labels['attachment_type_id'] ?? 'interface' }}
        </th>
        <th>
            {{ $labels['is_hidden'] ?? 'status' }}
        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (Auth::user()->lang_id == 1)
    {
        $interface_name = 'interface_type_na';
        $attach_name = 'attachment_type_na';
        $activeStatus = 'Active';
        $inactiveStatus = 'InActive';

    }
    else
    {
        $interface_name = 'interface_type_fo';
        $attach_name = 'attachment_type_fo';
        $activeStatus = 'فعال';
        $inactiveStatus = 'غير فعال';
    }
    ?>
    @foreach($documents  as $index => $document)

        <tr data-interface="{{$document->interface_type_id}}" data-attachment={{$document->attachment_type_id}}"">
            <td>{{$index+1}}</td>
            <td>{{$document->intface->$interface_name ?? ""}}</td>
            <td>{{$document->attachment->$attach_name ?? ""}}</td>
            <td>@if($document->is_hidden == 0) {{$activeStatus}} @else {{$inactiveStatus}}  @endif</td>
            <td>
                @if($id==1)
                <a href="{{route('settings.documents.edit',[$document->interface_type_id,$document->attachment_type_id])}}"
                   class="btn btn-sm btn-success btn-round btn-fab btn_edit"  data-toggle="tooltip" data-placement="top"
                   title="{{$labels['edit'] ?? 'edit'}} ">
                    <i class="material-icons">edit</i>
                </a>
                @else
                    <button type="button" data-interface="{{$document->interface_type_id}}" data-attachment="{{$document->attachment_type_id}}"
                            class="btn btn-sm btn-success btn-round btn-fab editSetting"  data-toggle="tooltip" data-placement="top"
                            title="{{$labels['edit'] ?? 'edit'}} "
                    >
                        <i class="material-icons">edit</i>
                    </button>
                @endif
                <button type="button" href="{{ route('settings.documents.delete',[$document->interface_type_id,$document->attachment_type_id])}}"
                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"
                        data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                    <i class="material-icons">delete</i>
                </button>
            </td>

        </tr>

    @endforeach
    </tbody>
</table>
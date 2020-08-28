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
                   class="mytooltip btn-setting-nav btn_edit"  data-toggle="tooltip" data-placement="top"
                   title="">
                    <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}} </span>
                </a>
                @else
                    <a href="#" data-interface="{{$document->interface_type_id}}" data-attachment="{{$document->attachment_type_id}}"
                            class="mytooltip btn-setting-nav editSetting"  data-toggle="tooltip" data-placement="top"
                            title=" "
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}} </span>
                    </a>
                @endif
                <a  href="{{ route('settings.documents.delete',[$document->interface_type_id,$document->attachment_type_id])}}"
                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDelete"
                        data-placement="top"  title="  ">
                    <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                </a>
            </td>

        </tr>

    @endforeach
    </tbody>
</table>
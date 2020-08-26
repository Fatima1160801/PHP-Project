<table class="table dataTable no-footer settingInfo table-bordered" id="table" style="width: 70em;">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['service_name_na'] ?? 'Service name'}}
        </th>
        <th>
            {{$labels['service_name_fo'] ?? 'Service name in other language'}}
        </th>

        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>

    </tr>
    </thead>
    <tbody>

    @if(!empty($list))
        @foreach($list  as $index => $item)
            <tr data-id="{{$item->id}}">
                <td>{{$index+1}}</td>
                <td>{{$item->service_name_na ?? ""}}</td>
                <td>{{$item->service_name_fo ?? ""}}</td>
                <td>
                    @if($id==1)
                    <a href="{{route('services.edit',$item->id)}}"
                       class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                       title="{{$labels['edit'] ?? 'edit'}} "
                    >
                        <i class="material-icons">edit</i>
                    </a>
                    @else
                        <button type="button" data-id="{{$item->id}}"
                                class="btn btn-sm btn-success btn-round btn-fab editService"  data-toggle="tooltip" data-placement="top"
                                title="{{$labels['edit'] ?? 'edit'}} "
                        >
                            <i class="material-icons">edit</i>
                        </button>
                    @endif
                    <button type="button" href="{{ route('services.delete',$item->id )}}"
                            rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteService"
                            data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                        <i class="material-icons">delete</i>
                    </button>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
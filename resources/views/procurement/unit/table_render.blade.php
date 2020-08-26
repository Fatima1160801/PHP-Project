<table class="table dataTable no-footer  table-bordered"style="width:65em;" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th style="width:30em;">
            {{$labels['unit_name_na'] ?? 'Unit name'}}
        </th>
        <th style="width: 25em;">
            {{$labels['unit_name_fo'] ?? 'Unit name in other language'}}
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
                <td>{{$item->unit_name_na ?? ""}}</td>
                <td>{{$item->unit_name_fo ?? ""}}</td>
                <td>
                    @if($id==1)
                    <a href="{{route('units.edit',$item->id)}}"
                       class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                       title="{{$labels['edit'] ?? 'edit'}} "
                    >
                        <i class="material-icons">edit</i>
                    </a>
                    @else
                        <button type="button" data-id="{{$item->id}}"
                                class="btn btn-sm btn-success btn-round btn-fab editUnit"  data-toggle="tooltip" data-placement="top"
                                title="{{$labels['edit'] ?? 'edit'}} "
                        >
                            <i class="material-icons">edit</i>
                        </button>
                    @endif
                    <button type="button" href="{{ route('units.delete',$item->id )}}"
                            rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteUnit"
                            data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                        <i class="material-icons">delete</i>
                    </button>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
<table class="table dataTable no-footer  table-bordered"id="table">
    <thead>
    <tr>
        <th>#</th>
        <th >
            {{$labels['unit_name_na'] ?? 'Unit name'}}
        </th>
        <th >
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
                       class="mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"
                       title=""
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                    @else
                        <a href="#" data-id="{{$item->id}}"
                                class="mytooltip btn-setting-nav editUnit"  data-toggle="tooltip" data-placement="top"
                                title=" "
                        >
                            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                        </a>
                    @endif
                    <a href="{{ route('units.delete',$item->id )}}"
                            rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteUnit"
                            data-placement="top"  title=" ">
                        <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                    </a>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
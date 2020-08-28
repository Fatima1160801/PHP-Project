<table class="table dataTable no-footer  table-bordered" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['sector_name_na'] ?? 'Sector name'}}
        </th>
        <th>
            {{$labels['sector_name_fo'] ?? 'Sector name in other language'}}
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
                <td>{{$item->sector_name_na ?? ""}}</td>
                <td>{{$item->sector_name_fo ?? ""}}</td>
                <td>
                    @if($id==1)
                    <a href="{{route('sectors.edit',$item->id)}}"
                       class="mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"
                       title=" "
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                    @else
                        <button type="button" data-id="{{$item->id}}"
                                class="mytooltip btn-setting-nav editSector"  data-toggle="tooltip" data-placement="top"
                                title=" "
                        >
                            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                        </button>@endif
                    <button type="button" href="{{ route('sectors.delete',$item->id )}}"
                            rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteSector"
                            data-placement="top"  title="">
                        <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                    </button>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
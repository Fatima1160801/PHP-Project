<table class="table dataTable no-footer table-bordered" id="table" >
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['brand_name'] ?? 'Brand name'}}
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
                <td >{{$item->brand_name ?? ""}}</td>

                <td>
                    @if($id==1)
                        <a href="{{route('brands.edit',$item->id)}}"
                           class="mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"
                           title="{{$labels['edit'] ?? 'edit'}} "
                        >
                            <i class="material-icons">edit</i>
                        </a>
                    @else
                        <a href="#" data-id="{{$item->id}}"
                                class="mytooltip btn-setting-nav editBrand"  data-toggle="tooltip" data-placement="top"
                                title="{{$labels['edit'] ?? 'edit'}} "
                        >
                            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                        </a>
                    @endif
                    <a href="{{ route('brands.delete',$item->id )}}"
                            rel="tooltip" class="mytooltip btn-setting-nav btnTypeDelete"
                            data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                        <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                    </a>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
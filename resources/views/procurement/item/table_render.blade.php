<table class="table dataTable no-footer table-bordered" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['item_name'] ?? 'item name'}}
        </th>
        <th>
            {{$labels['sku'] ?? 'SKU'}}
        </th>
        <th>
            {{$labels['short_description'] ?? 'Short Description'}}
        </th>
        <th>
            {{$labels['description'] ?? 'Description'}}
        </th>
        <th>
            {{$labels['upc'] ?? 'UPC'}}
        </th>
        <th>
            {{$labels['ean'] ?? 'EAN'}}
        </th>
        <th>
            {{$labels['mpn'] ?? 'EAN'}}
        </th>
        <th>
            {{$labels['isbn'] ?? 'ISBN'}}
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
                <td>{{$item->item_name ?? ""}}</td>
                <td>{{$item->sku ?? ""}}</td>
                <td>{{$item->short_description ?? ""}}</td>
                <td>{{$item->description ?? ""}}</td>
                <td>{{$item->upc ?? ""}}</td>
                <td>{{$item->ean ?? ""}}</td>
                <td>{{$item->mpn ?? ""}}</td>
                <td>{{$item->isbn ?? ""}}</td>

                <td>
                    @if($id==1)
                    <a href="{{route('items.edit',$item->id)}}"
                       class="mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"
                       title=" "
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                    @else
                        <a href="#" data-id="{{$item->id}}"
                                class="mytooltip btn-setting-nav editItem"  data-toggle="tooltip" data-placement="top"
                                title=" "
                        >
                            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                        </a>
                    @endif
                    <a href="{{ route('items.delete',$item->id )}}"
                            rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteItem"
                            data-placement="top"  title=""><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                        <i class="material-icons">delete</i>
                    </a>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
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
                       class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                       title="{{$labels['edit'] ?? 'edit'}} "
                    >
                        <i class="material-icons">edit</i>
                    </a>
                    @else
                        <button type="button" data-id="{{$item->id}}"
                                class="btn btn-sm btn-success btn-round btn-fab editItem"  data-toggle="tooltip" data-placement="top"
                                title="{{$labels['edit'] ?? 'edit'}} "
                        >
                            <i class="material-icons">edit</i>
                        </button>
                    @endif
                    <button type="button" href="{{ route('items.delete',$item->id )}}"
                            rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"
                            data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                        <i class="material-icons">delete</i>
                    </button>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
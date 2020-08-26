<table class="table dataTable no-footer table-bordered" id="table">
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
                <td style="width: 30em;">{{$item->brand_name ?? ""}}</td>

                <td>
                    @if($id==1)
                        <a href="{{route('brands.edit',$item->id)}}"
                           class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                           title="{{$labels['edit'] ?? 'edit'}} "
                        >
                            <i class="material-icons">edit</i>
                        </a>
                    @else
                        <button type="button" data-id="{{$item->id}}"
                                class="btn btn-sm btn-success btn-round btn-fab editBrand"  data-toggle="tooltip" data-placement="top"
                                title="{{$labels['edit'] ?? 'edit'}} "
                        >
                            <i class="material-icons">edit</i>
                        </button>
                    @endif
                    <button type="button" href="{{ route('brands.delete',$item->id )}}"
                            rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"
                            data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                        <i class="material-icons">delete</i>
                    </button>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
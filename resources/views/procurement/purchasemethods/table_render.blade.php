<table class="table dataTable no-footer  table-bordered"  id="table" style="margin-top: -7%;">
    <thead>
    <tr>
        <th>#</th>
        <th >
            {{$labels['method_name_na'] ?? 'Purchase Method name'}}
        </th>
        <th>
            {{$labels['method_name_fo'] ?? 'purchase Method name in other language'}}
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
                <td>{{$item->method_name_na ?? ""}}</td>
                <td>{{$item->method_name_fo ?? ""}}</td>
                <td>
                    @if($id==1)
                    <a href="{{route('purchasemethods.edit',$item->id)}}"
                       class="mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"
                       title=" "
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                    @else
                        <a href="#" data-id="{{$item->id}}"
                                class="mytooltip btn-setting-nav editPurchase"  data-toggle="tooltip" data-placement="top"
                                title=""
                        >
                            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                        </a>
                    @endif
                    <a href="{{ route('purchasemethods.delete',$item->id )}}"
                            rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteMethod"
                            data-placement="top"  title=" ">
                        <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                    </a>
                </td>

            </tr>

        @endforeach
    @endif
    </tbody>
</table>
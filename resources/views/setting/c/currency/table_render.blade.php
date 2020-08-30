<table class="table dataTable no-footer table-bordered" id="table" style="margin-left: 7% !important;margin-top: -10% !important; ">
    <thead>
    <tr>
        <th>#</th>
        <th>

            {{$labels['currency_name_na'] ?? 'currency_name_na'}}
        </th>
        <th>

            {{$labels['currency_name_fo'] ?? 'currency_name_fo'}}
        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($currencies  as $index => $currency)

        <tr data-id="{{$currency->id}}">
            <td>{{$index+1}}</td>
            <td>{{$currency->currency_name_na}}</td>
            <td>{{$currency->currency_name_fo}}</td>
            <td>@if($id==1)
                <a href="{{route('settings.currency.edit',$currency->id)}}"
                   class="mytooltip btn-setting-nav   btn-sm"  data-toggle="tooltip" data-placement="top"
                   title=""
                >
                    <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                </a>

                @else
                    <a href="#"  data-id="{{$currency->id}}"
                       class=" editCurrency  mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"

                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                    </a>@endif
                <a  href="{{ route('settings.currency.delete',$currency->id )}}"
                        rel="tooltip" class="mytooltip btn-setting-nav   btn-sm btnCDelete"
                        data-placement="top"  title="  ">
                    <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                </a>

                
            </td>
        </tr>

    @endforeach
    </tbody>
</table>
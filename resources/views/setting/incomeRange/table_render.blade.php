<table class="table dataTable no-footer table-bordered" id="table" style="margin-left: 7% !important;margin-top: -10% !important;">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['Name_English_IncomeRange'] ?? 'Name_English_IncomeRange'}}
        </th>
        <th>
            {{$labels['Name_Arabic_IncomeRange'] ?? 'Name_Arabic_IncomeRange'}}

        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($incomeRanges  as $index => $incomeRange)

        <tr data-id="{{$incomeRange->id}}">
            <td>{{$index+1}}</td>
            <td>{{$incomeRange->income_name_na}}</td>
            <td>{{$incomeRange->income_name_fo}}</td>
            <td>
                @if($id==1)
                <a href="{{route('settings.incomeRange.edit',$incomeRange->id)}}"
                   class="mytooltip btn-setting-nav "  data-toggle="tooltip" data-placement="top"
                   title="{{$labels['edit'] ?? 'edit'}} " >
                    <i class="material-icons">edit</i>
                </a>

                    @else
                        <a href="#"  data-id="{{$incomeRange->id}}"
                           class="btn-sm editRange  mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"

                        >
                            <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                        </a>

                    @endif
                {{--<button type="button" href="{{ route('settings.incomeRange.delete',$incomeRange->id )}}"--}}
                {{--rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnDelete"--}}
                {{--data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">--}}
                {{--<i class="material-icons">delete</i>--}}
                {{--</button>--}}
            </td>
        </tr>

    @endforeach
    </tbody>
</table>
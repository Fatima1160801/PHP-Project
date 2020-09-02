<table class="table dataTable no-footer table-bordered " id="table">
    <thead>
{{--    <tr>--}}
{{--        <th colspan="5">--}}
{{--            --}}{{--                        <a href="{{route('project.donors.types.create')}}"--}}
{{--            --}}{{--                           class="btn btn-primary btn-sm btn-fab btn-round "--}}
{{--            --}}{{--                           data-toggle="tooltip" data-placement="top" title="{{$labels['add']??'add'}}">--}}
{{--            --}}{{--                            <i class="material-icons">add--}}
{{--            --}}{{--                            </i>--}}
{{--            --}}{{--                        </a>--}}
{{--        </th>--}}
{{--    </tr>--}}
    <tr>
        <th>#</th>
        <th>
            {{$labels['donor_types_name_anglish']??'donor_types_name_anglish'}}
        </th>
        <th>
            {{$labels['donor_types_name_arabic']??'donor_types_name_arabic'}}
        </th>
        <th>
            {{$labels['status'] ?? 'status'}}
        </th>

        <th>
            {{$labels['actions']??'actions'}}

        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($donorstypes  as $index=>$donorstype)
        <tr data-id="{{$donorstype->id}}">
            <td>{{$index+1}}</td>
            <td>{{$donorstype->type_name_na}}</td>
            <td>{{$donorstype->type_name_fo}}</td>
            <td>{!! activeLabel($donorstype->is_hidden)  !!} </td>
            <td>
                @if($id==1)
                <a href="{{route('project.donors.types.edit',$donorstype->id)}}"
                   class="mytooltip btn-setting-nav" data-toggle="tooltip"
                   data-placement="left" title=" ">
                    <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit']??'edit'}}</span>
                </a>
                @else
                    <a href="#"data-id="{{$donorstype->id}}"
                       class="mytooltip btn-setting-nav editFunType" data-toggle="tooltip"
                       data-placement="left" title=" ">
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit']??'edit'}}</span>
                    </a>
                    @endif

                <a href="{{route('project.donors.types.destroy',$donorstype->id)}}"
                   class="mytooltip btn-setting-nav"
                   data-tooltip="tooltip" data-placement="right" title=""
                   id="DeleteDonorType">
                    <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete']??'delete'}}</span>
                </a>

            </td>
        </tr>


    @endforeach
    </tbody>
</table>

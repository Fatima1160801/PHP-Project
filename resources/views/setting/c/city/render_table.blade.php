<table class="table dataTable no-footer table-bordered table-responsive" id="table">
    <thead>
    <tr>
{{--        <th style="width:20px;">#</th>--}}
{{--        <th style="width:177px;">--}}
{{--            {{$labels['city_name_en']??'city_name_en'}}--}}
{{--        </th>--}}
{{--        <th style="width:177px;">--}}
{{--            {{$labels['city_name_ar']??'city_name_ar'}}--}}
{{--        </th>--}}
{{--        <th style="width:89px;">--}}
{{--            {{$labels['actions'] ?? 'actions'}}--}}
{{--        </th>--}}
        <th style="width:10%;">#</th>
        <th style="width:40%;">
            {{$labels['city_name_en']??'city_name_en'}}
        </th>
        <th style="width:20%;">
            {{$labels['city_name_ar']??'city_name_ar'}}
        </th>
        <th style="width:20%">
            {{$labels['actions'] ?? 'actions'}}
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>
{{--    @php--}}
{{--        $size=sizeof($cities) @endphp--}}
    @foreach($cities  as $index => $city)

        <tr data-id="{{$city->id}}">
{{--<td>{{$index-1}}</td>--}}
            <td>{{$index+1}}</td>
            <td>{{$city->city_name_no}}</td>
            <td>{{$city->city_name_fo}}</td>
            <td>
                @if($id==1)
                <a href="{{route('settings.cities.edit',$city->id)}}"
                   class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                   title="{{$labels['edit'] ?? 'edit'}} "
                >
                    <i class="material-icons">edit</i>
                </a>
                @else
                    <button type="button" data-id="{{$city->id}}"
                     class="btn btn-sm btn-success btn-round btn-fab editCity"  data-toggle="tooltip" data-placement="top"
                       title="{{$labels['edit'] ?? 'edit'}} "
                    >
                        <i class="material-icons">edit</i>
                    </button>
                @endif

                <button type="button" href="{{ route('settings.cities.delete',$city->id )}}"
                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnCityDelete"
                        data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                    <i class="material-icons">delete</i>
                </button>

            </td>
        </tr>

    @endforeach
    </tbody>
</table>
{{--@include('setting.c.city.location_script')--}}
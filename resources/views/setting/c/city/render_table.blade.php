<table class="table dataTable no-footer table-bordered"  id="table">
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
        <th>#</th>
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
                   class="mytooltip btn-setting-nav "  data-toggle="tooltip" data-placement="top"
                   title=" "
                >
                    <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                </a>
                @else
                    <a href="#"  data-id="{{$city->id}}"
                     class="mytooltip btn-setting-nav  editCity"  data-toggle="tooltip" data-placement="top"
                       title=""
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                @endif

                <a  href="{{ route('settings.cities.delete',$city->id )}}"
                        rel="tooltip" class="mytooltip btn-setting-nav  btnCityDelete"
                        data-placement="top"  title=" ">
                    <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                </a>

            </td>
        </tr>

    @endforeach
    </tbody>
</table>
{{--@include('setting.c.city.location_script')--}}
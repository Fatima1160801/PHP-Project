<table class="table dataTable no-footer table-bordered" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['Name_English_Districts'] ?? 'Name_English_Districts'}}

        </th>
        <th>
            {{$labels['Name_Arabic_Districts'] ?? 'Name_Arabic_Districts'}}

        </th>
        <th>
            {{$labels['City_Districts'] ?? 'City_Districts'}}
        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($districts  as $index => $district)

        <tr data-id="{{$district->id}}">
            <td>{{$index+1}}</td>
            <td>{{$district->district_name_no}}</td>
            <td>{{$district->district_name_fo}}</td>
            <td>{{ $district->city? $district->city->{'city_name_'.lang_character1()} : '' }}</td>
            <td>
                @if($id==1)
                <a href="{{route('settings.districts.edit',$district->id)}}"
                   class="mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"
                   title=""
                >
                    <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                </a>
                @else
                    <a href="#" data-id="{{$district->id}}"
                            class="mytooltip btn-setting-nav editDistrict"  data-toggle="tooltip" data-placement="top"
                            title=""
                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                @endif

                <a  href="{{ route('settings.districts.delete',$district->id )}}"
                        rel="tooltip" class="mytooltip btn-setting-nav btnDistrictDelete"
                        data-placement="top"  title="">
                    <i class="material-icons">delete</i><span class="mytooltiptext">{{$labels['delete'] ?? 'delete'}}</span>
                </a>

            </td>
        </tr>

    @endforeach
    </tbody>
</table>
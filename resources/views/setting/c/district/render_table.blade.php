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
                   class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                   title="{{$labels['edit'] ?? 'edit'}} "
                >
                    <i class="material-icons">edit</i>
                </a>
                @else
                    <button type="button" data-id="{{$district->id}}"
                            class="btn btn-sm btn-success btn-round btn-fab editDistrict"  data-toggle="tooltip" data-placement="top"
                            title="{{$labels['edit'] ?? 'edit'}} "
                    >
                        <i class="material-icons">edit</i>
                    </button>
                @endif

                <button type="button" href="{{ route('settings.districts.delete',$district->id )}}"
                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnDistrictDelete"
                        data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                    <i class="material-icons">delete</i>
                </button>

            </td>
        </tr>

    @endforeach
    </tbody>
</table>
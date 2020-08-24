<table class="table dataTable no-footer table-bordered table-responsive" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['city_name_en']??'city_name_en'}}
        </th>
        <th>
            {{$labels['city_name_ar']??'city_name_ar'}}
        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($cities  as $index => $city)

        <tr>
            <td>{{$index+1}}</td>
            <td>{{$city->city_name_no}}</td>
            <td>{{$city->city_name_fo}}</td>
            <td>
                <a href="{{route('settings.cities.edit',$city->id)}}"
                   class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                   title="{{$labels['edit'] ?? 'edit'}} "
                >
                    <i class="material-icons">edit</i>
                </a>


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

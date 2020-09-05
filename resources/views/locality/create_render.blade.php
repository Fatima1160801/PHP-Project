<div class="card-body">
    <a hidden href="{{route('locality.create')}}" class="btn btn-primary btn-sm btn-round btn-fab"
       data-toggle="tooltip" data-placement="top"
       title="Add New Locality" >
        <i class="material-icons">add</i></a>


    <table class="table" id="table">
        <thead>
        <tr>
            <th>#</th>
            <th>
                {{$labels['localit_name_english'] ?? 'localit_name_english'}}
            </th>
            <th>
                {{$labels['localit_name_arabic'] ?? 'localit_name_arabic'}}
            </th>
            <th>
                {{$labels['district'] ?? 'district'}}
            </th>
            <th>
                {{$labels['city'] ?? 'city'}}
            </th>
            <th>
                {{$labels['actions'] ?? 'actions'}}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($locality  as $index => $l)

            <tr>
                <td>{{$index+1}}</td>
                <td>{{$l->locality_name_na}}</td>
                <td>{{$l->locality_name_fo}}</td>
                <td>{{(Auth::user()->lang_id == 1) ? $l->district->district_name_no : $l->district->district_name_fo}}</td>
                <td>{{(Auth::user()->lang_id == 1) ? $l->city->city_name_no : $l->city->city_name_fo}}</td>
                <td>
                    <a href="{{route('locality.edit',$l->id)}}" data-id="{{$l->id}}"
                       class="mytooltip btn-setting-nav editLocalityNew"  data-toggle="tooltip" data-placement="top"
                       title="{{$labels['edit'] ?? 'edit'}} ">
                        <i class="material-icons">edit</i>
                    </a>

                    <a href="#" type="button" data-href="{{route('locality.delete',$l->id)}}"
                       rel="tooltip" class="mytooltip btn-setting-nav btnLocalityDelete"
                       data-placement="top" title=" {{$labels['delete'] ?? 'delete'}} ">
                        <i class="material-icons">delete</i>
                    </a>

                    <a href="{{ route('activity.beneficiaries.beneficiaryForm',[$l->id ,'4'] )}}"
                       id="btnBeneficiaryFormPrint" rel="tooltip" class="mytooltip btn-setting-nav"
                       data-placement="top" title=" {{$labels['print'] ?? 'print'}} ">
                        <i class="material-icons">print</i>
                    </a>

                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>
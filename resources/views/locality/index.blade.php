@extends('layouts._layout')

@section('content')

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">


                {{$labels['screen_locality'] ?? 'screen_locality'}}

            </h4>
        </div>
        <div class="card-body">
            <a href="{{route('locality.create')}}" class="btn btn-primary btn-sm btn-round btn-fab"
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
                            <a href="{{route('locality.edit',$l->id)}}"
                               class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                               title="{{$labels['edit'] ?? 'edit'}} ">
                                <i class="material-icons">edit</i>
                            </a>

                            <button type="button" data-href="{{route('locality.delete',$l->id)}}"
                                    rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnLocalityDelete"
                                    data-placement="top" title=" {{$labels['delete'] ?? 'delete'}} ">
                                <i class="material-icons">delete</i>
                            </button>

                            <a href="{{ route('activity.beneficiaries.beneficiaryForm',[$l->id ,'4'] )}}"
                               id="btnBeneficiaryFormPrint" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab"
                               data-placement="top" title=" {{$labels['print'] ?? 'print'}} ">
                                <i class="material-icons">print</i>
                            </a>

                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $(function () {
            active_nev_link('Localities-link');
            DataTableCall('#table',6);


            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');

            $(document).on('click', '.btnLocalityDelete', function (e) {
                e.preventDefault();
                $this = $(this);

                swal({
                    text: '{{$messageDeleteLocality['text']}}',
                    confirmButtonClass: 'btn btn-success  btn-sm',
                    cancelButtonClass: 'btn btn-danger  btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true){
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).data('href');
                        $.ajax({
                            url: url,
                            type: 'delete',
                            beforeSend: function () {
                            },
                            success: function (data) {
                                if (data.status == 'true') {
                                    $($this).closest('tr').css('background','red').delay(1000).hide(1000);
                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                    $('#contentModal .close').click();
                                } else {
                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                }
                            },
                            error: function () {
                            }
                        });
                    }
                })
            });


        })

    </script>

@endsection



@section('js')

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

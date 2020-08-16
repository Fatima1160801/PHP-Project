@extends('layouts._layout')

@section('content')

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                 {{$labels['screen_index_activity_type']??'screen_index_activity_type'}}

            </h4>


        </div>
        <div class="card-body ">
            <a href="{{route('settings.activity_types.create')}}"
               class="btn btn-primary btn-round btn-fab btn-sm"
               data-toggle="tooltip" data-placement="top"
               title="Add New Activity Type" >
                <i class="material-icons">add</i>
            </a>


            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>

                        {{$labels['name_activity_type_english']??'name_activity_type_english'}}
                    </th>
                    <th>

                        {{$labels['name_activity_type_arabic']??'name_activity_type_arabic'}}

                    </th>
                    <th>
                        {{$labels['status_activity_type']??'status_activity_type'}}

                    </th>
                    <th>
                        {{$labels['actions'] ?? 'actions'}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($activityTypes  as $index => $activityType)

                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$activityType->act_type_name_no}}</td>
                        <td>{{$activityType->act_type_name_fo}}</td>
                        <td>
                          {!! activeLabel($activityType->is_hidden ) !!}
                           </td>

                        <td>
                            <a href="{{route('settings.activity_types.edit',$activityType->id)}}"
                               class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"
                               title="{{$labels['edit'] ?? 'edit'}} ">
                                <i class="material-icons">edit</i>
                            </a>
                            <button type="button" href="{{ route('settings.activity_types.delete',$activityType->id )}}"
                                    rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnDistrictDelete"
                                    data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                                <i class="material-icons">delete</i>
                            </button>
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

            active_nev_link('activity_types');

            DataTableCall('#table', 5);

            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');

            $(document).on('click', '.btnDistrictDelete', function (e) {
                e.preventDefault();
                $this = $(this);

                swal({
                    text: '{{$messageDeleteActivityTypes['text']}}',
                    confirmButtonClass: 'btn btn-success  btn-sm',
                    cancelButtonClass: 'btn btn-danger  btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true){
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).attr('href');
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
                                }else {
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

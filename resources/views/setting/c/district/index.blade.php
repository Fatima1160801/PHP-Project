@extends('layouts._layout')

@section('content')

    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['screen_index_Districts'] ?? 'screen_index_Districts'}}--}}
{{--            </h4>--}}
{{--        </div>--}}
        <div class="card-body">
            <h4 class="card-title"><span>
                {{$labels['screen_index_Districts'] ?? 'screen_index_Districts'}}

            <a href="{{route('settings.districts.create')}}" class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="{{$labels['screen_add_Districts'] ?? 'screen_add_locating'}}" >
                <i class="material-icons">add</i></a>
            </span></h4>

            @include('setting.c.district.render_table')
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.locations.screen')}}"'>Back</button>

        </div>
    </div>


@endsection
@section('script')
    <script>
        $(function () {
            active_nev_link('districts-link');

            DataTableCall('#table', 5)

            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');

            $(document).on('click', '.btnDistrictDelete', function (e) {
                e.preventDefault();
                $this = $(this);

                swal({
                    text: '{{$messageDeleteDistrict['text']}}',
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

@extends('layouts._layout')

@section('content')

    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}

{{--                {{$labels['services'] ?? 'Service'}}--}}
{{--            </h4>--}}


{{--        </div>--}}
        <div class="card-body ">
            <h4 class="card-title "><span>

                {{$labels['services'] ?? 'Service'}}


            <a href="{{route('services.create')}}" class="btn btn-primary  btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="{{$labels['addservice'] ?? 'Add service'}}" >
                <i class="material-icons">add</i></a>
            </span></h4>
            @include('procurement.service.table_render')

{{--            <table class="table dataTable no-footer settingInfo table-bordered" id="table" style="width: 70em;">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th style="width: 30em;">--}}
{{--                        {{$labels['service_name_na'] ?? 'Service name'}}--}}
{{--                    </th>--}}
{{--                    <th style="width: 30em;">--}}
{{--                        {{$labels['service_name_fo'] ?? 'Service name in other language'}}--}}
{{--                    </th>--}}

{{--                    <th>--}}
{{--                        {{$labels['actions'] ?? 'actions'}}--}}
{{--                    </th>--}}

{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}

{{--                @if(!empty($list))--}}
{{--                    @foreach($list  as $index => $item)--}}
{{--                        <tr>--}}
{{--                            <td>{{$index+1}}</td>--}}
{{--                            <td>{{$item->service_name_na ?? ""}}</td>--}}
{{--                            <td>{{$item->service_name_fo ?? ""}}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{route('services.edit',$item->id)}}"--}}
{{--                                   class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"--}}
{{--                                   title="{{$labels['edit'] ?? 'edit'}} "--}}
{{--                                >--}}
{{--                                    <i class="material-icons">edit</i>--}}
{{--                                </a>--}}
{{--                                <button type="button" href="{{ route('services.delete',$item->id )}}"--}}
{{--                                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"--}}
{{--                                        data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">--}}
{{--                                    <i class="material-icons">delete</i>--}}
{{--                                </button>--}}
{{--                            </td>--}}

{{--                        </tr>--}}

{{--                    @endforeach--}}
{{--                @endif--}}
{{--                </tbody>--}}
{{--            </table>--}}
            <button type="button" class="btn  btn-sm btn-default" onclick='location.href="{{ route('screen.index')}}"'>Back</button>

        </div>
    </div>


@endsection
@section('script')
    @include('procurement.brand.brand_script')
    <script>
        $(function () {
            active_nev_link('visit-link');
            DataTableCall('#table',4);
            $('[data-toggle="tooltip"]').tooltip();

        {{--    $(document).on('click', '.btnTypeDelete', function (e) {--}}
        {{--        e.preventDefault();--}}
        {{--        $this = $(this);--}}
        {{--        swal({--}}
        {{--            text: '{{$messageDeleteType['text']}}',--}}
        {{--            confirmButtonClass: 'btn btn-success  btn-sm',--}}
        {{--            cancelButtonClass: 'btn btn-danger  btn-sm',--}}
        {{--            buttonsStyling: false,--}}
        {{--            showCancelButton: true--}}
        {{--        }).then(result => {--}}
        {{--            if (result == true){--}}
        {{--                // var project_id = $('#formProjectMain #id').val();--}}
        {{--                url = $(this).attr('href');--}}
        {{--                // alert(url);--}}
        {{--                $.ajax({--}}
        {{--                    url: url,--}}
        {{--                    type: 'delete',--}}
        {{--                    beforeSend: function () {--}}
        {{--                    },--}}
        {{--                    success: function (data) {--}}
        {{--                        if (data.status == true) {--}}
        {{--                            $($this).closest('tr').css('background','red').delay(1000).hide(1000);--}}
        {{--                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
        {{--                            $('#contentModal .close').click();--}}
        {{--                        }else {--}}
        {{--                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
        {{--                        }--}}
        {{--                    },--}}
        {{--                    error: function () {--}}
        {{--                    }--}}
        {{--                });--}}
        {{--            }--}}
        {{--        })--}}
        {{--    });--}}


        })





    </script>

@endsection



@section('js')

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

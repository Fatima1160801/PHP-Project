@extends('layouts._layout')


@section('css')
    <style>


    </style>
@endSection
@section('content')


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">

                {{$labels['screen_indicator_type']?? 'screen_indicator_type'}}
            </h4>
        </div>
        <div class="card-body ">

            <a href="{{route('goals.indicators.type.create')}}" rel="tooltip"
               class="btn btn-sm btn-primary btn-fab btn-round"
              data-original-title="" title="{{$labels['add']?? 'add'}}"
               data-placement="top" id="">

                <i class="material-icons">add</i>

            </a>

            <table class="table" id="table">
                <thead>
                <tr>
                    <th colspan="2">#</th>

                    <th>
                        {{$labels['type_name']?? 'type_name'}}
                    </th>
                    <th>
                        {{$labels['status']?? 'status'}}
                            </th>
                    <th>     {{$labels['action']?? 'action'}}</th>
                </tr>
                </thead>
                <tbody>

                @if($ITypes != null)

                    @foreach($ITypes  as $index=>$IType)
                        <tr>

                            <td colspan="2">{{$index+1}}</td>
                            <td>{{ $IType->indic_type_name_no }}</td>
                            <td>{!!activeLabel($IType->is_hidden)  !!} </td>
                            <td>
                                <a href="{{route('goals.indicators.type.edit',$IType->id)}}" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-success btn-fab"
                                   rel="tooltip" data-original-title="" title="Edit Type"
                                   data-placement="top" id="">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="{{route('goals.indicators.type.delete',$IType->id)}}" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-danger btn-fab"
                                   rel="tooltip" data-original-title="" title="Delete Type"
                                   data-placement="top" id="deleteType">
                                    <i class="material-icons">delete</i>
                                </a>

                            </td>

                        </tr>

                    @endforeach

                @endif

                </tbody>

            </table>
        </div>
    </div>

@stop

@section('script')

    <script>
        $(document).ready(function () {
            active_nev_link('indicators_type');
            DataTableCall('#table', 4)

        });

        $(document).on('click', '#deleteType', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '{{$messageDeleteIndicatorType['text']}}',
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
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

    </script>

@stop



@section('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

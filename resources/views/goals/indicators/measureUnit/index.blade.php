@extends('layouts._layout')


@section('css')
    <style>


    </style>
@endSection
@section('content')


    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['screen_indicator_measure_unit']?? 'screen_indicator_measure_unit'}}--}}
{{--            </h4>--}}
{{--        </div>--}}
        <div class="card-body ">
            <h4 class="card-title"><span>
                {{$labels['screen_indicator_measure_unit']?? 'screen_indicator_measure_unit'}}

            <a href="{{route('goals.indicators.measure.unit.create')}}" rel="tooltip"
               class="btn btn-sm btn-primary btn-round btn-fab"
              data-original-title="" title="
                {{$labels['add']?? 'add'}}
"
               data-placement="top" id="">

                <i class="material-icons">add</i>

            </a>
            </span></h4>
            @include('goals.indicators.measureUnit.table_render')
{{--            <table class="table dataTable no-footer table-bordered" id="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th colspan="2">#</th>--}}

{{--                    <th>--}}
{{--                        {{$labels['unit_name']?? 'unit_name'}}--}}

{{--                    </th>--}}
{{--                    <th>                        {{$labels['actions']?? 'actions'}}--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}

{{--                @if($imus != null)--}}

{{--                    @foreach($imus  as $index=>$imu)--}}
{{--                        <tr>--}}

{{--                            <td colspan="2">{{$index+1}}</td>--}}
{{--                            <td>{{ $imu->unit_name_no }}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{route('goals.indicators.measure.unit.edit',$imu->id)}}" rel="tooltip"--}}
{{--                                   class="btn btn-sm   btn-round btn-success btn-fab"--}}
{{--                                   rel="tooltip" data-original-title="" title="{{$labels['edit']?? 'edit'}}"--}}
{{--                                   data-placement="top" id="">--}}
{{--                                    <i class="material-icons">edit</i>--}}
{{--                                </a>--}}
{{--                                <a href="{{route('goals.indicators.measure.unit.delete',$imu->id)}}"--}}
{{--                                   class="btn btn-sm   btn-round btn-danger btn-fab"--}}
{{--                                   rel="tooltip" data-original-title="" title="{{$labels['delete']?? 'delete'}}"--}}
{{--                                   data-placement="top" id="deleteUnit">--}}
{{--                                    <i class="material-icons">delete</i>--}}
{{--                                </a>--}}

{{--                            </td>--}}

{{--                        </tr>--}}

{{--                    @endforeach--}}

{{--                @endif--}}

{{--                </tbody>--}}

{{--            </table>--}}
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.othersettings.screen')}}"'>Back</button>

        </div>
    </div>

@stop

@section('script')
    @include('project.projectcategories.othersettings_script')

    <script>
        $(document).ready(function () {
            active_nev_link('indicators_measure_unit');
            DataTableCall('#table', 3)
        })
        {{--$(document).on('click', '#deleteUnit', function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    $this = $(this);--}}

        {{--    swal({--}}
        {{--        text: '{{$messageDeleteMeasureUnit['text']}}',--}}
        {{--        confirmButtonClass: 'btn btn-success  btn-sm',--}}
        {{--        cancelButtonClass: 'btn btn-danger  btn-sm',--}}
        {{--        buttonsStyling: false,--}}
        {{--        showCancelButton: true--}}
        {{--    }).then(result => {--}}
        {{--        if (result == true) {--}}
        {{--            // var project_id = $('#formProjectMain #id').val();--}}
        {{--            url = $(this).attr('href');--}}
        {{--            $.ajax({--}}
        {{--                url: url,--}}
        {{--                type: 'delete',--}}
        {{--                data: {"_token": "{{csrf_token()}}"},--}}
        {{--                beforeSend: function () {--}}

        {{--                },--}}
        {{--                success: function (data) {--}}
        {{--                    if (data.status == 'true') {--}}
        {{--                        $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);--}}
        {{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
        {{--                    } else {--}}
        {{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
        {{--                    }--}}
        {{--                },--}}
        {{--                error: function () {--}}
        {{--                }--}}
        {{--            });--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}

    </script>

@stop




@section('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

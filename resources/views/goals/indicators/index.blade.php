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
                {{$labels['screen_indicators']??'screen_indicators'}}
            </h4>
        </div>
        <div class="card-body ">


            <table class="table" id="table">
                <thead>
                <tr>
                    <th colspan="2">#</th>

                    <th>
                        {{$labels['screen_indicators_name']??'screen_indicators_name'}}
                    </th>
                    <th>
                        {{$labels['screen_indicators_goals_name']??'screen_indicators_goals_name'}}
                    </th>
                    <th width="120">
                        {{$labels['actions']??'actions'}}

                    </th>
                </tr>
                </thead>
                <tbody>

                @if($indicators != null)

                    @foreach($indicators  as $index=>$indicator)
                        <tr>

                            <td colspan="2">{{$index+1}}</td>
                            <td>
                                <img src="{{asset('images\i.png')}}" style=" width: 25px; ">

                                {{ $indicator->indic_name_na }}</td>
                            <td>
                                @if($indicator->goal()->first()->parent_id == 0)
                                    <img src="{{asset('images\mg.png')}}" style=" width: 25px; ">
                                @else
                                    <img src="{{asset('images\sg.png')}}" style=" width: 25px; ">
                                @endif
                                {{ $indicator->goal()->first()->goal_name_na }}</td>
                            <td>
                                <a href="{{route('goals.indicators.edit',$indicator->id)}}" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-success btn-fab"
                                   rel="tooltip" data-original-title=""
                                   title="{{$labels['edit']??'edit'}}"
                                   data-placement="top" id="EditIndicator">
                                    <i class="material-icons">edit</i>
                                </a>

                                <a href="{{route('goals.results.create',[$indicator->goal_id,$indicator->id])}}"
                                   rel="tooltip"
                                   class="btn btn-sm   btn-round btn-info btn-fab"
                                   rel="tooltip" data-original-title="" title="{{$labels['add']??'add'}}"
                                   data-placement="top" id="AddResult">
                                    <img src="{{asset('images\r+.png')}}" style="margin-top: -15px;width: 25px; ">


                                </a>

                                <a href="{{route('goals.indicators.destroy',$indicator->id)}}" rel="tooltip"
                                   class="btn btn-sm   btn-round btn-danger btn-fab"
                                   rel="tooltip" data-original-title="" title="{{$labels['delete']??'delete'}}"
                                   data-placement="top" id="DeleteIndicator">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>

                        </tr>
                        @if($indicator->results()->get()->count() >0)


                            <tr>
                                <td style=" width: 20px; "></td>
                                <td>#</td>
                                <td>
                                    {{$labels['screen_indicators_result_name']??'screen_indicators_result_name'}}
                                </td>
                                <td>
                                    {{$labels['actions']??'actions'}}
                                </td>

                            </tr>
                            @foreach($indicator->results()->get() as$index=>$result )
                                <tr style=" background-color: #f3f3f3; ">
                                    <td style=" width: 20px; "></td>
                                    <td>{{$index+1}}</td>
                                    <td>
                                        <img src="{{asset('images\r.png')}}" style=" width: 25px; ">
                                        {{ $result->result_name_na }}</td>
                                    <td>
                                        <a href="{{route('goals.results.edit',$result->id)}}" rel="tooltip"
                                           class="btn btn-sm   btn-round btn-success btn-fab"
                                           rel="tooltip" data-original-title="" title="                                     {{$labels['action']??'action'}}
                                        {{$labels['edit']??'edit'}} "
                                           data-placement="top" id="EditResult">
                                            <i class="material-icons">edit</i>
                                        </a>

                                        <a href="{{route('goals.results.destroy',$result->id)}}" rel="tooltip"
                                           class="btn btn-sm   btn-round btn-danger btn-fab"
                                           rel="tooltip" data-original-title=""
                                           title="{{$labels['delete']??'delete'}}  "
                                           data-placement="top" id="DeleteResult">
                                            <i class="material-icons">delete</i>
                                        </a>


                                    </td>

                                </tr>
                            @endforeach

                        @endif

                    @endforeach

                @endif

                </tbody>

            </table>
        </div>
    </div>

@stop

@section('script')
    <script>
        $(function () {
        });


        $(document).on('click', '#DeleteResult', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                text: '{{$messageDeleteResult['text']}}',
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
                            }
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                        },
                        error: function () {
                        }
                    });
                }
            })
        });


        $(document).on('click', '#DeleteIndicator', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({

                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                text: '{{ $messageDeleteIndicator['text']}}',
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
                            }
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

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
    {{--<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->--}}
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    {{--<script src="{{ asset('js/datatables/datatables.min.js')}}"></script>--}}

@endsection

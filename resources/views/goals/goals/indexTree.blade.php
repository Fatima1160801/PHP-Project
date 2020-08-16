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

                <div class="row">
                    <div class="col-md-4">{{$labels['goals_list'] ?? 'goals_list'}}</div>

                    <div class="col-md-8" style=" background-color: #fff7d0; border-radius: 10px; ">
                        <div class="row">
                            @if(isset($strategics))
                                <div class='col-md-6'>
                                    <div class="row">
                                        <label style="text-align: center;padding: 17px;font-weight: bold;"
                                               for='strategic_id' class='col-md-4 col-form-label'>

                                            {{$labels['strategic_index'] ??'strategic_index'}}
                                        </label>

                                        <div class='col-md-6'>
                                            <div class='form-group has-default bmd-form-group'>
                                                <select id="strategic_id" name="strategic_id"
                                                        class="form-control  selectpicker" data-live-search='true'
                                                        data-style='btn btn-link'>

                                                    @foreach($strategics as $strategic)

                                                        @php
                                                            $checked ='';
                                                                    if($strategic->id == $strategic_id){
                                                                        $checked ='selected';
                                                                        }
                                                        @endphp
                                                        <option value="{{$strategic->id}}" {{$checked}}>{{$strategic->strategic_name_na}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class='col-md-6'>
                                <div class="row">
                                    <label style="text-align: center;padding: 17px;font-weight: bold;"
                                           for='strategic_id' class='col-md-4 col-form-label'>

                                        {{$labels['status'] ??'status'}}
                                    </label>

                                    <div class='col-md-6'>

                                        <div class='form-group has-default bmd-form-group'>

                                            <select id="status_id" name="status_id"
                                                    class="form-control  selectpicker" data-live-search='true'
                                                    data-style='btn btn-link'>

                                                <option value="0" @if($status==0 || $status==null)  selected @endif >
                                                    {{statusLang(0)}}
                                                </option>
                                                <option value="1" @if($status==1) selected @endif>
                                                  {{statusLang(1)}}
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </h4>
        </div>
        <div class="card-body ">

            <a href="{{route('goals.main.create')}}" class="btn btn-sm btn-primary btn-round"
               rel="tooltip" data-original-title=""
               title="  {{$labels['add_main_goals'] ?? 'add_main_goals'}}"
               data-placement="top"
               id="AddMainGoals">
                <i class="material-icons">add</i>
                {{$labels['add_main_goals'] ?? 'add_main_goals'}}

            </a>

            <a href="{{route('goals.main.index.table')}}" class="btn btn-sm btn-default pull-right"
               rel="tooltip" data-original-title="" title="table" data-placement="top"
               id="AddMainGoals">
                <i class="material-icons">grid_on</i>
            </a>

            <table class="table org-goal" id="table">
                <tbody>
                @if($goals_indic_result_view != null)
                    @foreach($goals_indic_result_view->where('goal_parent_id','0')->unique('goal_id')  as $index=>$goal)
                        {{--style="background-color: #dc2366;color: white; margin: 0px;"--}}
                        <tr style="font-weight: bold">
                            <td colspan="5">
                                <img src="{{asset('\images\mg.png')}}" style=" width: 25px; ">
                                {{ $goal->goal_name }}

                                {{--{!! activeLabel($goal->goal_is_hidden) !!}--}}
                            </td>
                            <td width="80">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-info btn-sm ">
                                        {{$labels['action'] ?? 'action'}}
                                    </button>
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" style="    width: 200px;">

                                        <li>
                                            <a href="{{route('goals.main.edit',$goal->goal_id)}}" id="EditGoals">
                                                {{$labels['edit'] ?? 'edit'}}
                                                {{--edit_main_goals--}}
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('goals.indicators.create',$goal->goal_id)}}"
                                               id="AddIndicators">
                                                {{$labels['add_indicator'] ?? 'add_indicator'}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('goals.sub.create',$goal->goal_id)}}" id="EditActivity">

                                                {{$labels['add_sub_goal'] ?? 'add_sub_goal'}}

                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('goals.main.destroy',$goal->goal_id)}}"
                                               id="DeleteMainGoals">
                                                {{$labels['delete'] ?? 'delete'}}

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {{--<tr>--}}
                        {{--<td></td>--}}
                        {{--<td colspan="4">Indicator</td>--}}
                        {{--<td></td>--}}
                        {{--</tr>--}}

                        @if($goals_indic_result_view->where('goal_id',$goal->goal_id)->where('indic_id','!=','null')->count() >0)
                            @foreach($goals_indic_result_view->where('goal_id',$goal->goal_id)->where('indic_id','!=','null')->unique('indic_id') as $index=>$indic)
                                @if($indic->indic_id)
                                    <tr>
                                        <td width="30"></td>
                                        <td width="30"></td>
                                        <td colspan="3">
                                            <img src="{{asset('images\i.png')}}"
                                                 style="margin-top: -15px;width: 25px; ">
                                            {{$indic->indicator_name}}
                                            {{--{!! activeLabel($indic->indic_is_hidden) !!}--}}
                                        </td>
                                        <td>

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm ">
                                                    {{$labels['action'] ?? 'action'}}
                                                </button>
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                                    <li>
                                                        <a href="{{route('goals.indicators.edit',$indic->indic_id)}}"
                                                           id="EditIndicator">
                                                            {{$labels['edit_indicator'] ?? 'edit_indicator'}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('goals.indicators.destroy',$indic->indic_id)}}"
                                                           id="DeleteIndicator">
                                                            {{$labels['delete_indicator'] ?? 'delete_indicator'}}

                                                        </a>
                                                    </li>
                                                    {{--<li>--}}
                                                        {{--<a href="{{route('goals.results.create',[$indic->goal_id,$indic->indic_id])}}"--}}
                                                           {{--id="AddResult">--}}
                                                            {{--{{$labels['add_result'] ?? 'add_result'}}--}}

                                                        {{--</a>--}}
                                                    {{--</li>--}}
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                            @endforeach
                        @endif

                        @if($goals_indic_result_view->where('goal_parent_id',$goal->goal_id)->count() >0)
                            @foreach($goals_indic_result_view->where('goal_parent_id',$goal->goal_id)->unique('goal_id') as$index=>$goal_sub )
                                {{--style="background-color: #fb9208;color: white;margin: 0px;"--}}
                                <tr>
                                    <td style="background-color: white;"></td>
                                    <td colspan="4">
                                        <img src="{{asset('\images\sg.png')}}" style=" width: 25px; ">
                                        {{ $goal_sub->goal_name }}
                                        {{--{!! activeLabel($goal_sub->goal_is_hidden) !!}--}}

                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm ">
                                                {{$labels['action'] ?? 'action'}}</button>
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                                <li>
                                                    <a href="{{route('goals.sub.edit',$goal_sub->goal_id)}}"
                                                       id="EditGoals">
                                                        {{$labels['edit_sub_goals'] ?? 'edit_sub_goals'}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('goals.sub.destroy',$goal_sub->goal_id)}}"
                                                       id="DeleteSubGoals">
                                                        {{$labels['delete'] ?? 'delete'}}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('goals.indicators.create',$goal_sub->goal_id)}}"
                                                       id="AddIndicators">
                                                        {{$labels['add_indicator'] ?? 'add_indicator'}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                @if($goals_indic_result_view->where('goal_id',$goal_sub->goal_id)->where('indic_id','!=','null')->count() >0)
                                    @foreach($goals_indic_result_view->where('goal_id',$goal_sub->goal_id)->where('indic_id','!=','null')->unique('indic_id') as $index=>$indic)
                                        @if($indic->indic_id)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="3">
                                                    <img src="{{asset('images\i.png')}}"
                                                         style="margin-top: -15px;width: 25px; ">
                                                    {{$indic->indicator_name}}
                                                    {{--{!! activeLabel($indic->indic_is_hidden) !!}--}}

                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm ">
                                                            {{$labels['action'] ?? 'action'}}

                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-info btn-sm dropdown-toggle"
                                                                data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                                            <li>
                                                                <a href="{{route('goals.indicators.edit',$indic->indic_id)}}"
                                                                   id="EditIndicator">
                                                                    {{$labels['edit_indicator'] ?? 'edit_indicator'}}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('goals.indicators.destroy',$indic->indic_id)}}"
                                                                   id="DeleteIndicator">
                                                                    {{$labels['delete_indicator'] ?? 'delete_indicator'}}
                                                                </a>
                                                            </li>
                                                            {{--<li>--}}
                                                                {{--<a href="{{route('goals.results.create',[$indic->goal_id,$indic->indic_id])}}"--}}
                                                                   {{--id="AddResult">--}}
                                                                    {{--{{$labels['add_result'] ?? 'add_result'}}--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif


                                    @endforeach
                                @endif

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
            active_nev_link('goals');
            $('.selectpicker').selectpicker();

            setTimeout(function () {
                $('.selectpicker').selectpicker('refresh');
            }, 1000);
        });
        $(document).on('click', '#DeleteSubGoals', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({

                text: '{{ $messageDeleteSubGoals['text']}}',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
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

        $(document).on('click', '#DeleteMainGoals', function (e) {
            e.preventDefault();
            $this = $(this);
            swal({
                text: '{{ $messageDeleteMainGoals['text']}}',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
                buttonsStyling: false,
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


        $(document).on('change', '#strategic_id', function (e) {
            e.preventDefault();
            var strategic_id = $('#strategic_id').val();
            var status_id = $('#status_id').val();
            var url = '{{route("goals.main.index.table")}}' + '/' + strategic_id + '/' + status_id;
            window.location.href = url;
        });

        $(document).on('change', '#status_id', function (e) {
            e.preventDefault();
            var strategic_id = $('#strategic_id').val();
            var status_id = $('#status_id').val();
            var url = '{{route("goals.main.index.table")}}' + '/' + strategic_id + '/' + status_id;
            window.location.href = url;
        });

    </script>



@stop




@section('js')
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    {{--<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->--}}
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    {{--<script src="{{ asset('js/datatables/datatables.min.js')}}"></script>--}}

@endsection

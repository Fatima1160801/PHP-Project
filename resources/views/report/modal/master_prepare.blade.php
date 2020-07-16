@extends('layouts._layout_modal')
@section('css')
    <style>
        .bg_c11 {
            background-color: #c1c1c1;
        }
    </style>
@stop
@section('content')

    <div class="wizardReport">


        <div class="col-md-12 col-12 mr-auto ml-auto">
            <div class="card card-wizard" data-color="rose" id="wizardReport">
                <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                <div class="card-header text-center">
                    <h3 class="card-title">
                        {{$labels['generate_repor']??'generate_repor'}}
                    </h3>
                    <h5 class="card-description">{{$repName}}</h5>
                </div>
                <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#main_info" data-toggle="tab" role="tab">
                                {{$labels['main_info']??'main_info'}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#preparing" data-toggle="tab" role="tab">
                                {{$labels['columns']??'columns'}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#details" data-toggle="tab" role="tab">
                                {{$labels['details']??'details'}}
                            </a>
                        </li>
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#show_r" data-toggle="tab" role="tab">--}}
                        {{--{{$labels['show_report']??'show_report'}}--}}
                        {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="main_info">
                            <h5 class="info-text">
                                {{$labels['report_text1']??'report_text1'}}
                            </h5>

                            {!! Form::open(['route' => 'reports.updateMaster' ,'action'=>'post' ,'id'=>'formReportPrepare']) !!}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {!! $html !!}

                            <button type="button" id="submit_formReportPrepare" style="display:none"></button>

                            {!! Form::close() !!}
                        </div>
                        <div class="tab-pane" id="preparing">

                            <div class="row">
                                <div id="columns_data" data-json="{{json_encode($reportDetail)}}"></div>
                                <div class="col-md-5">
                                    <div class="card" style="min-height: 400px;">

                                        <div class="card-body">
                                            <div style="height:300px;overflow: auto;">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="background-color:#ea2c6d;color:#fff">
                                                        {{$labels['report_text2']??'report_text2'}}

                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="all_columns">
                                                @foreach($reportDetail as $index => $reportDet)
                                                    @if(!in_array($reportDet->rep_detail_id,$arr_du_ids))
                                                        <tr class="column_elm" style="cursor: pointer;"
                                                            data-id="{{$reportDet->rep_detail_id}}"
                                                            data-order="{{$reportDet->column_order}}"
                                                            data-label="{{$reportDet->column_label}}"
                                                            data-width="{{$reportDet->column_width}}"
                                                            data-aggregation="{{$reportDet->column_aggregation}}"
                                                            data-alignment="{{$reportDet->column_alignment}}">
                                                            <td><b>{{$reportDet->column_label}}</b></td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1" style="padding-top:160px">
                                    <button type="button" id="btnMoveOneRight" class="btn btn-sm btn-rose "><i
                                                class="fa fa-angle-right"></i></button>
                                    <button type="button" id="btnMoveAllRight" class="btn btn-sm btn-rose "
                                            style="width: 46px;"><i class="fa fa-angle-double-right"></i></button>
                                    <button type="button" id="btnMoveAllLeft" class="btn btn-sm btn-rose "
                                            style="width: 46px;"><i class="fa fa-angle-double-left"></i></button>
                                    <button type="button" id="btnMoveOneLeft" class="btn btn-sm btn-rose "><i
                                                class="fa fa-angle-left"></i></button>
                                </div>
                                <div class="col-md-6">
                                    <div class="card" style="min-height: 400px;">

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-9 ps-scrollbar-y"
                                                     style="height:300px;overflow: auto;">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th style="background-color:#9c27b0;color:#fff">
                                                                {{$labels['report_text3']??'report_text3'}}

                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="columns_appear">
                                                        @if($reportDetailUser != null && count($arr_du_ids) > 0)
                                                            @foreach($reportDetailUser as $index => $reportDetailU)
                                                                <tr class="column_elm_" style="cursor: pointer;"
                                                                    data-id="{{$reportDetailU->rep_detail_id}}"
                                                                    data-order="{{$reportDetailU->column_order}}"
                                                                    data-label="{{$reportDetailU->column_label}}"
                                                                    data-width="{{$reportDetailU->column_width}}"
                                                                    data-aggregation="{{$reportDetailU->column_aggregation}}"
                                                                    data-alignment="{{$reportDetailU->column_alignment}}"
                                                                    data-data_type="{{$reportDetailU->column_data_type}}">
                                                                    <td><b>{{$reportDetailU->column_label}}</b></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-3" style="padding-top:100px">

                                                    <button type="button" id="moveOneUp" class="btn btn-sm btn-primary">
                                                        <i
                                                                class="material-icons">keyboard_arrow_up</i></button>
                                                    <button type="button" id="moveOneDown"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="material-icons">keyboard_arrow_down</i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="details">

                            <div class="row">
                                <div class="col-md-12 ps-scrollbar-y" style="height:300px;overflow: auto;">
                                    <form action="{{route('reports.customize')}}" method="post"
                                          id="reportColumnsDetails">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="rep_master_id" value="{{$rep_master_id}}">
                                        <table class="table" id="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th width="30%">
                                                    {{$labels['column_name']??'column_name'}}
                                                </th>
                                                <th width="13%">
                                                    {{$labels['column_width']??'column_width'}}
                                                </th>
                                                <th>
                                                    {{$labels['column_alignment']??'column_alignment'}}
                                                </th>
                                                <th>
                                                    {{$labels['options']??'options'}}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="columns_details_list">

                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--<div class="tab-pane" id="show_r">--}}

                        {{--<div align="center" id="loader-icon" class="col-md-12">--}}
                        {{--<div class="loader loader-div"></div>--}}
                        {{--</div>--}}
                        {{--<div id="report-data">--}}

                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="card-footer" style="margin-top:50px">
                    <div class="mr-auto">
                        <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled"
                               name="previous"
                               value=" {{$labels['previous']??'previous'}}">
                    </div>
                    <div class="ml-auto">
                        <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next"
                               value="{{$labels['next']??'next'}}">
                        <input type="button" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish"
                               value="{{$labels['finish']??'finish'}}"
                               style="display: none;">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script>

        $(document).ready(function () {
            wizard();
            $('.selectpicker').selectpicker();
        });
        function wizard() {
            reportWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardReport').addClass('active');
            }, 200);
        }

    </script>
@endsection






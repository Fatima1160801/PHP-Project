@extends('layouts._layout')

@section('css')

@endsection
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['screen_report_beneficiary_search'] ?? 'screen_report_beneficiary_search'}}
            </h4>

        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'beneficiary.report.result.search' ,'action'=>'get' ,'id'=>'formSearch','class'=>'']) !!}

            @if($projects!= null)
                <div class='col-md-12'>
                    <div class="row">
                        <label for='project_id' class='col-md-2 col-form-label'>
                            {{$labels['project_id'] ?? 'project_id'}}
                        </label>
                        <div class='col-md-10'>
                            <div class='form-group has-default bmd-form-group'>
                                <select id="project_id" name="project_id" class="form-control  selectpicker"
                                        data-live-search='true' data-style='btn btn-link'>
                                    <option value="" style="height: 30px"></option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{$project->project_name_na}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class='col-md-12'>
                <div class="row">
                    <label for='activity_id' class='col-md-2 col-form-label'>
                        {{$labels['activity_id'] ?? 'activity_id'}}
                    </label>
                    <div class='col-md-10'>
                        <div class='form-group has-default bmd-form-group'>
                            {!! Form::select('activity_id',[] , null, ['class' => 'form-control  selectpicker'  ,'data-live-search'=>'true' ,'id'=>'activity_id' ,'data-style'=>'btn btn-link'])  !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class='col-md-12'>
                <div class="row">
                    <label for='activity_id' class='col-md-2 col-form-label'>
                        {{$labels['activity_sub_id'] ?? 'activity_sub_id'}}
                    </label>
                    <div class='col-md-10'>
                        <div class='form-group has-default bmd-form-group'>
                            {!! Form::select('activity_sub_id',[] , null, ['class' => 'form-control  selectpicker'  ,'data-live-search'=>'true' ,'id'=>'activity_sub_id' ,'data-style'=>'btn btn-link'])  !!}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">

                <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                        id="saveProjectMain">
                    {{$labels['search'] ?? 'search'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>

                <a href="{{route('reports.prepare',11)}}" class="btn btn-danger btn-sm "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="{{$labels['report_settings'] ?? 'report_settings'}}">
                    <i class="material-icons">settings</i>
                </a>

                <a href="{{route('beneficiary.famindv.report.btnReportPDF')}}" class="btn btn-sm btn-primary"
                   target="_blank" id="btnReportPdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                    <i class="material-icons">print</i> PDF
                </a>
                <a href="{{route('beneficiary.famindv.report.reportExportExcel')}}" class="btn btn-sm btn-info"
                   data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
                    <i class="material-icons">print</i> Excel
                </a>
                <a href="#" class="btn btn-sm btn-info"
                   data-toggle="tooltip" data-placement="top" title="" id="btnValue">
                    <i class="material-icons">print</i>
                    Value
                </a>
            </div>

            {!! Form::close() !!}
            <div class="col-md-12" id="report-data">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>


        $(document).ready(function () {
            $('.selectpicker').selectpicker();

            active_nev_link('beneficiary_report_result_value')
        });

        $(document).on('change', '#project_id', function (e) {
            e.preventDefault();
            var project_id = $(this).val();
            $("#activity_id option").remove();
            $("#indicator_id option").remove();
            $("#result_id option").remove();
            $("#activity_id ").append("<option  style='height: 37px;' value></option>");
            $('#activity_id').selectpicker('refresh');
            $url = '{{route('beneficiary.report.result.activity')}}' + '/' + project_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.activities != null) {
                        selectActivities(data['activities']);
                    }
                    $('#activity_id').selectpicker('refresh');
                },
                error: function () {
                }
            });

        });

        function selectActivities(data) {
            $.each(data, function (index, value) {
                $("#activity_id").append('<option value=' + value['id'] + '>' + value['activity_name_na'] + '</option>');
            });
        }

        $(document).on('change', '#activity_id', function (e) {
            e.preventDefault();
            var project_id = $('#project_id').val();
            var activity_id = $(this).val();
            $("#activity_sub_id option").remove();
            $("#activity_sub_id ").append("<option  style='height: 37px;' value></option>");
            $('#activity_sub_id').selectpicker('refresh');
            $url = '{{route('beneficiary.report.result.activity.sub')}}' + '/' + project_id + '/' + activity_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.activities != null) {
                        selectSubActivities(data['activities']);
                    }
                    $('#activity_sub_id').selectpicker('refresh');
                },
                error: function () {
                }
            });

        });

        function selectSubActivities(data) {
            $.each(data, function (index, value) {
                $("#activity_sub_id").append('<option value=' + value['id'] + '>' + value['activity_name_na'] + '</option>');
            });
        }

        /*open modal  report setting***/
        $(document).on('click', '#btnOpenModalReport', function (e) {
            e.preventDefault();

            // url = $(this).attr('href');
            url = '{{route("reports.prepare")}}' + '/' + 11;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                    $('#modalReport .modal-body').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
                },
                success: function (data) {
                    $('#modalReprt .modal-body').html();
                    $('#modalReport .modal-body').html(data);
                },
                error: function () {
                }
            });
        });


        $(document).on('submit', '#formSearch', function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var url = '{{route("beneficiary.report.result.search")}}';
            $.ajax({
                url: url,
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#report-data').html('<div class="col-md-12" align="center"> <div class="loader-div"></div></div>');
                },
                success: function (data) {
                    $('#report-data').empty();
                    $('#report-data').html(data);
                },
                error: function () {
                }
            })
        });

        $(document).on('click', '#btnReportExcel', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.report.result.reportExportExcel")}}' + '?' + data;
            window.location.href = url;

        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.report.result.btnReportPDF")}}' + '?' + data;
            window.location.href = url;

        });
        $(document).on('click', '#btnValue', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var activity_id = $('#activity_sub_id').val();
            if (typeof activity_id === typeof undefined || activity_id == null|| activity_id == "" ) {
                activity_id =  $('#activity_id').val();
            }

            var url = '{{route("beneficiary.report.result.reportValueResult")}}' + '/' + activity_id + '?' + data;
            window.location.href = url;

        });


        var reports_getData = "{{route('reports.getData',11)}}";

    </script>
@endsection


@section('js')
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>

    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>


    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/modal_setting.js')}}"></script>
    <script src="{{ asset('js/wizardReport.js')}}"></script>
@endsection
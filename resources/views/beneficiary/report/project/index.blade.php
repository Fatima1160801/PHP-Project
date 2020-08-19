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
                {{$labels['beneficiary_project'] ?? 'beneficiary_project'}}

            </h4>

        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'beneficiary.report.project.search' ,'action'=>'get' ,'id'=>'formSearch','class'=>'']) !!}


            @if($strategics!= null)
                <div class='col-md-12'>
                    <div class="row">
                        <label for='project_id' class='col-md-2 col-form-label'>
                            {{$labels['strategic_name'] ?? 'strategic_name'}}
                        </label>
                        <div class='col-md-10'>
                            <div class='form-group has-default bmd-form-group'>
                                <select id="strategic_plan" name="strategic_plan" class="form-control  selectpicker"
                                        data-live-search='true' data-style='btn btn-link'>
                                    <option value=""></option>
                                    @foreach($strategics as $strategic)
                                        <option value="{{$strategic->id}}">{{$strategic->{'strategic_name_'.lang_character()} }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            @endif



            @if($projects!= null)
                <div class='col-md-12'>
                    <div class="row">
                        <label for='project_id' class='col-md-2 col-form-label'>
                            {{$labels['project_name'] ?? 'project_name'}}
                        </label>
                        <div class='col-md-10'>
                            <div class='form-group has-default bmd-form-group'>
                                <select id="project_id" name="project_id" class="form-control  selectpicker"
                                        data-live-search='true' data-style='btn btn-link'>
                                    <option value=""></option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{$project->{'project_name_'.lang_character()} }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-12">

                <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                        id="saveProjectMain">
                    {{$labels['search'] ?? 'search'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>
                <a href="{{route('reports.prepare',8)}}" class="btn btn-danger btn-sm "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="{{$labels['report_settings'] ?? 'report_settings'}}">
                    <i class="material-icons">settings</i>
                </a>
                <a href="{{route('beneficiary.report.project.btnReportPDF')}}" class="btn btn-sm btn-primary"
                   target="_blank" id="btnReportPdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                    <i class="material-icons">print</i> PDF
                </a>
                <a href="{{route('beneficiary.report.project.reportExportExcel')}}" class="btn btn-sm btn-info"
                   data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
                    <i class="material-icons">print</i> Excel
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
            active_nev_link('beneficiary_project')
        });

        $(document).on('change', '#project_id', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = '{{route("beneficiary.report.project.search")}}';
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

        /*open modal  report setting***/
        $(document).on('click', '#btnOpenModalReport', function (e) {
            e.preventDefault();

            // url = $(this).attr('href');
            url = '{{route("reports.prepare")}}' + '/' + 8;
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
            var data = $(this).serialize();
            var url = '{{route("beneficiary.report.project.search")}}';
            $.ajax({
                url: url,
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#report-data').html('<div class="col-md-12" align="center"> <div class="loader-div"></div></div>');
                },
                success: function (data) {
                    if (data.status != 'false') {
                        $('#report-data').empty();
                        $('#report-data').html(data);
                    }else{
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                    }

                },
                error: function () {
                }
            })
        });

        $(document).on('click', '#btnReportExcel', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.report.project.reportExportExcel")}}' + '?' + data;
            window.location.href = url;
        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.report.project.btnReportPDF")}}' + '?' + data;
            window.location.href = url;

        });

        var reports_getData = "{{route('reports.getData',8)}}";

        /* strategic_plan  change*/
        $(document).on('change', '#strategic_plan', function (e) {
            e.preventDefault();
            var strategic_id = $(this).val();
            $("#project_id option").remove();
            $('#project_id').selectpicker('refresh');
            $url = '{{route('project.project.getProjectByStrategicID')}}' + '/' + strategic_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.status == true) {
                        selectproject(data.projects);
                    }
                    $('#project_id').selectpicker('refresh');
                },
                error: function () {
                    $('#project_id').selectpicker('refresh');
                }
            });

        });

        function selectproject(data) {
            $("#project_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#project_id").append('<option value=' + index+ '>' + value + '</option>');
            });
        }

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
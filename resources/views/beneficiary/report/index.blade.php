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


            {!! Form::open(['route' => 'beneficiary.report.search' ,'action'=>'get' ,'id'=>'formSearch','class'=>'']) !!}

                @if($projects!= null)
                    <div class='col-md-12'>
                        <div class="row">
                            <label for='project_id' class='col-md-2 col-form-label'>
                                {{$labels['project_name'] ?? 'project_name'}}
                            </label>
                            <div class='col-md-10'>
                                <div class='form-group has-default bmd-form-group'>
                                  <select id="project_id" name="project_id" class="form-control  selectpicker" data-live-search='true' data-style='btn btn-link'>
                                      <option value=""></option>
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
                            {{$labels['activity_name'] ?? 'activity_name'}}
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
                    <label for='activity_sub_id' class='col-md-2 col-form-label'>
                        {{$labels['activity_sub_id'] ?? 'activity_sub_id'}}
                    </label>
                    <div class='col-md-10'>
                        <div class='form-group has-default bmd-form-group'>
                            {!! Form::select('activity_sub_id',[] , null, ['class' => 'form-control  selectpicker'  ,'data-live-search'=>'true' ,'id'=>'activity_sub_id' ,'data-style'=>'btn btn-link'])  !!}
                        </div>
                    </div>
                </div>
            </div>


                <div class='col-md-12'>
                    <div class="row">
                        <label for='indicator_id' class='col-md-2 col-form-label'>
                            {{$labels['indicator_name'] ?? 'indicator_name'}}
                        </label>
                        <div class='col-md-10'>
                            <div class='form-group has-default bmd-form-group'>
                                {!! Form::select('indicator_id',[] , null, ['class' => 'form-control  selectpicker'  ,'data-live-search'=>'true' ,'id'=>'indicator_id' ,'data-style'=>'btn btn-link'])  !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class="row">
                        <label for='result_id' class='col-md-2 col-form-label'>
                            {{$labels['result_name'] ?? 'result_name'}}
                        </label>
                        <div class='col-md-10'>
                            <div class='form-group has-default bmd-form-group'>
                                {!! Form::select('result_id',[] , null, ['class' => 'form-control  selectpicker'  ,'data-live-search'=>'true' ,'id'=>'result_id' ,'data-style'=>'btn btn-link'])  !!}
                            </div>
                        </div>
                    </div>
                </div>

            <div class='col-md-12'>
                <div class="row">
                    <label for='name' class='col-md-2 col-form-label'>
                        {{$labels['ben_name'] ?? 'ben_name'}}
                    </label>
                    <div class='col-md-10'>
                        <div class='form-group has-default bmd-form-group'>
                            {!! Form::text('name',null,  ['class' => 'form-control' ,'id'=>'name' ,'data-style'=>'btn btn-link'])  !!}
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

                <a href="{{route('reports.prepare',7)}}" class="btn btn-danger btn-sm "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="{{$labels['report_settings'] ?? 'report_settings'}}">
                    <i class="material-icons">settings</i>
                </a>

                <a href="{{route('beneficiary.famindv.report.btnReportPDF')}}"  class="btn btn-sm btn-primary"
                   target="_blank" id="btnReportPdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                    <i class="material-icons" >print</i> PDF
                </a>
                <a href="{{route('beneficiary.famindv.report.reportExportExcel')}}" class="btn btn-sm btn-info"
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

            active_nev_link('beneficiary_search')
        });

        $(document).on('change', '#project_id', function (e) {
            e.preventDefault();
            var project_id = $(this).val();
            $("#activity_id option").remove();
            $("#indicator_id option").remove();
            $("#result_id option").remove();
            $("#activity_id ").append("<option  style='height: 37px;' value></option>");
            $('#activity_id').selectpicker('refresh');
            $url = '{{route('beneficiary.report.index.activity')}}' + '/' + project_id;
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
            $("#indicator_id option").remove();
            $("#result_id option").remove();

            $("#indicator_id ").append("<option  style='height: 37px;' value></option>");
            $('#indicator_id').selectpicker('refresh');
            $url = '{{route('beneficiary.report.index.indicator')}}' + '/' + project_id + '/' + activity_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.indicators != null) {
                        selectIndicator(data['indicators']);
                    }
                    $('#indicator_id').selectpicker('refresh');
                },
                error: function () {
                }
            });

             $("#activity_sub_id option").remove();
            $("#activity_sub_id ").append("<option  style='height: 37px;' value></option>");
            $('#activity_sub_id').selectpicker('refresh');
            $url = '{{route('beneficiary.report.index.activity.sub')}}'+'/'+project_id+'/'+activity_id;
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

        function selectIndicator(data) {
            $.each(data, function (index, value) {
                $("#indicator_id").append('<option value=' + value['org_indic_id'] + '>' + value['indic_name_na'] + '</option>');
            });
        }

        function selectSubActivities(data) {
            $.each(data, function (index, value) {
                $("#activity_sub_id").append('<option value=' + value['id'] + '>' + value['activity_name_na'] + '</option>');
            });
        }



        $(document).on('change', '#indicator_id', function (e) {
            e.preventDefault();
            var project_id = $('#project_id').val();
            var activity_id = $('#activity_id').val();
            var indicator_id = $(this).val();
            $("#result_id option").remove();
            $("#result_id").append("<option  style='height: 37px;' value></option>");
            $('#result_id').selectpicker('refresh');
            $url = '{{route('beneficiary.report.index.result')}}' + '/' + project_id + '/' + activity_id + '/' + indicator_id;
            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.results != null) {
                        selectResult(data['results']);
                    }
                    $('#result_id').selectpicker('refresh');
                },
                error: function () {
                }
            });

        });

        function selectResult(data) {
            $.each(data, function (index, value) {
                $("#result_id").append('<option value=' + value['org_result_id'] + '>' + value['result_name_na'] + '</option>');
            });
        }

        /*open modal  report setting***/
        $(document).on('click', '#btnOpenModalReport', function (e) {
            e.preventDefault();

            // url = $(this).attr('href');
            url = '{{route("reports.prepare")}}' + '/' + 7;
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
            var url = '{{route("beneficiary.report.search")}}';
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
            var url = '{{route("beneficiary.report.reportExportExcel")}}'+'?'+data;
            window.location.href = url;

        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.report.btnReportPDF")}}'+'?'+data;
            window.location.href = url;

        });
        var reports_getData = "{{route('reports.getData',7)}}";

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
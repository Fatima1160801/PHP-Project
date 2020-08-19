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
                {{$labels['screen_report_beneficiary_activity'] ?? 'screen_report_beneficiary_activity'}}
            </h4>
        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'beneficiary.report.activity.search' ,'action'=>'get' ,'id'=>'formSearch','class'=>'']) !!}

                @if($activities!= null)
                    <div class='col-md-12'>
                        <div class="row">
                            <label for='activity_id' class='col-md-2 col-form-label'>
                                {{$labels['activity_name'] ?? 'activity_name'}}
                            </label>
                            <div class='col-md-10'>
                                <div class='form-group has-default bmd-form-group'>
                                  <select id="activity_id" name="activity_id" class="form-control  selectpicker" data-live-search='true' data-style='btn btn-link'>
                                      <option value=""></option>
                                      @foreach($activities as $activity)
                                          <option value="{{$activity->id}}">{{$activity->activity_name_na}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
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

            <div class="col-md-12">

                <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                        id="saveProjectMain">
                    {{$labels['search'] ?? 'search'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>

                <a href="{{route('reports.prepare',9)}}" class="btn btn-danger btn-sm "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="{{$labels['report_settings'] ?? 'report_settings'}}">
                    <i class="material-icons">settings</i>
                </a>

                <a href="{{route('beneficiary.report.activity.btnReportPDF')}}"  class="btn btn-sm btn-primary"
                   target="_blank" id="btnReportPdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                    <i class="material-icons" >print</i> PDF
                </a>
                <a href="{{route('beneficiary.report.activity.reportExportExcel')}}" class="btn btn-sm btn-info"
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
            active_nev_link('nav-link-beneficiary-activity');

        });

        $(document).on('change', '#activity_id', function (e) {
            e.preventDefault();
             var activity_id = $(this).val();
            $("#activity_sub_id option").remove();
            $("#activity_sub_id ").append("<option  style='height: 37px;' value></option>");
            $('#activity_sub_id').selectpicker('refresh');
            $url = '{{route('beneficiary.report.activity.sub')}}'+'/'+activity_id;
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
            url = '{{route("reports.prepare")}}' + '/' + 9;
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
            var url = '{{route("beneficiary.report.activity.search")}}';
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

                    setTimeout(function(){
                        DataTableCall('#table');
                    }, 1000);

                },
                error: function () {
                }
            })
        });

        $(document).on('click', '#btnReportExcel', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.report.activity.reportExportExcel")}}'+'?'+data;
            window.location.href = url;
        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.report.activity.btnReportPDF")}}'+'?'+data;
            window.location.href = url;
        });


        var reports_getData = "{{route('reports.getData',9)}}";

    </script>
@endsection


@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>

    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}">
    </script> <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>

    <script src="{{ asset('js/modal_setting.js')}}"></script>
    <script src="{{ asset('js/wizardReport.js')}}"></script>

@endsection

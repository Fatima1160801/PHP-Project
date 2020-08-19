@extends('layouts._layout')

@section('css')

@stop
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['screen_report_beneficiary'] ?? 'screen_report_beneficiary'}}
            </h4>

        </div>
        <div class="card-body ">

            {!! Form::open(['route' => 'beneficiary.famindv.report.search' ,'action'=>'get' ,'id'=>'formSearch','class'=>'']) !!}

            {!! $html !!}
            <div class="col-md-12">

                <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                        id="saveProjectMain">
                    {{$labels['search'] ?? 'search'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>

                <a href="{{route('reports.prepare',5)}}" class="btn btn-danger btn-sm "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="{{$labels['report_settings'] ?? 'report_settings'}}">
                    <i class="material-icons">settings</i>
                    {{$labels['report_settings'] ?? 'report_settings'}}
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

            <div class="" id="report-data">
                {{--<div class="loader-div" align="center"></div>--}}
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script>
        $(document).ready(function () {
          //  retriveReportData();
            $('.selectpicker').selectpicker();

            datetimepicker();
            active_nev_link('{{$id}}');
        });

        function datetimepicker() {
            $('.datetimepicker').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                },
                format: 'DD/MM/YYYY'
            });
        }

        /*open modal  report setting***/
        $(document).on('click', '#btnOpenModalReport', function (e) {
            e.preventDefault();

            // url = $(this).attr('href');
            url = '{{route("reports.prepare")}}' + '/' + 5;
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
                    // setTimeout(function () {
                    //     selectpicker();
                    //     $('#wizardGoalStyle .card-body').perfectScrollbar();
                    // }, 200);
                },
                error: function () {
                }
            });
        });

        $(document).on('hidden.bs.modal', '#modalReport', function () {
            retriveReportData();
        });

        function retriveReportData() {
            var url = '{{route("reports.getData",5)}}';
            $.get(url,
                function (data) {
                    if (data.status != 'false') {
                        $('#report-data').empty();
                        $('#report-data').html(data);
                    }
                    else {
                        $('[href="#preparing"]').click();
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                });
        }


        // beneficiary.report.search

        $(document).on('submit', '#formSearch', function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var url = '{{route("beneficiary.famindv.report.search")}}';
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
                    }
                    else {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }


                },
                error: function () {
                }
            })
        });

        //beneficiary.report.reportExportExcel

        $(document).on('click', '#btnReportExcel', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.famindv.report.reportExportExcel")}}'+'?'+data;
            window.location.href = url;

        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formSearch').serialize();
            var url = '{{route("beneficiary.famindv.report.btnReportPDF")}}'+'?'+data;
            window.location.href = url;

        });

        var reports_getData = "{{route('reports.getData',5)}}";

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

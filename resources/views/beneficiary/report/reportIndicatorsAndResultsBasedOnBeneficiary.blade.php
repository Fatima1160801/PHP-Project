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
                {{$labels['reportIndicatorsAndResultsBasedOnBeneficiary'] ?? 'reportIndicatorsAndResultsBasedOnBeneficiary'}}
            </h4>

        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'beneficiary.searchIndicatorsAndResultsBasedOnBeneficiary' ,'action'=>'get' ,'id'=>'formProjectSearch','class'=>'']) !!}


            <div class="col-md-12">
                <div class="row">
                    <label class="col-md-2 col-form-label" for="task_name">
                        {{$labels['beneficiary_name'] ?? 'beneficiary_name'}}
                    </label>
                    <div class=" col-md-10">
                        <div class='form-group has-default bmd-form-group'>
                            <select class='form-control selectpicker' data-live-search="true" name='beneficiary_id'
                                    id='beneficiary_id'
                                    data-style='btn btn-link'>
                                <option style='height: 37px;' value></option>
                                @if($beneficiaries)
                                    @foreach($beneficiaries as $key=>$c)
                                        <option value="{{$key}}">{{ $c }}</option>
                                    @endforeach
                                @endif
                            </select>
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

                <a href="#" class="btn btn-danger btn-sm "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="{{$labels['report_settings'] ?? 'report_settings'}}">
                    <i class="material-icons">settings</i>

                </a>
                <a href="#"
                   class="btn btn-sm btn-primary"
                   target="_blank" id="btnReportPdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                    <i class="material-icons">print</i> PDF
                </a>
                <a href="#"
                   class="btn btn-sm btn-info"
                   data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
                    <i class="material-icons">print</i> Excel
                </a>

                <a href="#" class="btn btn-default btn-sm" id="btnNew">
                    {{$labels['new'] ?? 'new'}}
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
            // retriveReportData();
            $('.selectpicker').selectpicker();

            datetimepicker();
            active_nev_link('reportIndicatorsAndResultsBasedOnBeneficiary');
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


        $(document).on('click', '#btnOpenModalReport', function (e) {
            e.preventDefault();
            // url = $(this).attr('href');
            url = '{{route("reports.prepare")}}' + '/' + 16;
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
                    $('.selectpicker').selectpicker();

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
            var url = '{{route("reports.getData",16)}}';
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
        // project.project.search
        $(document).on('submit', '#formProjectSearch', function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var url = '{{route("beneficiary.searchIndicatorsAndResultsBasedOnBeneficiary")}}';
            $.ajax({
                url: url,
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#report-data').html('<div class="col-md-12" align="center"> <div class="loader-div"></div></div>');
                },
                success: function (data) {
                    if (data.status == 'false') {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('#report-data').empty();
                    $('#report-data').html(data);
                    $('.selectpicker').selectpicker({
                        @if(Auth::user()->lang_id == 2 )
                        noneSelectedText: 'لم يتم تحديد شيء',
                        @endif
                    });
                    // setTimeout(function(){
                    //     $('#table').DataTable({
                    //         language: {
                    //             search: "_INPUT_",
                    //             searchPlaceholder: "Search records",
                    //         }
                    //     });
                    // }, 1000);
                },
                error: function () {
                }
            })
        });
        //project.project.reportExportExcel
        $(document).on('click', '#btnReportExcel', function (e) {
            e.preventDefault();
            data = $('#formProjectSearch').serialize();
            var url = '{{route("beneficiary.reportExportExcelIndicatorsAndResultsBasedOnBeneficiary")}}' + '?' + data;
            window.location.href = url;

        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formProjectSearch').serialize();
            var url = '{{route("beneficiary.reportExportPDFIndicatorsAndResultsBasedOnBeneficiary")}}' + '?' + data;
            window.location.href = url;

        });
        var reports_getData = "{{route('reports.getData',16)}}";
        $(document).on('click', '#btnNew', function (e) {
            e.preventDefault();
            $('#beneficiary_id').val('');
            $('#beneficiary_id').selectpicker('refresh');
        })
    </script>

@endsection


@section('js')


    <!-- Forms Validations Plugin -->
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

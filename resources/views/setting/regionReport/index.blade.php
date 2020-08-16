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
                {{$labels['region_report'] ?? 'region_report'}}
            </h4>

        </div>
        <div class="card-body ">

            {!! Form::open(['route' => 'region.report.search' ,'action'=>'get' ,'id'=>'formSearch','class'=>'']) !!}

            <div class='col-md-12'>
                <div class="row">
                    <label for='city_id' class='col-md-2 col-form-label'>
                        {{$labels['c_cities_id'] ?? 'c_cities_id'}}
                    </label>
                    <div class='col-md-10'>
                        <div class='form-group has-default bmd-form-group'>
                            <select id="city_id" name="city_id" class="form-control  selectpicker"
                                    data-live-search='true' data-style='btn btn-link'>
                                <option value="" style="height: 30px"></option>
                                @if($cities!= null)

                                    @foreach($cities as $city=>$key)

                                        <option value="{{$key}}">{{$city }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class='col-md-12'>
                <div class="row">
                    <label for='district_id' class='col-md-2 col-form-label'>
                        {{$labels['c_districts_id'] ?? 'c_districts_id'}}
                    </label>
                    <div class='col-md-10'>
                        <div class='form-group has-default bmd-form-group'>
                            <select id="district_id" name="district_id" class="form-control  selectpicker"
                                    data-live-search='true' data-style='btn btn-link'>
                                    <option value="" style="height: 30px"></option>

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

                <a href="{{route('reports.prepare',21)}}" class="btn btn-danger btn-sm "
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


        </div>
        <div class="card-body ">
            <div class="" id="report-data">
                {{--<div class="loader-div" align="center" disabled="disabled"></div>--}}
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker({
                @if(Auth::user()->lang_id == 2 )
                noneSelectedText: 'لم يتم تحديد شيء',
                @endif
            });
            datetimepicker();
            active_nev_link('region_report')
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


        $(document).on('change', '#formSearch #city_id', function (e) {
            e.preventDefault();
            var city_id = $(this).val();
            $url = '{{route("region.report.getDistanceByCityId")}}' + '/' + city_id;

            $.ajax({
                url: $url,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    $("#district_id option").remove();
                    $("#district_id ").append("<option  style='height: 37px;' value></option>");
                    $('#district_id').selectpicker('refresh');
                },
                success: function (data) {
                    if (data != null) {
                        selectDestrice(data);
                    }

                    $('#district_id').selectpicker('refresh');
                },
                error: function () {
                }
            });
        });

        function selectDestrice(data) {
            $.each(data, function (index, value) {
                $("#district_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }



        /*open modal  report setting***/
        $(document).on('click', '#btnOpenModalReport', function (e) {
            e.preventDefault();

            // url = $(this).attr('href');
            url = '{{route("reports.prepare")}}' + '/' + 21;
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
            var url = '{{route("reports.getData",21)}}';
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
        $(document).on('submit', '#formSearch', function (e) {
            e.preventDefault();
            data = $(this).serialize();

            var url = '{{route("region.report.search")}}';
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
                    $('.selectpicker').selectpicker();
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
            data = $('#formSearch').serialize();
            var url = '{{route("region.report.excel")}}' + '?' + data;
            window.location.href = url;

        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formProjectSearch').serialize();
            var url = '{{route("region.report.pdf")}}' + '?' + data;
            window.location.href = url;

        });
        var reports_getData = "{{route('reports.getData',21)}}";
        $(document).on('click', '#btnNew', function (e) {
            e.preventDefault();
            $('#district_id').val('');
            $('#district_id').selectpicker('refresh');
            $('#city_id').val('');
            $('#city_id').selectpicker('refresh');

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

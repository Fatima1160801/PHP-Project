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
                {{$labels['screen_report_vendor'] ?? 'screen_report_vendor'}}
            </h4>

        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'vendors.search' ,'action'=>'get' ,'id'=>'formProjectSearch','class'=>'']) !!}

            {!! $html !!}
            <div class="col-md-12">

                <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                        id="saveProjectMain">
                    {{$labels['search'] ?? 'search'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>
                <a href="{{route('reports.prepare',23)}}" class="btn btn-sm btn-danger "
                   rel="tooltip" data-placement="top" id="btnOpenModalReport"
                   data-toggle="modal" data-target="#modalReport"
                   title="{{$labels['report_settings'] ?? 'report_settings'}}">
                    <i class="material-icons">settings</i>
                </a>


                <a href="{{route('vendors.btnReportPDF')}}"  class="btn btn-sm btn-primary"
                   target="_blank" id="btnReportPdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                    <i class="material-icons" >print</i> PDF
                </a>
                <a href="{{route('vendors.reportExportExcel')}}" class="btn btn-sm btn-info"
                   data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
                    <i class="material-icons">print</i> Excel
                </a>
            </div>
            {!! Form::close() !!}

            <div class="" id="report-data">
                <div class="loader-div" align="center"></div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script>
        $(document).ready(function () {
           retriveReportData();
            document.getElementById("sort_then").disabled = true;
       // }
        {{--    $('.selectpicker').selectpicker();--}}
        {{--    datetimepicker();--}}
        {{--    active_nev_link('{{$id}}');--}}
        });

        {{--function datetimepicker() {--}}
        {{--    $('.datetimepicker').datetimepicker({--}}
        {{--        icons: {--}}
        {{--            time: "fa fa-clock-o",--}}
        {{--            date: "fa fa-calendar",--}}
        {{--            up: "fa fa-chevron-up",--}}
        {{--            down: "fa fa-chevron-down",--}}
        {{--            previous: 'fa fa-chevron-left',--}}
        {{--            next: 'fa fa-chevron-right',--}}
        {{--            today: 'fa fa-screenshot',--}}
        {{--            clear: 'fa fa-trash',--}}
        {{--            close: 'fa fa-remove'--}}
        {{--        },--}}
        {{--        format: 'DD/MM/YYYY'--}}
        {{--    });--}}
        {{--}--}}
        $( "#country_id" ).change(function() {
            var state = $('#country_id').find(":selected").val();
            getState(state);
        });
        function getState(state) {
            $("#country_id_loader").show();
            var list1 ="<option selected  value=''></option>";
            $id=state;
            $.get('{{url('/state/by/country')}}'+'/'+$id,function(data){
                $.each(data.list, function (index, value) {
                    list1+='<option value=' +index + '>' + value + '</option>';
                });
                $("#state_id").html(list1);
                $("#state_id").selectpicker("refresh");

                $("#country_id_loader").hide();
            });
        }

        $( "#state_id" ).change(function() {
            var state = $('#state_id').find(":selected").val();
            getCity(state);
        });
        function getCity(state) {
            $("#state_id_loader").show();
            var list2 ="<option selected  value=''></option>";
            $id=state;
            $.get('{{url('/city/by/state')}}'+'/'+$id,function(data){
                $.each(data.list, function (index, value) {
                    list2+='<option value=' +index + '>' + value + '</option>';
                });
                $("#city_id").html(list2);
                $("#city_id").selectpicker("refresh");

                $("#state_id_loader").hide();
            });
        }
        $( "#sort_by" ).change(function() {

            var len=document.getElementById("sort_then").options.length;

            for ( var i = 0; i < len; i++ ) {
                 document.getElementById("sort_then").options[i].disabled=false;

            }
            var sort_val =$( "#sort_by option:selected" ).val();
            alert(sort_val);
            var val=document.getElementById("sort_by").options[document.getElementById("sort_by").selectedIndex].value;
            if(sort_val==0){
                $("#sort_then select").prop("disabled", true);


            }
            else{
                $("#sort_then select").prop("disabled", false);
                // for (var i = 1; i < len; i++) {
                //     opt = document.getElementById("sort_then").options[i];
                //     if (opt.value === val) {
                //         opt.disabled = true;
                //     }
                // }

                }
            $("#sort_then").selectpicker();
            // }
            // else{
            //     document.getElementById("sort_then").disabled=true;
            // }

        });


        $( "#sort_then" ).change(function() {

            var len=document.getElementById("sort_by").options.length;

            for ( var i = 0; i < len; i++ ) {
                document.getElementById("sort_by").options[i].disabled=false;

            }
            var val=document.getElementById("sort_then").options[document.getElementById("sort_then").selectedIndex].value;
            // if(val) {
           // document.getElementById("sort_then").disabled = false;
            for (var i = 1; i < len; i++) {
                opt = document.getElementById("sort_by").options[i];
                if (opt.value === val) {
                    opt.disabled = true;
                }

            }
        });
        /*open modal  report setting***/
        $(document).on('click', '#btnOpenModalReport', function (e) {
            e.preventDefault();

            // url = $(this).attr('href');
            url = '{{route("reports.prepare")}}' + '/' + 23;
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
            var url = '{{route("reports.getData",23)}}';
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
            var url = '{{route("vendors.search")}}';
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
                   // $('.selectpicker').selectpicker();
                    setTimeout(function(){
                     //   DataTableCall('#table');
                    }, 1000);

                },
                error: function () {
                }
            })
        });

        //project.project.reportExportExcel

        $(document).on('click', '#btnReportExcel', function (e) {
            e.preventDefault();
            data = $('#formProjectSearch').serialize();
            var url = '{{route("vendors.reportExportExcel")}}'+'?'+data;
            window.location.href = url;

        });
        $(document).on('click', '#btnReportPdf', function (e) {
            e.preventDefault();
            data = $('#formProjectSearch').serialize();
            var url = '{{route("vendors.btnReportPDF")}}'+'?'+data;
            window.location.href = url;

        });

        var reports_getData = "{{route('reports.getData',2)}}";
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

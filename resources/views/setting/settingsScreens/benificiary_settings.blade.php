@extends('layouts._layout')
@section('css')
    @include('setting.settingsScreens.settings_style')
    <style>
        .card .card-body .col-form-label, .card .card-body .label-on-right{
            margin-right: -21px;
        }
        #activity_lessons_type_name_na,#activity_lessons_related_name_na{
            margin-left: -51px;
        }
    </style>
@endsection
@section('content')
    <div class="container col-md-12 ml-2">
        <div class="row mt-4" id="containerc" style="padding:30px;">
            <div class="col-md-3 card p-3 mr-4">
                <ul class="navbar-nav mailli33">
                    <li class="nav-item mb-3 selected-item" id="beneficiary" data-nameeng="{{$labels['families_individuals'] ?? 'families_individuals'}}" data-namear="{{$labels['families_individuals'] ?? 'families_individuals'}}" data-value="1">
                        <a href="#"
                           class="navi-link py-4 ">
                            <div class="card-icon ">
                                <span>  <i class="material-icons default-color mr-2 "
                                    >local_offer</i>{{$labels['families_individuals'] ?? 'families_individuals'}}</span>
                            </div>
                        </a>

                    </li>
                    <li class="nav-item mb-3 " id="organizations" data-nameeng="{{$labels['organizations'] ?? 'organizations'}}" data-namear="{{$labels['organizations'] ?? 'organizations'}}" data-value="2">
                        <a href="#"
                           class="navi-link py-4">
                            <div class="card-icon">
                                <span>  <i class='material-icons'>weekend</i> {{$labels['organizations'] ?? 'organizations'}}</span>
                            </div>
                        </a>

                    </li>
                    <li class="nav-item mb-3 " id="Localities" data-nameeng="{{$labels['Localities-link'] ?? 'Localities-link'}}" data-namear="{{$labels['Localities-link'] ?? 'Localities-link'}}" data-value="3">
                        <a href="#"
                           class="navi-link py-4">
                            <div class="card-icon">
                                <span>  <i class='material-icons'>weekend</i>{{$labels['Localities-link'] ?? 'Localities-link'}}</span>
                            </div>
                        </a>

                    </li>

                </ul>
            </div>
            <div class="col-md-8 p-3 card"><div class="card-title" id="content">
                    <label id="title" style="font-weight: bold;font-size: 19px !important;"></label>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<span id="add"></span>
                </div>
                <div id="loadScreen" class="col-md-2" style="padding-left:300px;"><div class="loader pull-center" style="display: none;width: 30px;
 height: 30px;"></div></div>

                <div id="render_result">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="procurementModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="brandModal">
                <div class="card card-signup card-plain">
                    <div class="modal-body" id="procurementModalBody">
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    @include('beneficiary.families_individuals.create_script')
    @include('beneficiary.families_individuals.script_render')
    @include('beneficiary.families_individuals.update_script')
    @include('beneficiary.organizations.update_script')
    @include('beneficiary.organizations.script_render')
    @include('beneficiary.organizations.create_script')
    @include('locality.create_script')
    @include('locality.script_render')
    @include('locality.update_script')
    <script>
        $(document).ready(function() {
            defaultVal();
        });

        $("#beneficiary").click(function (e) {
            addSelected($("#beneficiary").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            e.preventDefault();
           defaultVal();
        });

        $("#organizations").click(function (e) {
            addSelected($("#organizations").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            e.preventDefault();
            $('#loadScreen div.loader').show();
            $.get('{{route('beneficiary.oraganizations.index')}}',function(data){
                if(data.status==true){
                    if(lang==1)
                        $("#title").html($("#organizations").attr("data-nameeng"));
                    else
                        $("#title").html($("#organizations").attr("data-namear"))
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    // $("#add").html("<a href=\"#\" onclick='addOrganizations()' id='addOrganizations' class=\"mytooltip btn-setting-nav add\"\n" +
                    //     "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    //     "               title=\"\" >\n" +
                    //     "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add</span></a>\n" +
                    //     "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',6);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                    var table = $('#table').DataTable();
                    table
                        .order( [0, 'desc' ] )
                        .draw();
                }else{
                }
            });
        });

        $("#Localities").click(function (e) {
            addSelected($("#Localities").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            e.preventDefault();
            $('#loadScreen div.loader').show();
            $.get('{{route('locality')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#Localities").attr("data-nameeng"));
                    else
                        $("#title").html($("#Localities").attr("data-namear"))
                    $("#add").html("<a href=\"#\" onclick='addLocalities()' id='addLocalities' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">add</span></a>\n" +
                        "            </span> </h4>");
                    //$('#table').DataTable().ajax.reload();
                    DataTableCall('#table',6);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                    var table = $('#table').DataTable();
                    table
                        .order( [0, 'desc' ] )
                        .draw();
                }else{
                }
            });
        });

        function addSelected(value){
            $(".mailli33 .nav-item").removeClass("selected-item");
            if(value==1){
                $("#beneficiary").addClass("selected-item");
            }
            else  if(value==2){
                $("#organizations").addClass("selected-item");
            }
            else{
                $("#Localities").addClass("selected-item");
            }
        }
        function addLocalities(){
            $.get('{{route('locality.create')}}',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        }
        function addFam_indev(){
            $.get('{{route('beneficiary.fam_indev.create')}}',function(data){
                if(data.status==true) {
                    $("#render_result").html(data.html);
                    // $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    // $('#procurementModal').modal({
                    //     show: true
                    // });
                }
            });
        }

        function addOrganizations(){
            $.get('{{route('beneficiary.oraganizations.create')}}',function(data){
                if(data.status==true) {
                    $("#render_result").html(data.html);
                    // $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    // $('#procurementModal').modal({
                    //     show: true
                    // });
                }
            });
        }

        $(document).on("click", ".editLocalityNew", function (e) {
            e.preventDefault();
            var val=$(this).attr("data-id");
            $.get('{{url('locality')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        });

        $(document).on("click", ".editFamIndNew", function (e) {
            e.preventDefault();
            var val=$(this).attr("data-id");
            $.get('{{url('beneficiary/fam_indev')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#render_result").html(data.html);
                    // $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    // $('#procurementModal').modal({
                    //     show: true
                    // });
                }
            });
        });

        $(document).on("click", ".editOrganzNew", function (e) {
            e.preventDefault();
            var val=$(this).attr("data-id");
            $.get('{{url('beneficiary/oraganizations/')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#render_result").html(data.html);
                    // $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    // $('#procurementModal').modal({
                    //     show: true
                    // });
                }
            });
        });
function defaultVal(){
    $("#beneficiary").addClass("selected-item");
            $("#organizations").removeClass("selected-item");
            $("#Localities").removeClass("selected-item");
    $('#loadScreen div.loader').show();
    $.get('{{route('beneficiary.fam_indev.index')}}',function(data){
        if(data.status==true){
            $("#render_result").html(data.html);
            $('#loadScreen div.loader').hide();
            var lang=@json($lang);
            if(lang==1)
                $("#title").html($("#beneficiary").attr("data-nameeng"));
            else
                $("#title").html($("#beneficiary").attr("data-namear"))
            // $("#add").html("<a href=\"#\" onclick='addFam_indev()' id='addFam_indev' class=\"mytooltip btn-setting-nav add\"\n" +
            //     "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
            //     "               title=\"\" >\n" +
            //     "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add</span></a>\n" +
            //     "            </span> </h4>");
            // $('#table').DataTable().ajax.reload();
            DataTableCall('#table',6);
            $("#table_length").html("");
            $("#table_filter").html("");
            var table = $('#table').DataTable();
            table
                .order( [0, 'desc' ] )
                .draw();
        }else{
        }
    });
}
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
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
       #table{
            margin-top: -12%  !important;
        }
    </style>
@endsection
@section('content')
<div class="container ml-2">
    <div class="row" id="containerc" style="padding:30px;">
        <div class="col-md-3 card p-3 mr-4">
            <ul class="navbar-nav mailli33">
                <li class="nav-item mb-3 selected-item" id="role" data-nameeng="Institution Roles" data-namear="العلامات التجارية" data-value="1">
                    <a href="#"
                       class="navi-link py-4 ">
                        <div class="card-icon ">
                                <span>  <i class="material-icons default-color mr-2 "
                                    >local_offer</i>@if($lang==1)Institution Role @elseدور المؤسسة@endif</span>
                        </div>
                    </a>

                </li>
{{--                <li class="nav-item mb-3 " id="visit" data-nameeng="Visits Types" data-namear="نوع الزيارات" data-value="2">--}}
{{--                    <a href="#"--}}
{{--                       class="navi-link py-4">--}}
{{--                        <div class="card-icon">--}}
{{--                            <span>  <i class='material-icons'>weekend</i>&nbsp;&nbsp;&nbsp;&nbsp;@if($lang==1)Visits Types @elseنوع الزيارات @endif</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}

{{--                </li>--}}
                <li class="nav-item mb-3 " id="achievement" data-nameeng="Achievement Types" data-namear="أنواع الإنجاز" data-value="3">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>card_giftcard</i>&nbsp;&nbsp;@if($lang==1)Achievement Types @elseأنواع الإنجاز@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="achievementty" data-nameeng="Indicators Measure Units" data-namear="وحدات القياس للمؤشرات" data-value="4">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>straighten</i>&nbsp;&nbsp;@if($lang==1)Indicators Measure Units @elseوحدات القياس للمؤشرات@endif</span>
                        </div>
                    </a>

                </li>

                <li class="nav-item mb-3 " id="income" data-nameeng="Income Range" data-namear="معدل الدخل" data-value="5">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>payment</i>&nbsp;&nbsp;@if($lang==1)Income Range @elseمعدل الدخل@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="currencies" data-nameeng="Currencies" data-namear="العملات" data-value="6">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>money</i>&nbsp;&nbsp;@if($lang==1)Currencies @elseالعملات@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="issue" data-nameeng="Issues Types" data-namear="أنواع القضايا" data-value="7">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>subject</i>&nbsp;&nbsp;@if($lang==1)Issues Types @elseأنواع القضايا@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="issuesetting" data-nameeng="Issue Relations Setting" data-namear="إعدادات القضايا" data-value="8">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>settings</i>&nbsp;&nbsp;@if($lang==1)Issue Relations Setting @elseإعدادات القضايا@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="task" data-nameeng="Tasks Types" data-namear="أنواع المهمات" data-value="9">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>list</i>&nbsp;&nbsp;@if($lang==1)Tasks Types @elseأنواع المهمات@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="fundertype" data-nameeng="Funder Types" data-namear="أنواع الممولون" data-value="10">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>business_center</i>&nbsp;&nbsp;@if($lang==1)Funder Types @elseأنواع الممولون@endif</span>
                        </div>
                    </a>

                </li>

            </ul>
        </div>
        <div class="col-md-8 p-3 card" style="width:2000px;"><div class="card-title" id="content">
                <label id="title" style="font-weight: bold;font-size: 19px !important;"></label>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<span id="add"></span>
            </div>
            <div id="loadScreen" class="col-md-2" style="padding-left:300px;"><div class="loader pull-center" style="display: none;width: 30px;
 height: 30px;"></div></div>

            <div id="render_result" style="min-height: 400px;" >

            </div>
        </div>
    </div>
</div>
{{--   Start Modal--}}
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
    @include('project.projectcategories.othersettings_script')
    <script>
        measure=[];
    $(document).ready(function() {
    defaultVal();
        active_nev_link('incomeRange-link');
        active_nev_link('project_category');
        active_nev_link('visittypeSettings');
        active_nev_link('indicators_measure_unit');
        active_nev_link('currency-link');
        active_nev_link('activity_lessons_type');
        active_nev_link('activity_lessons_related');
        active_nev_link('achievementtypeSettings');
        active_nev_link('donor_types');
        active_nev_link('donors1');
        active_nev_link('task-Type-link');
        funValidateForm();
    });
    $("#role").click(function (e) {
    addSelected($("#role").attr("data-value"));
    $("#add").html("");
    $("#title").html("");
    $("#render_result").html("");
    e.preventDefault();
    defaultVal();
    });

    $("#visit").click(function (e) {
        addSelected($("#visit").attr("data-value"));
        $("#add").html("");
        $("#title").html("");
        $("#render_result").html("");
        e.preventDefault();
        $('#loadScreen div.loader').show();
        $.get('{{route('settings.visit.type.index')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#visit").attr("data-nameeng"));
                else
                    $("#title").html($("#visit").attr("data-namear"))
                $("#add").html("<a href=\"#\" onclick='addVisit()' id='addVisit' class=\"mytooltip btn-setting-nav add\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Visit Type</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',5);
                $("#table_length").html("");
                $("#table_filter").html("");
                        {{--                            @include('setting.c.city.location_script');--}}

                var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                table
                    .order( [0, 'desc' ] )
                    .draw();

            }else{

            }
        });

    });
    $("#achievementty").click(function (e) {
        addSelected($("#achievementty").attr("data-value"));
        $("#add").html("");
        $("#title").html("");
        $("#render_result").html("");
        e.preventDefault();
        $('#loadScreen div.loader').show();
        $.get('{{route('goals.indicators.measure.unit.index')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#achievementty").attr("data-nameeng"));
                else
                    $("#title").html($("#achievementty").attr("data-namear"))
                $("#add").html("<a href=\"#\" onclick='addAchType()' id='addAchType' class=\"mytooltip btn-setting-nav add\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Unit</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',3);
                $("#table_length").html("");
                $("#table_filter").html("");
                        {{--                            @include('setting.c.city.location_script');--}}

                var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                table
                    .order( [0, 'desc' ] )
                    .draw();

            }else{

            }
        });

    });
    $("#income").click(function (e) {
        addSelected($("#income").attr("data-value"));
        $("#add").html("");
        $("#title").html("");
        $("#render_result").html("");
        e.preventDefault();
        $('#loadScreen div.loader').show();
        $.get('{{route('settings.incomeRange.index')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#income").attr("data-nameeng"));
                else
                    $("#title").html($("#income").attr("data-namear"))
                $("#add").html("<a href=\"#\" onclick='addIncome()' id='addIncome' class=\"mytooltip btn-setting-nav add\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Income Range</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',4);
                $("#table_length").html("");
                $("#table_filter").html("");
                        {{--                            @include('setting.c.city.location_script');--}}

                var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                table
                    .order( [0, 'desc' ] )
                    .draw();

            }else{

            }
        });

    });
    $("#issue").click(function (e) {
        addSelected($("#issue").attr("data-value"));
        $("#add").html("");
        $("#title").html("");
        $("#render_result").html("");
        e.preventDefault();
        $('#loadScreen div.loader').show();
        $.get('{{route('activity.lessons.type')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#issue").attr("data-nameeng"));
                else
                    $("#title").html($("#issue").attr("data-namear"))
                $("#add").html("<a href=\"#\" onclick='addIssue()' id='addIssue' class=\"mytooltip btn-setting-nav add\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Issue</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',4);
                $("#table_length").html("");
                $("#table_filter").html("");
                        {{--                            @include('setting.c.city.location_script');--}}

                var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                table
                    .order( [0, 'desc' ] )
                    .draw();

            }else{

            }
        });

    });
    $("#issuesetting").click(function (e) {
        addSelected($("#issuesetting").attr("data-value"));
        $("#add").html("");
        $("#title").html("");
        $("#render_result").html("");
        e.preventDefault();
        $('#loadScreen div.loader').show();
        $.get('{{route('activity.lessons.related')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#issuesetting").attr("data-nameeng"));
                else
                    $("#title").html($("#issuesetting").attr("data-namear"))
                $("#add").html("<a href=\"#\" onclick='addIssueSetting()' id='addIssueSetting' class=\"mytooltip btn-setting-nav add\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',4);
                $("#table_length").html("");
                $("#table_filter").html("");
                        {{--                            @include('setting.c.city.location_script');--}}

                var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
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
            $("#role").addClass("selected-item");

        }
        else  if(value==2){
            $("#visit").addClass("selected-item");

        }
        else  if(value==3){
            $("#achievement").addClass("selected-item");
        }
        else  if(value==4){
            $("#achievementty").addClass("selected-item");
        }
        else  if(value==5){
            $("#income").addClass("selected-item");
        }
        else  if(value==6){
            $("#currencies").addClass("selected-item");

        }
        else  if(value==7){
            $("#issue").addClass("selected-item");

        }
        else  if(value==8){
            $("#issuesetting").addClass("selected-item");

        }
        else  if(value==9){
            $("#task").addClass("selected-item");

        }
        else{
            $("#fundertype").addClass("selected-item");

        }

    }
    function defaultVal(){
        $('#loadScreen div.loader').show();
        $.get('{{route('project.projectcategories.index')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#role").attr("data-nameeng"));
                else
                    $("#title").html($("#role").attr("data-namear"))
                $("#add").html("<a href=\"#\" onclick='addRole()' id='addRole' class=\"mytooltip btn-setting-nav add\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Role</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',5);
                $("#table_length").html("");
                $("#table_filter").html("");
                        {{--                            @include('setting.c.city.location_script');--}}

                var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                table
                    .order( [0, 'desc' ] )
                    .draw();

            }else{

            }
        });


    }
    $("#currencies").click(function (e) {
        addSelected($("#currencies").attr("data-value"));
        $("#add").html("");
        $("#title").html("");
        $("#render_result").html("");
        e.preventDefault();
        $('#loadScreen div.loader').show();
        $.get('{{route('settings.currency')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#currencies").attr("data-nameeng"));
                else
                    $("#title").html($("#currencies").attr("data-namear"))
                $("#add").html("<a href=\"#\" onclick='addCurrency()' id='addCurrency' class=\"mytooltip btn-setting-nav add\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Currency</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',4);
                $("#table_length").html("");
                $("#table_filter").html("");
                        {{--                            @include('setting.c.city.location_script');--}}

                var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                table
                    .order( [0, 'desc' ] )
                    .draw();

            }else{

            }
        });

    });
    $("#achievement").click(function (e) {
        addSelected($("#achievement").attr("data-value"));
        $("#add").html("");
        $("#title").html("");
        $("#render_result").html("");
        // $("#procurementModal").addClass("modalSize")

        $('#loadScreen div.loader').show();
        e.preventDefault();
        index();
    });
        $("#fundertype").click(function (e) {
            addSelected($("#fundertype").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            e.preventDefault();
            $('#loadScreen div.loader').show();
            $.get('{{route('project.donors.types.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#fundertype").attr("data-nameeng"));
                    else
                        $("#title").html($("#fundertype").attr("data-namear"))
                    $("#add").html("<a href=\"#\" onclick='addFunderType()' id='addVisit' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add </span></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',5);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });
        $("#task").click(function (e) {
            addSelected($("#task").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            e.preventDefault();
            $('#loadScreen div.loader').show();
            $.get('{{route('settings.taskType')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#task").attr("data-nameeng"));
                    else
                        $("#title").html($("#task").attr("data-namear"))
                    $("#add").html("<a href=\"#\" onclick='addTask()' id='addTask' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add </span></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',5);
                    $("#table_length").html("");
                    $("#table_filter").html("");

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });
        function addTask() {
            $.get('{{route('settings.taskType.create')}}',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        }
    function addRole() {
        $.get('{{route('project.projectcategories.create')}}',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    }
    function addIncome(){
        $.get('{{route('settings.incomeRange.create')}}',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    }
    function addIssue() {
        $.get('{{route('activity.lessons.type.create')}}',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    }
    function addIssueSetting() {
        $.get('{{route('activity.lessons.related.create')}}',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    }
    $(document).on("click", ".editRoleType", function (e) {
        var val=$(this).attr("data-id");
        $.get('{{url('projectcategories')}}'+'/'+val+'/edit',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    })
    $(document).on("click", ".editVisit", function (e) {
        var val=$(this).attr("data-id");
        $.get('{{url('settings/visit/type')}}'+'/'+val+'/edit',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    })
    $(document).on("click", ".editIssue", function (e) {
        var val=$(this).attr("data-id");
        $.get('{{url('settings/issues/type')}}'+'/'+val+'/edit',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    })

        function addFunderType(){
            $.get('{{route('project.donors.types.create')}}',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        }
        $(document).on("click", ".editFunType", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('donors/types')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        })
        $(document).on("click", ".editTask", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('settings/taskType')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        })
function addAchType(){
    $.get('{{route('goals.indicators.measure.unit.create')}}',function(data){
        if(data.status==true) {
            $("#procurementModalBody").html(data.html);
            $('.selectpicker').selectpicker();
            $('#procurementModal').modal({
                show: true
            });
        }
    });
}
    $(document).on("click", ".editAcType", function (e) {
        var val=$(this).attr("data-id");
        $.get('{{url('goals/indicators/measure/units')}}'+'/'+val+'/edit',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    })
    $(document).on("click", ".editRange", function (e) {
        var val=$(this).attr("data-id");
        $.get('{{url('settings/incomeRange')}}'+'/'+val+'/edit',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    })
    $(document).on("click", ".editCurrency", function (e) {
        var val=$(this).attr("data-id");
        $.get('{{url('settings/currency')}}'+'/'+val+'/edit',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    })
    $(document).on("click", ".editRelatedIssue", function (e) {
        var val=$(this).attr("data-id");
        $.get('{{url('settings/issues/related')}}'+'/'+val+'/edit',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    })
    $(document).on("click", ".editAchievement", function (e) {
        var val=$(this).attr("data-id");
        $.get('{{url('settings/achievement/type')}}'+'/'+val+'/edit',function(data){
            if(data.status==true) {
                measure=data.measureUnit;
                $("#render_result").html(data.html);
            }
        });
    })
    function addCurrency() {
        $.get('{{route('settings.currency.create')}}',function(data){
            if(data.status==true) {
                $("#procurementModalBody").html(data.html);
                $('.selectpicker').selectpicker();
                $('#procurementModal').modal({
                    show: true
                });
            }
        });
    }
    function addAch() {
        // $('#loadScreen div.loader').show();
        $.get('{{route('settings.achievement.type.create')}}',function(data){
            if(data.status==true) {
                $("#render_result").html("");
                $("#render_result").html(data.html);
                $('.selectpicker').selectpicker();
                $('#loadScreen div.loader').hide();
            }
        });
    }
    function appendTable(data,status,count,id,cityname,citynamefo){
        var table = document.getElementById("table");
        var count1=count+1;
        // var number = table.rows.length;
        // if($dd==1){
        Body = $("#table tbody");
        if(id==1){
            {{--var url = '{{ route("project.projectcategories.destroy", ":id") }}';--}}
            // url = url.replace(':id', data.id);
var modal="#delete"+data.id;
var modalname="delete"+data.id;
            markup='<tr data-id='+data.id+'><td>'+count1 +'</td><td>'+data.category_name_na+'</td><td>'+data.category_name_fo+'</td><td>'+ status+'</td><td> <a href="#" data-id='+data.id+'\n' +
                '                     class="mytooltip btn-setting-nav editRoleType"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a href="#"\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDelete" data-toggle="modal"\n' +
                '                        data-target='+modal+'\n' +
                '                        data-placement="top"  data-tooltip="tooltip" title=" ">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a></td></tr>'
            var mark='<div class="modal" id='+modalname+' tabindex="-1" role="dialog"\n' +
                '             aria-labelledby="myModalLabel">\n' +
                '            <div class="modal-dialog" role="document">\n' +
                '                <div class="modal-content">\n' +
                '                    <div class="modal-header">\n' +
                '                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span\n' +
                '                                    aria-hidden="true">&times;</span></button>\n' +
                '                        <h4 class="modal-title text-center" id="myModalLabel">Delete Project Category\n' +
                '                            Confirmation</h4>\n' +
                '                    </div><form>\n' +
                '                    <div class="modal-body">\n' +
                '                        <p class="text-center">\n' +
                '                            Are you sure you want to delete this?\n' +
                '                        </p>\n' +
                '                    </div>\n' +
                '                    <div class="modal-footer">\n' +
                '                        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel\n' +
                '                        </button>\n' +
                '                        <button type="submit" class="btn btn-warning yes" data-id="'+data.id+'">Yes, Delete</button>\n' +
                '                    </div>\n' +
                '                    </form>\n' +
                '\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div> <!-- End Modal -->\n';$("#render_result").append(mark);}

        else if(id==2){
            var lang=@json($lang);
            var url = '{{ route("settings.visit.type.delete", ":id") }}';
            url = url.replace(':id', data.id);

            markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.visit_name_na+'</td><td>'+data.visit_name_fo+'</td><td>'+ status+'</td><td> <a href="#" data-id='+data.id+'\n' +
                '                     class="mytooltip btn-setting-nav editVisit"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title="edit"\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a  href='+url+'\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav btnVisitTypeDelete"\n' +
                '                        data-placement="top"  title=" ">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a>\n</td></tr>';

        }
        else if(id==3){
            var lang=@json($lang);
            var url = '{{ route("sectors.delete", ":id") }}';
            url = url.replace(':id', data.id);
            markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.sector_name_na+'</td><td>'+data.sector_name_fo+'</td><td> <a href="#" data-id='+data.id+'\n' +
                '                     class=" mytooltip btn-setting-nav editSector"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a href='+url+'\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteSector"\n' +
                '                        data-placement="top"  title=" ">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a>\n</td></tr>';
        }
        else if(id==4){
            var lang=@json($lang);
            var url = '{{ route("goals.indicators.measure.unit.delete", ":id") }}';
            url = url.replace(':id', data.id);

            markup='<tr data-id='+data.id+'><td colspan="2">'+count1+'</td><td>'+data.unit_name_no+'</td><td> <a data-id='+data.id+'\n' +
                '                     class=" mytooltip btn-setting-nav editAcType"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a  href='+url+'\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav deleteAcType"\n' +
                '                        data-placement="top"  title="">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a>\n</td></tr>';
        }
        else if(id==5){
            var lang=@json($lang);
            {{--var url = '{{ route("purchasemethods.delete", ":id") }}';--}}
            // url = url.replace(':id', data.id);
            markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.income_name_na+'</td><td>'+data.income_name_fo+'</td><td> <a  data-id='+data.id+'\n' +
                '                     class="mytooltip btn-setting-nav editRange"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> </td></tr>';
        }
        else if(id==6){
            var lang=@json($lang);
            var url = '{{ route("settings.currency.delete", ":id") }}';
            url = url.replace(':id', data.id);
            markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.currency_name_na+'</td><td>'+data.currency_name_fo+'</td><td> <a href="#" data-id='+data.id+'\n' +
                '                     class=" mytooltip btn-setting-nav editCurrency"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a href='+url+'\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav btnCDelete"\n' +
                '                        data-placement="top"  title=" ">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a>\n</td></tr>';

        }
        else if(id==7){
            var lang=@json($lang);
            var url = '{{ route("activity.lessons.type.delete", ":id") }}';
            url = url.replace(':id', data.id);
            markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.activity_lessons_type_name_na+'</td><td>'+data.activity_lessons_type_name_fo+'</td><td> <a href="#" data-id='+data.id+'\n' +
                '                     class=" mytooltip btn-setting-nav editIssue"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a href='+url+'\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav  btnIssueDelete"\n' +
                '                        data-placement="top"  title=" ">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a>\n</td></tr>';

        }
        else if(id==8){
            var lang=@json($lang);
            var url = '{{ route("activity.lessons.related.delete", ":id") }}';
            url = url.replace(':id', data.id);
            markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.activity_lessons_related_name_na+'</td><td>'+data.activity_lessons_related_name_fo+'</td><td> <a href="#" data-id='+data.id+'\n' +
                '                     class=" mytooltip btn-setting-nav editRelatedIssue"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a href='+url+'\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav  btnRelatedtDelete"\n' +
                '                        data-placement="top"  title=" ">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a>\n</td></tr>';

        }
        else if(id==9){
            alert(status);
            var lang=@json($lang);
            var url = '{{ route("settings.taskType.delete", ":id") }}';
            url = url.replace(':id', data.id);
            markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.task_type_name_na+'</td><td>'+data.task_type_name_fo+'</td><td>'+status+'</td><td> <a href="#" data-id='+data.id+'\n' +
                '                     class=" mytooltip btn-setting-nav editTask"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a href='+url+'\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav  btnTaskDelete"\n' +
                '                        data-placement="top"  title=" ">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a>\n</td></tr>';

        }
        else if(id==10){
            var lang=@json($lang);
            var url = '{{ route("project.donors.types.destroy", ":id") }}';
            url = url.replace(':id', data.id);
            markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.type_name_na+'</td><td>'+data.type_name_na+'</td><td>'+cityname+'</td><td> <a href="#" data-id='+data.id+'\n' +
                '                     class=" mytooltip btn-setting-nav editFunType"  data-toggle="tooltip" data-placement="top"\n' +
                '                       title=""\n' +
                '                    >\n' +
                '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                '                    </a> <a href='+url+'\n' +
                '                        rel="tooltip" class="mytooltip btn-setting-nav  DeleteDonorType"\n' +
                '                        data-placement="top"  title=" " id="DeleteDonorType">\n' +
                '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                '                </a>\n</td></tr>';

        }
        $(markup).insertAfter("#table tr:first");
        $('#procurementModal').modal('hide');
        // }
    }

    function editRow(data,status,id,cityname,citynamefo){
        var lang=@json($lang);

        if(id==1){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.category_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.category_name_fo);
            $('tr[data-id='+data.id+']').find("td:eq(3)").html(status);

        }
        else if(id==2){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.visit_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.visit_name_fo);
            $('tr[data-id='+data.id+']').find("td:eq(3)").html(status);

        }
        else if(id==3){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.sector_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.sector_name_fo);
        }
        else if(id==4){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.unit_name_no);
        }
        else if(id==5){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.income_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.income_name_fo);
        }
        else if(id==6){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.currency_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.currency_name_fo);
        }
        else if(id==7){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.activity_lessons_type_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.activity_lessons_type_name_fo);
        }
        else if(id==8){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data. activity_lessons_related_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data. activity_lessons_related_name_fo);
        }
        else if(id==10){
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.type_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.type_name_fo);
            $('tr[data-id='+data.id+']').find("td:eq(3)").html(cityname);

        }
        else{
            $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.task_type_name_na);
            $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.task_type_name_fo);
            $('tr[data-id='+data.id+']').find("td:eq(3)").html(status);

        }
        $('#procurementModal').modal('hide');
    }
   function addVisit(){
       $.get('{{route('settings.visit.type.create')}}',function(data){
           if(data.status==true) {
               $("#procurementModalBody").html(data.html);
               $('.selectpicker').selectpicker();
               $('#procurementModal').modal({
                   show: true
               });
           }
       });
    }
    function  index() {
        $.get('{{route('settings.achievement.type')}}',function(data){
            if(data.status==true){
                $("#render_result").html(data.html);
                measure=data.measureUnit;
                $('#loadScreen div.loader').hide();
                var lang=@json($lang);
                if(lang==1)
                    $("#title").html($("#achievement").attr("data-nameeng"));
                else
                    $("#title").html($("#achievement").attr("data-namear"))
                $("#add").html("<a href=\"#\" onclick='addAch()' id='addAch' class=\"mytooltip btn-setting-nav add\"\n" +
                    "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                    "               title=\"\" >\n" +
                    "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Achievement</span></a>\n" +
                    "            </span> </h4>");
                // $('#table').DataTable().ajax.reload();
                DataTableCall('#table',4);
                $("#table_length").html("");
                $("#table_filter").html("");
                        {{--                            @include('setting.c.city.location_script');--}}

                var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                table
                    .order( [0, 'desc' ] )
                    .draw();

            }else{

            }
        });
    }
    function measureVal(){
        return measure;
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